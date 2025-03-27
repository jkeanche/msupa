<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('admin.subscriptions.index');
    }

    public function create()
    {
        return view('admin.subscriptions.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully');
    }

    public function show($id)
    {
        return view('admin.subscriptions.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.subscriptions.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted successfully');
    }
}
