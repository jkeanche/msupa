@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Store Settings</h2>
        <div>
            <button type="button" class="btn btn-outline-secondary me-2" id="reset-settings">
                <i class="fas fa-undo mr-2"></i> Reset
            </button>
            <button type="submit" form="store-settings-form" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush rounded-0" id="settings-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="general-tab" data-bs-toggle="list" href="#general" role="tab" aria-controls="general">
                            <i class="fas fa-store me-2"></i> General
                        </a>
                        <a class="list-group-item list-group-item-action" id="payment-tab" data-bs-toggle="list" href="#payment" role="tab" aria-controls="payment">
                            <i class="fas fa-credit-card me-2"></i> Payment
                        </a>
                        <a class="list-group-item list-group-item-action" id="shipping-tab" data-bs-toggle="list" href="#shipping" role="tab" aria-controls="shipping">
                            <i class="fas fa-truck me-2"></i> Shipping
                        </a>
                        <a class="list-group-item list-group-item-action" id="tax-tab" data-bs-toggle="list" href="#tax" role="tab" aria-controls="tax">
                            <i class="fas fa-receipt me-2"></i> Tax
                        </a>
                        <a class="list-group-item list-group-item-action" id="notification-tab" data-bs-toggle="list" href="#notification" role="tab" aria-controls="notification">
                            <i class="fas fa-bell me-2"></i> Notifications
                        </a>
                        <a class="list-group-item list-group-item-action" id="seo-tab" data-bs-toggle="list" href="#seo" role="tab" aria-controls="seo">
                            <i class="fas fa-search me-2"></i> SEO
                        </a>
                        <a class="list-group-item list-group-item-action" id="policy-tab" data-bs-toggle="list" href="#policy" role="tab" aria-controls="policy">
                            <i class="fas fa-file-contract me-2"></i> Policies
                        </a>
                        <a class="list-group-item list-group-item-action" id="api-tab" data-bs-toggle="list" href="#api" role="tab" aria-controls="api">
                            <i class="fas fa-code me-2"></i> API
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <form id="store-settings-form" action="{{ route('vendor.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="tab-content">
                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">General Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="store_name" class="form-label">Store Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name" value="{{ old('store_name', $store->name ?? '') }}" required>
                                        @error('store_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="store_email" class="form-label">Store Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('store_email') is-invalid @enderror" id="store_email" name="store_email" value="{{ old('store_email', $store->email ?? '') }}" required>
                                        @error('store_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="store_phone" class="form-label">Store Phone</label>
                                        <input type="tel" class="form-control @error('store_phone') is-invalid @enderror" id="store_phone" name="store_phone" value="{{ old('store_phone', $store->phone ?? '') }}">
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="store_status" class="form-label">Store Status</label>
                                        <select class="form-select @error('store_status') is-invalid @enderror" id="store_status" name="store_status">
                                            <option value="active" {{ old('store_status', $store->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="maintenance" {{ old('store_status', $store->status ?? '') == 'maintenance' ? 'selected' : '' }}>Maintenance Mode</option>
                                            <option value="vacation" {{ old('store_status', $store->status ?? '') == 'vacation' ? 'selected' : '' }}>Vacation Mode</option>
                                            <option value="closed" {{ old('store_status', $store->status ?? '') == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                        @error('store_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="store_description" class="form-label">Store Description</label>
                                    <textarea class="form-control @error('store_description') is-invalid @enderror" id="store_description" name="store_description" rows="3">{{ old('store_description', $store->description ?? '') }}</textarea>
                                    @error('store_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="store_logo" class="form-label">Store Logo</label>
                                        <input type="file" class="form-control @error('store_logo') is-invalid @enderror" id="store_logo" name="store_logo">
                                        <div class="form-text">Recommended size: 200x200px</div>
                                        @error('store_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        
                                        @if($store->logo ?? false)
                                        <div class="mt-2">
                                            <img src="{{ asset($store->logo) }}" alt="Store Logo" class="img-thumbnail" style="max-width: 100px;">
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="store_banner" class="form-label">Store Banner</label>
                                        <input type="file" class="form-control @error('store_banner') is-invalid @enderror" id="store_banner" name="store_banner">
                                        <div class="form-text">Recommended size: 1200x300px</div>
                                        @error('store_banner')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        
                                        @if($store->banner ?? false)
                                        <div class="mt-2">
                                            <img src="{{ asset($store->banner) }}" alt="Store Banner" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="store_address" class="form-label">Store Address</label>
                                    <textarea class="form-control @error('store_address') is-invalid @enderror" id="store_address" name="store_address" rows="2">{{ old('store_address', $store->address ?? '') }}</textarea>
                                    @error('store_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="store_city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('store_city') is-invalid @enderror" id="store_city" name="store_city" value="{{ old('store_city', $store->city ?? '') }}">
                                        @error('store_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="store_state" class="form-label">State/Province</label>
                                        <input type="text" class="form-control @error('store_state') is-invalid @enderror" id="store_state" name="store_state" value="{{ old('store_state', $store->state ?? '') }}">
                                        @error('store_state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="store_zip" class="form-label">ZIP/Postal Code</label>
                                        <input type="text" class="form-control @error('store_zip') is-invalid @enderror" id="store_zip" name="store_zip" value="{{ old('store_zip', $store->zip ?? '') }}">
                                        @error('store_zip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="store_country" class="form-label">Country</label>
                                    <select class="form-select @error('store_country') is-invalid @enderror" id="store_country" name="store_country">
                                        <option value="">Select Country</option>
                                        <option value="KE" {{ old('store_country', $store->country ?? '') == 'KE' ? 'selected' : '' }}>Kenya</option>
                                        <option value="UG" {{ old('store_country', $store->country ?? '') == 'UG' ? 'selected' : '' }}>Uganda</option>
                                        <option value="TZ" {{ old('store_country', $store->country ?? '') == 'TZ' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="RW" {{ old('store_country', $store->country ?? '') == 'RW' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="BI" {{ old('store_country', $store->country ?? '') == 'BI' ? 'selected' : '' }}>Burundi</option>
                                    </select>
                                    @error('store_country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Settings -->
                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Payment Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="payment_methods" class="form-label">Accepted Payment Methods</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_mpesa" name="payment_methods[]" value="mpesa" {{ in_array('mpesa', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_mpesa">
                                                    M-Pesa
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_card" name="payment_methods[]" value="card" {{ in_array('card', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_card">
                                                    Credit/Debit Card
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_bank" name="payment_methods[]" value="bank" {{ in_array('bank', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_bank">
                                                    Bank Transfer
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_cod" name="payment_methods[]" value="cod" {{ in_array('cod', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_cod">
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_paypal" name="payment_methods[]" value="paypal" {{ in_array('paypal', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_paypal">
                                                    PayPal
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="payment_other" name="payment_methods[]" value="other" {{ in_array('other', old('payment_methods', $paymentMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_other">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ old('bank_name', $paymentSettings->bank_name ?? '') }}">
                                    @error('bank_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="account_name" class="form-label">Account Name</label>
                                        <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" name="account_name" value="{{ old('account_name', $paymentSettings->account_name ?? '') }}">
                                        @error('account_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="account_number" class="form-label">Account Number</label>
                                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number', $paymentSettings->account_number ?? '') }}">
                                        @error('account_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="mpesa_phone" class="form-label">M-Pesa Phone Number</label>
                                    <input type="text" class="form-control @error('mpesa_phone') is-invalid @enderror" id="mpesa_phone" name="mpesa_phone" value="{{ old('mpesa_phone', $paymentSettings->mpesa_phone ?? '') }}">
                                    @error('mpesa_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="paypal_email" class="form-label">PayPal Email</label>
                                    <input type="email" class="form-control @error('paypal_email') is-invalid @enderror" id="paypal_email" name="paypal_email" value="{{ old('paypal_email', $paymentSettings->paypal_email ?? '') }}">
                                    @error('paypal_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Shipping Settings -->
                    <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Shipping Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="enable_shipping" name="enable_shipping" value="1" {{ old('enable_shipping', $shippingSettings->enable_shipping ?? '') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_shipping">Enable Shipping</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="shipping_methods" class="form-label">Shipping Methods</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="shipping_standard" name="shipping_methods[]" value="standard" {{ in_array('standard', old('shipping_methods', $shippingMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="shipping_standard">
                                                    Standard Shipping
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="shipping_express" name="shipping_methods[]" value="express" {{ in_array('express', old('shipping_methods', $shippingMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="shipping_express">
                                                    Express Shipping
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="shipping_pickup" name="shipping_methods[]" value="pickup" {{ in_array('pickup', old('shipping_methods', $shippingMethods ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="shipping_pickup">
                                                    Store Pickup
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="standard_shipping_fee" class="form-label">Standard Shipping Fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('standard_shipping_fee') is-invalid @enderror" id="standard_shipping_fee" name="standard_shipping_fee" value="{{ old('standard_shipping_fee', $shippingSettings->standard_shipping_fee ?? '') }}">
                                        </div>
                                        @error('standard_shipping_fee')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="express_shipping_fee" class="form-label">Express Shipping Fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('express_shipping_fee') is-invalid @enderror" id="express_shipping_fee" name="express_shipping_fee" value="{{ old('express_shipping_fee', $shippingSettings->express_shipping_fee ?? '') }}">
                                        </div>
                                        @error('express_shipping_fee')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="free_shipping_threshold" class="form-label">Free Shipping Threshold</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('free_shipping_threshold') is-invalid @enderror" id="free_shipping_threshold" name="free_shipping_threshold" value="{{ old('free_shipping_threshold', $shippingSettings->free_shipping_threshold ?? '') }}">
                                    </div>
                                    <div class="form-text">Orders above this amount qualify for free shipping. Leave empty to disable free shipping.</div>
                                    @error('free_shipping_threshold')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="shipping_policy" class="form-label">Shipping Policy</label>
                                    <textarea class="form-control @error('shipping_policy') is-invalid @enderror" id="shipping_policy" name="shipping_policy" rows="4">{{ old('shipping_policy', $shippingSettings->shipping_policy ?? '') }}</textarea>
                                    @error('shipping_policy')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Other tabs would be implemented similarly -->
                    <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Tax Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Configure your tax settings here.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Notification Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Configure your notification preferences here.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">SEO Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Configure your SEO settings here.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="policy" role="tabpanel" aria-labelledby="policy-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Policy Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Configure your store policies here.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="api" role="tabpanel" aria-labelledby="api-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">API Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Configure your API settings here.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reset form button
        document.getElementById('reset-settings').addEventListener('click', function() {
            if (confirm('Are you sure you want to reset all settings to their original values?')) {
                document.getElementById('store-settings-form').reset();
            }
        });
        
        // Tab persistence
        const triggerTabList = [].slice.call(document.querySelectorAll('#settings-tab a'));
        triggerTabList.forEach(function(triggerEl) {
            const tabTrigger = new bootstrap.Tab(triggerEl);
            triggerEl.addEventListener('click', function(event) {
                event.preventDefault();
                tabTrigger.show();
                // Save active tab to localStorage
                localStorage.setItem('activeSettingsTab', triggerEl.getAttribute('id'));
            });
        });
        
        // Restore active tab from localStorage
        const activeTab = localStorage.getItem('activeSettingsTab');
        if (activeTab) {
            const tab = document.querySelector('#' + activeTab);
            if (tab) {
                const instance = bootstrap.Tab.getInstance(tab);
                if (instance) {
                    instance.show();
                } else {
                    const newTabTrigger = new bootstrap.Tab(tab);
                    newTabTrigger.show();
                }
            }
        }
    });
</script>
@endsection
