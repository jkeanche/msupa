@extends('layouts.app')

@section('title', 'Category Details')

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
            <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-indigo-600">Categories</a>
            <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li class="text-indigo-600 font-medium" aria-current="page">{{ $category->name }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Category Details</h3>
            <div class="flex space-x-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center">
                @if($category->image)
                    <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden mr-4">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover">
                    </div>
                @else
                    <div class="flex-shrink-0 h-20 w-20 rounded-md bg-gray-200 flex items-center justify-center mr-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $category->name }}</h2>
                    <p class="text-sm text-gray-500">
                        {{ $category->slug }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <h4 class="text-base font-medium text-gray-900">Basic Information</h4>
                    <dl class="mt-2 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Parent Category</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($category->parent)
                                    <a href="{{ route('admin.categories.show', $category->parent_id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $category->parent->name }}
                                    </a>
                                @else
                                    <span class="text-gray-500">None</span>
                                @endif
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($category->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created At</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $category->created_at->format('M d, Y h:i A') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $category->updated_at->format('M d, Y h:i A') }}</dd>
                        </div>
                    </dl>
                </div>
                
                @if($category->description)
                <div>
                    <h4 class="text-base font-medium text-gray-900">Description</h4>
                    <div class="mt-2 prose prose-sm max-w-none text-gray-500">
                        {{ $category->description }}
                    </div>
                </div>
                @endif
                
                <div>
                    <h4 class="text-base font-medium text-gray-900">SEO Information</h4>
                    <dl class="mt-2 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Meta Title</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $category->meta_title ?: 'Not set' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Meta Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $category->meta_description ?: 'Not set' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            
            <div>
                <h4 class="text-base font-medium text-gray-900">
                    Subcategories 
                    @if(count($category->children))
                        <span class="ml-2 text-xs font-medium text-gray-500">({{ count($category->children) }})</span>
                    @endif
                </h4>
                
                @if(count($category->children))
                    <ul class="mt-2 divide-y divide-gray-200">
                        @foreach($category->children as $child)
                            <li class="py-2">
                                <a href="{{ route('admin.categories.show', $child->id) }}" class="flex items-center hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                    @if($child->image)
                                        <img src="{{ asset('storage/' . $child->image) }}" alt="{{ $child->name }}" class="h-8 w-8 rounded-full object-cover mr-3">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                        <div class="text-xs text-gray-500">
                                            @if($child->is_active)
                                                <span class="text-green-600">Active</span>
                                            @else
                                                <span class="text-red-600">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="mt-2 py-4 text-center text-sm text-gray-500 bg-gray-50 rounded-md">
                        No subcategories found
                    </div>
                @endif
                
                <h4 class="text-base font-medium text-gray-900 mt-6">
                    Products 
                    @if($category->products_count > 0)
                        <span class="ml-2 text-xs font-medium text-gray-500">({{ $category->products_count }})</span>
                    @endif
                </h4>
                
                @if($category->products_count > 0)
                    <div class="mt-2">
                        <a href="{{ route('admin.products.index', ['category' => $category->id]) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View All Products in this Category
                        </a>
                    </div>
                @else
                    <div class="mt-2 py-4 text-center text-sm text-gray-500 bg-gray-50 rounded-md">
                        No products in this category
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection