@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Add Featured Product</h2>
        <a href="{{ route('vendor.featured.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Featured Products
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendor.featured.store') }}" method="POST">
                @csrf
                
                @if(request('section'))
                    <input type="hidden" name="section" value="{{ request('section') }}">
                @endif
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Product Selection -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Select Product</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                                    <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                        <option value="">Select a product</option>
                                        @if(isset($products))
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }} ({{ $product->sku ?? 'No SKU' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div id="product-preview" class="mt-4" style="display: none;">
                                    <h6 class="mb-3">Product Preview</h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img id="product-image" src="{{ asset('images/placeholder.jpg') }}" class="img-fluid rounded border" alt="Product Image">
                                        </div>
                                        <div class="col-md-9">
                                            <h5 id="product-name">Product Name</h5>
                                            <p id="product-price" class="mb-1">Price: $0.00</p>
                                            <p id="product-category" class="mb-1">Category: N/A</p>
                                            <p id="product-stock" class="mb-0">Stock: 0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Featured Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Featured Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                        <div class="form-text">Leave empty to start immediately</div>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                        <div class="form-text">Leave empty for no end date</div>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <select class="form-select @error('position') is-invalid @enderror" id="position" name="position">
                                        <option value="1" {{ old('position') == '1' ? 'selected' : '' }}>1 (Top)</option>
                                        <option value="2" {{ old('position') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('position') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('position') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('position') == '5' ? 'selected' : '' }}>5</option>
                                        <option value="last" {{ old('position') == 'last' ? 'selected' : '' }}>Last</option>
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="custom_title" class="form-label">Custom Title (Optional)</label>
                                    <input type="text" class="form-control @error('custom_title') is-invalid @enderror" id="custom_title" name="custom_title" value="{{ old('custom_title') }}">
                                    <div class="form-text">Leave empty to use product name</div>
                                    @error('custom_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="custom_description" class="form-label">Custom Description (Optional)</label>
                                    <textarea class="form-control @error('custom_description') is-invalid @enderror" id="custom_description" name="custom_description" rows="3">{{ old('custom_description') }}</textarea>
                                    <div class="form-text">Leave empty to use product description</div>
                                    @error('custom_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="custom_link" class="form-label">Custom Link (Optional)</label>
                                    <input type="text" class="form-control @error('custom_link') is-invalid @enderror" id="custom_link" name="custom_link" value="{{ old('custom_link') }}">
                                    <div class="form-text">Leave empty to link to product page</div>
                                    @error('custom_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Featured Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="featured_section" class="form-label">Featured Section</label>
                                    <select class="form-select @error('featured_section') is-invalid @enderror" id="featured_section" name="featured_section">
                                        <option value="general" {{ old('featured_section', request('section', 'general')) == 'general' ? 'selected' : '' }}>General Featured</option>
                                        <option value="homepage_banner" {{ old('featured_section', request('section')) == 'homepage_banner' ? 'selected' : '' }}>Homepage Banner</option>
                                        <option value="special_deals" {{ old('featured_section', request('section')) == 'special_deals' ? 'selected' : '' }}>Special Deals</option>
                                        <option value="category_featured" {{ old('featured_section') == 'category_featured' ? 'selected' : '' }}>Category Featured</option>
                                    </select>
                                    @error('featured_section')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div id="category-selection" class="mb-3" style="display: none;">
                                    <label for="category_id" class="form-label">Select Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        <option value="">Select a category</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="badge_text" class="form-label">Badge Text (Optional)</label>
                                    <input type="text" class="form-control @error('badge_text') is-invalid @enderror" id="badge_text" name="badge_text" value="{{ old('badge_text') }}">
                                    <div class="form-text">E.g., "New", "Hot Deal", "Best Seller"</div>
                                    @error('badge_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="badge_color" class="form-label">Badge Color</label>
                                    <select class="form-select @error('badge_color') is-invalid @enderror" id="badge_color" name="badge_color">
                                        <option value="primary" {{ old('badge_color', 'primary') == 'primary' ? 'selected' : '' }}>Blue</option>
                                        <option value="success" {{ old('badge_color') == 'success' ? 'selected' : '' }}>Green</option>
                                        <option value="danger" {{ old('badge_color') == 'danger' ? 'selected' : '' }}>Red</option>
                                        <option value="warning" {{ old('badge_color') == 'warning' ? 'selected' : '' }}>Yellow</option>
                                        <option value="info" {{ old('badge_color') == 'info' ? 'selected' : '' }}>Light Blue</option>
                                        <option value="dark" {{ old('badge_color') == 'dark' ? 'selected' : '' }}>Black</option>
                                    </select>
                                    @error('badge_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Display Options -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Display Options</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="show_price" name="show_price" value="1" {{ old('show_price', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_price">
                                        Show Price
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="show_description" name="show_description" value="1" {{ old('show_description', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_description">
                                        Show Description
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="show_add_to_cart" name="show_add_to_cart" value="1" {{ old('show_add_to_cart', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_add_to_cart">
                                        Show Add to Cart Button
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Featured Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Product selection preview
        const productSelect = document.getElementById('product_id');
        const productPreview = document.getElementById('product-preview');
        const productImage = document.getElementById('product-image');
        const productName = document.getElementById('product-name');
        const productPrice = document.getElementById('product-price');
        const productCategory = document.getElementById('product-category');
        const productStock = document.getElementById('product-stock');
        
        // This would be populated with actual product data from the backend
        const products = @json($products ?? []);
        
        productSelect.addEventListener('change', function() {
            const selectedProductId = parseInt(this.value);
            if (selectedProductId) {
                const selectedProduct = products.find(p => p.id === selectedProductId);
                if (selectedProduct) {
                    productName.textContent = selectedProduct.name;
                    productPrice.textContent = `Price: $${parseFloat(selectedProduct.price).toFixed(2)}`;
                    productCategory.textContent = `Category: ${selectedProduct.category ? selectedProduct.category.name : 'N/A'}`;
                    productStock.textContent = `Stock: ${selectedProduct.stock_quantity ?? 0}`;
                    
                    if (selectedProduct.image_url) {
                        productImage.src = selectedProduct.image_url;
                    } else {
                        productImage.src = "{{ asset('images/placeholder.jpg') }}";
                    }
                    
                    productPreview.style.display = 'block';
                }
            } else {
                productPreview.style.display = 'none';
            }
        });
        
        // Featured section change handler
        const featuredSectionSelect = document.getElementById('featured_section');
        const categorySelection = document.getElementById('category-selection');
        
        featuredSectionSelect.addEventListener('change', function() {
            if (this.value === 'category_featured') {
                categorySelection.style.display = 'block';
            } else {
                categorySelection.style.display = 'none';
            }
        });
        
        // Trigger change event to set initial state
        featuredSectionSelect.dispatchEvent(new Event('change'));
        
        // Date validation
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        
        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && this.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(this.value);
                
                if (endDate < startDate) {
                    alert('End date cannot be earlier than start date');
                    this.value = '';
                }
            }
        });
        
        startDateInput.addEventListener('change', function() {
            if (endDateInput.value && this.value) {
                const startDate = new Date(this.value);
                const endDate = new Date(endDateInput.value);
                
                if (endDate < startDate) {
                    alert('Start date cannot be later than end date');
                    this.value = '';
                }
            }
        });
    });
</script>
@endsection
