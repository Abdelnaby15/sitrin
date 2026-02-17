@extends('layouts.app')

@section('title', 'Order Successful - SITRIN')

@section('content')
<!-- Success Section -->
<section class="success-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="text-center mb-5">
                    <div class="success-icon mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h1 class="display-5 text-dark-green mb-3">Order Placed Successfully!</h1>
                    <p class="lead text-muted mb-4">Thank you for your purchase. Your order has been received and is being processed.</p>
                    <p class="text-muted">Order Number: <strong class="text-primary">{{ $order->order_number }}</strong></p>
                </div>
                
                <!-- Order Details -->
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                    <h4 class="text-dark-green mb-4">Order Details</h4>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="text-muted d-block small">Order Date</span>
                                <strong>{{ $order->created_at->format('F d, Y') }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="text-muted d-block small">Payment Method</span>
                                <strong>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="text-muted d-block small">Status</span>
                                <span class="badge bg-{{ $order->status_color }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="text-muted d-block small">Total Amount</span>
                                <strong class="text-primary">EGP {{ number_format($order->total, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Shipping Address -->
                    <div class="shipping-info p-3 bg-light rounded">
                        <h6 class="text-dark-green mb-3">Shipping Address</h6>
                        <p class="mb-1"><strong>{{ $order->shipping_name }}</strong></p>
                        <p class="mb-1">{{ $order->shipping_address }}</p>
                        <p class="mb-1">{{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
                        <p class="mb-1">Phone: {{ $order->shipping_phone }}</p>
                        <p class="mb-0">Email: {{ $order->shipping_email }}</p>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                    <h4 class="text-dark-green mb-4">Order Items</h4>
                    
                    @foreach($order->items as $item)
                    <div class="order-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($item->product->main_image) }}" alt="{{ $item->product_name }}" class="img-fluid rounded me-3" style="width: 80px;">
                            <div>
                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                @if($item->size)
                                    <small class="text-muted">• Size: {{ $item->size }}</small>
                                @endif
                                <p class="mb-0 mt-1">
                                    <span class="text-muted small">EGP {{ number_format($item->price, 2) }} each</span>
                                </p>
                            </div>
                        </div>
                        <strong class="text-primary">EGP {{ number_format($item->subtotal, 2) }}</strong>
                    </div>
                    @endforeach
                    
                    <!-- Order Summary -->
                    <div class="order-summary mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>EGP {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span>EGP {{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="h5 mb-0">Total</strong>
                            <strong class="h5 mb-0 text-primary">EGP {{ number_format($order->total, 2) }}</strong>
                        </div>
                    </div>
                </div>
                
                <!-- Next Steps -->
                <div class="bg-beige p-4 rounded-3 mb-4">
                    <h5 class="text-dark-green mb-3">What's Next?</h5>
                    <div class="d-flex align-items-start mb-2">
                        <i class="bi bi-1-circle-fill text-gold me-3 mt-1"></i>
                        <div>
                            <strong>Order Confirmation</strong>
                            <p class="mb-0 small text-muted">You will receive an email confirmation shortly</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-2">
                        <i class="bi bi-2-circle-fill text-gold me-3 mt-1"></i>
                        <div>
                            <strong>Processing</strong>
                            <p class="mb-0 small text-muted">We'll prepare your order for shipment</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="bi bi-3-circle-fill text-gold me-3 mt-1"></i>
                        <div>
                            <strong>Delivery</strong>
                            <p class="mb-0 small text-muted">Expect delivery within 2-3 business days</p>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5 me-2">
                        <i class="bi bi-bag me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-5">
                        <i class="bi bi-house me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
