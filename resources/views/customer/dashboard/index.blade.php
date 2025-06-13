@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome back, {{ auth()->user()->name }}</p>
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Orders Card -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-blue-500 bg-opacity-30 p-3">
                        <i class="fas fa-shopping-bag text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-blue-100">
                        <span class="text-sm mr-1">{{ $activeOrders ?? 0 }}</span>
                        <span class="text-xs">active</span>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($totalOrders ?? 0) }}</h3>
                <p class="text-blue-100">Total Orders</p>
            </div>
        </div>

        <!-- Wallet Card -->
        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-emerald-500 bg-opacity-30 p-3">
                        <i class="fas fa-wallet text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-emerald-100">
                        <i class="fas fa-plus-circle mr-1"></i>
                        <span class="text-sm">Top up</span>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($walletBalance ?? 0) }}</h3>
                <p class="text-emerald-100">Wallet Balance</p>
            </div>
        </div>

        <!-- Points Card -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-amber-400 bg-opacity-30 p-3">
                        <i class="fas fa-star text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-amber-100">
                        <span class="text-sm mr-1">{{ $pointsToNextLevel ?? 0 }}</span>
                        <span class="text-xs">to next level</span>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($loyaltyPoints ?? 0) }}</h3>
                <p class="text-amber-100">Loyalty Points</p>
            </div>
        </div>

        <!-- Saved Items Card -->
        <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-purple-500 bg-opacity-30 p-3">
                        <i class="fas fa-heart text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-purple-100">
                        <a href="{{ route('customer.wishlist.index') }}" class="text-sm hover:underline">View All</a>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ $savedItems ?? 0 }}</h3>
                <p class="text-purple-100">Saved Items</p>
            </div>
        </div>
    </div>

    <!-- Active Orders and Recent Purchases -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Active Orders -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Active Orders</h3>
                    <a href="{{ route('customer.orders.active') }}" class="text-blue-600 hover:text-blue-700">View All</a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($activeOrders ?? [] as $order)
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-lg" src="{{ $order->store->logo ?? asset('images/default-store.png') }}" alt="">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->store->name }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $order->total }}</p>
                                <p class="text-sm text-gray-500">{{ $order->items_count }} items</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-100">
                                <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500" 
                                    style="width: {{ $order->progress }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-600">
                                <span>Order Placed</span>
                                <span>Processing</span>
                                <span>On the Way</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">No active orders</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Purchases -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Purchases</h3>
                    <button class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-my-4 divide-y divide-gray-200">
                            @forelse($recentPurchases ?? [] as $purchase)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 rounded-lg" src="{{ $purchase->product->image ?? asset('images/default-product.png') }}" alt="">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $purchase->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $purchase->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex-shrink-0 text-right">
                                        <p class="text-sm font-medium text-gray-900">{{ $purchase->total }}</p>
                                        <a href="{{ route('customer.products.show', $purchase->product) }}" 
                                            class="text-sm text-blue-600 hover:text-blue-700">Buy Again</a>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="py-4 text-center text-gray-500">No recent purchases</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Products -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Recommended for You</h3>
            <a href="{{ route('customer.products.index') }}" class="text-blue-600 hover:text-blue-700">View All</a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($recommendedProducts ?? [] as $product)
                <div class="group relative">
                    <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden bg-gray-100">
                        <img src="{{ $product->image ?? asset('images/default-product.png') }}" 
                            alt="{{ $product->name }}"
                            class="object-center object-cover group-hover:opacity-75">
                        <div class="flex items-end p-4">
                            <button class="absolute top-4 right-4 rounded-full p-2 bg-white text-gray-900 hover:bg-gray-100">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between space-x-8">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{ route('customer.products.show', $product) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ $product->price }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center text-gray-500 py-12">No recommendations available</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
