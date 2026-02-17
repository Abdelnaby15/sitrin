@extends('layouts.app')

@section('title', 'Shopping Cart - SITRIN')

@section('content')
<!-- Cart Section -->
<section class="cart-section py-5">
    <div class="container">
        <h2 class="text-dark-green mb-4">
            <i class="bi bi-bag me-2"></i>Shopping Cart
        </h2>
        
        @if(count($cartItems) > 0)
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                @foreach($cartItems as $id => $item)
                <div class="cart-item bg-white rounded-3 shadow-sm mb-3">
                    <!-- Mobile Layout -->
                    <div class="d-md-none">
                        <div class="row g-0">
                            <!-- Image -->
                            <div class="col-5">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded-start w-100" style="height: 100%; object-fit: cover;">
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-7 p-3">
                                <h6 class="mb-1 fw-bold">{{ $item['name'] }}</h6>
                                <p class="mb-1 small text-muted">{{ $item['size'] }}</p>
                                <p class="mb-2 fw-bold text-primary">EGP {{ number_format($item['price'], 2) }}</p>
                                
                                <!-- Quantity & Actions -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex-grow-1 me-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm" style="max-width: 120px;">
                                            <button type="button" class="btn btn-outline-secondary" onclick="this.nextElementSibling.stepDown(); this.form.submit();">-</button>
                                            <input type="number" name="quantity" class="form-control text-center" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" style="max-width: 50px;">
                                            <button type="button" class="btn btn-outline-secondary" onclick="this.previousElementSibling.stepUp(); this.form.submit();">+</button>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="mt-2 text-end">
                                    <small class="text-muted">Subtotal: </small>
                                    <strong class="text-primary">EGP {{ number_format($item['subtotal'], 2) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Desktop Layout -->
                    <div class="d-none d-md-block p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-1">{{ $item['name'] }}</h5>
                                <p class="text-muted small mb-1">{{ $item['product']->category->name }}</p>
                                @if($item['size'])
                                    <span class="badge bg-light text-dark small">{{ $item['size'] }}</span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <p class="mb-0 fw-bold">EGP {{ number_format($item['price'], 2) }}</p>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="quantity" class="form-control" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="mb-2 fw-bold text-primary">EGP {{ number_format($item['subtotal'], 2) }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Cart Actions -->
                <div class="cart-actions d-flex flex-column flex-md-row justify-content-between gap-2 mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to clear the cart?')">
                            <i class="bi bi-trash me-2"></i>Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary bg-white p-3 p-md-4 rounded-3 shadow-sm position-sticky" style="top: 100px;">
                    <h4 class="text-dark-green mb-3 mb-md-4 fs-5 fs-md-4">Order Summary</h4>
                    
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">EGP {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Shipping</span>
                        <span class="fw-semibold text-muted">To be calculated</span>
                    </div>
                    <hr class="my-2 my-md-3">
                    <div class="d-flex justify-content-between mb-3 mb-md-4">
                        <span class="h6 h5-md mb-0">Total</span>
                        <span class="h6 h5-md mb-0 text-primary">EGP {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                        </a>
                    </div>
                    
                    <!-- Trust Badges -->
                    <div class="trust-badges mt-3 mt-md-4 pt-3 pt-md-4 border-top">
                        <div class="d-flex align-items-center mb-2 text-muted small">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <span>Secure Checkout</span>
                        </div>
                        <div class="d-flex align-items-center mb-2 text-muted small">
                            <i class="bi bi-truck text-success me-2"></i>
                            <span>Fast Delivery</span>
                        </div>
                        <div class="d-flex align-items-center text-muted small">
                            <i class="bi bi-arrow-repeat text-success me-2"></i>
                            <span>Easy Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div class="empty-cart text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted mb-4"></i>
            <h3 class="text-dark-green mb-3">Your Cart is Empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-arrow-left me-2"></i>Start Shopping
            </a>
        </div>
        @endif
    </div>
</section>
@endsection
