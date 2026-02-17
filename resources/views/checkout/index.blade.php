@extends('layouts.app')

@section('title', 'Checkout - SITRIN')

@section('content')
<!-- Checkout Section -->
<section class="checkout-section py-5">
    <div class="container">
        <h2 class="text-dark-green mb-4">
            <i class="bi bi-credit-card me-2"></i>Checkout
        </h2>
        
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <!-- Shipping Information -->
                <div class="col-lg-8">
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h4 class="text-dark-green mb-4">Shipping Information</h4>
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="shipping_name" class="form-control @error('shipping_name') is-invalid @enderror" value="{{ old('shipping_name', Auth::user()->name ?? '') }}" pattern="[a-zA-Z\s]{3,}" minlength="3" maxlength="255" placeholder="Enter your full name" required>
                                @error('shipping_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Letters and spaces only, at least 3 characters</small>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="shipping_email" class="form-control @error('shipping_email') is-invalid @enderror" value="{{ old('shipping_email', Auth::user()->email ?? '') }}" placeholder="example@email.com" required>
                                @error('shipping_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="shipping_phone" class="form-control @error('shipping_phone') is-invalid @enderror" value="{{ old('shipping_phone', Auth::user()->phone ?? '') }}" pattern="(\+20|0)?1[0125]\d{8}" placeholder="01012345678 or +201012345678" required>
                                @error('shipping_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Egyptian mobile: 010/011/012/015 followed by 8 digits</small>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Street Address *</label>
                                <input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" value="{{ old('shipping_address', Auth::user()->address ?? '') }}" minlength="10" maxlength="500" placeholder="Building number, street name, area" required>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Please provide a detailed address (at least 10 characters)</small>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">City *</label>
                                <select name="shipping_city" id="shipping_city" class="form-select @error('shipping_city') is-invalid @enderror" required>
                                    <option value="">Select City</option>
                                    <option value="Cairo" {{ old('shipping_city', Auth::user()->city ?? '') == 'Cairo' ? 'selected' : '' }}>Cairo</option>
                                    <option value="Giza" {{ old('shipping_city', Auth::user()->city ?? '') == 'Giza' ? 'selected' : '' }}>Giza</option>
                                    <option value="Alexandria" {{ old('shipping_city', Auth::user()->city ?? '') == 'Alexandria' ? 'selected' : '' }}>Alexandria</option>
                                    <option value="Dakahlia" {{ old('shipping_city', Auth::user()->city ?? '') == 'Dakahlia' ? 'selected' : '' }}>Dakahlia</option>
                                    <option value="Red Sea" {{ old('shipping_city', Auth::user()->city ?? '') == 'Red Sea' ? 'selected' : '' }}>Red Sea</option>
                                    <option value="Beheira" {{ old('shipping_city', Auth::user()->city ?? '') == 'Beheira' ? 'selected' : '' }}>Beheira</option>
                                    <option value="Fayoum" {{ old('shipping_city', Auth::user()->city ?? '') == 'Fayoum' ? 'selected' : '' }}>Fayoum</option>
                                    <option value="Gharbia" {{ old('shipping_city', Auth::user()->city ?? '') == 'Gharbia' ? 'selected' : '' }}>Gharbia</option>
                                    <option value="Ismailia" {{ old('shipping_city', Auth::user()->city ?? '') == 'Ismailia' ? 'selected' : '' }}>Ismailia</option>
                                    <option value="Menofia" {{ old('shipping_city', Auth::user()->city ?? '') == 'Menofia' ? 'selected' : '' }}>Menofia</option>
                                    <option value="Minya" {{ old('shipping_city', Auth::user()->city ?? '') == 'Minya' ? 'selected' : '' }}>Minya</option>
                                    <option value="Qaliubiya" {{ old('shipping_city', Auth::user()->city ?? '') == 'Qaliubiya' ? 'selected' : '' }}>Qaliubiya</option>
                                    <option value="New Valley" {{ old('shipping_city', Auth::user()->city ?? '') == 'New Valley' ? 'selected' : '' }}>New Valley</option>
                                    <option value="Suez" {{ old('shipping_city', Auth::user()->city ?? '') == 'Suez' ? 'selected' : '' }}>Suez</option>
                                    <option value="Aswan" {{ old('shipping_city', Auth::user()->city ?? '') == 'Aswan' ? 'selected' : '' }}>Aswan</option>
                                    <option value="Assiut" {{ old('shipping_city', Auth::user()->city ?? '') == 'Assiut' ? 'selected' : '' }}>Assiut</option>
                                    <option value="Beni Suef" {{ old('shipping_city', Auth::user()->city ?? '') == 'Beni Suef' ? 'selected' : '' }}>Beni Suef</option>
                                    <option value="Port Said" {{ old('shipping_city', Auth::user()->city ?? '') == 'Port Said' ? 'selected' : '' }}>Port Said</option>
                                    <option value="Damietta" {{ old('shipping_city', Auth::user()->city ?? '') == 'Damietta' ? 'selected' : '' }}>Damietta</option>
                                    <option value="Sharkia" {{ old('shipping_city', Auth::user()->city ?? '') == 'Sharkia' ? 'selected' : '' }}>Sharkia</option>
                                    <option value="South Sinai" {{ old('shipping_city', Auth::user()->city ?? '') == 'South Sinai' ? 'selected' : '' }}>South Sinai</option>
                                    <option value="Kafr Al sheikh" {{ old('shipping_city', Auth::user()->city ?? '') == 'Kafr Al sheikh' ? 'selected' : '' }}>Kafr Al sheikh</option>
                                    <option value="Matrouh" {{ old('shipping_city', Auth::user()->city ?? '') == 'Matrouh' ? 'selected' : '' }}>Matrouh</option>
                                    <option value="Luxor" {{ old('shipping_city', Auth::user()->city ?? '') == 'Luxor' ? 'selected' : '' }}>Luxor</option>
                                    <option value="Qena" {{ old('shipping_city', Auth::user()->city ?? '') == 'Qena' ? 'selected' : '' }}>Qena</option>
                                    <option value="North Sinai" {{ old('shipping_city', Auth::user()->city ?? '') == 'North Sinai' ? 'selected' : '' }}>North Sinai</option>
                                    <option value="Sohag" {{ old('shipping_city', Auth::user()->city ?? '') == 'Sohag' ? 'selected' : '' }}>Sohag</option>
                                </select>
                                @error('shipping_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Country *</label>
                                <input type="text" name="shipping_country" class="form-control @error('shipping_country') is-invalid @enderror" value="{{ old('shipping_country', Auth::user()->country ?? 'Egypt') }}" required>
                                @error('shipping_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Postal Code (Optional)</label>
                                <input type="text" name="shipping_postal_code" class="form-control" value="{{ old('shipping_postal_code') }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h4 class="text-dark-green mb-4">Payment Method</h4>
                        
                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cash_on_delivery" checked>
                            <label class="form-check-label w-100" for="cod">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-cash text-success me-2"></i>
                                        <strong>Cash on Delivery</strong>
                                        <p class="mb-0 small text-muted">Pay when you receive your order</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-check p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="instapay" value="instapay_on_delivery">
                            <label class="form-check-label w-100" for="instapay">
                                <div>
                                    <i class="bi bi-phone text-primary me-2"></i>
                                    <strong>Instapay on Delivery</strong>
                                    <p class="mb-0 small text-muted">Pay via Instapay when you receive your order</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Order Notes -->
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h4 class="text-dark-green mb-4">Order Notes (Optional)</h4>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Any special requests or notes about your order...">{{ old('notes') }}</textarea>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-3 shadow-sm sticky-top">
                        <h4 class="text-dark-green mb-4">Order Summary</h4>
                        
                        <!-- Cart Items -->
                        <div class="order-items mb-3">
                            @foreach($cartItems as $item)
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item['name'] }}</h6>
                                    <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    @if($item['size'])
                                        <small class="text-muted">• Size: {{ $item['size'] }}</small>
                                    @endif
                                </div>
                                <span class="fw-semibold">EGP {{ number_format($item['subtotal'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Totals -->
                        <div class="order-totals">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-semibold" id="subtotal-amount">EGP {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping</span>
                                <span class="fw-semibold" id="shipping-amount">EGP 0.00</span>
                            </div>
                            <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="h5 mb-0">Total</span>
                                <span class="h5 mb-0 text-primary" id="total-amount">EGP {{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Place Order Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Place Order
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Cart
                            </a>
                        </div>
                        
                        <!-- Security Badge -->
                        <div class="security-badge mt-4 p-3 bg-light rounded text-center">
                            <i class="bi bi-shield-lock-fill text-success me-2"></i>
                            <small class="text-muted">Your information is secure</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
    const subtotal = {{ $subtotal }};
    const shippingCity = document.getElementById('shipping_city');
    const shippingAmount = document.getElementById('shipping-amount');
    const shippingCost = document.getElementById('shipping_cost');
    const totalAmount = document.getElementById('total-amount');
    
    function calculateShipping() {
        const city = shippingCity.value;
        let shipping = 0;
        
        if (city === 'Cairo' || city === 'Giza') {
            shipping = 65;
        } else if (city) {
            shipping = 80;
        }
        
        const total = subtotal + shipping;
        
        shippingAmount.textContent = 'EGP ' + shipping.toFixed(2);
        shippingCost.value = shipping;
        totalAmount.textContent = 'EGP ' + total.toFixed(2);
    }
    
    shippingCity.addEventListener('change', calculateShipping);
    
    // Calculate on page load if city is already selected
    if (shippingCity.value) {
        calculateShipping();
    }
</script>
@endpush
@endsection
