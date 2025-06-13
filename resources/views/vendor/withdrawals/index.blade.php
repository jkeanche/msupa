@extends('layouts.app')

@section('content')
<div class="px-4 py-5 mx-auto max-w-7xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Withdrawal Requests</h2>
        <a href="{{ route('vendor.withdrawals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            <i class="fas fa-plus mr-2"></i> New Withdrawal Request
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <!-- Balance Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Available Balance</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">Ksh.{{ number_format($availableBalance ?? 0, 2) }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-info-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-info-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Pending Withdrawals</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">Ksh.{{ number_format($pendingWithdrawals ?? 0, 2) }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-success-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Withdrawn</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">Ksh.{{ number_format($totalWithdrawn ?? 0, 2) }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Withdrawal History</h3>
            <div>
                <form action="{{ route('vendor.withdrawals.index') }}" method="GET" class="d-flex">
                    <select name="status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($withdrawals) && count($withdrawals) > 0)
                        @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ $withdrawal->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ date('M d, Y', strtotime($withdrawal->created_at)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    Ksh.{{ number_format($withdrawal->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @php
                                        $methodIcons = [
                                            'bank_transfer' => 'fa-university',
                                            'paypal' => 'fa-paypal',
                                            'mpesa' => 'fa-mobile-alt',
                                            'stripe' => 'fa-credit-card'
                                        ];
                                        $icon = $methodIcons[$withdrawal->payment_method] ?? 'fa-money-bill';
                                    @endphp
                                    <span><i class="fas {{ $icon }} mr-2"></i>{{ ucwords(str_replace('_', ' ', $withdrawal->payment_method)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $withdrawal->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                        ($withdrawal->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                        ($withdrawal->status == 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('vendor.withdrawals.show', $withdrawal->id) }}" class="text-primary-600 hover:text-primary-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($withdrawal->status === 'pending')
                                        <form action="{{ route('vendor.withdrawals.destroy', $withdrawal->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-transparent border-0 p-0" onclick="return confirm('Are you sure you want to cancel this withdrawal request?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No withdrawal requests found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        @if(isset($withdrawals) && $withdrawals->hasPages())
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                {{ $withdrawals->links() }}
            </div>
        @endif
    </div>

    <!-- Withdrawal Policy -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-4">
        <div class="px-4 py-3 border-b bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Withdrawal Policy</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h6 class="mb-3">Processing Times</h6>
                    <ul class="list-none mb-4">
                        <li class="mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                1
                            </span>
                            <div class="ml-4">
                                <strong>Withdrawal Request Review</strong>
                                <p class="mb-0 text-gray-500">1-2 business days</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                2
                            </span>
                            <div class="ml-4">
                                <strong>Payment Processing</strong>
                                <p class="mb-0 text-gray-500">2-3 business days</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                3
                            </span>
                            <div class="ml-4">
                                <strong>Bank/Payment Provider Processing</strong>
                                <p class="mb-0 text-gray-500">1-5 business days (varies by provider)</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <h6 class="mb-3">Withdrawal Terms</h6>
                    <ul class="list-none">
                        <li class="mb-2"><i class="fas fa-check-circle text-success-600 mr-2"></i> Minimum withdrawal amount: $1.00</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success-600 mr-2"></i> Maximum monthly withdrawals: 4</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success-600 mr-2"></i> Funds are available for withdrawal after order completion and any return period</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success-600 mr-2"></i> Withdrawal fees vary by payment method</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success-600 mr-2"></i> All withdrawals are subject to our terms of service</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
