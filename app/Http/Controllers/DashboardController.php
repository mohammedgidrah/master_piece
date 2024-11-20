<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orderitem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
        $instock = Product::where('stock', 'in_stock')->count();
        $outofstock = Product::where('stock',  'out_of_stock')->count();
        // Fetch user count by month for the bar chart

        $registrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->keyBy('month'); // Key results by month for easy lookup

        $monthlyRegistrations = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRegistrations[$i] = $registrations[$i]->count ?? 0;
        }
        // Fetch daily sales for the line chart
        $dailySales = Orderitem::selectRaw('DATE(created_at) as date, SUM(total_price) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_sales', 'date');
            
            $today = Carbon::today();

         return view('dashboard.statestic', [
            'users' => User::count(),
            'categorys' => Category::count(),
            'products' => Product::count(),
            'orders' => Orderitem::count(),
            'sales' =>  Orderitem::whereDate('created_at', $today)->sum('total_price'),
             'dailySales' => $dailySales,
            'monthlyRegistrations' => $monthlyRegistrations,
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'instock' => $instock,
            'outofstock' => $outofstock,
            'registrations' => $registrations,
        ]);
    }
}
