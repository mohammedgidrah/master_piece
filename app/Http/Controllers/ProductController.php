<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20;
        }
        $query = Product::query();
        $stockFilter = $request->input('stock');
        if ($stockFilter) {
            $query->where('stock', $stockFilter);
        }
        $search = $request->input('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate($perPage);
        $totalProducts = Product::count();

        return view('dashboard.products.index', compact('products', 'totalProducts'));
    }
    public function trashed(Request $request)
    {
        $totaltrashedproducts= Product::onlyTrashed()->count();
     
        // Fetch trashed users with pagination
        $products = Product::onlyTrashed()->paginate(5);
    
        return view('dashboard.products.trashed', compact('products', 'totaltrashedproducts'));
    }

    public function restore($id)
    {
        $products = Product::onlyTrashed()->findOrFail($id);
        $products->restore();

        return redirect()->route('products.trashed')->with('success', 'Product restored successfully.');
    }
    public function forceDelete($id)
    {
        $products = Product::onlyTrashed()->findOrFail($id);
        $products->forceDelete();

        return redirect()->route('products.trashed')->with('success', 'Product permanently deleted.');
    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
 
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|in:in_stock,out_of_stock',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

 

    public function show($id)
    {
        $products = User::onlyTrashed()->findOrFail($id); // Fetch the trashed products by ID
        return view('dashboard.products.trashed', compact('products'));
    }
    

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|in:in_stock,out_of_stock',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $product = Product::findOrFail($id);

        $currentImagePath = $product->image;

        if ($request->hasFile('image')) {

            if ($currentImagePath && \Storage::disk('public')->exists($currentImagePath)) {
                \Storage::disk('public')->delete($currentImagePath);
            }

            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $product->image = $imagePath;
        } else {

            $product->image = $currentImagePath;
        }

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

}
