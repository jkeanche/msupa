@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Create New Delivery</h2>
        <a href="{{ route('vendor.deliveries.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Deliveries
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendor.deliveries.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Delivery Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Delivery Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="order_id" class="form-label">Order <span class="text-danger">*</span></label>
                                    <select class="form-select @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
                                        <option value="">Select Order</option>
                                        @if(isset($orders))
                                            @foreach($orders as $order)
                                                <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                                    #{{ $order->id }} - {{ $order->customer->name ?? 'Unknown Customer' }} ({{ date('M d, Y', strtotime($order->created_at)) }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('order_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tracking_number" class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control @error('tracking_number') is-invalid @enderror" id="tracking_number" name="tracking_number" value="{{ old('tracking_number') }}">
                                    @error('tracking_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="carrier" class="form-label">Carrier/Shipping Method <span class="text-danger">*</span></label>
                                        <select class="form-select @error('carrier') is-invalid @enderror" id="carrier" name="carrier" required>
                                            <option value="">Select Carrier</option>
                                            <option value="standard" {{ old('carrier') == 'standard' ? 'selected' : '' }}>Standard Delivery</option>
                                            <option value="express" {{ old('carrier') == 'express' ? 'selected' : '' }}>Express Delivery</option>
                                            <option value="pickup" {{ old('carrier') == 'pickup' ? 'selected' : '' }}>Store Pickup</option>
                                            <option value="other" {{ old('carrier') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('carrier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="delivery_date" class="form-label">Estimated Delivery Date</label>
                                        <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
                                        @error('delivery_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="in_transit" {{ old('status') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                        <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Shipping Address</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="use_order_address" name="use_order_address" value="1" checked>
                                    <label class="form-check-label" for="use_order_address">
                                        Use order shipping address
                                    </label>
                                </div>
                            </div>
                            <div class="card-body" id="shipping-address-fields">
                                <div class="mb-3">
                                    <label for="recipient_name" class="form-label">Recipient Name</label>
                                    <input type="text" class="form-control @error('recipient_name') is-invalid @enderror" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}">
                                    @error('recipient_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address_line1" class="form-label">Address Line 1</label>
                                    <input type="text" class="form-control @error('address_line1') is-invalid @enderror" id="address_line1" name="address_line1" value="{{ old('address_line1') }}">
                                    @error('address_line1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address_line2" class="form-label">Address Line 2</label>
                                    <input type="text" class="form-control @error('address_line2') is-invalid @enderror" id="address_line2" name="address_line2" value="{{ old('address_line2') }}">
                                    @error('address_line2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State/Province</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="postal_code" class="form-label">Postal/ZIP Code</label>
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select @error('country') is-invalid @enderror" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                            <option value="Uganda" {{ old('country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                            <option value="Tanzania" {{ old('country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                            <option value="Rwanda" {{ old('country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                            <option value="Burundi" {{ old('country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Additional Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Additional Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Delivery Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="special_instructions" class="form-label">Special Instructions</label>
                                    <textarea class="form-control @error('special_instructions') is-invalid @enderror" id="special_instructions" name="special_instructions" rows="4">{{ old('special_instructions') }}</textarea>
                                    @error('special_instructions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="requires_signature" name="requires_signature" value="1" {{ old('requires_signature') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="requires_signature">
                                        Requires Signature on Delivery
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="notify_customer" name="notify_customer" value="1" {{ old('notify_customer', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notify_customer">
                                        Notify Customer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Delivery</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const useOrderAddressCheckbox = document.getElementById('use_order_address');
        const shippingAddressFields = document.getElementById('shipping-address-fields');
        
        // Toggle shipping address fields based on checkbox
        function toggleShippingFields() {
            if (useOrderAddressCheckbox.checked) {
                shippingAddressFields.classList.add('opacity-50');
                const inputs = shippingAddressFields.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.setAttribute('disabled', 'disabled');
                });
            } else {
                shippingAddressFields.classList.remove('opacity-50');
                const inputs = shippingAddressFields.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.removeAttribute('disabled');
                });
            }
        }
        
        // Initial setup
        toggleShippingFields();
        
        // Event listener
        useOrderAddressCheckbox.addEventListener('change', toggleShippingFields);
    });
</script>
@endsection
