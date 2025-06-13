@props(['stores'])

<div id="stores" class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Featured Stores</h2>
            <a href="{{ route('stores.index') ?? '#' }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center group">
                View All 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @if(isset($stores) && count($stores) > 0)
                @foreach($stores as $store)
                    <a href="{{ route('stores.show', $store->slug) ?? '#' }}" class="bg-white rounded-lg shadow-sm p-6 text-center transition duration-300 hover:shadow-md hover:scale-105 transform">
                        <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="h-16 mx-auto object-contain mb-4">
                        <h3 class="font-medium text-gray-900">{{ $store->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $store->products()->count() }} Products</p>
                        @if($store->isFeatured())
                            <span class="mt-2 inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Featured</span>
                        @endif
                    </a>
                @endforeach
            @else
                <!-- Fallback stores -->
                <a href="#" class="bg-white rounded-lg shadow-sm p-6 text-center transition duration-300 hover:shadow-md hover:scale-105 transform">
                    <img src="https://via.placeholder.com/150" alt="Naivas" class="h-16 mx-auto object-contain mb-4">
                    <h3 class="font-medium text-gray-900">Naivas</h3>
                    <p class="text-sm text-gray-500 mt-1">1,240 Products</p>
                </a>
                <!-- Add more placeholder stores -->
            @endif
        </div>
    </div>
</div>
