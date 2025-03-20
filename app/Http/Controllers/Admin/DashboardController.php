<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalStores = Store::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalSales = Order::where('payment_status', 'paid')->sum('total_amount');
        $recentOrders = Order::with(['user'])->latest()->take(10)->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalVendors',
            'totalStores',
            'totalProducts',
            'totalOrders',
            'totalSales',
            'recentOrders'
        ));
    }
}