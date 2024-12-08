<?php

namespace App\Http\Controllers;

use App\Mail\ReceiptEmail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('backend.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'address1' => 'string|required',
            'address2' => 'string|nullable',
            'phone' => 'numeric|required',
            'email' => 'string|required',
            'shipping' => 'required'
        ]);
        if (empty(Cart::where('user_id', auth()->user()->id)->where('order_id', null)->first())) {
            request()->session()->flash('error', 'Cart is Empty !');
            return back();
        }
        $order = new Order();
        $order_data = $request->all();
        $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $order_data['user_id'] = $request->user()->id;
        $order_data['shipping_id'] = $request->shipping;
        $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
        $order_data['sub_total'] = Helper::totalCartPrice();
        $order_data['quantity'] = Helper::cartCount();
        if (session('coupon')) {
            $order_data['coupon'] = session('coupon')['value'];
        }
        $total_amount = 0;
        if ($request->shipping) {
            if (session('coupon')) {
                $total_amount = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
            } else {
                $total_amount = Helper::totalCartPrice() + $shipping[0];
            }
        } else {
            if (session('coupon')) {
                $total_amount = Helper::totalCartPrice() - session('coupon')['value'];
            } else {
                $total_amount = Helper::totalCartPrice();
            }
        }
        $order_data['total_amount'] = $total_amount;
        $order_data['payment_status'] = 'unpaid';
        $order_data['payment_method'] = 'stripe';
        $order->fill($order_data);
        $status = $order->save();
        if (!$status) {
            // Handle error saving order
            return back()->with('error', 'Error placing order. Please try again.');
        }
        $stripe = new \Stripe\StripeClient('sk_test_wsFx86XDJWwmE4dMskBgJYrt');
        $redirectUrl = route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}' . '&order_id=' . $order->id;
        $cancelurl = route('stripe.cancel') . '?order_id=' . $order->id;
        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'cancel_url' => $cancelurl,
            'customer_email' => $request->email,

            'payment_method_types' => ['link', 'card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => 'Museum Artefacts',
                        ],
                        'unit_amount' => round($total_amount) * 100,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => false,
        ]);
        session()->forget('cart');
        session()->forget('coupon');
        return redirect($response['url']);
    }

    public function StripeSuccess(Request $request)
    {
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $request->order_id]);
        $order = Order::where('id', $request->order_id)->first();
        $order->payment_status = 'paid';
        $order->save();
        $stripe = new \Stripe\StripeClient('sk_test_wsFx86XDJWwmE4dMskBgJYrt');
        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        //Mail::to($order['email'])->send(new ReceiptEmail($order));
        return redirect()->route('home')
            ->with('success', 'Payment successful and Order Placed.');
    }

    public function StripeCancel(Request $request)
    {
        Order::where('id', $request->order_id)->delete();
        return redirect()->route('checkout')
            ->with('error', 'Payment Cancelled.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        // return $order;
        return view('backend.order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $this->validate($request, [
            'status' => 'required|in:new,process,delivered,cancel'
        ]);
        $data = $request->all();
        // return $request->status;
        if ($request->status == 'delivered') {
            foreach ($order->cart as $cart) {
                $product = $cart->product;
                // return $product;
                $product->stock -= $cart->quantity;
                $product->save();
            }
        }
        $status = $order->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Successfully updated order');
        } else {
            request()->session()->flash('error', 'Error while updating order');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $status = $order->delete();
            if ($status) {
                request()->session()->flash('success', 'Order Successfully deleted');
            } else {
                request()->session()->flash('error', 'Order can not deleted');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Order can not found');
            return redirect()->back();
        }
    }

    // Income chart
    public function incomeChart(Request $request)
    {
        $year = \Carbon\Carbon::now()->year;
        // dd($year);
        $items = Order::with(['cart_info'])->whereYear('created_at', $year)->where('status', 'delivered')->get()
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
        // dd($items);
        $result = [];
        foreach ($items as $month => $item_collections) {
            foreach ($item_collections as $item) {
                $amount = $item->cart_info->sum('amount');
                // dd($amount);
                $m = intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}
