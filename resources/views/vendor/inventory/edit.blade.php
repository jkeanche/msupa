@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Update Inventory</h2>
        <a href="{{ route('vendor.inventory.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Stock Management</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.inventory.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_stock" class="form-label">Current Stock</label>
                                    <input type="number" class="form-control-plaintext" id="current_stock" value="{{ $product->stock_quantity }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock_status" class="form-label">Stock Status</label>
                                    <div>
                                        @if($product->stock_quantity <= 0)
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @elseif($product->stock_quantity < 5)
                                            <span class="badge bg-warning text-dark">Low Stock</span>
                                        @else
                                            <span class="badge bg-success">In Stock</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Update Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_method" id="update_method_set" value="set" checked>
                                <label class="form-check-label" for="update_method_set">
                                    Set exact quantity
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_method" id="update_method_add" value="add">
                                <label class="form-check-label" for="update_method_add">
                                    Add to current stock
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_method" id="update_method_subtract" value="subtract">
                                <label class="form-check-label" for="update_method_subtract">
                                    Subtract from current stock
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 0) }}" min="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted" id="quantity_help">Enter the quantity to update stock.</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="reason" class="form-label">Reason for Update</label>
                            <select class="form-select @error('reason') is-invalid @enderror" id="reason" name="reason">
                                <option value="stock_count">Stock Count/Adjustment</option>
                                <option value="received_inventory">Received New Inventory</option>
                                <option value="damaged">Damaged/Defective Items</option>
                                <option value="returned">Customer Returns</option>
                                <option value="other">Other</option>
                            </select>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4" id="other_reason_container" style="display: none;">
                            <label for="other_reason" class="form-label">Specify Reason</label>
                            <textarea class="form-control @error('other_reason') is-invalid @enderror" id="other_reason" name="other_reason" rows="2">{{ old('other_reason') }}</textarea>
                            @error('other_reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i> Update Inventory
                            </button>
                        </div>
                    </form>
                </div>
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
                        <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i> Edit Product Details
                        </a>
                        <a href="{{ route('vendor.products.show', $product->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i> View Product
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Inventory History -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Inventory History</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($inventoryHistory ?? [] as $history)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0 fw-semibold">
                                            @if($history->adjustment_type == 'add')
                                                <span class="text-success">+{{ $history->quantity }}</span>
                                            @elseif($history->adjustment_type == 'subtract')
                                                <span class="text-danger">-{{ $history->quantity }}</span>
                                            @else
                                                <span>Set to {{ $history->quantity }}</span>
                                            @endif
                                        </p>
                                        <p class="text-muted small mb-0">{{ $history->reason }}</p>
                                    </div>
                                    <small class="text-muted">{{ $history->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center py-3">
                                <p class="text-muted mb-0">No inventory history available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                @if(!empty($inventoryHistory) && count($inventoryHistory) > 5)
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('vendor.inventory.history', $product->id) }}" class="text-decoration-none">View Full History</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Show/hide other reason field based on selection
    document.getElementById('reason').addEventListener('change', function() {
        const otherReasonContainer = document.getElementById('other_reason_container');
        if (this.value === 'other') {
            otherReasonContainer.style.display = 'block';
        } else {
            otherReasonContainer.style.display = 'none';
        }
    });
    
    // Update help text based on update method
    const updateMethodRadios = document.querySelectorAll('input[name="update_method"]');
    const quantityHelp = document.getElementById('quantity_help');
    
    updateMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            switch(this.value) {
                case 'set':
                    quantityHelp.textContent = 'Enter the exact quantity to set as current stock.';
                    break;
                case 'add':
                    quantityHelp.textContent = 'Enter the quantity to add to current stock.';
                    break;
                case 'subtract':
                    quantityHelp.textContent = 'Enter the quantity to subtract from current stock.';
                    break;
            }
        });
    });
</script>
@endpush
@endsection
