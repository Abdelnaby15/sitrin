@extends('layouts.app')

@section('title', $product->name . ' - SITRIN')

@section('content')
<!-- Product Details Section -->
<section class="product-details py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
        
        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-gallery">
                    <!-- Main Image -->
                    <div class="main-image-wrapper mb-3 position-relative" id="imageZoomContainer" style="cursor: zoom-in;">
                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="img-fluid rounded-3 shadow w-100" id="mainImage" style="max-height: 600px; object-fit: contain;">
                        @if($product->isOnSale())
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 fs-6">
                                -{{ $product->discount_percentage }}% OFF
                            </span>
                        @endif
                        @if($product->is_new_arrival)
                            <span class="badge bg-primary position-absolute top-0 end-0 m-3 fs-6">New Arrival</span>
                        @endif
                        <!-- Zoom Lens -->
                        <div id="zoomLens" class="position-absolute rounded-circle" style="display: none; border: 2px solid #C9A961; pointer-events: none; width: 100px; height: 100px;"></div>
                    </div>
                    
                    <!-- Zoomed Image Result -->
                    <div id="zoomResult" class="position-fixed bg-white rounded-3 shadow-lg" style="display: none; width: 400px; height: 400px; border: 2px solid #C9A961; z-index: 1000; overflow: hidden;"></div>
                    
                    <!-- Thumbnail Gallery Grid -->
                    <div class="row g-2 g-md-3">
                        <!-- Main Image Thumbnail -->
                        <div class="col-3">
                            <div class="thumbnail-wrapper">
                                <img src="{{ asset($product->main_image) }}" 
                                     alt="Thumbnail 1" 
                                     class="img-thumbnail thumbnail-item active w-100" 
                                     style="height: 100px; object-fit: cover; cursor: pointer; border: 3px solid #C9A961;" 
                                     onclick="changeImage('{{ asset($product->main_image) }}', this)">
                            </div>
                        </div>
                        
                        @if($product->images && is_array($product->images) && count($product->images) > 0)
                            @foreach($product->images as $index => $image)
                                @if($index < 4)
                                <div class="col-3">
                                    <div class="thumbnail-wrapper">
                                        <img src="{{ asset($image) }}" 
                                             alt="Thumbnail {{ $index + 2 }}" 
                                             class="img-thumbnail thumbnail-item w-100" 
                                             style="height: 100px; object-fit: cover; cursor: pointer; border: 3px solid transparent; transition: all 0.3s;" 
                                             onclick="changeImage('{{ asset($image) }}', this)">
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <!-- Placeholder thumbnails if no additional images -->
                            @for($i = 1; $i <= 3; $i++)
                            <div class="col-3">
                                <div class="thumbnail-wrapper">
                                    <img src="{{ asset($product->main_image) }}" 
                                         alt="Thumbnail {{ $i + 1 }}" 
                                         class="img-thumbnail thumbnail-item w-100" 
                                         style="height: 100px; object-fit: cover; cursor: pointer; border: 3px solid transparent; transition: all 0.3s; opacity: 0.5;" 
                                         onclick="changeImage('{{ asset($product->main_image) }}', this)">
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-details-info">
                    <span class="badge bg-gold-subtle text-gold mb-2">{{ $product->category->name }}</span>
                    <h1 class="display-5 fw-bold text-dark-green mb-3">{{ $product->name }}</h1>
                    
                    <!-- Rating & Reviews (placeholder) -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="stars text-gold">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted small">({{ $product->views }} views)</span>
                    </div>
                    
                    <!-- Price -->
                    <div class="price-section mb-4">
                        @if($product->isOnSale())
                            <h3 class="mb-0">
                                <span class="text-muted text-decoration-line-through me-3 fs-4">EGP {{ number_format($product->price, 2) }}</span>
                                <span class="text-primary">EGP {{ number_format($product->sale_price, 2) }}</span>
                            </h3>
                            <p class="text-success mb-0">Save EGP {{ number_format($product->price - $product->sale_price, 2) }}</p>
                        @else
                            <h3 class="text-primary mb-0">EGP {{ number_format($product->price, 2) }}</h3>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <div class="product-description mb-4">
                        <h5 class="text-dark-green mb-3">Description</h5>
                        <p class="text-muted" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif; direction: rtl; text-align: right; line-height: 1.8;">{{ $product->description }}</p>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="product-meta mb-4">
                        <div class="row g-3">
                            @if($product->fabric)
                            <div class="col-6">
                                <div class="meta-item p-3 bg-light rounded">
                                    <i class="bi bi-flag text-gold me-2"></i>
                                    <span class="text-muted small d-block">Fabric</span>
                                    <strong>{{ $product->fabric }}</strong>
                                </div>
                            </div>
                            @endif
                            @if($product->color)
                            <div class="col-6">
                                <div class="meta-item p-3 bg-light rounded">
                                    <i class="bi bi-palette text-gold me-2"></i>
                                    <span class="text-muted small d-block">Color</span>
                                    <strong>{{ $product->color }}</strong>
                                </div>
                            </div>
                            @endif
                            <div class="col-6">
                                <div class="meta-item p-3 bg-light rounded">
                                    <i class="bi bi-box-seam text-gold me-2"></i>
                                    <span class="text-muted small d-block">Availability</span>
                                    <strong class="{{ $product->inStock() ? 'text-success' : 'text-danger' }}">
                                        {{ $product->inStock() ? 'In Stock' : 'Out of Stock' }}
                                    </strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="meta-item p-3 bg-light rounded">
                                    <i class="bi bi-truck text-gold me-2"></i>
                                    <span class="text-muted small d-block">Delivery</span>
                                    <strong>2-3 Days</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add to Cart Form -->
                    @if($product->inStock())
                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="row g-3 mb-4">
                            <!-- Size Information -->
                            @if($product->size)
                            <div class="col-12">
                                <label class="form-label fw-semibold">Size</label>
                                <input type="hidden" name="size" value="{{ $product->size }}">
                                <div class="border rounded p-3 bg-light">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-rulers text-primary fs-5 mt-1"></i>
                                        <div>
                                            <div class="fw-semibold text-dark mb-1">{{ $product->size }}</div>
                                            <small class="text-muted">Measured from shoulders without hijab</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Quantity -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Quantity</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decrementQty()">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="incrementQty()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </form>
                    @else
                    <!-- Out of Stock Alert -->
                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>This product is currently out of stock.
                    </div>
                    
                    <!-- Stock Notification Form -->
                    <div class="stock-notification-form bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h6 class="mb-3"><i class="bi bi-bell me-2"></i>Get Notified When Available</h6>
                        <p class="text-muted small mb-3">Enter your email and we'll notify you when this product is back in stock.</p>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        <form action="{{ route('stock-notifications.subscribe', $product) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-bell me-2"></i>Notify Me
                                </button>
                            </div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                    @endif
                    
                    <!-- Features -->
                    <div class="product-features mt-4 p-4 bg-beige rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-shield-check text-gold me-2"></i>
                            <span>100% Authentic Product</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-arrow-repeat text-gold me-2"></i>
                            <span>7 Days Easy Return</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-credit-card text-gold me-2"></i>
                            <span>Cash on Delivery Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="related-products py-5 bg-light">
    <div class="container">
        <h3 class="text-dark-green mb-4">You May Also Like</h3>
        <div class="row g-4">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-6 col-lg-3 col-md-6">
                <div class="product-card">
                    <div class="product-image-wrapper position-relative">
                        <img src="{{ asset($relatedProduct->main_image) }}" alt="{{ $relatedProduct->name }}" class="product-image">
                        <div class="product-overlay">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="btn btn-white btn-sm">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                    <div class="product-info p-3 text-center">
                        <span class="text-muted small">{{ $relatedProduct->category->name }}</span>
                        <h5 class="product-title mb-2">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="text-dark text-decoration-none">
                                {{ $relatedProduct->name }}
                            </a>
                        </h5>
                        <div class="product-price">
                            <span class="text-primary fw-bold">EGP {{ number_format($relatedProduct->final_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    // Image Zoom Functionality
    const imageContainer = document.getElementById('imageZoomContainer');
    const mainImage = document.getElementById('mainImage');
    const zoomLens = document.getElementById('zoomLens');
    const zoomResult = document.getElementById('zoomResult');
    
    let zoomLevel = 2.5;
    
    imageContainer.addEventListener('mouseenter', function() {
        zoomLens.style.display = 'block';
        zoomResult.style.display = 'block';
        zoomResult.style.backgroundImage = `url('${mainImage.src}')`;
        zoomResult.style.backgroundSize = `${mainImage.width * zoomLevel}px ${mainImage.height * zoomLevel}px`;
    });
    
    imageContainer.addEventListener('mouseleave', function() {
        zoomLens.style.display = 'none';
        zoomResult.style.display = 'none';
    });
    
    imageContainer.addEventListener('mousemove', function(e) {
        const rect = imageContainer.getBoundingClientRect();
        let x = e.clientX - rect.left;
        let y = e.clientY - rect.top;
        
        // Keep lens within bounds
        const lensWidth = 100;
        const lensHeight = 100;
        
        x = Math.max(lensWidth / 2, Math.min(x, rect.width - lensWidth / 2));
        y = Math.max(lensHeight / 2, Math.min(y, rect.height - lensHeight / 2));
        
        // Position the lens
        zoomLens.style.left = (x - lensWidth / 2) + 'px';
        zoomLens.style.top = (y - lensHeight / 2) + 'px';
        
        // Position zoom result next to image
        zoomResult.style.left = (rect.right + 20) + 'px';
        zoomResult.style.top = rect.top + 'px';
        
        // Calculate background position
        const bgX = (x / rect.width) * 100;
        const bgY = (y / rect.height) * 100;
        
        zoomResult.style.backgroundPosition = `${bgX}% ${bgY}%`;
    });
    
    function changeImage(src, thumbnail) {
        // Update main image
        mainImage.src = src;
        
        // Update zoom result background
        if (zoomResult.style.display === 'block') {
            zoomResult.style.backgroundImage = `url('${src}')`;
        }
        
        // Remove active class from all thumbnails
        document.querySelectorAll('.thumbnail-item').forEach(item => {
            item.classList.remove('active');
            item.style.borderColor = 'transparent';
        });
        
        // Add active class to clicked thumbnail
        thumbnail.classList.add('active');
        thumbnail.style.borderColor = '#C9A961';
    }
    
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }
    
    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    
    // Hide zoom on mobile devices
    if (window.innerWidth < 992) {
        imageContainer.style.cursor = 'default';
        imageContainer.removeEventListener('mouseenter', () => {});
        imageContainer.removeEventListener('mousemove', () => {});
    }
</script>
@endpush
