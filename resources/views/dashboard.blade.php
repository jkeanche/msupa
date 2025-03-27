
@extends('layouts.app')

@section('content')
<div class="flex bg-gray-100">
    <!-- Sidebar -->
    {{-- <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-blue-800 border-r">
                <div class="flex flex-col items-center flex-shrink-0 px-4">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-widest text-white uppercase rounded-lg focus:outline-none focus:shadow-outline">
                        m-Supa
                    </a>
                    <p class="text-sm text-blue-200">{{ auth()->user()->name }}</p>
                </div>
                <div class="flex flex-col flex-grow px-4 mt-5">
                    <nav class="flex-1 space-y-1 bg-blue-800">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-white bg-blue-900 rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('user.orders') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            My Orders
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Shopping Lists
                        </a>
                        
                        <a href="{{ route('user.wallet') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            My Wallet
                        </a>
                        
                        <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            Favorites
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            Notifications
                        </a>
                    </nav>
                </div>
                <div class="flex flex-shrink-0 p-4 border-t border-blue-700">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-white rounded-md hover:bg-blue-700 p-2">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    
    <!-- Mobile menu button -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-blue-800 shadow-lg">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs">Home</span>
            </a>
            <a href="{{ route('user.orders') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="text-xs">Orders</span>
            </a>
            <a href="#" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-xs">Lists</span>
            </a>
            <a href="{{ route('user.profile') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs">Profile</span>
            </a>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <main class="flex-1 relative overflow-y-auto focus:outline-none pb-16 md:pb-0">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900">My Dashboard</h1>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Welcome Banner -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6 mt-4">
                        <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-700 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-white rounded-md p-3">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 text-white">
                                    <h3 class="text-lg leading-6 font-medium">Welcome back, {{ auth()->user()->name }}!</h3>
                                    <div class="mt-2 text-sm">
                                        <p>Discover great deals from local supermarkets near you.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mt-4">
                        <!-- Total Orders Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-gray-600">Total Orders</h2>
                                        <p class="text-2xl font-semibold">{{ $totalOrders ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="{{ route('user.orders') }}" class="font-medium text-blue-600 hover:text-blue-500">View all orders</a>
                                </div>
                            </div>
                        </div>

                        <!-- Total Spent Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-gray-600">Total Spent</h2>
                                        <p class="text-2xl font-semibold">KES {{ $totalSpent ?? '0.00' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="{{ route('user.wallet') }}" class="font-medium text-green-600 hover:text-green-500">View wallet</a>
                                </div>
                            </div>
                        </div>

                        <!-- Shopping Lists Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-gray-600">Shopping Lists</h2>
                                        <p class="text-2xl font-semibold">{{ $totalLists ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-yellow-600 hover:text-yellow-500">View all lists</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Order -->
                    @if(isset($currentOrder))
                    <div class="mt-8">
                        <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">Current Order</h2>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Order ID</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">#{{ $currentOrder->id }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $currentOrder->status }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Store</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $currentOrder->store->name }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Total</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">KES {{ $currentOrder->total }}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Ordered On</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $currentOrder->created_at->format('F d, Y \a\t h:i A') }}</dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="bg-white px-4 py-5 sm:px-6 flex justify-end">
                                <a href="{{ route('user.orders.show', $currentOrder->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Order Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="mt-8">
                        <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white rounded-lg p-4 hover:bg-blue-700 transition">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Start Shopping
                                </div>
                            </a>
                            <a href="#" class="bg-green-600 text-white rounded-lg p-4 hover:bg-green-700 transition">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Create Shopping List
                                </div>
                            </a>
                            <a href="{{ route('user.wallet') }}" class="bg-yellow-600 text-white rounded-lg p-4 hover:bg-yellow-700 transition">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Add Funds to Wallet
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg leading-6 font-medium text-gray-900">Recent Orders</h2>
                            <a href="{{ route('user.orders') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all</a>
                        </div>
                        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200">
                                @forelse($recentOrders ?? [] as $order)
                                <li>
                                    <a href="{{ route('user.orders.show', $order->id) }}" class="block hover:bg-gray-50">
                                        <div class="px-4 py-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-blue-600 truncate">Order #{{ $order->id }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $order->status }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-2 sm:flex sm:justify-between">
                                                <div class="sm:flex">
                                                    <p class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                        </svg>
                                                        {{ $order->store->name }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p>KES {{ $order->total }}</p>
                                                    <p class="ml-4">{{ $order->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @empty
                                <li class="px-4 py-4 sm:px-6 text-center text-gray-500">No orders yet</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Recommended Products -->
                    <div class="mt-8 mb-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg leading-6 font-medium text-gray-900">Recommended For You</h2>
                            <a href="{{ route('products.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all products</a>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            @forelse($recommendedProducts ?? [] as $product)
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-4">
                                    <div class="flex items-center justify-center h-48 bg-gray-50 mb-4">
                                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" alt="{{ $product->name }}" class="max-h-full max-w-full">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">{{ $product->store->name }}</p>
                                        <p class="mt-2 text-sm font-bold text-gray-900">KES {{ $product->price }}</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 flex justify-between">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View details</a>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="text-sm font-medium text-blue-600 hover:text-blue-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-3 text-center text-gray-500 py-4">No recommendations available</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection