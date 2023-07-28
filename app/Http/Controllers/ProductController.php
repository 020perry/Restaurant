<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'info' => 'required',
            'price' => 'required|numeric',
        ]);

        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);

        return redirect()->route('products.index');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Validate the $id to ensure it's a positive integer
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('products.index')->withErrors('Invalid product ID');
        }

        // Attempt to find the product
        $product = Product::find($id);

        // If the product was not found, redirect back to the product index page with an error message
        if ($product === null) {
            return redirect()->route('products.index')->withErrors('Product not found');
        }

        // Return the product show view with the product data
        return view('products.show', ['product' => $product]);
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'info' => 'required',
            'price' => 'required|numeric',
        ]);

        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // You may wish to add checks here to prevent deletion of products in certain situations

        $product->delete();

        return redirect()->route('products.index');
    }

}
