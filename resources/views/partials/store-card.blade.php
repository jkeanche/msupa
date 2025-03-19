<div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <a href="{{ route('stores.show', $store->id) }}">
        <div class="h-36 bg-gray-200 relative overflow-hidden">
            @if($store->logo)
                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full bg-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            @endif
            
            @if($store->is_featured)
                <div class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-yellow-900 px-2 py-1 rounded-full">
                    Featured
                </div>
            @endif
        </div>
        
        <div class="p-4">
            <h3 class="font-bold text-gray-900 truncate">{{ $store->name }}</h3>
            <p class="text-gray-500 text-sm mt-1">{{ $store->products_count ?? 0 }} products</p>
        </div>
    </a>
</div>
