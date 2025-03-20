@props(['title', 'products', 'viewAllLink' => '#', 'id'])

<div id="{{ $id }}" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">{{ $title }}</h2>
        <a href="{{ $viewAllLink }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center group">
            View All 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        @else
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No products available at this time.</p>
            </div>
        @endif
    </div>
</div>
