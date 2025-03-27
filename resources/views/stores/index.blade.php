@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @forelse ($stores as $store)
                            <div class="overflow-hidden transition-shadow duration-300 bg-white rounded shadow-lg hover:shadow-xl">
                                <a href="{{ route('stores.show', $store) }}">
                                    @if($store->banner)
                                        <img class="object-cover w-full h-48" src="{{ Storage::url($store->banner) }}" alt="{{ $store->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-100">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <div class="flex items-center mb-2">
                                            @if($store->logo)
                                                <img class="w-10 h-10 mr-3 rounded-full" src="{{ Storage::url($store->logo) }}" alt="{{ $store->name }} logo">
                                            @endif
                                            <h3 class="text-xl font-semibold">{{ $store->name }}</h3>
                                        </div>
                                        @if($store->description)
                                            <p class="mt-2 text-gray-600">{{ Str::limit($store->description, 100) }}</p>
                                        @endif
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="text-sm text-gray-500">
                                                {{ $store->products_count }} {{ Str::plural('product', $store->products_count) }}
                                            </span>
                                            @if($store->rating)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <span class="ml-1 text-sm font-medium text-gray-600">{{ number_format($store->rating, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No stores found.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($stores->hasPages())
                        <div class="mt-6">
                            {{ $stores->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection