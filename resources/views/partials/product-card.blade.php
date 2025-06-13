<div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <a href="{{ route('products.show', $product->id) }}">
        <div class="h-48 bg-gray-100 relative overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
            
            @if($product->is_featured)
                <div class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-yellow-900 px-2 py-1 rounded-full">
                    Featured
                </div>
            @endif
            
            @if($product->discount_percent > 0)
                <div class="absolute top-2 left-2 bg-red-500 text-xs font-bold text-white px-2 py-1 rounded-full">
                    -{{ $product->discount_percent }}%
                </div>
            @endif
        </div>
        
        <div class="p-4">
            <div class="text-xs text-indigo-600 font-medium mb-1">{{ $product->store->name }}</div>
            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $product->name }}</h3>
            
            <div class="flex items-center gap-2">
                @if($product->discount_price)
                    <span class="font-bold text-gray-900">Ksh. {{ number_format($product->discount_price, 2) }}</span>
                    <span class="text-sm text-gray-500 line-through">Ksh. {{ number_format($product->regular_price, 2) }}</span>
                @else
                    <span class="font-bold text-gray-900">Ksh. {{ number_format($product->regular_price, 2) }}</span>
                @endif
            </div>
        </div>
    </a>
    
    <div class="px-4 pb-4">
        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition flex items-center justify-center gap-2"
                onclick="addToCart({{ $product->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Add to Cart
        </button>
    </div>
</div>
