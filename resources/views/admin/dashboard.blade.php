@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="text-dark-green mb-1 fw-bold">Dashboard Overview</h2>
        <p class="text-muted mb-0">Monitor your store performance and manage operations</p>
    </div>
    <div class="text-end">
        <div class="d-flex align-items-center gap-3">
            <div>
                <small class="text-muted d-block">Welcome back,</small>
                <strong class="text-dark">{{ Auth::user()->name }}</strong>
            </div>
            <div class="avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                <i class="bi bi-person-fill text-primary fs-5"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2 small text-uppercase fw-semibold">Total Orders</p>
                        <h2 class="mb-0 fw-bold">{{ $stats['total_orders'] }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-cart-check text-primary fs-3"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">
                        <i class="bi bi-arrow-up-short"></i> View All
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2 small text-uppercase fw-semibold">Pending Orders</p>
                        <h2 class="mb-0 fw-bold text-warning">{{ $stats['pending_orders'] }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-clock-history text-warning fs-3"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1">
                        <i class="bi bi-hourglass-split"></i> Awaiting
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2 small text-uppercase fw-semibold">Total Products</p>
                        <h2 class="mb-0 fw-bold text-info">{{ $stats['total_products'] }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-box-seam text-info fs-3"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-info bg-opacity-10 text-info px-2 py-1">
                        <i class="bi bi-plus-circle"></i> Manage
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2 small text-uppercase fw-semibold">Total Revenue</p>
                        <h2 class="mb-0 fw-bold text-success">EGP {{ number_format($stats['total_revenue'], 2) }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-cash-stack text-success fs-3"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                        <i class="bi bi-graph-up-arrow"></i> +0%
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold">Recent Orders</h5>
                        <p class="text-muted small mb-0">Latest customer purchases</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-eye me-1"></i> View All
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold small">Order #</th>
                                <th class="py-3 text-muted fw-semibold small">Customer</th>
                                <th class="py-3 text-muted fw-semibold small">Total</th>
                                <th class="py-3 text-muted fw-semibold small">Status</th>
                                <th class="py-3 text-muted fw-semibold small">Date</th>
                                <th class="py-3 text-muted fw-semibold small">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="px-4 py-3">
                                    <strong class="text-primary">#{{ $order->order_number }}</strong>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        <span>{{ $order->shipping_name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <strong class="text-dark">EGP {{ number_format($order->total, 2) }}</strong>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-{{ $order->status_color }} bg-opacity-10 text-{{ $order->status_color }} px-3 py-2 rounded-pill">
                                        {{ ucfirst($order->status) }}
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
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        <p class="mb-0">No orders yet</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Low Stock Alert -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold">Low Stock Alert</h5>
                        <p class="text-muted small mb-0">Products running low</p>
                    </div>
                    <span class="badge bg-danger rounded-pill">{{ count($lowStockProducts) }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($lowStockProducts as $product)
                    <div class="list-group-item border-0 px-4 py-3">
                        <div class="d-flex align-items-start gap-3">
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $product->name }}</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 small">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }} left
                                    </span>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-primary small text-decoration-none">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-4 py-5 text-center text-muted">
                        <i class="bi bi-check-circle fs-1 text-success d-block mb-2"></i>
                        <p class="mb-0">All products are well stocked!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.15) !important;
}

.avatar-sm {
    flex-shrink: 0;
}
</style>

@endsection
