@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Request Withdrawal</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Available Balance</h5>
                                <p class="mb-0">Your current available balance for withdrawal is <strong>Ksh.{{ number_format($availableBalance ?? 0, 2) }}</strong></p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('vendor.withdrawals.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="amount" class="form-label">Withdrawal Amount ($)</label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                id="amount" name="amount" step="0.01" min="1" 
                                max="{{ $availableBalance ?? 0 }}" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Minimum withdrawal amount is $1.00</div>
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                id="payment_method" name="payment_method" required>
                                <option value="">Select payment method</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                <option value="mpesa" {{ old('payment_method') == 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                                <option value="stripe" {{ old('payment_method') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Bank Transfer Details (shown/hidden based on selection) -->
                        <div class="payment-details" id="bank_transfer_details" style="display: none;">
                            <div class="card mb-4 border-light">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Bank Account Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" 
                                            id="bank_name" name="bank_name" value="{{ old('bank_name') }}">
                                        @error('bank_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="account_name" class="form-label">Account Holder Name</label>
                                        <input type="text" class="form-control @error('account_name') is-invalid @enderror" 
                                            id="account_name" name="account_name" value="{{ old('account_name') }}">
                                        @error('account_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="account_number" class="form-label">Account Number</label>
                                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" 
                                            id="account_number" name="account_number" value="{{ old('account_number') }}">
                                        @error('account_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="swift_code" class="form-label">SWIFT/BIC Code</label>
                                        <input type="text" class="form-control @error('swift_code') is-invalid @enderror" 
                                            id="swift_code" name="swift_code" value="{{ old('swift_code') }}">
                                        @error('swift_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PayPal Details -->
                        <div class="payment-details" id="paypal_details" style="display: none;">
                            <div class="card mb-4 border-light">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">PayPal Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="paypal_email" class="form-label">PayPal Email</label>
                                        <input type="email" class="form-control @error('paypal_email') is-invalid @enderror" 
                                            id="paypal_email" name="paypal_email" value="{{ old('paypal_email') }}">
                                        @error('paypal_email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- M-Pesa Details -->
                        <div class="payment-details" id="mpesa_details" style="display: none;">
                            <div class="card mb-4 border-light">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">M-Pesa Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                            id="phone_number" name="phone_number" placeholder="e.g. 254712345678" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Details -->
                        <div class="payment-details" id="stripe_details" style="display: none;">
                            <div class="card mb-4 border-light">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Stripe Account Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="stripe_account" class="form-label">Stripe Account ID</label>
                                        <input type="text" class="form-control @error('stripe_account') is-invalid @enderror" 
                                            id="stripe_account" name="stripe_account" value="{{ old('stripe_account') }}">
                                        @error('stripe_account')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" 
                                id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms">
                                I confirm that the provided information is correct and I understand that withdrawals typically take 3-5 business days to process.
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vendor.withdrawals.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit Withdrawal Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodSelect = document.getElementById('payment_method');
        const paymentDetails = document.querySelectorAll('.payment-details');
        
        // Show/hide payment details based on selection
        function togglePaymentDetails() {
            // Hide all payment details first
            paymentDetails.forEach(detail => {
                detail.style.display = 'none';
            });
            
            // Show the selected payment method details
            const selectedMethod = paymentMethodSelect.value;
            if (selectedMethod) {
                const selectedDetails = document.getElementById(selectedMethod + '_details');
                if (selectedDetails) {
                    selectedDetails.style.display = 'block';
                }
            }
        }
        
        // Initial toggle based on any pre-selected value
        togglePaymentDetails();
        
        // Toggle on change
        paymentMethodSelect.addEventListener('change', togglePaymentDetails);
    });
</script>
@endsection
