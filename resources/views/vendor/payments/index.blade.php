@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Payments</h2>
        <a href="{{ route('vendor.withdrawals.create') }}" class="btn btn-primary">
            <i class="fas fa-money-bill-wave mr-2"></i> Request Withdrawal
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Available Balance</h5>
                    <h2 class="display-4">Ksh.{{ number_format($availableBalance ?? 0, 2) }}</h2>
                    <p class="card-text">Ready to withdraw</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Earnings</h5>
                    <h2 class="display-4">Ksh.{{ number_format($totalEarnings ?? 0, 2) }}</h2>
                    <p class="card-text">Lifetime earnings</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <h2 class="display-4">Ksh.{{ number_format($pendingAmount ?? 0, 2) }}</h2>
                    <p class="card-text">Being processed</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">On Hold</h5>
                    <h2 class="display-4">Ksh.{{ number_format($onHoldAmount ?? 0, 2) }}</h2>
                    <p class="card-text">Not yet available</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment History -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Payment History</h5>
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Search payments..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Date</th>
                            <th class="py-3">Order ID</th>
                            <th class="py-3">Amount</th>
                            <th class="py-3">Fee</th>
                            <th class="py-3">Net Amount</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($payments) && count($payments) > 0)
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($payment->order_id)
                                        <a href="{{ route('vendor.orders.show', $payment->order_id) }}" class="text-decoration-none">
                                            #{{ $payment->order_id }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>Ksh.{{ number_format($payment->amount, 2) }}</td>
                                <td>Ksh.{{ number_format($payment->fee, 2) }}</td>
                                <td>Ksh.{{ number_format($payment->net_amount, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        switch($payment->status) {
                                            case 'completed':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'on_hold':
                                                $statusClass = 'bg-info text-dark';
                                                break;
                                            case 'failed':
                                                $statusClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $payment->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Payment Details Modal -->
                                    <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $payment->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="paymentModalLabel{{ $payment->id }}">Payment Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Payment ID</h6>
                                                        <p class="mb-0">{{ $payment->id }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Date</h6>
                                                        <p class="mb-0">{{ $payment->created_at->format('M d, Y H:i:s') }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Order</h6>
                                                        <p class="mb-0">
                                                            @if($payment->order_id)
                                                                <a href="{{ route('vendor.orders.show', $payment->order_id) }}" class="text-decoration-none">
                                                                    #{{ $payment->order_id }}
                                                                </a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Amount</h6>
                                                        <p class="mb-0">Ksh.{{ number_format($payment->amount, 2) }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Fee</h6>
                                                        <p class="mb-0">Ksh.{{ number_format($payment->fee, 2) }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Net Amount</h6>
                                                        <p class="mb-0">Ksh.{{ number_format($payment->net_amount, 2) }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Status</h6>
                                                        <p class="mb-0">
                                                            <span class="badge {{ $statusClass }}">
                                                                {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Payment Method</h6>
                                                        <p class="mb-0">{{ $payment->payment_method ?? 'N/A' }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Transaction ID</h6>
                                                        <p class="mb-0">{{ $payment->transaction_id ?? 'N/A' }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Notes</h6>
                                                        <p class="mb-0">{{ $payment->notes ?? 'No notes available' }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    @if($payment->invoice_url)
                                                        <a href="{{ $payment->invoice_url }}" class="btn btn-primary" target="_blank">
                                                            <i class="fas fa-file-invoice"></i> View Invoice
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center py-4">No payment records found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($payments) && $payments->hasPages())
        <div class="card-footer bg-white">
            {{ $payments->links() }}
        </div>
        @endif
    </div>

    <!-- Withdrawal Requests -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Withdrawal Requests</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Requested Date</th>
                            <th class="py-3">Amount</th>
                            <th class="py-3">Payment Method</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Processed Date</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($withdrawals) && count($withdrawals) > 0)
                            @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>{{ $withdrawal->id }}</td>
                                <td>{{ $withdrawal->created_at->format('M d, Y') }}</td>
                                <td>Ksh.{{ number_format($withdrawal->amount, 2) }}</td>
                                <td>{{ $withdrawal->payment_method }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        switch($withdrawal->status) {
                                            case 'completed':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'processing':
                                                $statusClass = 'bg-info text-dark';
                                                break;
                                            case 'rejected':
                                                $statusClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </td>
                                <td>{{ $withdrawal->processed_at ? date('M d, Y', strtotime($withdrawal->processed_at)) : 'N/A' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#withdrawalModal{{ $withdrawal->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Withdrawal Details Modal -->
                                    <div class="modal fade" id="withdrawalModal{{ $withdrawal->id }}" tabindex="-1" aria-labelledby="withdrawalModalLabel{{ $withdrawal->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="withdrawalModalLabel{{ $withdrawal->id }}">Withdrawal Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Withdrawal ID</h6>
                                                        <p class="mb-0">{{ $withdrawal->id }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Requested Date</h6>
                                                        <p class="mb-0">{{ $withdrawal->created_at->format('M d, Y H:i:s') }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Amount</h6>
                                                        <p class="mb-0">Ksh.{{ number_format($withdrawal->amount, 2) }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Payment Method</h6>
                                                        <p class="mb-0">{{ $withdrawal->payment_method }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Status</h6>
                                                        <p class="mb-0">
                                                            <span class="badge {{ $statusClass }}">
                                                                {{ ucfirst($withdrawal->status) }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Processed Date</h6>
                                                        <p class="mb-0">{{ $withdrawal->processed_at ? date('M d, Y H:i:s', strtotime($withdrawal->processed_at)) : 'Not processed yet' }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Payment Details</h6>
                                                        <p class="mb-0">{{ $withdrawal->payment_details ?? 'No details available' }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Notes</h6>
                                                        <p class="mb-0">{{ $withdrawal->notes ?? 'No notes available' }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    @if($withdrawal->status == 'pending')
                                                        <form action="{{ route('vendor.withdrawals.cancel', $withdrawal->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger">Cancel Request</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">No withdrawal requests found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($withdrawals) && $withdrawals->hasPages())
        <div class="card-footer bg-white">
            {{ $withdrawals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        
        searchButton.addEventListener('click', function() {
            performSearch();
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        function performSearch() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                window.location.href = "{{ route('vendor.payments.index') }}?search=" + encodeURIComponent(searchTerm);
            }
        }
    });
</script>
@endsection
