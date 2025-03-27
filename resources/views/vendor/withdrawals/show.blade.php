@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-2xl font-semibold">Withdrawal Request Details</h2>
                <a href="{{ route('vendor.withdrawals.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Withdrawals
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Request #{{ $withdrawal->id }}</h5>
                        @php
                            $statusClass = 'bg-secondary';
                            switch($withdrawal->status) {
                                case 'pending':
                                    $statusClass = 'bg-warning text-dark';
                                    break;
                                case 'processing':
                                    $statusClass = 'bg-info text-white';
                                    break;
                                case 'completed':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'rejected':
                                    $statusClass = 'bg-danger';
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $statusClass }} fs-6">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Requested On</p>
                            <p class="fs-5">{{ date('F j, Y, g:i a', strtotime($withdrawal->created_at)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="fs-5">{{ date('F j, Y, g:i a', strtotime($withdrawal->updated_at)) }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Amount</p>
                            <p class="fs-4 fw-bold">Ksh.{{ number_format($withdrawal->amount, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Payment Method</p>
                            <p class="fs-5">
                                @php
                                    $methodIcons = [
                                        'bank_transfer' => 'fa-university',
                                        'paypal' => 'fa-paypal',
                                        'mpesa' => 'fa-mobile-alt',
                                        'stripe' => 'fa-credit-card'
                                    ];
                                    $icon = $methodIcons[$withdrawal->payment_method] ?? 'fa-money-bill';
                                @endphp
                                <i class="fas {{ $icon }} me-2"></i>{{ ucwords(str_replace('_', ' ', $withdrawal->payment_method)) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Payment Method Details -->
                    <h5 class="mb-3">Payment Details</h5>
                    @if($withdrawal->payment_method == 'bank_transfer')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Bank Name</p>
                                <p>{{ $withdrawal->bank_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Account Holder</p>
                                <p>{{ $withdrawal->account_name }}</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Account Number</p>
                                <p>{{ $withdrawal->account_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">SWIFT/BIC Code</p>
                                <p>{{ $withdrawal->swift_code }}</p>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_method == 'paypal')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">PayPal Email</p>
                                <p>{{ $withdrawal->paypal_email }}</p>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_method == 'mpesa')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Phone Number</p>
                                <p>{{ $withdrawal->phone_number }}</p>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_method == 'stripe')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Stripe Account ID</p>
                                <p>{{ $withdrawal->stripe_account }}</p>
                            </div>
                        </div>
                    @endif

                    <hr class="my-4">

                    <!-- Notes -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <p class="text-muted mb-1">Your Notes</p>
                            <p>{{ $withdrawal->notes ?: 'No notes provided' }}</p>
                        </div>
                    </div>

                    @if($withdrawal->admin_notes)
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted mb-1">Admin Notes</p>
                                <div class="alert alert-info">
                                    {{ $withdrawal->admin_notes }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Transaction ID (if completed) -->
                    @if($withdrawal->status == 'completed' && $withdrawal->transaction_id)
                        <hr class="my-4">
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted mb-1">Transaction ID</p>
                                <p class="font-monospace">{{ $withdrawal->transaction_id }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    @if($withdrawal->status == 'pending')
                        <hr class="my-4">
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('vendor.withdrawals.destroy', $withdrawal->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this withdrawal request?')">
                                    <i class="fas fa-times me-2"></i> Cancel Request
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Request Timeline</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Request Submitted</h6>
                                <p class="text-muted mb-0">{{ date('F j, Y, g:i a', strtotime($withdrawal->created_at)) }}</p>
                                <p>Your withdrawal request for Ksh.{{ number_format($withdrawal->amount, 2) }} was submitted.</p>
                            </div>
                        </li>

                        @if($withdrawal->status != 'pending')
                            <li class="timeline-item">
                                <div class="timeline-marker {{ $withdrawal->status == 'rejected' ? 'bg-danger' : 'bg-info' }}"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Status Updated to {{ ucfirst($withdrawal->status) }}</h6>
                                    <p class="text-muted mb-0">{{ date('F j, Y, g:i a', strtotime($withdrawal->updated_at)) }}</p>
                                    @if($withdrawal->admin_notes)
                                        <p>{{ $withdrawal->admin_notes }}</p>
                                    @endif
                                </div>
                            </li>
                        @endif

                        @if($withdrawal->status == 'completed')
                            <li class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Payment Completed</h6>
                                    <p class="text-muted mb-0">{{ date('F j, Y, g:i a', strtotime($withdrawal->completed_at ?? $withdrawal->updated_at)) }}</p>
                                    <p>Your withdrawal has been processed and the funds have been sent to your account.</p>
                                    @if($withdrawal->transaction_id)
                                        <p class="mb-0">Transaction ID: <span class="font-monospace">{{ $withdrawal->transaction_id }}</span></p>
                                    @endif
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Timeline styles */
    .timeline {
        position: relative;
        padding-left: 30px;
        list-style: none;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 30px;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        left: 7px;
        height: 100%;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-marker {
        position: absolute;
        left: -30px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #e9ecef;
    }
    
    .timeline-content {
        padding-bottom: 10px;
    }
</style>
@endsection
