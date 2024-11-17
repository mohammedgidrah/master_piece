<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Ensure this controller uses the 'auth' middleware to check for authenticated users
    public function __construct()
    {
        // Apply auth middleware to all methods in this controller
        $this->middleware('auth'); // This ensures the user is logged in
    }

    public function mainDashboard()
    {
        return view('dashboard.statestic'); // Ensure this view exists
    }

    public function index()
    {
        // Check if the user is logged in and is an admin
        if (Auth::check() && !auth()->user()->isAdmin()) {
            // Redirect regular users away from the dashboard
            return redirect('/unauthorized'); // You can define a custom unauthorized route
        }

        // If user is an admin, proceed with the dashboard logic
        return view('dashboard.maindasboard');
    }
}
    