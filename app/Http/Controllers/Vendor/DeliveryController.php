<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('vendor.deliveries.index');
    }

    public function create()
    {
        return view('vendor.deliveries.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.deliveries.index')->with('success', 'Delivery created successfully');
    }

    public function show($id)
    {
        return view('vendor.deliveries.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.deliveries.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.deliveries.index')->with('success', 'Delivery updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.deliveries.index')->with('success', 'Delivery deleted successfully');
    }
}
