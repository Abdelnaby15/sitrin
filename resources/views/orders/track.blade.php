@extends('layouts.app')

@section('title', 'Track Order #' . $order->id . ' - SITRIN')

@section('content')
<!-- Order Tracking Section -->
<section class="order-tracking py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="text-center mb-5">
                    <i class="bi bi-box-seam display-3 text-primary mb-3"></i>
                    <h2 class="display-5 fw-bold text-dark-green mb-2">Order Tracking</h2>
                    <p class="lead text-muted">Order #{{ $order->id }}</p>
                </div>

                <!-- Order Status Timeline -->
                <div class="order-status-timeline bg-white p-4 p-md-5 rounded-3 shadow-sm mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="timeline">
                                <!-- Pending -->
                                <div class="timeline-item {{ $order->status == 'pending' || $order->status == 'processing' || $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5 class="fw-bold">Order Placed</h5>
                                        <p class="text-muted small mb-0">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                                    </div>
                                </div>

                                <!-- Processing -->
                                <div class="timeline-item {{ $order->status == 'processing' || $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}{{ $order->status == 'processing' ? ' active' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi {{ $order->status == 'processing' || $order->status == 'shipped' || $order->status == 'delivered' ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5 class="fw-bold">Processing</h5>
                                        <p class="text-muted small mb-0">We're preparing your order</p>
                                    </div>
                                </div>

                                <!-- Shipped -->
                                <div class="timeline-item {{ $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}{{ $order->status == 'shipped' ? ' active' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi {{ $order->status == 'shipped' || $order->status == 'delivered' ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5 class="fw-bold">Shipped</h5>
                                        <p class="text-muted small mb-0">Your order is on its way</p>
                                    </div>
                                </div>

                                <!-- Delivered -->
                                <div class="timeline-item {{ $order->status == 'delivered' ? 'completed active' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi {{ $order->status == 'delivered' ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5 class="fw-bold">Delivered</h5>
                                        <p class="text-muted small mb-0">Order delivered successfully</p>
                                    </div>
                                </div>

                                @if($order->status == 'cancelled')
                                <!-- Cancelled -->
                                <div class="timeline-item cancelled">
                                    <div class="timeline-icon">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5 class="fw-bold text-danger">Cancelled</h5>
                                        <p class="text-muted small mb-0">This order has been cancelled</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm mb-4">
                    <h4 class="text-dark-green mb-4">Order Details</h4>
                    
                    <div class="row g-4">
                        @foreach($order->items as $item)
                        <div class="col-12">
                            <div class="d-flex gap-3 align-items-center pb-3 border-bottom">
                                <img src="{{ asset($item->product->main_image ?? 'images/placeholder.svg') }}" alt="{{ $item->product_name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product_name }}</h6>
                                    <p class="text-muted small mb-0">Quantity: {{ $item->quantity }} @if($item->size)• Size: {{ $item->size }}@endif</p>
                                </div>
                                <div class="text-end">
                                    <p class="fw-bold mb-0">EGP {{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>EGP {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span>EGP {{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <span class="h5 mb-0">Total</span>
                            <span class="h5 mb-0 text-primary">EGP {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm">
                    <h4 class="text-dark-green mb-4">Shipping Information</h4>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Delivery Address</h6>
                            <p class="mb-0">
                                <strong>{{ $order->shipping_name }}</strong><br>
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_country }}<br>
                                @if($order->shipping_postal_code){{ $order->shipping_postal_code }}<br>@endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Contact Information</h6>
                            <p class="mb-0">
                                <i class="bi bi-phone me-2"></i>{{ $order->shipping_phone }}<br>
                                <i class="bi bi-envelope me-2"></i>{{ $order->shipping_email }}
                            </p>
                        </div>
                        <div class="col-12">
                            <h6 class="text-muted mb-2">Payment Method</h6>
                            <p class="mb-0">
                                <span class="badge bg-primary">{{ $order->payment_method == 'cash_on_delivery' ? 'Cash on Delivery' : 'Instapay on Delivery' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary px-5">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.timeline {
    position: relative;
}

.timeline-item {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem 0;
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 1.25rem;
    top: 3.5rem;
    width: 2px;
    height: calc(100% - 1rem);
    background: #e0e0e0;
}

.timeline-item.completed::after {
    background: #198754;
}

.timeline-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    z-index: 1;
}

.timeline-item.completed .timeline-icon {
    background: #198754;
    border-color: #198754;
    color: white;
}

.timeline-item.active .timeline-icon {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white;
    animation: pulse 2s infinite;
}

.timeline-item.cancelled .timeline-icon {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
    }
}

.timeline-content h5 {
    margin-bottom: 0.25rem;
}

@media (max-width: 767px) {
    .timeline-item {
        gap: 1rem;
        padding: 1rem 0;
    }
    
    .timeline-icon {
        width: 2rem;
        height: 2rem;
    }
}
</style>
@endpush
@endsection
