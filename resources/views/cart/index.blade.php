@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Your Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Product</th>
                                <th class="text-center py-2">Price</th>
                                <th class="text-center py-2">Quantity</th>
                                <th class="text-center py-2">Total</th>
                                <th class="text-right py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subtotal = 0; @endphp
                            @foreach($cartItems as $item)
                                @php
                                    $price = $item->product->getCurrentPrice();
                                    $itemTotal = $price * $item->quantity;
                                    $subtotal += $itemTotal;
                                @endphp
                                <tr class="border-b">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            @if($item->product->images->count() > 0)
                                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 mr-4 flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">No image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="font-medium">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $item->product->store->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4">Ksh.{{ number_format($price, 2) }}</td>
                                    <td class="text-center py-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center justify-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="border rounded w-16 text-center py-1">
                                            <button type="submit" class="ml-2 text-sm text-blue-600 hover:text-blue-800">Update</button>
                                        </form>
                                    </td>
                                    <td class="text-center py-4">Ksh.{{ number_format($itemTotal, 2) }}</td>
                                    <td class="text-right py-4">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>Ksh.{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($coupon)
                        <div class="flex justify-between mb-2 text-green-600">
                            <span>Discount ({{ $coupon->code }})</span>
                            @php
                                $discountAmount = 0;
                                if ($coupon->discount_type === 'percentage') {
                                    $discountAmount = $subtotal * ($coupon->discount_value / 100);
                                } else {
                                    $discountAmount = $coupon->discount_value;
                                }
                                // Ensure discount doesn't exceed subtotal
                                $discountAmount = min($discountAmount, $subtotal);
                            @endphp
                            <span>-Ksh.{{ number_format($discountAmount, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-4 font-semibold">
                            <span>Total</span>
                            <span>Ksh.{{ number_format($subtotal - $discountAmount, 2) }}</span>
                        </div>
                        <form action="{{ route('cart.removeCoupon') }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full bg-red-100 text-red-600 py-2 px-4 rounded hover:bg-red-200 transition">Remove Coupon</button>
                        </form>
                    @else
                        <div class="flex justify-between mb-4 font-semibold">
                            <span>Total</span>
                            <span>Ksh.{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="flex">
                                <input type="text" name="code" placeholder="Coupon code" class="flex-grow border rounded-l p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit" class="bg-blue-600 text-white rounded-r px-4 hover:bg-blue-700 transition">Apply</button>
                            </div>
                        </form>
                    @endif

                    <a href="{{ route('checkout') }}" class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded font-semibold hover:bg-blue-700 transition">Proceed to Checkout</a>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Continue Shopping</h2>
                    <a href="{{ route('home') }}" class="block w-full bg-gray-200 text-gray-800 text-center py-2 px-4 rounded font-semibold hover:bg-gray-300 transition">Back to Store</a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold mb-4">Your cart is empty</h2>
            <p class="mb-6 text-gray-600">Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white py-2 px-6 rounded font-semibold hover:bg-blue-700 transition">Start Shopping</a>
        </div>
    @endif
</div>
@endsection