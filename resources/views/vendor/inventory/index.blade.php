@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Inventory Management</h2>
        <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Stock Levels</h5>
                </div>
                <div class="col-auto">
                    <form action="{{ route('vendor.inventory.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <select name="stock_status" class="form-select">
                                <option value="">All Stock Status</option>
                                <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                                <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" width="80">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Category</th>
                            <th scope="col">Current Stock</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="60">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    <div class="small text-muted">ID: #{{ $product->id }}</div>
                                </td>
                                <td>{{ $product->sku ?? 'N/A' }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if($product->stock_quantity <= 0)
                                        <span class="text-danger fw-bold">{{ $product->stock_quantity }}</span>
                                    @elseif($product->stock_quantity < 5)
                                        <span class="text-warning fw-bold">{{ $product->stock_quantity }}</span>
                                    @else
                                        <span class="text-success">{{ $product->stock_quantity }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->stock_quantity <= 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @elseif($product->stock_quantity < 5)
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    @else
                                        <span class="badge bg-success">In Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.inventory.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="{{ route('vendor.products.edit', $product->id) }}" class="dropdown-item">
                                                    <i class="fas fa-pencil-alt me-2"></i> Edit Product
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('vendor.products.show', $product->id) }}" class="dropdown-item">
                                                    <i class="fas fa-eye me-2"></i> View Details
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5>No products found</h5>
                                        <p class="text-muted">Start adding products to manage your inventory</p>
                                        <a href="{{ route('vendor.products.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus mr-2"></i> Add New Product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} products
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Products</h6>
                            <h2 class="mt-2 mb-0">{{ $totalProducts ?? 0 }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-boxes fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-primary-dark">
                    <a href="{{ route('vendor.products.index') }}" class="small text-white stretched-link">View All Products</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Low Stock Items</h6>
                            <h2 class="mt-2 mb-0">{{ $lowStockCount ?? 0 }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-exclamation-triangle fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-warning-dark text-dark">
                    <a href="{{ route('vendor.inventory.index', ['stock_status' => 'low_stock']) }}" class="small text-dark stretched-link">View Low Stock Items</a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Out of Stock Items</h6>
                            <h2 class="mt-2 mb-0">{{ $outOfStockCount ?? 0 }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-times-circle fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-danger-dark">
                    <a href="{{ route('vendor.inventory.index', ['stock_status' => 'out_of_stock']) }}" class="small text-white stretched-link">View Out of Stock Items</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
