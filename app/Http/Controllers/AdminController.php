<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function mainDashboard()
    {
        return view('dashboard.statestic'); // Ensure this view exists
    }
}
