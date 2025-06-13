<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of stores.
     */
    public function index(Request $request)
    {
        $query = Store::with(['owner', 'subscription']);
        
        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }
        
        if ($request->has('subscription_status') && $request->subscription_status !== '') {
            $query->whereHas('subscription', function($q) use ($request) {
                $q->where('status', $request->subscription_status);
            });
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('owner', function($ownerQuery) use ($search) {
                      $ownerQuery->where('name', 'like', "%{$search}%")
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
        
        // Sort stores
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);
        
        $stores = $query->paginate(15);
        
        // Get statistics
        $stats = [
            'total_stores' => Store::count(),
            'active_stores' => Store::where('is_active', true)->count(),
            'inactive_stores' => Store::where('is_active', false)->count(),
            'with_active_subscription' => Store::whereHas('subscription', function($q) {
                $q->where('status', 'active');
            })->count(),
        ];
        
        // Get filter data
        $subscriptionStatuses = ['active', 'pending', 'expired', 'cancelled'];
        
        return view('admin.stores.index', compact('stores', 'stats', 'subscriptionStatuses'));
    }

    /**
     * Display the specified store.
     */
    public function show(Store $store)
    {
        $store->load(['owner', 'subscription.plan', 'products', 'categories']);
        
        // Get store statistics
        $storeStats = [
            'total_products' => $store->products()->count(),
            'active_products' => $store->products()->where('is_active', true)->count(),
            'total_categories' => $store->categories()->count(),
            'total_orders' => $store->orders()->count(),
            'monthly_revenue' => $store->orders()
                ->where('payment_status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('total_amount'),
        ];
        
        return view('admin.stores.show', compact('store', 'storeStats'));
    }

    /**
     * Show the form for editing the specified store.
     */
    public function edit(Store $store)
    {
        $store->load(['owner', 'subscription']);
        $owners = User::where('role', 'vendor')->get();
        
        return view('admin.stores.edit', compact('store', 'owners'));
    }

    /**
     * Update the specified store in storage.
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        
        $store->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);
        
        return redirect()->route('admin.stores.index')
            ->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified store from storage.
     */
    public function destroy(Store $store)
    {
        // Check if store has active orders
        if ($store->orders()->whereIn('status', ['pending', 'processing', 'shipped'])->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete store with active orders.');
        }
        
        $store->delete();
        
        return redirect()->route('admin.stores.index')
            ->with('success', 'Store deleted successfully.');
    }

    /**
     * Toggle store status (activate/deactivate).
     */
    public function toggleStatus(Store $store)
    {
        $store->update(['is_active' => !$store->is_active]);
        
        $status = $store->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Store {$status} successfully.");
    }

    /**
     * Export stores data to CSV.
     */
    public function export(Request $request)
    {
        $query = Store::with(['owner', 'subscription']);
        
        // Apply same filters as index
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }
        
        if ($request->has('subscription_status') && $request->subscription_status !== '') {
            $query->whereHas('subscription', function($q) use ($request) {
                $q->where('status', $request->subscription_status);
            });
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        $stores = $query->get();
        
        $filename = 'stores_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($stores) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Owner',
                'Owner Email',
                'Status',
                'Subscription Status',
                'Created At',
            ]);
            
            // CSV data
            foreach ($stores as $store) {
                fputcsv($file, [
                    $store->id,
                    $store->name,
                    $store->email,
                    $store->phone,
                    $store->owner->name ?? 'N/A',
                    $store->owner->email ?? 'N/A',
                    $store->is_active ? 'Active' : 'Inactive',
                    $store->subscription->status ?? 'No Subscription',
                    $store->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
} 