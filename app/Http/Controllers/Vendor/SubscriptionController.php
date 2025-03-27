<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('vendor.subscription.index');
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
