<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payments.index');
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('admin.payments.index')->with('success', 'Payment created successfully');
    }

    public function show($id)
    {
        return view('admin.payments.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.payments.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully');
    }
}
