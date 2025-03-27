@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $store->name }}
            </h2>
            <a href="{{ route('stores.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                &larr; Back to Stores
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Store Header -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="relative h-64">
                    @if($store->banner)
                        <img class="object-cover w-full h-full" src="{{ Storage::url($store->banner) }}" alt="{{ $store->name }} banner">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-100">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                        <div class="flex items-center">
                            @if($store->logo)
                                <img class="w-16 h-16 mr-4 rounded-full" src="{{ Storage::url($store->logo) }}" alt="{{ $store->name }} logo">
                            @endif
                            <div>
                                <h1 class="text-3xl font-bold text-white">{{ $store->name }}</h1>
                                @if($store->rating)
                                    <div class="flex items-center mt-2">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-white">{{ number_format($store->rating, 1) }} / 5.0</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    @if($store->description)
                        <p class="text-gray-600">{{ $store->description }}</p>
                    @endif
                    <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                        @if($store->address)
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 w-5 h-5 mt-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="ml-2 text-gray-600">{{ $store->address }}</span>
                            </div>
                        @endif
                        @if($store->phone)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="ml-2 text-gray-600">{{ $store->phone }}</span>
                            </div>
                        @endif
                        @if($store->email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-2 text-gray-600">{{ $store->email }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Categories -->
            @if($categories->count() > 0)
                <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="mb-4 text-xl font-semibold">Categories</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <a href="{{ route('categories.show', $category) }}" class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200">
                                    {{ $category->name }}
                                    <span class="ml-1 text-xs text-gray-500">({{ $category->products_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-semibold">Products</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @forelse($products as $product)
                            <div class="overflow-hidden transition-shadow duration-300 bg-white rounded shadow-lg hover:shadow-xl">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    @if($product->images->count() > 0)
                                        <img class="object-cover w-full h-48" src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-100">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                        <p class="mt-2 text-gray-600">{{ Str::limit($product->description, 100) }}</p>
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="text-xl font-bold text-primary-600">
                                                {{ config('app.currency_symbol') }}{{ number_format($product->price, 2) }}
                                            </span>
                                            @if($product->stock > 0)
                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                    In Stock
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No products found in this store.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($products->hasPages())
                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection