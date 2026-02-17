@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark-green mb-1 fw-bold">Order #{{ $order->order_number }}</h2>
        <p class="text-muted mb-0">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-2"></i>Back to Orders
    </a>
</div>

<div class="row g-4">
    <!-- Order Items -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="mb-0 fw-bold">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold small">Product</th>
                                <th class="py-3 text-muted fw-semibold small">Price</th>
                                <th class="py-3 text-muted fw-semibold small">Quantity</th>
                                <th class="py-3 text-muted fw-semibold small text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset($item->product->main_image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                                            @if($item->size)
                                                <small class="text-muted">Size: {{ $item->size }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-dark">EGP {{ number_format($item->price, 2) }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-light text-dark px-3 py-2">{{ $item->quantity }}</span>
                                </td>
                                <td class="py-3 text-end">
                                    <strong class="text-dark">EGP {{ number_format($item->subtotal, 2) }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-end"><strong>Total:</strong></td>
                                <td class="py-3 text-end">
                                    <h5 class="mb-0 text-primary fw-bold">EGP {{ number_format($order->total, 2) }}</h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Shipping Information -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="mb-0 fw-bold">Shipping Information</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Full Name</label>
                        <p class="mb-0 fw-semibold">{{ $order->shipping_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Email</label>
                        <p class="mb-0">{{ $order->shipping_email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Phone</label>
                        <p class="mb-0">{{ $order->shipping_phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">City</label>
                        <p class="mb-0">{{ $order->shipping_city }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-1">Address</label>
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>
                    @if($order->notes)
                    <div class="col-12">
                        <label class="text-muted small mb-1">Order Notes</label>
                        <p class="mb-0 text-muted">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Status & Actions -->
    <div class="col-lg-4">
        <!-- Order Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="mb-0 fw-bold">Order Status</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Status</label>
                        <div class="mb-3">
                            <span class="badge bg-{{ $order->status_color }} bg-opacity-10 text-{{ $order->status_color }} px-4 py-3 w-100 d-block fs-6">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Update Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-check-circle me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Payment Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="mb-0 fw-bold">Payment Info</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="text-muted small mb-1">Payment Method</label>
                    <p class="mb-0 fw-semibold">{{ ucfirst($order->payment_method) }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small mb-1">Payment Status</label>
                    <div>
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} bg-opacity-10 text-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} px-3 py-2">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
                <div>
                    <label class="text-muted small mb-1">Order Total</label>
                    <h5 class="text-primary mb-0">EGP {{ number_format($order->total, 2) }}</h5>
                </div>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="mb-0 fw-bold">Customer</h5>
            </div>
            <div class="card-body p-4">
                @if($order->user)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $order->user->name }}</h6>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </div>
                </div>
                <a href="mailto:{{ $order->user->email }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                    <i class="bi bi-envelope me-2"></i>Contact Customer
                </a>
                @else
                <p class="text-muted mb-0">Guest checkout</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
