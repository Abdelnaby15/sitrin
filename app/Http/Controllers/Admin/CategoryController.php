<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display categories list.
     */
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show form for creating new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store new category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show form for editing category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category.
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with products.');
        }

        // Delete category image
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
