@extends('layouts.app')

@section('title', 'Our Collection - SITRIN')

@section('content')
<!-- Page Header -->
<section class="page-header bg-beige py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-dark-green mb-2">Our Collection</h1>
        <p class="lead text-muted">Discover elegant abayas for the blessed month</p>
    </div>
</section>

<!-- Products Section -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <!-- Products Grid -->
            <div class="col-12">
                <!-- Toolbar -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
                    <p class="text-muted mb-0 small">Showing {{ $products->count() }} of {{ $products->total() }} products</p>
                    
                    <form method="GET" action="{{ route('products.index') }}" class="d-flex align-items-center gap-2 w-100 w-md-auto">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                        <input type="hidden" name="in_stock" value="{{ request('in_stock') }}">
                        
                        <label class="mb-0 me-2 text-muted small">Sort:</label>
                        <select name="sort" class="form-select form-select-sm flex-grow-1" style="max-width: 200px;" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        </select>
                    </form>
                </div>
                
                <!-- Products Grid -->
                <div class="row g-3 g-md-4 mb-4">
                    @forelse($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <div class="product-image-wrapper position-relative">
                                @if($product->isOnSale())
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                @endif
                                @if($product->is_new_arrival)
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3">New</span>
                                @endif
                                @if(!$product->inStock())
                                    <span class="badge bg-secondary position-absolute bottom-0 start-50 translate-middle-x mb-3">Out of Stock</span>
                                @endif
                                <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="product-image" loading="lazy">
                                <div class="product-overlay">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-white btn-sm">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </a>
                                    @if($product->inStock())
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <div class="product-info p-3 text-center">
                                <span class="text-muted small">{{ $product->category->name }}</span>
                                <h5 class="product-title mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <div class="product-price">
                                    @if($product->isOnSale())
                                        <span class="text-muted text-decoration-line-through me-2">EGP {{ number_format($product->price, 2) }}</span>
                                        <span class="text-primary fw-bold">EGP {{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        <span class="text-primary fw-bold">EGP {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search fs-1 text-muted mb-3"></i>
                        <h4 class="text-muted">No products found</h4>
                        <p class="text-muted">Try adjusting your filters</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($products->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
