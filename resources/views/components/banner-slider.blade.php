@props(['banners'])

<div class="banner-slider relative mb-12">
    @if(isset($banners) && count($banners) > 0)
        @foreach($banners as $banner)
            <div class="relative">
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="w-full h-[500px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-lg">
                            <h2 class="text-4xl font-extrabold text-white mb-4">{{ $banner->title }}</h2>
                            <p class="text-xl text-white mb-6">{{ $banner->description }}</p>
                            <a href="{{ $banner->link_url }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 inline-flex items-center transition duration-300 transform hover:translate-x-2">
                                {{ $banner->link_text ?? 'Shop Now' }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- Fallback Banner -->
        <div class="relative">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e" alt="Shop Groceries" class="w-full h-[500px] object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-lg">
                        <h2 class="text-4xl font-extrabold text-white mb-4">Compare & Shop Across Stores</h2>
                        <p class="text-xl text-white mb-6">Find the best prices on groceries and household items from Kenya's top supermarkets.</p>
                        <a href="#products" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 inline-flex items-center transition duration-300 transform hover:translate-x-2">
                            Shop Now
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
