@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Inventory History</h2>
        <div>
            <a href="{{ route('vendor.inventory.edit', $product->id) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit mr-2"></i> Update Stock
            </a>
            <a href="{{ route('vendor.inventory.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Stock History for {{ $product->name }}</h5>
                    <span class="badge bg-{{ $product->stock_quantity <= 0 ? 'danger' : ($product->stock_quantity < 5 ? 'warning text-dark' : 'success') }}">
                        Current Stock: {{ $product->stock_quantity }}
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Adjustment</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inventoryHistory as $history)
                                    <tr>
                                        <td>{{ $history->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            @if($history->adjustment_type == 'add')
                                                <span class="badge bg-success">Added</span>
                                            @elseif($history->adjustment_type == 'subtract')
                                                <span class="badge bg-danger">Removed</span>
                                            @else
                                                <span class="badge bg-info">Set</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->adjustment_type == 'add')
                                                <span class="text-success">+{{ $history->quantity }}</span>
                                                <small class="text-muted d-block">{{ $history->old_quantity }} → {{ $history->new_quantity }}</small>
                                            @elseif($history->adjustment_type == 'subtract')
                                                <span class="text-danger">-{{ $history->quantity }}</span>
                                                <small class="text-muted d-block">{{ $history->old_quantity }} → {{ $history->new_quantity }}</small>
                                            @else
                                                <span>{{ $history->quantity }}</span>
                                                <small class="text-muted d-block">{{ $history->old_quantity }} → {{ $history->new_quantity }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $history->reason }}</td>
                                        <td>{{ $history->user->name ?? 'System' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                                <h5>No history records found</h5>
                                                <p class="text-muted">Stock adjustments will appear here</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($inventoryHistory->hasPages())
                    <div class="card-footer bg-white">
                        {{ $inventoryHistory->links() }}
                    </div>
                @endif
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Product Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        @if($product->images->count() > 0)
                            <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-1">{{ $product->name }}</h5>
                            <p class="text-muted mb-0">SKU: {{ $product->sku ?? 'N/A' }}</p>
                            <p class="mb-0">Category: {{ $product->category->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 text-muted">Price:</p>
                                <p class="fw-bold">Ksh.{{ number_format($product->price, 2) }}</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 text-muted">Sale Price:</p>
                                <p class="fw-bold">{{ $product->sale_price ? '$'.number_format($product->sale_price, 2) : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <p class="mb-1 text-muted">Status:</p>
                        <p class="mb-0">
                            @if($product->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('vendor.inventory.edit', $product->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i> Update Stock
                        </a>
                        <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-pencil-alt me-2"></i> Edit Product Details
                        </a>
                        <a href="{{ route('vendor.products.show', $product->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i> View Product
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Stock Stats -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Stock Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Current Stock Level</h6>
                        <div class="progress" style="height: 25px;">
                            @php
                                $stockPercentage = 0;
                                $stockClass = 'bg-danger';
                                
                                if ($product->stock_quantity > 0) {
                                    // Assuming a reasonable max stock of 100 for percentage calculation
                                    $maxStock = 100;
                                    $stockPercentage = min(100, ($product->stock_quantity / $maxStock) * 100);
                                    
                                    if ($product->stock_quantity < 5) {
                                        $stockClass = 'bg-warning';
                                    } else if ($product->stock_quantity < 20) {
                                        $stockClass = 'bg-info';
                                    } else {
                                        $stockClass = 'bg-success';
                                    }
                                }
                            @endphp
                            <div class="progress-bar {{ $stockClass }}" role="progressbar" style="width: {{ $stockPercentage }}%;" aria-valuenow="{{ $product->stock_quantity }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $product->stock_quantity }} units
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-center mt-4">
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <h6 class="text-muted mb-2">Total Added</h6>
                                <h3 class="text-success">
                                    {{ $inventoryHistory->where('adjustment_type', 'add')->sum('quantity') ?? 0 }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <h6 class="text-muted mb-2">Total Removed</h6>
                                <h3 class="text-danger">
                                    {{ $inventoryHistory->where('adjustment_type', 'subtract')->sum('quantity') ?? 0 }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
