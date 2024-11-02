<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Make sure your Order model is set up correctly

class NavController extends Controller
{
    // Method to get the cart count for the authenticated user
    public function index()
    {
        // Count orders for the authenticated user
        $cartCount = auth()->check() ? Order::where('customer_id', auth()->id())->count() : 0;
        return view('homepage.homenav.homenav', compact('cartCount'));
    }
}
