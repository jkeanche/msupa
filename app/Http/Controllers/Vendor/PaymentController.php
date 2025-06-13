<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('vendor.payments.index');
    }

    public function create()
    {
        return view('vendor.payments.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.payments.index')->with('success', 'Payment created successfully');
    }

    public function show($id)
    {
        return view('vendor.payments.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.payments.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.payments.index')->with('success', 'Payment updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.payments.index')->with('success', 'Payment deleted successfully');
    }
}
