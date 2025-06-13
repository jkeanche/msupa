<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['user', 'order', 'subscription']);
        
        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }
        
        if ($request->has('payment_method') && $request->payment_method !== '') {
            $query->where('payment_method', $request->payment_method);
        }
        
        if ($request->has('user') && $request->user !== '') {
            $query->where('user_id', $request->user);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('payment_id', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Sort
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);
        
        $transactions = $query->paginate(15);
        
        // Get summary statistics
        $stats = [
            'total_transactions' => Payment::count(),
            'completed_transactions' => Payment::where('status', 'completed')->count(),
            'pending_transactions' => Payment::where('status', 'pending')->count(),
            'failed_transactions' => Payment::where('status', 'failed')->count(),
            'total_amount' => Payment::where('status', 'completed')->sum('amount'),
            'total_fees' => Payment::where('status', 'completed')->sum('fee'),
            'today_transactions' => Payment::whereDate('created_at', today())->count(),
            'today_amount' => Payment::whereDate('created_at', today())
                ->where('status', 'completed')
                ->sum('amount'),
        ];
        
        // Get filter data
        $users = User::select('id', 'name', 'email')->get();
        $statuses = ['pending', 'completed', 'failed'];
        $types = ['order', 'subscription', 'feature'];
        $paymentMethods = Payment::distinct()->pluck('payment_method')->filter();
        
        return view('admin.payments.index', compact(
            'transactions', 
            'stats', 
            'users', 
            'statuses', 
            'types', 
            'paymentMethods'
        ));
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

    public function show(Payment $payment)
    {
        $payment->load(['user', 'order', 'subscription']);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit($id)
    {
        return view('admin.payments.edit', compact('id'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $payment->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
        
        return redirect()->back()->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        // Only allow deletion of failed payments
        if ($payment->status !== 'failed') {
            return redirect()->back()
                ->with('error', 'Only failed payments can be deleted.');
        }
        
        $payment->delete();
        
        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    public function getStatistics()
    {
        $stats = [
            'total_transactions' => Payment::count(),
            'completed_transactions' => Payment::where('status', 'completed')->count(),
            'pending_transactions' => Payment::where('status', 'pending')->count(),
            'failed_transactions' => Payment::where('status', 'failed')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'total_fees' => Payment::where('status', 'completed')->sum('fee'),
            'today_transactions' => Payment::whereDate('created_at', today())->count(),
            'today_revenue' => Payment::whereDate('created_at', today())
                ->where('status', 'completed')
                ->sum('amount'),
        ];
        
        return response()->json($stats);
    }
}
