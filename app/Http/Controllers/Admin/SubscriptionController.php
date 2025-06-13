<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscription::with(['store', 'plan']);
        
        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('plan') && $request->plan !== '') {
            $query->where('subscription_plan_id', $request->plan);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('store', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Sort by latest
        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get statistics
        $stats = [
            'active' => Subscription::where('status', 'active')->count(),
            'pending' => Subscription::where('status', 'pending')->count(),
            'expired' => Subscription::where('status', 'expired')->count(),
            'revenue' => Subscription::where('status', 'active')
                ->where('start_date', '>=', now()->startOfMonth())
                ->sum('amount_paid')
        ];
        
        // Get all plans for filter dropdown
        $plans = SubscriptionPlan::where('is_active', true)->get();
        
        return view('admin.subscriptions.index', compact('subscriptions', 'stats', 'plans'));
    }

    public function create()
    {
        $stores = Store::where('is_active', true)->get();
        $plans = SubscriptionPlan::where('is_active', true)->get();
        
        return view('admin.subscriptions.create', compact('stores', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,pending,expired,canceled',
            'payment_status' => 'required|in:paid,unpaid,refunded',
            'amount_paid' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'auto_renew' => 'boolean',
        ]);
        
        Subscription::create($validated);
        
        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription created successfully');
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['store', 'plan']);
        
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        $stores = Store::where('is_active', true)->get();
        $plans = SubscriptionPlan::where('is_active', true)->get();
        
        return view('admin.subscriptions.edit', compact('subscription', 'stores', 'plans'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,pending,expired,canceled',
            'payment_status' => 'required|in:paid,unpaid,refunded',
            'amount_paid' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'auto_renew' => 'boolean',
        ]);
        
        $subscription->update($validated);
        
        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully');
    }

    public function destroy(Subscription $subscription)
    {
        // Only allow canceling active subscriptions
        if ($subscription->status === 'active') {
            $subscription->update([
                'status' => 'canceled',
                'canceled_at' => now(),
            ]);
            
            return redirect()->route('admin.subscriptions.index')
                ->with('success', 'Subscription canceled successfully');
        }
        
        return redirect()->route('admin.subscriptions.index')
            ->with('error', 'Only active subscriptions can be canceled');
    }
    
    public function export(Request $request)
    {
        $query = Subscription::with(['store', 'plan']);
        
        // Apply same filters as index
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('plan') && $request->plan !== '') {
            $query->where('subscription_plan_id', $request->plan);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('store', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $subscriptions = $query->orderBy('created_at', 'desc')->get();
        
        $filename = 'subscriptions_' . now()->format('Y_m_d_H_i_s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Store Name',
                'Store Email',
                'Plan Name',
                'Status',
                'Payment Status',
                'Start Date',
                'End Date',
                'Amount Paid',
                'Transaction ID',
                'Payment Method',
                'Auto Renew',
                'Created At'
            ]);
            
            // CSV data
            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->id,
                    $subscription->store->name ?? 'N/A',
                    $subscription->store->email ?? 'N/A',
                    $subscription->plan->name ?? 'N/A',
                    ucfirst($subscription->status),
                    ucfirst($subscription->payment_status),
                    $subscription->start_date ? $subscription->start_date->format('Y-m-d H:i:s') : 'N/A',
                    $subscription->end_date ? $subscription->end_date->format('Y-m-d H:i:s') : 'N/A',
                    $subscription->amount_paid,
                    $subscription->transaction_id ?? 'N/A',
                    $subscription->payment_method ?? 'N/A',
                    $subscription->auto_renew ? 'Yes' : 'No',
                    $subscription->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
