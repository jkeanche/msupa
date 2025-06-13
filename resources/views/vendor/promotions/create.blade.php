@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Create New Promotion</h2>
        <a href="{{ route('vendor.promotions.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Promotions
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendor.promotions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Promotion Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <label for="type" class="form-label">Promotion Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                            <option value="bogo" {{ old('type') == 'bogo' ? 'selected' : '' }}>Buy One Get One</option>
                                            <option value="free_shipping" {{ old('type') == 'free_shipping' ? 'selected' : '' }}>Free Shipping</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3 discount-value-container">
                                        <label for="value" class="form-label">Discount Value <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="discount-symbol">%</span>
                                            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}" step="0.01" min="0">
                                        </div>
                                        @error('value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="code" class="form-label">Promotion Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}">
                                        <button class="btn btn-outline-secondary" type="button" id="generate-code">Generate</button>
                                    </div>
                                    <div class="form-text">Leave empty for automatic generation</div>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Conditions -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Conditions</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="min_purchase" class="form-label">Minimum Purchase Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('min_purchase') is-invalid @enderror" id="min_purchase" name="min_purchase" value="{{ old('min_purchase') }}">
                                    </div>
                                    <div class="form-text">Leave empty for no minimum</div>
                                    @error('min_purchase')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="max_uses" class="form-label">Maximum Uses</label>
                                    <input type="number" min="1" class="form-control @error('max_uses') is-invalid @enderror" id="max_uses" name="max_uses" value="{{ old('max_uses') }}">
                                    <div class="form-text">Leave empty for unlimited uses</div>
                                    @error('max_uses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="max_uses_per_customer" class="form-label">Maximum Uses Per Customer</label>
                                    <input type="number" min="1" class="form-control @error('max_uses_per_customer') is-invalid @enderror" id="max_uses_per_customer" name="max_uses_per_customer" value="{{ old('max_uses_per_customer', 1) }}">
                                    <div class="form-text">Leave empty for unlimited uses per customer</div>
                                    @error('max_uses_per_customer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_scope" id="specific_categories" value="categories" {{ old('product_scope') == 'categories' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="specific_categories">
                                            Specific Categories
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3 product-selection" style="display: none;">
                                    <label for="products" class="form-label">Select Products</label>
                                    <select class="form-select @error('products') is-invalid @enderror" id="products" name="products[]" multiple>
                                        @if(isset($products))
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ (is_array(old('products')) && in_array($product->id, old('products'))) ? 'selected' : '' }}>
                                                    {{ $product->name }} ({{ $product->sku }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('products')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 category-selection" style="display: none;">
                                    <label for="categories" class="form-label">Select Categories</label>
                                    <select class="form-select @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('categories')
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
                                <div class="mb-3">
                                    <label for="status" class="form-label">Promotion Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Promotion
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Banner Image -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Banner Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="banner_image" class="form-label">Upload Banner</label>
                                    <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image">
                                    <div class="form-text">Recommended size: 1200x300px</div>
                                    @error('banner_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mt-3">
                                    <div id="image-preview-container" class="text-center">
                                        <img id="image-preview" src="{{ asset('images/placeholder-banner.jpg') }}" class="img-fluid rounded border" alt="Banner Preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Additional Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_public" name="is_public" value="1" {{ old('is_public', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_public">
                                        Show in Public Promotions Page
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="requires_auth" name="requires_auth" value="1" {{ old('requires_auth') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="requires_auth">
                                        Requires Customer Login
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="can_combine" name="can_combine" value="1" {{ old('can_combine', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="can_combine">
                                        Can Combine with Other Promotions
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Promotion</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Type change handler
        const typeSelect = document.getElementById('type');
        const valueContainer = document.querySelector('.discount-value-container');
        const discountSymbol = document.querySelector('.discount-symbol');
        const bogoFields = document.querySelector('.bogo-fields');
        
        typeSelect.addEventListener('change', function() {
            // Show/hide value field based on type
            if (this.value === 'free_shipping') {
                valueContainer.style.display = 'none';
            } else {
                valueContainer.style.display = 'block';
            }
            
            // Update symbol based on type
            if (this.value === 'percentage') {
                discountSymbol.textContent = '%';
            } else if (this.value === 'fixed') {
                discountSymbol.textContent = '$';
            } else {
                discountSymbol.textContent = '';
            }
            
            // Show/hide BOGO fields
            if (this.value === 'bogo') {
                bogoFields.style.display = 'flex';
            } else {
                bogoFields.style.display = 'none';
            }
        });
        
        // Trigger change event to set initial state
        typeSelect.dispatchEvent(new Event('change'));
        
        // Product scope change handler
        const productScopeRadios = document.querySelectorAll('input[name="product_scope"]');
        const productSelection = document.querySelector('.product-selection');
        const categorySelection = document.querySelector('.category-selection');
        
        productScopeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'specific') {
                    productSelection.style.display = 'block';
                    categorySelection.style.display = 'none';
                } else if (this.value === 'categories') {
                    productSelection.style.display = 'none';
                    categorySelection.style.display = 'block';
                } else {
                    productSelection.style.display = 'none';
                    categorySelection.style.display = 'none';
                }
            });
            
            // Check initial state
            if (radio.checked) {
                radio.dispatchEvent(new Event('change'));
            }
        });
        
        // Generate promotion code
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
        
        // Image preview
        const imageInput = document.getElementById('banner_image');
        const imagePreview = document.getElementById('image-preview');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
