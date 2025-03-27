<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['items.product', 'store'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get total spent by the user
        $totalSpent = Order::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->sum('total_amount');
        
        // Get total orders by the user
        $totalOrders = Order::where('user_id', $user->id)->count();
        
        // Get recently viewed products (if you have that functionality)
        // For now, let's just get some featured products
        $recommendedProducts = Product::where('is_featured', true)
            ->where('status', 'active')
            ->with(['store', 'images'])
            ->take(4)
            ->get();
            
        return view('user.dashboard', compact(
            'user',
            'recentOrders',
            'totalSpent',
            'totalOrders',
            'recommendedProducts'
        ));
    }
}