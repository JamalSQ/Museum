<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* Add your CSS styles for the email here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
            color: #555;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3 {
            color: #333;
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        .order-details {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .product-details {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .product-details p {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total {
            margin-top: 20px;
            font-size: 1.2em;
            color: #333;
        }

        .thank-you {
            margin-top: 20px;
            font-style: italic;
            color: #666;
        }

        .card {
            background-color: #28a745;
            /* Green background color */
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
        <p><img src="https://cosmoseworld.fr/photos/Logo/logo.png" alt="Cosmose World Logo" style="max-width: 200px; display: inline-block; vertical-align: middle;"> Thanks for your order, {{ $order->user->name }}.</p>
            <p>Explore your new product and let us know if you need any help. We're here for you 24/7. And when you feel like you're ready for more, we have tools that'll take you even further online.</p>
            <p><a href="link_to_my_products" style="color: white; text-decoration: none; background-color: #fd7e14; padding: 10px 20px; border-radius: 5px;">Go to My Products</a></p>
        </div>
        <div class="order-details">
            <h2>Order Details</h2>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('h:i A, l, d-F-Y') }}</p>
            <div class="product-details">
                <h3>Products:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->cart as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->title }}</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>${{ $cartItem->price }}</td>
                            <td>${{ $cartItem->quantity * $cartItem->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p><strong>Shipping:</strong> {{ $order->shipping->type }}</p>
            <p><strong>Shipping Fee:</strong> ${{ $order->shipping->price }}</p>
            @if($order->coupon)
            <p><strong>*You Saved:</strong> $ {{ $order->coupon }} <strong> By Using Discount Coupon</strong> </p>
            @endif
            <p class="total"><strong>Total:</strong> ${{ $order->total_amount }}</p>
        </div>
        <div style="background-color: #28a745; padding: 20px; color: white; text-align: center;">
            <p>&copy; {{ date('Y') }} Cosmose World. All rights reserved.</p>
            <p>If you have any questions, please <a href="contact" style="color: white; text-decoration: underline;">contact us</a>.</p>
        </div>

    </div>
</body>

</html>