@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
<nav class="py-3 px-5">
    <ol class="flex flex-wrap text-sm">
        <li class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
            <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li class="flex items-center">
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-indigo-600">Products</a>
            <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li class="text-indigo-600 font-medium" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <!-- Product Details Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Product Details</h2>
            <div class="flex space-x-2 mt-2 sm:mt-0">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this product?')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Product Images -->
                <div class="md:col-span-4">
                    <div class="space-y-4">
                        @if($product->images && $product->images->count() > 0)
                            <div class="rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                            </div>
                            
                            @if($product->images->count() > 1)
                                <div class="grid grid-cols-4 gap-2">
                                    @foreach($product->images->skip(1)->take(4) as $image)
                                        <div class="rounded-md overflow-hidden bg-gray-100">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-16 object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="bg-gray-100 rounded-lg flex items-center justify-center h-64">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Status Cards -->
                    <div class="mt-6 space-y-4">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Status</span>
                            @if($product->status == 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Stock Status</span>
                            @if($product->quantity > 10)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    In Stock ({{ $product->quantity }})
                                </span>
                            @elseif($product->quantity > 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Low Stock ({{ $product->quantity }})
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                        
                        @if(isset($product->is_featured))
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Featured</span>
                            @if($product->is_featured)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Yes
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    No
                                </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="md:col-span-8">
                    <div class="space-y-6">
                        <!-- Basic Info -->
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                            
                            <div class="mt-2 flex items-center">
                                <span class="px-2 py-1 text-xs rounded-md bg-indigo-100 text-indigo-800 mr-2">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                                @if(isset($product->sku) && $product->sku)
                                <span class="text-sm text-gray-500">SKU: {{ $product->sku }}</span>
                                @endif
                            </div>
                            
                            <!-- Price -->
                            <div class="mt-4 flex items-baseline">
                                @if(isset($product->sale_price) && $product->sale_price)
                                    <p class="text-2xl font-bold text-indigo-600">
                                        Ksh {{ number_format($product->sale_price, 2) }}
                                    </p>
                                    <p class="ml-2 text-lg text-gray-500 line-through">
                                        Ksh {{ number_format($product->price, 2) }}
                                    </p>
                                    
                                @else
                                    <p class="text-2xl font-bold text-indigo-600">
                                        Ksh {{ number_format($product->price, 2) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Description</h3>
                            <div class="mt-2 prose prose-sm max-w-none text-gray-500">
                                {!! $product->description !!}
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 py-4 border-t border-b border-gray-200">
                            @if(isset($product->store))
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Store</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->store->name ?? 'N/A' }}</p>
                            </div>
                            @endif
                            
                            @if(isset($product->brand))
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Brand</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->brand ?? 'N/A' }}</p>
                            </div>
                            @endif
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Quantity</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->quantity }}</p>
                            </div>
                            
                            @if(isset($product->weight))
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Weight</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->weight ?? 'N/A' }} kg</p>
                            </div>
                            @endif
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Created At</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->created_at->format('M d, Y') }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Last Updated</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <!-- Admin Actions -->
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Product
                            </a>
                            
                            @if($product->status == 'active')
                                <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                    Mark as Inactive
                                </a>
                            @else
                                <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Mark as Active
                                </a>
                            @endif
                            
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products Section -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Related Products</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="group relative bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="aspect-w-3 aspect-h-3 bg-gray-200 group-hover:opacity-90">
                        @if($relatedProduct->images->count() > 0)
                            <img src="{{ asset('storage/' . $relatedProduct->images->first()->image) }}" 
                                alt="{{ $relatedProduct->name }}" 
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-1">
                            {{ $relatedProduct->name }}
                        </h3>
                        
                        <p class="text-xs text-gray-500 mb-2">
                            {{ $relatedProduct->category->name ?? 'Uncategorized' }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <div>
                                @if(isset($relatedProduct->sale_price) && $relatedProduct->sale_price)
                                    <span class="text-sm font-bold text-indigo-600">Ksh {{ number_format($relatedProduct->sale_price, 2) }}</span>
                                    <span class="text-xs text-gray-500 line-through ml-1">Ksh {{ number_format($relatedProduct->price, 2) }}</span>
                                @else
                                    <span class="text-sm font-bold text-indigo-600">Ksh {{ number_format($relatedProduct->price, 2) }}</span>
                                @endif
                            </div>
                            
                            <div>
                                @if($relatedProduct->quantity > 0)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        In Stock
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('admin.products.show', $relatedProduct->id) }}" class="flex-1 bg-white text-indigo-600 text-xs text-center px-2 py-1 border border-indigo-600 rounded hover:bg-indigo-50 transition-colors duration-150">
                                View Details
                            </a>
                            <a href="{{ route('admin.products.edit', $relatedProduct->id) }}" class="flex-1 bg-indigo-600 text-white text-xs text-center px-2 py-1 rounded hover:bg-indigo-700 transition-colors duration-150">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection