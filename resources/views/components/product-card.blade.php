@props(['product'])

<div class="bg-white rounded-lg shadow-sm overflow-hidden product-card transition duration-300 hover:shadow-md transform hover:scale-[1.02]">
    <div class="relative">
        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-white shadow flex items-center justify-center">
            <i class="far fa-heart text-gray-400 hover:text-red-500"></i>
        </button>
        @if($product->is_new)
            <div class="absolute top-0 left-0 bg-green-500 text-white px-3 py-1 text-sm font-medium">NEW</div>
        @endif
        @if($product->original_price && $product->original_price > $product->price)
            <div class="absolute bottom-0 left-0 bg-red-500 text-white px-3 py-1 text-sm font-medium">SALE</div>
        @endif
    </div>
    <div class="p-4">
        <div class="flex items-center mb-2">
            <span class="text-xs text-gray-500">{{ $product->store->name ?? 'Unknown Store' }}</span>
        </div>
        <h3 class="font-medium text-gray-900 mb-1">{{ $product->name }}</h3>
        <p class="text-sm text-gray-500 mb-2 line-clamp-2">{{ $product->short_description ?? Str::limit($product->description, 60) }}</p>
        <div class="flex items-center justify-between">
            <div>
                <span class="text-lg font-bold text-indigo-600">KSh {{ number_format($product->price, 2) }}</span>
                @if($product->original_price && $product->original_price > $product->price)
                    <span class="text-sm text-gray-500 line-through ml-2">KSh {{ number_format($product->original_price, 2) }}</span>
                @endif
            </div>
            <button class="bg-indigo-100 text-indigo-700 p-2 rounded-full hover:bg-indigo-600 hover:text-white transition duration-300 add-to-cart-btn" data-product-id="{{ $product->id }}">
                <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        
        @if($product->quantity < 10 && $product->quantity > 0)
            <div class="mt-2 text-xs text-orange-600">Only {{ $product->quantity }} left in stock!</div>
        @elseif($product->quantity <= 0)
            <div class="mt-2 text-xs text-red-600">Out of stock</div>
        @endif
    </div>
</div>
