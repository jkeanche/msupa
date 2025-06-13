<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Invoice;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $store = $user->store;
        
        // Get current subscription
        $currentPlan = null;
        if ($store) {
            $currentPlan = Subscription::where('store_id', $store->id)
                ->where(function($query) {
                    $query->where('status', 'active')
                          ->orWhere('status', 'pending')
                          ->orWhere(function($q) {
                              $q->where('status', 'expired')
                                ->where('end_date', '>=', now()->subDays(30));
                          });
                })
                ->latest()
                ->first();
        }
        
        // Get available subscription plans
        $availablePlans = SubscriptionPlan::where('is_active', true)->get();
        
        // Get billing history
        $invoices = [];
        if ($store) {
            $invoices = Invoice::where('store_id', $store->id)
                ->latest()
                ->paginate(10);
        }
        
        return view('vendor.subscription.index', compact('currentPlan', 'availablePlans', 'invoices'));
    }

    public function create()
    {
        return view('vendor.subscription.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.subscription.index')->with('success', 'Subscription created successfully');
    }

    public function show($id)
    {
        return view('vendor.subscription.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.subscription.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.subscription.index')->with('success', 'Subscription updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.subscription.index')->with('success', 'Subscription deleted successfully');
    }
}
