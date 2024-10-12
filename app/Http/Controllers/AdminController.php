<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function mainDashboard()
    {
        return view('dashboard.statestic'); // Ensure this view exists
    }
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            // Redirect regular users away from the dashboard
            return redirect('/unauthorized');
        }

        // Proceed with the dashboard logic for admins
        return view('dashboard.maindasboard');
    }

}
