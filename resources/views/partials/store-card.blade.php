<div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <a href="{{ route('stores.show', $store->slug) }}">
        <div class="h-36 bg-gray-200 relative overflow-hidden">
            @if($store->logo)
                <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full bg-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            @endif
            
            @if($store->isFeatured())
                <div class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-yellow-900 px-2 py-1 rounded-full">
                    Featured
                </div>
            @endif
        </div>
        
        <div class="p-4">
            <h3 class="font-bold text-gray-900 truncate">{{ $store->name }}</h3>
            <p class="text-gray-500 text-sm mt-1">{{ $store->products()->count() }} products</p>
            
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $store->city }}, {{ $store->country }}
            </div>
            
            @if($store->status === 'active')
                <div class="mt-2 inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                    Active
                </div>
            @endif
        </div>
    </a>
</div>
