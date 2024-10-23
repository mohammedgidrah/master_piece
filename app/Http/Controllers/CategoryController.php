<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{

    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 5);

        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20;
        }

        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');

            });
        }

        $categories = $query->paginate($perPage);
        $totalcategories = Category::count();

        return view('dashboard.categories.index', compact('categories', 'totalcategories'));
    }

    public function trashed(Request $request)
    {
        $totaltrashedcategories= Category::onlyTrashed()->count();
     
        // Fetch trashed users with pagination
        $categories = Category::onlyTrashed()->paginate(5);
    
        return view('dashboard.categories.trashed', compact('categories', 'totaltrashedcategories'));
    }

    public function restore($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();

        return redirect()->route('categories.trashed')->with('success', 'Category restored successfully.');
    }
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();

        return redirect()->route('categories.trashed')->with('success', 'Category permanently deleted.');
    }
    public function show($id)
    {
        // Retrieve the category
        $category = Category::findOrFail($id);

        // Fetch products related to the category
        $products = Product::where('category_id', $id)->get();

        // Return a view with the category and products
        return view('homepage.products.index', compact('category', 'products'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',

        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $category = Category::findOrFail($id);

        $currentImagePath = $category->image;

        if ($request->hasFile('image')) {

            if ($currentImagePath && \Storage::disk('public')->exists($currentImagePath)) {
                \Storage::disk('public')->delete($currentImagePath);
            }

            $imagePath = $request->file('image')->store('uploads/categories', 'public');
            $category->image = $imagePath;
        } else {

            $category->image = $currentImagePath;
        }

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
