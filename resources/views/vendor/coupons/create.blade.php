@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Create New Coupon</h2>
        <a href="{{ route('vendor.coupons.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Coupons
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendor.coupons.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Coupon Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
                                            <button class="btn btn-outline-secondary" type="button" id="generate-code">Generate</button>
                                        </div>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type" required>
                                            <option value="">Select Type</option>
                                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                        </select>
                                        @error('discount_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="discount_value" class="form-label">Discount Value <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="discount-symbol">%</span>
                                            <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value') }}" required>
                                        </div>
                                        @error('discount_value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Usage Restrictions -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Usage Restrictions</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="min_purchase_amount" class="form-label">Minimum Purchase Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('min_purchase_amount') is-invalid @enderror" id="min_purchase_amount" name="min_purchase_amount" value="{{ old('min_purchase_amount') }}">
                                        </div>
                                        <div class="form-text">Leave empty for no minimum</div>
                                        @error('min_purchase_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="usage_limit" class="form-label">Usage Limit</label>
                                        <input type="number" min="1" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}">
                                        <div class="form-text">Leave empty for unlimited uses</div>
                                        @error('usage_limit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="usage_limit_per_user" class="form-label">Usage Limit Per Customer</label>
                                        <input type="number" min="1" class="form-control @error('usage_limit_per_user') is-invalid @enderror" id="usage_limit_per_user" name="usage_limit_per_user" value="{{ old('usage_limit_per_user', 1) }}">
                                        <div class="form-text">Leave empty for unlimited uses per customer</div>
                                        @error('usage_limit_per_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="expires_at" class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="{{ old('expires_at') }}">
                                        <div class="form-text">Leave empty for no expiry</div>
                                        @error('expires_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Applicable Products</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_scope" id="all_products" value="all" {{ old('product_scope', 'all') == 'all' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="all_products">
                                            All Products
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_scope" id="specific_products" value="specific" {{ old('product_scope') == 'specific' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="specific_products">
                                            Specific Products
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3 product-selection" style="display: none;">
                                    <label for="products" class="form-label">Select Products</label>
                                    <select class="form-select @error('products') is-invalid @enderror" id="products" name="products[]" multiple>
                                        @if(isset($products))
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ (is_array(old('products')) && in_array($product->id, old('products'))) ? 'selected' : '' }}>
                                                    {{ $product->name }} ({{ $product->sku ?? 'No SKU' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('products')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Status</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <div class="form-text">Inactive coupons cannot be redeemed by customers.</div>
                            </div>
                        </div>
                        
                        <!-- Additional Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Additional Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_first_order_only" name="is_first_order_only" value="1" {{ old('is_first_order_only') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_first_order_only">
                                        First Order Only
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="requires_auth" name="requires_auth" value="1" {{ old('requires_auth', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="requires_auth">
                                        Requires Customer Login
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="can_combine" name="can_combine" value="1" {{ old('can_combine') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="can_combine">
                                        Can Combine with Other Coupons
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="exclude_sale_items" name="exclude_sale_items" value="1" {{ old('exclude_sale_items') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exclude_sale_items">
                                        Exclude Sale Items
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Coupon
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Discount type change handler
        const discountTypeSelect = document.getElementById('discount_type');
        const discountSymbol = document.getElementById('discount-symbol');
        
        discountTypeSelect.addEventListener('change', function() {
            if (this.value === 'percentage') {
                discountSymbol.textContent = '%';
            } else if (this.value === 'fixed') {
                discountSymbol.textContent = '$';
            }
        });
        
        // Generate coupon code
        const generateCodeBtn = document.getElementById('generate-code');
        const codeInput = document.getElementById('code');
        
        generateCodeBtn.addEventListener('click', function() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < 8; i++) {
                code += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            codeInput.value = code;
        });
        
        // Product scope change handler
        const productScopeRadios = document.querySelectorAll('input[name="product_scope"]');
        const productSelection = document.querySelector('.product-selection');
        
        productScopeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'specific') {
                    productSelection.style.display = 'block';
                } else {
                    productSelection.style.display = 'none';
                }
            });
            
            // Check initial state
            if (radio.checked && radio.value === 'specific') {
                productSelection.style.display = 'block';
            }
        });
    });
</script>
@endsection
