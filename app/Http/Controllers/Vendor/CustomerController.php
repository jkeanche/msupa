<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('vendor.customers.index');
    }

    public function create()
    {
        return view('vendor.customers.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.customers.index')->with('success', 'Customer created successfully');
    }

    public function show($id)
    {
        return view('vendor.customers.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.customers.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.customers.index')->with('success', 'Customer deleted successfully');
    }
}
