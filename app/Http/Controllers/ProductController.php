<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('is_parent', 1)->get();
        // return $category;
        return view('backend.product.create')->with('categories', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $file = $request->file('photo');
        if ($request->hasFile('mainfile')) {
            try {
                $destinationPath = 'Digital';
                $mainfile = $request->file('mainfile');

                // Generate a unique filename
                $filename = time() . '_' .   $mainfile->getClientOriginalName();

                // Move the file to the specified directory
                $mainfile->move(public_path($destinationPath), $filename);

                // Save the file path in the $data array
                $data['mainfile'] = $destinationPath . '/' . $filename;
            } catch (\Exception $e) {
                // Handle any errors during the upload process
                return redirect()->back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        }

        if ($file) {
            // Generate a unique filename based on current time
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos/Product'), $filename);

            // Get the URL of the stored file
            $data['photo'] = 'photos/Product/' . $filename;
        }
        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);

        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        // return $items;
        return view('backend.product.edit')->with('product', $product)
            ->with('categories', $category)->with('items', $items);
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
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        if ($request->hasFile('mainfile')) {
            try {
                $destinationPath = 'Digital';
                $mainfile = $request->file('mainfile');

                // Generate a unique filename
                $filename = time() . '_' .   $mainfile->getClientOriginalName();

                // Move the file to the specified directory
                $mainfile->move(public_path($destinationPath), $filename);

                // Save the file path in the $data array
                $data['mainfile'] = $destinationPath . '/' . $filename;
            } catch (\Exception $e) {
                // Handle any errors during the upload process
                return redirect()->back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        }
        $file = $request->file('photo');
        if ($file) {
            // Generate a unique filename based on current time
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos/Product'), $filename);

            // Get the URL of the stored file
            $data['photo'] = 'photos/Product/' . $filename;
        }
        $data['is_featured'] = $request->input('is_featured', 0);

        // return $data;
        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Product updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'Product deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
