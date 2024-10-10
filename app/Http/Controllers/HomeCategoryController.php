<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeCategoryController extends Controller
{
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();

        // Pass the categories to the Blade view
        return view('homepage.home', compact('categories'));
    }
}
