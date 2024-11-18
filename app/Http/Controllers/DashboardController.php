<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orderitem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch user count by month for the bar chart
        $userStatistics = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');

        // Fetch daily sales for the line chart
        $dailySales = Orderitem::selectRaw('DATE(created_at) as date, SUM(total_price) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_sales', 'date');

        return view('dashboard.statestic', [
            'users' => User::count(),
            'categorys' => Category::count(),
            'products' => Product::count(),
            'orders' => Orderitem::count(),
            'sales' => Orderitem::sum('total_price'),
            'userStatistics' => $userStatistics,
            'dailySales' => $dailySales,
        ]);
    }
}
