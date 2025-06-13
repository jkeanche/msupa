<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'store', 'items']);
        
        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('payment_status') && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }
        
        if ($request->has('store') && $request->store !== '') {
            $query->where('store_id', $request->store);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($customerQuery) use ($search) {
                      $customerQuery->where('name', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Sort orders
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);
        
        $orders = $query->paginate(15);
        
        // Get data for filters
        $stores = Store::where('is_active', true)->get();
        $orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        
        return view('admin.orders.index', compact('orders', 'stores', 'orderStatuses', 'paymentStatuses'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'store', 'items.product', 'transactions']);
        
        // Get order status history
        $orderStatuses = OrderStatus::where('order_id', $order->id)
            ->latest()
            ->get();
        
        return view('admin.orders.show', compact('order', 'orderStatuses'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $order->load(['customer', 'store', 'items.product']);
        $stores = Store::where('is_active', true)->get();
        $orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        
        return view('admin.orders.edit', compact('order', 'stores', 'orderStatuses', 'paymentStatuses'));
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $request->status;
        
        // Update order
        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
            'shipping_cost' => $request->shipping_cost,
            'notes' => $request->notes,
        ]);
        
        // Create status history entry if status changed
        if ($oldStatus !== $newStatus) {
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => $newStatus,
                'comments' => "Status changed from {$oldStatus} to {$newStatus} by admin",
            ]);
        }
        
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,refunded',
            'comments' => 'nullable|string|max:500',
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $request->status;
        
        if ($oldStatus !== $newStatus) {
            // Update order status
            $order->update(['status' => $newStatus]);
            
            // Create status history entry
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => $newStatus,
                'comments' => $request->comments ?? "Status changed from {$oldStatus} to {$newStatus} by admin",
            ]);
            
            return redirect()->back()->with('success', 'Order status updated successfully.');
        }
        
        return redirect()->back()->with('info', 'No changes made to order status.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Only allow deletion of cancelled or refunded orders
        if (!in_array($order->status, ['cancelled', 'refunded'])) {
            return redirect()->back()
                ->with('error', 'Only cancelled or refunded orders can be deleted.');
        }
        
        DB::transaction(function () use ($order) {
            // Delete related records
            $order->items()->delete();
            $order->transactions()->delete();
            OrderStatus::where('order_id', $order->id)->delete();
            
            // Delete the order
            $order->delete();
        });
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    /**
     * Get order statistics for dashboard.
     */
    public function getStatistics()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'today_revenue' => Order::whereDate('created_at', today())
                ->where('payment_status', 'paid')
                ->sum('total_amount'),
        ];
        
        return response()->json($stats);
    }

    /**
     * Export orders to CSV.
     */
    public function export(Request $request)
    {
        $query = Order::with(['customer', 'store', 'items.product']);
        
        // Apply same filters as index method
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('payment_status') && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }
        
        if ($request->has('store') && $request->store !== '') {
            $query->where('store_id', $request->store);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($customerQuery) use ($search) {
                      $customerQuery->where('name', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        $filename = 'orders_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Order ID',
                'Order Number',
                'Customer Name',
                'Customer Email',
                'Store Name',
                'Total Amount',
                'Discount Amount',
                'Shipping Cost',
                'Status',
                'Payment Status',
                'Payment Method',
                'Order Date',
                'Items Count',
                'Shipping Address',
                'Notes'
            ]);
            
            // Add order data
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->order_number ?? '#' . $order->id,
                    $order->customer->name ?? 'N/A',
                    $order->customer->email ?? 'N/A',
                    $order->store->name ?? 'N/A',
                    $order->total_amount,
                    $order->discount_amount ?? 0,
                    $order->shipping_cost ?? 0,
                    ucfirst($order->status),
                    ucfirst($order->payment_status ?? 'pending'),
                    $order->payment_method ?? 'N/A',
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->items->count(),
                    $order->shipping_address ?? 'N/A',
                    $order->notes ?? 'N/A'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
} 