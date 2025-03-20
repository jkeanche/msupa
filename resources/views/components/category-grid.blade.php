@props(['categories'])

<div id="categories" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Shop by Category</h2>
        <a href="{{ route('categories.index') ?? '#' }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center group">
            View All 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @if(isset($categories) && count($categories) > 0)
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) ?? '#' }}" class="group">
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center transition duration-300 group-hover:shadow-md group-hover:scale-105 transform">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-4">
                            <i class="fas {{ $category->icon ?? 'fa-tag' }} text-indigo-600 text-xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 group-hover:text-indigo-600">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $category->products_count ?? '0' }} Products</p>
                    </div>
                </a>
            @endforeach
        @else
            <a href="#" class="group">
                <div class="bg-white rounded-lg shadow-sm p-4 text-center transition duration-300 group-hover:shadow-md group-hover:scale-105 transform">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-4">
                        <i class="fas fa-apple-alt text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="font-medium text-gray-900 group-hover:text-indigo-600">Fruits & Vegetables</h3>
                    <p class="text-sm text-gray-500 mt-1">128 Products</p>
                </div>
            </a>
            <!-- Add more placeholder categories -->
        @endif
    </div>
</div>
