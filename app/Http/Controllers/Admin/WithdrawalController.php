<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        return view('admin.withdrawals.index');
    }

    public function create()
    {
        return view('admin.withdrawals.create');
    }

    public function store(Request $request)
    {
        // Store withdrawal logic
        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal created successfully');
    }

    public function show($id)
    {
        return view('admin.withdrawals.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.withdrawals.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update withdrawal logic
        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal updated successfully');
    }

    public function destroy($id)
    {
        // Delete withdrawal logic
        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal deleted successfully');
    }
} 