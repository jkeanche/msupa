@extends('layouts.app')

@section('content')
<div class="px-4 py-5 mx-auto max-w-7xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Subscription Management</h2>
        @if(!$currentPlan || $currentPlan->status === 'expired')
            <a href="{{ route('vendor.subscription.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-plus me-2"></i> Subscribe to a Plan
            </a>
        @endif
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

    <!-- Current Subscription -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="px-4 py-3 border-b bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Current Subscription</h3>
        </div>
        <div class="p-4">
            @if($currentPlan)
                <div class="bg-white border rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="col-span-1">
                                <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $currentPlan->plan_name }}</h4>
                                <div class="flex items-center mb-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $currentPlan->status == 'active' ? 'bg-green-100 text-green-800' : ($currentPlan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($currentPlan->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-4">
                                    @if($currentPlan->status == 'active')
                                        Active until {{ date('F j, Y', strtotime($currentPlan->expires_at)) }}
                                    @elseif($currentPlan->status == 'pending')
                                        Payment pending
                                    @elseif($currentPlan->status == 'expired')
                                        Expired on {{ date('F j, Y', strtotime($currentPlan->expires_at)) }}
                                    @endif
                                </p>
                                
                                <div class="mt-4">
                                    @if($currentPlan->status == 'active')
                                        <a href="{{ route('vendor.subscription.renew') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <i class="fas fa-sync-alt mr-2"></i> Renew Subscription
                                        </a>
                                    @elseif($currentPlan->status == 'expired')
                                        <a href="{{ route('vendor.subscription.renew') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <i class="fas fa-redo mr-2"></i> Reactivate
                                        </a>
                                    @endif
                                    
                                    @if($currentPlan->status == 'active')
                                        <a href="{{ route('vendor.subscription.cancel') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 ml-3">
                                            <i class="fas fa-times mr-2"></i> Cancel
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-span-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 mb-2">Plan Features</h5>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-sm text-gray-600">{{ $currentPlan->product_limit ?? 'Unlimited' }} Products</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-sm text-gray-600">{{ $currentPlan->storage_limit ?? 'Unlimited' }}GB Storage</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-sm text-gray-600">{{ $currentPlan->commission_rate ?? '0' }}% Commission Rate</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 mb-2">Billing Details</h5>
                                        <div class="space-y-2">
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-500">Billing Cycle:</span>
                                                <span class="text-sm font-medium text-gray-900">{{ ucfirst($currentPlan->billing_cycle) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-500">Next Billing:</span>
                                                <span class="text-sm font-medium text-gray-900">
                                                    @if($currentPlan->status == 'active')
                                                        {{ date('F j, Y', strtotime($currentPlan->next_billing_date)) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-500">Amount:</span>
                                                <span class="text-sm font-medium text-gray-900">Ksh.{{ number_format($currentPlan->amount, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No active subscription</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by subscribing to a plan.</p>
                    <div class="mt-6">
                        <a href="#available-plans" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-plus mr-2"></i> Choose a Plan
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Available Plans -->
    <div id="available-plans" class="bg-white rounded-lg shadow-sm mb-6">
        <div class="px-4 py-3 border-b bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Available Plans</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($availablePlans as $plan)
                <div class="bg-white border rounded-lg overflow-hidden {{ $currentPlan && $currentPlan->subscription_plan_id == $plan->id ? 'ring-2 ring-primary-500' : '' }}">
                    @if($currentPlan && $currentPlan->subscription_plan_id == $plan->id)
                    <div class="bg-primary-500 text-white text-center py-1 text-xs font-semibold uppercase tracking-wide">
                        Current Plan
                    </div>
                    @endif
                    <div class="p-5">
                        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $plan->name }}</h4>
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-gray-900">Ksh.{{ number_format($plan->monthly_price, 2) }}</span>
                            <span class="text-sm text-gray-500">/month</span>
                            
                            @if($plan->billing_cycle == 'year' && $plan->annual_price)
                            <p class="text-sm text-gray-500 mt-1">
                                or Ksh.{{ number_format($plan->annual_price / 12, 2) }}/month billed annually
                                
                                @if($plan->savings_percentage)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 ml-2">
                                    Save {{ $plan->savings_percentage }}%
                                </span>
                                @endif
                            </p>
                            @endif
                        </div>
                        
                        <ul class="space-y-3 mb-5">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $plan->product_limit ?? 'Unlimited' }} Products</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $plan->storage_limit ?? 'Unlimited' }}GB Storage</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $plan->commission_rate ?? '0' }}% Commission Rate</span>
                            </li>
                        </ul>
                        
                        <div class="mt-4">
                            @if($currentPlan && $currentPlan->subscription_plan_id == $plan->id)
                                <button class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Current Plan
                                </button>
                            @else
                                <a href="{{ route('vendor.subscription.create', ['plan' => $plan->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Subscribe
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Billing History -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-4 py-3 border-b bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Billing History</h3>
        </div>
        <div class="p-4">
            @if(count($invoices) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $invoice->invoice_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ date('M d, Y', strtotime($invoice->created_at)) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Ksh.{{ number_format($invoice->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-800' : ($invoice->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('vendor.subscription.invoice', $invoice->id) }}" class="text-primary-600 hover:text-primary-900">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No invoices yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Your billing history will appear here once you subscribe to a plan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
