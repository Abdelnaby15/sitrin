@extends('layouts.app')

@section('title', 'SITRIN - Premium Ramadan Abayas Collection')

@section('content')
<!-- Hero Section -->
<section class="hero-section-fullwidth position-relative overflow-hidden">
    <!-- Background Image -->
    <div class="hero-background" style="background-image: url('{{ asset('images/hero-ramadan-model.png') }}');"></div>
    
    <!-- Dark Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Islamic Pattern Overlay -->
    <div class="islamic-pattern-overlay"></div>
    
    <!-- Floating Decorations -->
    <div class="floating-star" style="top: 15%; left: 10%;"><i class="bi bi-star-fill"></i></div>
    <div class="floating-star" style="top: 25%; right: 15%;"><i class="bi bi-star-fill"></i></div>
    <div class="floating-crescent" style="bottom: 20%; left: 8%;"><i class="bi bi-moon-stars-fill"></i></div>
    
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center justify-content-lg-start">
            <div class="col-11 col-md-10 col-lg-7 col-xl-6">
                <!-- Glass Morphism Content Card -->
                <div class="hero-glass-card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="hero-badge mb-3">
                        <i class="bi bi-star-fill text-gold"></i>
                        <span class="text-gold">Ramadan Collection 2026</span>
                    </div>
                    
                    <h1 class="hero-title mb-4">
                        Elegance in Every <span class="text-gold-glow">Thread</span>
                    </h1>
                    
                    <p class="hero-description mb-4">
                        Discover our exclusive Ramadan Abayas collection, where tradition meets contemporary elegance. Each piece is crafted with care to make your blessed month special.
                    </p>
                    
                    <div class="hero-buttons d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                            Explore Collection
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-5">
                            Our Story
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <span>Scroll</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</section>

<!-- Ramadan Message -->
<section class="ramadan-message py-5 bg-beige">
    <div class="container text-center">
        <div class="crescent-divider mb-4" data-aos="zoom-in">
            <i class="bi bi-moon-stars-fill text-gold fs-1"></i>
        </div>
        <h3 class="text-dark-green mb-3 font-elegant">رمضان كريم</h3>
        <p class="lead text-muted mb-0">May this blessed month bring peace, prosperity, and joy to you and your loved ones</p>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-products py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">Featured Collection</span>
            <h2 class="display-5 fw-bold text-dark-green mb-3">Handpicked for You</h2>
            <p class="lead text-muted">Discover our most beloved pieces, carefully curated for the holy month</p>
        </div>
        
        <div class="row g-3 g-md-4">
            @forelse($featuredProducts as $product)
            <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
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
                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="product-image" loading="lazy">
                        <div class="product-overlay">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-white btn-sm">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
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
            <div class="col-12 text-center">
                <p class="text-muted">No featured products available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg px-5">
                View All Products
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">Shop by Category</span>
            <h2 class="display-5 fw-bold text-dark-green mb-3">Explore Our Collections</h2>
        </div>
        
        <div class="row g-3 g-md-4">
            @foreach($categories as $category)
            <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="collection-carousel-card">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                        <!-- Image Carousel Container -->
                        <div class="carousel-container position-relative">
                            <div class="carousel-images">
                                @php
                                    $categoryProducts = $category->products()->take(6)->get();
                                @endphp
                                @if($categoryProducts->count() > 0)
                                    @foreach($categoryProducts as $product)
                                        <div class="carousel-image {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" loading="lazy">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-image active">
                                        <img src="{{ asset('images/default-category.jpg') }}" alt="{{ $category->name }}" loading="lazy">
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Overlay Content -->
                            <div class="carousel-overlay">
                                <div class="carousel-content">
                                    <h4 class="text-white mb-2 font-elegant">{{ $category->name }}</h4>
                                    <p class="text-gold mb-3">{{ $category->activeProductsCount() }} Products</p>
                                    <span class="btn btn-sm btn-light px-4">Shop Now <i class="bi bi-arrow-right ms-2"></i></span>
                                </div>
                            </div>
                            
                            <!-- Carousel Indicators -->
                            @if($categoryProducts->count() > 1)
                            <div class="carousel-indicators">
                                @foreach($categoryProducts as $product)
                                    <span class="indicator {{ $loop->first ? 'active' : '' }}"></span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- New Arrivals -->
@if($newArrivals->count() > 0)
<section class="new-arrivals py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary-subtle text-primary mb-3 px-4 py-2">Just Arrived</span>
            <h2 class="display-5 fw-bold text-dark-green mb-3">New This Ramadan</h2>
            <p class="lead text-muted">Fresh designs to celebrate the holy month in style</p>
        </div>
        
        <div class="row g-3 g-md-4">
            @foreach($newArrivals as $product)
            <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="product-card">
                    <div class="product-image-wrapper position-relative">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3">New</span>
                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="product-image" loading="lazy">
                        <div class="product-overlay">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-white btn-sm">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
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
                            <span class="text-primary fw-bold">EGP {{ number_format($product->final_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="features-section py-5 bg-beige">
    <div class="container">
        <div class="row g-3 g-md-4">
            <div class="col-6 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-icon mb-3">
                    <i class="bi bi-truck text-gold fs-1"></i>
                </div>
                <h5 class="text-dark-green mb-2">Fast Delivery</h5>
                <p class="text-muted small mb-0">Quick shipping across Egypt</p>
            </div>
            <div class="col-6 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon mb-3">
                    <i class="bi bi-shield-check text-gold fs-1"></i>
                </div>
                <h5 class="text-dark-green mb-2">Quality Assured</h5>
                <p class="text-muted small mb-0">Premium fabrics & craftsmanship</p>
            </div>
            <div class="col-6 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon mb-3">
                    <i class="bi bi-arrow-repeat text-gold fs-1"></i>
                </div>
                <h5 class="text-dark-green mb-2">Easy Returns</h5>
                <p class="text-muted small mb-0">7-day return policy</p>
            </div>
            <div class="col-6 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon mb-3">
                    <i class="bi bi-headset text-gold fs-1"></i>
                </div>
                <h5 class="text-dark-green mb-2">24/7 Support</h5>
                <p class="text-muted small mb-0">Always here to help</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="zoom-in">
                <i class="bi bi-envelope-heart text-gold fs-1 mb-3"></i>
                <h3 class="text-dark-green mb-3">Stay Connected This Ramadan</h3>
                <p class="text-muted mb-4">Subscribe to receive exclusive offers, new arrivals, and Ramadan blessings</p>
                <form class="newsletter-form d-flex flex-column flex-md-row gap-2 justify-content-center">
                    <input type="email" class="form-control" placeholder="Enter your email" required style="max-width: 400px;">
                    <button type="submit" class="btn btn-primary px-4">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>
@endpush
