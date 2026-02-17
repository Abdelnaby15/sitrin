<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display products list.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('sort_order', 'asc')->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show form for creating new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stock' => 'required|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['main_image', 'images']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['category_id'] = 1; // Default category

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['main_image'] = 'images/products/' . $imageName;
        }
        
        // Handle additional images
        if ($request->hasFile('images')) {
            $additionalImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $additionalImages[] = 'images/products/' . $imageName;
            }
            $data['images'] = $additionalImages;
        }

        $product = Product::create($data);
        
        ActivityLog::log('created', "Created product: {$product->name}", $product, [
            'sku' => $product->sku,
            'price' => $product->price,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show form for editing product.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product.
     */
    public function update(Request $request, Product $product)
    {
        // Quick update for sort_order only
        if ($request->has('quick_update')) {
            $product->update(['sort_order' => $request->sort_order ?? 0]);
            return back()->with('success', 'Display order updated successfully');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'stock' => 'required|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['main_image', 'images']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($product->main_image && file_exists(public_path($product->main_image))) {
                unlink(public_path($product->main_image));
            }

            $image = $request->file('main_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['main_image'] = 'images/products/' . $imageName;
        }
        
        // Handle additional images
        if ($request->hasFile('images')) {
            // Delete old additional images
            if ($product->images && is_array($product->images)) {
                foreach ($product->images as $oldImage) {
                    if (file_exists(public_path($oldImage))) {
                        unlink(public_path($oldImage));
                    }
                }
            }
            
            $additionalImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $additionalImages[] = 'images/products/' . $imageName;
            }
            $data['images'] = $additionalImages;
        }

        $product->update($data);
        
        ActivityLog::log('updated', "Updated product: {$product->name}", $product);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product.
     */
    public function destroy(Product $product)
    {
        // Delete product image
        if ($product->main_image && file_exists(public_path($product->main_image))) {
            unlink(public_path($product->main_image));
        }
        
        ActivityLog::log('deleted', "Deleted product: {$product->name}", $product, [
            'sku' => $product->sku,
        ]);

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
    
    /**
     * Move product up in order.
     */
    public function moveUp(Product $product)
    {
        $previousProduct = Product::where('sort_order', '<', $product->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();
        
        if (!$previousProduct) {
            $previousProduct = Product::where('id', '<', $product->id)
                ->where('sort_order', $product->sort_order)
                ->orderBy('id', 'desc')
                ->first();
        }
        
        if ($previousProduct) {
            $tempOrder = $product->sort_order;
            $product->sort_order = $previousProduct->sort_order;
            $previousProduct->sort_order = $tempOrder;
            
            $product->save();
            $previousProduct->save();
        }
        
        return back()->with('success', 'Product moved up successfully');
    }
    
    /**
     * Move product down in order.
     */
    public function moveDown(Product $product)
    {
        $nextProduct = Product::where('sort_order', '>', $product->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();
        
        if (!$nextProduct) {
            $nextProduct = Product::where('id', '>', $product->id)
                ->where('sort_order', $product->sort_order)
                ->orderBy('id', 'asc')
                ->first();
        }
        
        if ($nextProduct) {
            $tempOrder = $product->sort_order;
            $product->sort_order = $nextProduct->sort_order;
            $nextProduct->sort_order = $tempOrder;
            
            $product->save();
            $nextProduct->save();
        }
        
        return back()->with('success', 'Product moved down successfully');
    }
    
    /**
     * Reorder products via drag and drop.
     */
    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $index => $productId) {
            Product::where('id', $productId)->update(['sort_order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}
