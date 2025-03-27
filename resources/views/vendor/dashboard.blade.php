<!-- filepath: c:\xampp\htdocs\msupa\resources\views\vendor\dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Vendor Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600">Manage your store, products, and orders from one place.</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-4">
        <!-- Total Products Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Products
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $totalProducts ?? 48 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-green-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>+5.2%</span>
                        </div>
                        <div class="text-sm text-gray-500">vs last month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Orders
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $totalOrders ?? 156 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-green-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>+12.3%</span>
                        </div>
                        <div class="text-sm text-gray-500">vs last month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Revenue
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    Ksh.{{ number_format($totalRevenue ?? 24680, 2) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-green-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>+8.7%</span>
                        </div>
                        <div class="text-sm text-gray-500">vs last month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Pending Orders
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $pendingOrders ?? 12 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('vendor.orders.index', ['status' => 'pending']) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View pending orders →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Low Stock Products -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-heading font-medium text-gray-900">Recent Orders</h2>
                    <a href="{{ route('vendor.orders.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all</a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOrders ?? [] as $order)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Ksh.{{ number_format($order->total, 2) }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($order->status == 'completed') bg-green-100 text-green-800 
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800 
                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800 
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    @for($i = 1; $i <= 5; $i++)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#{{ 1000 + $i }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">Customer {{ $i }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Ksh.{{ rand(50, 500) }}.00</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @php
                                                    $statuses = ['completed', 'processing', 'pending', 'cancelled'];
                                                    $status = $statuses[array_rand($statuses)];
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($status == 'completed') bg-green-100 text-green-800 
                                                    @elseif($status == 'processing') bg-blue-100 text-blue-800 
                                                    @elseif($status == 'cancelled') bg-red-100 text-red-800 
                                                    @else bg-yellow-100 text-yellow-800 @endif">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ now()->subDays(rand(1, 30))->format('M d, Y') }}</td>
                                        </tr>
                                    @endfor
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Low Stock Products -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-soft overflow-hidden h-full">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-heading font-medium text-gray-900">Low Stock Products</h2>
                    <a href="{{ route('vendor.products.index', ['filter' => 'low_stock']) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all</a>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($lowStockProducts ?? [] as $product)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}" alt="{{ $product->name }}">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">Stock: {{ $product->stock }}</div>
                                </div>
                                <div>
                                    <a href="{{ route('vendor.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            @for($i = 1; $i <= 5; $i++)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-md object-cover" src="https://via.placeholder.com/100" alt="Product {{ $i }}">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="text-sm font-medium text-gray-900">Product {{ $i }}</div>
                                        <div class="text-sm text-gray-500">Stock: {{ rand(1, 5) }}</div>
                                    </div>
                                    <div>
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 mb-8">
        <h2 class="text-lg font-heading font-medium text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('vendor.products.create') }}" class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300 p-6 flex items-center">
                <div class="flex-shrink-0 bg-green-100 p-3 rounded-lg">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-medium text-gray-900">Add Product</h3>
                    <p class="text-sm text-gray-500">Create a new product listing</p>
                </div>
            </a>
            
            <a href="{{ route('vendor.coupons.create') }}" class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300 p-6 flex items-center">
                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-medium text-gray-900">Create Coupon</h3>
                    <p class="text-sm text-gray-500">Offer discounts to customers</p>
                </div>
            </a>
            
            <a href="{{ route('vendor.withdrawals.create') }}" class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300 p-6 flex items-center">
                <div class="flex-shrink-0 bg-purple-100 p-3 rounded-lg">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-medium text-gray-900">Request Withdrawal</h3>
                    <p class="text-sm text-gray-500">Withdraw your earnings</p>
                </div>
            </a>
            
            <a href="{{ route('vendor.reports.index') }}" class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300 p-6 flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-lg">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-medium text-gray-900">View Reports</h3>
                    <p class="text-sm text-gray-500">Analyze your store performance</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection