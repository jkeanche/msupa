@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">My Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stats Card - Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Total Orders</p>
                    <h3 class="text-xl font-bold">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Stats Card - Spent -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Total Spent</p>
                    <h3 class="text-xl font-bold">Ksh {{ number_format($totalSpent, 2) }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Stats Card - Account -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Member Since</p>
                    <h3 class="text-xl font-bold">{{ $user->created_at->format('M Y') }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="font-bold text-xl">Recent Orders</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse ($recentOrders as $order)
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">Order #{{ $order->order_number }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-xs
                                @if($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm">{{ $order->items->count() }} 
                                    {{ Str::plural('item', $order->items->count()) }}</p>
                                <p class="text-sm text-gray-500">
                                    @foreach($order->items->take(2) as $item)
                                        {{ $item->product->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                    {{ $order->items->count() > 2 ? '...' : '' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">Ksh {{ number_format($order->total_amount, 2) }}</p>
                                <a href="{{ route('user.orders.show', $order->id) }}" 
                                   class="text-sm text-blue-600 hover:text-blue-900">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <p>No orders yet. Start shopping!</p>
                </div>
            @endforelse
        </div>
        @if ($totalOrders > 5)
            <div class="px-6 py-4 text-center border-t border-gray-200">
                <a href="{{ route('user.orders') }}" class="text-blue-600 hover:text-blue-900">
                    View All Orders
                </a>
            </div>
        @endif
    </div>
    
    <!-- Recommended Products -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="font-bold text-xl">Recommended For You</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($recommendedProducts as $product)
                    <div class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 mb-4">
                            <img src="{{ $product->images->first() ? $product->images->first()->url : asset('images/placeholder.png') }}" 
                                 alt="{{ $product->name }}"
                                 class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">{{ $product->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $product->store->name }}</p>
                        <p class="mt-1 text-sm font-medium text-gray-900">Ksh {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" 
                           class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-900">
                            View Product
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection