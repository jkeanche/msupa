<?php

// app/Http/Controllers/Vendor/WithdrawalController.php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = WithdrawalRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('vendor.withdrawals.index', compact('withdrawals'));
    }
    
    public function create()
    {
        $store = Auth::user()->store;
        $balance = $store->balanceFloat;
        
        return view('vendor.withdrawals.create', compact('balance'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method' => 'required|string|in:bank_transfer,paypal,mobile_money',
            'payment_details' => 'required|string',
        ]);
        
        $store = Auth::user()->store;
        
        // Check if user has enough balance
        if ($store->balanceFloat < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance for withdrawal.');
        }
        
        // Create the withdrawal request
        $withdrawal = new WithdrawalRequest();
        $withdrawal->user_id = Auth::id();
        $withdrawal->amount = $request->amount;
        $withdrawal->payment_method = $withdrawal->payment_method;
        $withdrawal->payment_details = $request->payment_details;
        $withdrawal->save();
        
        return redirect()->route('vendor.withdrawals.index')->with('success', 'Withdrawal request submitted successfully.');
    }
}