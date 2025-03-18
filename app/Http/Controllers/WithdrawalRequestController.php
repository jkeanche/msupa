<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WithdrawalRequestController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdrawalRequests = WithdrawalRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('withdrawal_requests.index', compact('withdrawalRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('withdrawal_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_details' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        $withdrawalRequest = new WithdrawalRequest();
        $withdrawalRequest->user_id = Auth::id();
        $withdrawalRequest->amount = $validated['amount'];
        $withdrawalRequest->bank_details = $validated['bank_details'];
        $withdrawalRequest->notes = $validated['notes'] ?? null;
        $withdrawalRequest->status = 'pending';
        $withdrawalRequest->save();
        
        return redirect()->route('withdrawal-requests.index')
            ->with('success', 'Withdrawal request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WithdrawalRequest $withdrawalRequest)
    {
        $this->authorize('view', $withdrawalRequest);
        
        return view('withdrawal_requests.show', compact('withdrawalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WithdrawalRequest $withdrawalRequest)
    {
        $this->authorize('update', $withdrawalRequest);
        
        return view('withdrawal_requests.edit', compact('withdrawalRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        $this->authorize('update', $withdrawalRequest);
        
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_details' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        $withdrawalRequest->amount = $validated['amount'];
        $withdrawalRequest->bank_details = $validated['bank_details'];
        $withdrawalRequest->notes = $validated['notes'] ?? null;
        $withdrawalRequest->save();
        
        return redirect()->route('withdrawal-requests.index')
            ->with('success', 'Withdrawal request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WithdrawalRequest $withdrawalRequest)
    {
        $this->authorize('delete', $withdrawalRequest);
        
        $withdrawalRequest->delete();
        
        return redirect()->route('withdrawal-requests.index')
            ->with('success', 'Withdrawal request deleted successfully.');
    }
}
