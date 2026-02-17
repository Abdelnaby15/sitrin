@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark-green mb-1 fw-bold">Orders Management</h2>
        <p class="text-muted mb-0">View and manage customer orders</p>
    </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.orders.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Order Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Payment Status</label>
                    <select name="payment_status" class="form-select">
                        <option value="">All Payments</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 flex-grow-1">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Orders Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted fw-semibold small">Order #</th>
                        <th class="py-3 text-muted fw-semibold small">Customer</th>
                        <th class="py-3 text-muted fw-semibold small">Items</th>
                        <th class="py-3 text-muted fw-semibold small">Total</th>
                        <th class="py-3 text-muted fw-semibold small">Status</th>
                        <th class="py-3 text-muted fw-semibold small">Payment</th>
                        <th class="py-3 text-muted fw-semibold small">Date</th>
                        <th class="py-3 text-muted fw-semibold small">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-4 py-3">
                            <strong class="text-primary">#{{ $order->order_number }}</strong>
                        </td>
                        <td class="py-3">
                            <div>
                                <div class="fw-semibold">{{ $order->shipping_name }}</div>
                                <small class="text-muted">{{ $order->shipping_email }}</small>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-light text-dark px-3 py-2">{{ $order->items->count() }} items</span>
                        </td>
                        <td class="py-3">
                            <strong class="text-dark">EGP {{ number_format($order->total, 2) }}</strong>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-{{ $order->status_color }} bg-opacity-10 text-{{ $order->status_color }} px-3 py-2 rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} bg-opacity-10 text-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} px-3 py-2 rounded-pill">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td class="py-3 text-muted">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>
                        <td class="py-3">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                <i class="bi bi-eye me-1"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                <p class="mb-0">No orders found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
