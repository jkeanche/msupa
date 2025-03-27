@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $category->name }}
            </h2>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                &larr; Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Category Header -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="relative h-64">
                    @if($category->image)
                        <img class="object-cover w-full h-full" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }} banner">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-100">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                        <h1 class="text-3xl font-bold text-white">{{ $category->name }}</h1>
                        @if($category->description)
                            <p class="mt-2 text-gray-200">{{ $category->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-semibold">Products in {{ $category->name }}</h2>
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
                                <p class="text-center text-gray-500">No products found in this category.</p>
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