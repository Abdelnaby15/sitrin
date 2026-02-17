@extends('layouts.admin')

@section('title', 'Products Management')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark-green mb-1 fw-bold">Products Management</h2>
        <p class="text-muted mb-0">Manage your product inventory</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-plus-circle me-2"></i>Add New Product
    </a>
</div>

<!-- Products Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted fw-semibold small">Order</th>
                        <th class="py-3 text-muted fw-semibold small">Image</th>
                        <th class="py-3 text-muted fw-semibold small">Name</th>
                        <th class="py-3 text-muted fw-semibold small">Price</th>
                        <th class="py-3 text-muted fw-semibold small">Stock</th>
                        <th class="py-3 text-muted fw-semibold small">Status</th>
                        <th class="py-3 text-muted fw-semibold small">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr data-id="{{ $product->id }}" style="cursor: move;">
                        <td class="px-4 py-3">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="bi bi-grip-vertical text-muted"></i>
                                @if($index > 0)
                                <form action="{{ route('admin.products.moveUp', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border" title="Move Up">
                                        <i class="bi bi-arrow-up"></i>
                                    </button>
                                </form>
                                @else
                                <button class="btn btn-sm btn-light border" disabled style="visibility: hidden;">
                                    <i class="bi bi-arrow-up"></i>
                                </button>
                                @endif
                                
                                @if($index < count($products) - 1)
                                <form action="{{ route('admin.products.moveDown', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border" title="Move Down">
                                        <i class="bi bi-arrow-down"></i>
                                    </button>
                                </form>
                                @else
                                <button class="btn btn-sm btn-light border" disabled style="visibility: hidden;">
                                    <i class="bi bi-arrow-down"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                        <td class="py-3">
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td class="py-3">
                            <div>
                                <h6 class="mb-1">{{ $product->name }}</h6>
                                <small class="text-muted">SKU: {{ $product->sku }}</small>
                            </div>
                        </td>
                        <td class="py-3">
                            <strong class="text-dark">EGP {{ number_format($product->price, 2) }}</strong>
                        </td>
                        <td class="py-3">
                            @if($product->stock <= 5)
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }}
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($product->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>Active
                                </span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-light rounded-start" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border-start rounded-end" title="Delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                                <p class="mb-3">No products found</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-plus-circle me-2"></i>Add Your First Product
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.querySelector('table tbody');
        
        if (tbody) {
            const sortable = new Sortable(tbody, {
                animation: 150,
                handle: 'tr',
                ghostClass: 'bg-light',
                dragClass: 'opacity-50',
                onEnd: function(evt) {
                    // Get all product IDs in the new order
                    const productIds = Array.from(tbody.querySelectorAll('tr[data-id]'))
                        .map(tr => tr.getAttribute('data-id'));
                    
                    // Send AJAX request to update order
                    fetch('{{ route('admin.products.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: productIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success notification
                            const alert = document.createElement('div');
                            alert.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
                            alert.style.zIndex = '9999';
                            alert.innerHTML = `
                                <i class="bi bi-check-circle me-2"></i>Product order updated successfully
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            `;
                            document.body.appendChild(alert);
                            
                            // Auto-dismiss after 3 seconds
                            setTimeout(() => {
                                alert.remove();
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating order:', error);
                        // Revert the change
                        location.reload();
                    });
                }
            });
        }
    });
</script>
@endpush
@endsection
