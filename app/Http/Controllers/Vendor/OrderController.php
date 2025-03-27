<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;
        
     
        $orderItems = OrderItem::where('store_id', $store->id)
            ->with(['order', 'product'])
            ->latest()
            ->get()
            ->groupBy('order_id');
            
        return view('vendor.orders.index', compact('store','orderItems'));
    }
    
    public function show($orderId)
    {
        $store = Auth::user()->store;
        
        $order = Order::findOrFail($orderId);
        $orderItems = OrderItem::where('order_id', $orderId)
            ->where('store_id', $store->id)
            ->with('product')
            ->get();
            
        if ($orderItems->isEmpty()) {
            return abort(404);
        }
        
        $orderStatuses = OrderStatus::where('order_id', $orderId)->latest()->get();
        
        return view('vendor.orders.show', compact('order', 'orderItems', 'orderStatuses'));
    }
    
    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'comments' => 'nullable|string',
        ]);
        
        $store = Auth::user()->store;
        
        // Check if this vendor has items in this order
        $hasItems = OrderItem::where('order_id', $orderId)
            ->where('store_id', $store->id)
            ->exists();
            
        if (!$hasItems) {
            return abort(403);
        }
        
        // Create a new order status entry
        $status = new OrderStatus();
        $status->order_id = $orderId;
        $status->status = $request->status;
        $status->comments = $request->comments;
        $status->save();
        
        // Update the order's main status
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}