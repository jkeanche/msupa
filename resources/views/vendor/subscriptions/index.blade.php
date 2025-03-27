@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Subscriptions</h2>
        <a href="{{ route('vendor.subscriptions.plans') }}" class="btn btn-primary">
            <i class="fas fa-crown mr-2"></i> Upgrade Plan
        </a>
    </div>

    <!-- Current Subscription -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Current Subscription</h5>
        </div>
        <div class="card-body">
            @if(isset($currentSubscription))
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                @if($currentSubscription->plan->name == 'Basic')
                                    <div class="bg-info text-white rounded-circle p-3">
                                        <i class="fas fa-store fa-2x"></i>
                                    </div>
                                @elseif($currentSubscription->plan->name == 'Standard')
                                    <div class="bg-primary text-white rounded-circle p-3">
                                        <i class="fas fa-store-alt fa-2x"></i>
                                    </div>
                                @elseif($currentSubscription->plan->name == 'Premium')
                                    <div class="bg-warning text-dark rounded-circle p-3">
                                        <i class="fas fa-store-alt-slash fa-2x"></i>
                                    </div>
                                @elseif($currentSubscription->plan->name == 'Enterprise')
                                    <div class="bg-success text-white rounded-circle p-3">
                                        <i class="fas fa-building fa-2x"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="mb-0">{{ $currentSubscription->plan->name ?? 'Free' }} Plan</h3>
                                <p class="text-muted mb-0">
                                    @if($currentSubscription->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($currentSubscription->status == 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @elseif($currentSubscription->status == 'past_due')
                                        <span class="badge bg-warning text-dark">Past Due</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($currentSubscription->status) }}</span>
                                    @endif
                                    
                                    @if($currentSubscription->ends_at)
                                        Expires on {{ date('M d, Y', strtotime($currentSubscription->ends_at)) }}
                                    @elseif($currentSubscription->trial_ends_at)
                                        Trial ends on {{ date('M d, Y', strtotime($currentSubscription->trial_ends_at)) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Billing Cycle</h6>
                                <p>{{ ucfirst($currentSubscription->billing_cycle) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Next Billing Date</h6>
                                <p>{{ $currentSubscription->next_billing_date ? date('M d, Y', strtotime($currentSubscription->next_billing_date)) : 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Started On</h6>
                                <p>{{ date('M d, Y', strtotime($currentSubscription->created_at)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Price</h6>
                                <p>Ksh.{{ number_format($currentSubscription->price, 2) }} / {{ $currentSubscription->billing_cycle }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Plan Features</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Products
                                        <span class="badge bg-primary rounded-pill">{{ $currentSubscription->plan->product_limit ?? 'Unlimited' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Commission Rate
                                        <span class="badge bg-primary rounded-pill">{{ $currentSubscription->plan->commission_rate ?? '0' }}%</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Featured Products
                                        <span class="badge bg-primary rounded-pill">{{ $currentSubscription->plan->featured_products ?? '0' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Categories
                                        <span class="badge bg-primary rounded-pill">{{ $currentSubscription->plan->category_limit ?? 'Unlimited' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    @if($currentSubscription->status == 'active')
                        @if(!$currentSubscription->ends_at)
                            <form action="{{ route('vendor.subscriptions.cancel') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger me-2" onclick="return confirm('Are you sure you want to cancel your subscription?')">
                                    Cancel Subscription
                                </button>
                            </form>
                        @else
                            <form action="{{ route('vendor.subscriptions.resume') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-success me-2">
                                    Resume Subscription
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('vendor.subscriptions.plans') }}" class="btn btn-primary">
                            Change Plan
                        </a>
                    @elseif($currentSubscription->status == 'canceled' || $currentSubscription->status == 'expired')
                        <a href="{{ route('vendor.subscriptions.plans') }}" class="btn btn-primary">
                            Renew Subscription
                        </a>
                    @elseif($currentSubscription->status == 'past_due')
                        <a href="{{ route('vendor.subscriptions.payment') }}" class="btn btn-warning">
                            Update Payment Method
                        </a>
                    @endif
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-store fa-4x text-muted"></i>
                    </div>
                    <h4>You don't have an active subscription</h4>
                    <p class="text-muted">Subscribe to a plan to unlock more features for your store.</p>
                    <a href="{{ route('vendor.subscriptions.plans') }}" class="btn btn-primary mt-3">
                        View Plans
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Billing History -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Billing History</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">Date</th>
                            <th class="py-3">Invoice #</th>
                            <th class="py-3">Plan</th>
                            <th class="py-3">Amount</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($invoices) && count($invoices) > 0)
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ date('M d, Y', strtotime($invoice->date)) }}</td>
                                <td>{{ $invoice->number }}</td>
                                <td>{{ $invoice->plan_name }}</td>
                                <td>Ksh.{{ number_format($invoice->amount, 2) }}</td>
                                <td>
                                    @if($invoice->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($invoice->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($invoice->status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($invoice->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ $invoice->invoice_url }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                        <a href="{{ $invoice->receipt_url }}" class="btn btn-sm btn-outline-info" target="_blank">
                                            <i class="fas fa-receipt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4">No billing history found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($invoices) && $invoices instanceof \Illuminate\Pagination\LengthAwarePaginator && $invoices->hasPages())
        <div class="card-footer bg-white">
            {{ $invoices->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
