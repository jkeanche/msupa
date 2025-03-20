<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function adminDashboard()
    {
        // Admin dashboard stats
        $totalUsers = User::count();
        $totalStores = Store::count();
        $totalSales = Transaction::query()->sum('amount');
      
        $recentTransactions = Transaction::with('user')->orderBy('created_at', 'desc')->take(10)->get();
        $storesByMonth = Store::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();
            
        $pendingOrders = Order::where('status', 'pending')->count();

       
        
        return view('admin.dashboard.index', compact(
            'totalUsers', 
            'totalStores', 
            'totalSales', 
            'recentTransactions',
            'storesByMonth',
            'pendingOrders'
        ));
    }
    
    /**
     * Display the store owner dashboard.
     */
    public function ownerDashboard()
    {
        $store = Auth::user()->store;
        
        if (!$store) {
            return view('stores.create');
        }
        
        // Store owner dashboard stats
        $totalProducts = $store->products()->count();
        $totalOrders = $store->orders()->count();
        $totalSales = $store->orders()->where('status', 'delivered')->sum('total');
        $recentOrders = $store->orders()->with('customer')->orderBy('created_at', 'desc')->take(5)->get();
        $lowStockProducts = $store->products()->where('stock_quantity', '<=', 5)->get();
        $subscription = Auth::user()->subscription;
        
        // Chart data
        $salesByDay = $store->orders()
            ->where('status', 'delivered')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->get();
            
        return view('dashboard.owner', compact(
            'store',
            'totalProducts',
            'totalOrders',
            'totalSales',
            'recentOrders',
            'lowStockProducts',
            'subscription',
            'salesByDay'
        ));
    }
    
    /**
     * Display the customer dashboard.
     */
    public function customerDashboard()
    {
        // Customer dashboard stats
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->take(5)->get();
        $totalSpent = Auth::user()->orders()->where('status', 'delivered')->sum('total');
        $pendingOrders = Auth::user()->orders()->where('status', 'pending')->count();
        $recentlyViewedProducts = session()->get('recently_viewed_products', []);
        
        if (!empty($recentlyViewedProducts)) {
            $recentProducts = Product::whereIn('id', $recentlyViewedProducts)->get();
        } else {
            $recentProducts = collect([]);
        }
        
        return view('dashboard.customer', compact(
            'orders',
            'totalSpent',
            'pendingOrders',
            'recentProducts'
        ));
    }
}
