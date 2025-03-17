<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;
        
        if (!$store) {
            return redirect()->route('vendor.stores.create')->with('info', 'Please create your store first.');
        }
        
        $totalProducts = Product::where('store_id', $store->id)->count();
        $totalOrders = OrderItem::where('store_id', $store->id)->distinct('order_id')->count();
        $totalSales = OrderItem::where('store_id', $store->id)
            ->whereHas('order', function ($query) {
                $query->where('payment_status', 'paid');
            })
            ->sum('total');
        
        $recentOrders = OrderItem::with(['order', 'product'])
            ->where('store_id', $store->id)
            ->latest()
            ->take(10)
            ->get()
            ->groupBy('order_id');
        
        $balance = $store->balanceFloat;

        return view('vendor.dashboard', compact(
            'store',
            'totalProducts',
            'totalOrders',
            'totalSales',
            'recentOrders',
            'balance'
        ));
    }
}
