@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @forelse ($categories as $category)
                            <div class="overflow-hidden transition-shadow duration-300 bg-white rounded shadow-lg hover:shadow-xl">
                                <a href="{{ route('categories.show', $category) }}">
                                    @if($category->image)
                                        <img class="object-cover w-full h-48" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-100">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                                        @if($category->description)
                                            <p class="mt-2 text-gray-600">{{ Str::limit($category->description, 100) }}</p>
                                        @endif
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="text-sm text-gray-500">
                                                {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                                            </span>
                                            <span class="px-2 py-1 text-xs font-semibold text-primary-600 bg-primary-100 rounded-full">
                                                {{ $category->store->name }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No categories found.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($categories->hasPages())
                        <div class="mt-6">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@end