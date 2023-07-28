<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    // Add methods for create, store, show, edit, update, and destroy...


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create($validated);

        return redirect()->route('categories.index');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Validate the $id to ensure it's a positive integer
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('categories.index')->withErrors('Invalid category ID');
        }

        // Attempt to find the category
        $category = Category::find($id);

        // If the category was not found, redirect back to the category index page with an error message
        if ($category === null) {
            return redirect()->route('categories.index')->withErrors('Category not found');
        }

        // Return the category show view with the category data
        return view('categories.show', ['category' => $category]);
    }


    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id.'|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // You may wish to add checks here to prevent deletion of categories with related products

        $category->delete();

        return redirect()->route('categories.index');
    }

}
