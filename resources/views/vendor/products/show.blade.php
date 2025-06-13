@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Product Details</h2>
        <div>
            <a href="{{ route('vendor.products.edit', $product) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit mr-2"></i> Edit Product
            </a>
            <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Products
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Product Images -->
                            <div class="product-gallery mb-4">
                                @if($product->images->count() > 0)
                                    <div class="main-image mb-3">
                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded" 
                                             id="main-product-image">
                                    </div>
                                    @if($product->images->count() > 1)
                                        <div class="thumbnails d-flex flex-wrap">
                                            @foreach($product->images as $image)
                                                <div class="thumbnail-item me-2 mb-2" style="width: 70px; height: 70px;">
                                                    <img src="{{ asset('storage/' . $image->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-thumbnail w-100 h-100" 
                                                         style="object-fit: cover; cursor: pointer;"
                                                         onclick="document.getElementById('main-product-image').src = this.src">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div class="no-image bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-3x mb-3"></i>
                                            <p>No images available</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Product Details -->
                            <h3 class="h4 mb-3">{{ $product->name }}</h3>
                            
                            <div class="mb-3">
                                <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                                <span class="badge bg-info">{{ $product->category->name ?? 'No Category' }}</span>
                            </div>
                            
                            <div class="mb-3">
                                @if($product->sale_price)
                                    <div class="d-flex align-items-center">
                                        <span class="text-decoration-line-through text-muted me-2">Ksh.{{ number_format($product->price, 2) }}</span>
                                        <span class="text-danger fs-4">Ksh.{{ number_format($product->sale_price, 2) }}</span>
                                        {{-- @php
                                            $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                                        @endphp --}}
                                        {{-- <span class="badge bg-danger ms-2">{{ $discount }}% OFF</span> --}}
                                    </div>
                                @else
                                    {{-- <span class="fs-4">Ksh.{{ number_format($product->price, 2) }}</span> --}}
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                <p class="mb-1"><strong>Stock:</strong> 
                                    <span class="{{ $product->quantity < 5 ? 'text-danger' : 'text-success' }}">
                                        {{ $product->quantity }} in stock
                                    </span>
                                </p>
                                <p class="mb-1"><strong>Created:</strong> {{ $product->created_at->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>Last Updated:</strong> {{ $product->updated_at->format('M d, Y') }}</p>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('vendor.products.edit', $product) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i> Edit Product
                                </a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                    <i class="fas fa-trash me-2"></i> Delete Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Description -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Product Description</h5>
                </div>
                <div class="card-body">
                    <div class="product-description">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Product Statistics -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Product Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Views</span>
                            <span class="badge bg-primary rounded-pill">{{ $product->views_count ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Orders</span>
                            <span class="badge bg-primary rounded-pill">{{ $product->orders_count ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Units Sold</span>
                            <span class="badge bg-primary rounded-pill">{{ $product->units_sold ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Revenue Generated</span>
                            <span class="badge bg-success rounded-pill">Ksh.{{ number_format($product->revenue ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('vendor.inventory.edit', $product->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-boxes me-2"></i> Update Inventory
                        </a>
                        <a href="{{ route('vendor.promotions.create', ['product_id' => $product->id]) }}" class="btn btn-outline-success">
                            <i class="fas fa-percentage me-2"></i> Create Promotion
                        </a>
                        <a href="{{ route('vendor.featured.create', ['product_id' => $product->id]) }}" class="btn btn-outline-info">
                            <i class="fas fa-star me-2"></i> Feature Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                <p class="text-danger"><strong>{{ $product->name }}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('vendor.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
