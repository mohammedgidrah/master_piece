<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Sale;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetching the data from the database (use actual table/model names)
        $users = User::count(); // Example: Count the number of users
        $categorys = Category::count(); // Example: Count the number of categorys
        // $sales = orde::sum('amount'); // Example: Total sales
        $orders = OrderItem::count(); // Example: Count the number of orders

        // Passing the data to the view
        return view('dashboard.statestic', compact('users', 'categorys' , 'orders'));
    }
}
