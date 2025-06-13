<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return view('user.wallet.index');
    }
    
    public function deposit(Request $request)
    {
        // Wallet deposit functionality would be implemented here
        return redirect()->back()->with('success', 'Deposit functionality will be implemented');
    }
} 