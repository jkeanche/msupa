<!-- filepath: c:\xampp\htdocs\msupa\resources\views\admin\dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600">Monitor and manage your entire platform from one place.</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-4">
        <!-- Active Stores Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Active Stores
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $activeStoresCount ?? 24 }}
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
                            <span>+12.5%</span>
                        </div>
                        <div class="text-sm text-gray-500">vs last month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Users
                            </dt>
                            <dd>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $totalUsersCount ?? 1,254 }}
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
                            <span>+8.2%</span>
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
                    <div class="flex-shrink-0 bg-green-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    {{ $totalOrdersCount ?? 3,782 }}
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
                            <span>+15.3%</span>
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
                    <div class="flex-shrink-0 bg-purple-100 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    Ksh.{{ number_format($totalRevenue ?? 128750, 2) }}
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
                            <span>+10.6%</span>
                        </div>
                        <div class="text-sm text-gray-500">vs last month</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and New Stores -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-heading font-medium text-gray-900">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all</a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Store</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOrders ?? [] as $order)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $order->store->name }}</td>
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
                                    </tr>
                                @empty
                                    @for($i = 1; $i <= 5; $i++)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#{{ 1000 + $i }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">Customer {{ $i }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">Store {{ $i }}</td>
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
                                        </tr>
                                    @endfor
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- New Stores -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-soft overflow-hidden h-full">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-heading font-medium text-gray-900">New Stores</h2>
                    <a href="{{ route('admin.stores.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all</a>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($newStores ?? [] as $store)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $store->logo ? asset('storage/' . $store->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($store->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ $store->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $store->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $store->owner->name }}</div>
                                </div>
                                <div class="ml-auto text-sm text-gray-500">
                                    {{ $store->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            @for($i = 1; $i <= 5; $i++)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=S{{ $i }}&color=7F9CF5&background=EBF4FF" alt="Store {{ $i }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Store {{ $i }}</div>
                                        <div class="text-sm text-gray-500">Owner {{ $i }}</div>
                                    </div>
                                    <div class="ml-auto text-sm text-gray-500">
                                        {{ now()->subDays(rand(1, 7))->diffForHumans() }}
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection