<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories
    public function index(Request $request)
    {

         $perPage = $request->input('per_page', 5);

        // Cap the maximum number of users displayed to 20
        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20; // Limit to 20 when 'all' is selected
        }

         $search = $request->input('search');

        $query = Category::query();

        // Apply role filter if provided
        // if ($roleFilter) {
        //     $query->where('role', $roleFilter);
        // }

        // Apply search filter if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
  
            });
        }

        // Get users with pagination
        $categories = $query->paginate($perPage);
        $totalcategories = Category::count();

        return view('dashboard.categories.index', compact('categories', 'totalcategories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('dashboard.categories.create');
    }

    // Store a newly created category in storage
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
    
        // Create a new user
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Display the specified category
    // public function show(Category $category)
    // {
    //     return view('categories.show', compact('category'));
    // }

    // Show the form for editing the specified category
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    // Update the specified category in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);
    
        $category = Category::findOrFail($id);
        
        // Store the current image path to retain it if no new image is uploaded
        $currentImagePath = $category->image;
    
        // Handle file upload if exists
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($currentImagePath && \Storage::disk('public')->exists($currentImagePath)) {
                \Storage::disk('public')->delete($currentImagePath);
            }
    
            // Store the new image
            $imagePath = $request->file('image')->store('uploads/categories', 'public');
            $category->image = $imagePath; // Update the category's image path to the new image
        } else {
            // If no new image was uploaded, retain the current image path
            $category->image = $currentImagePath;
        }
    
        // Update other fields
        $category->name = $request->name;
        $category->description = $request->description;
    
        // Save the changes to the database
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    
    // Remove the specified category from storage
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
