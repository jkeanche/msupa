@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Product Details</h4>
        <div>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                        <span class="text-muted">No image available</span>
                    </div>
                @endif
                
                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Status</h5>
                        <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h5>Featured</h5>
                        <span class="badge {{ $product->featured ? 'bg-warning' : 'bg-secondary' }}">
                            {{ $product->featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <h2>{{ $product->name }}</h2>
                
                <div class="mb-3">
                    <span class="badge bg-primary me-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                    <span class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</span>
                </div>
                
                <h4 class="text-primary mb-3">Ksh {{ number_format($product->price, 2) }}</h4>
                
                <div class="mb-3">
                    <h5>Stock Status:</h5>
                    @if($product->stock > 10)
                        <span class="text-success">In Stock ({{ $product->stock }} available)</span>
                    @elseif($product->stock > 0)
                        <span class="text-warning">Low Stock ({{ $product->stock }} remaining)</span>
                    @else
                        <span class="text-danger">Out of Stock</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <h5>Description:</h5>
                    <div class="border rounded p-3 bg-light">
                        {!! $product->description !!}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Created:</h5>
                        <p>{{ $product->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Last Updated:</h5>
                        <p>{{ $product->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
