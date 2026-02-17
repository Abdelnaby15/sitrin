<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="SITRIN - Premium Ramadan Abayas Collection">
    <meta name="theme-color" content="#1B4332">
    <title>@yield('title', 'SITRIN - Premium Ramadan Abayas')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Cormorant Garamond for elegance -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="SITRIN" class="logo" style="height: 50px; width: auto; max-width: 180px;">
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="nav-icon position-relative">
                        <i class="bi bi-bag"></i>
                        <span class="cart-count badge bg-primary rounded-circle" id="cartCount">0</span>
                    </a>
                    
                    <!-- User Account -->
                    {{-- Temporarily disabled auth
                    @auth
                        <div class="dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></span></li>
                                <li><hr class="dropdown-divider"></li>
                                @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else --}}
                        <a href="{{ route('login') }}" class="nav-icon">
                            <i class="bi bi-person"></i>
                        </a>
                    {{-- @endauth --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{-- Temporarily disabled session messages
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        --}}
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark-green text-white mt-5">
        <div class="container py-4 py-md-5">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <h5 class="mb-3 mb-md-4 text-gold">SITRIN</h5>
                    <p class="text-beige small">Premium Ramadan Abayas crafted with elegance and tradition. Embrace the spirit of Ramadan with our exclusive collection.</p>
                    <div class="social-links mt-3">
                        <a href="https://www.instagram.com/women_wearrs?igsh=MXR3b2loZWFnazBzbQ%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer" class="text-white me-3" aria-label="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="https://www.tiktok.com/@veloraa_veil?_r=1&_t=ZS-93yQwUbxJdH" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="TikTok"><i class="bi bi-tiktok fs-5"></i></a>
                    </div>
                </div>
                
                <div class="col-6 col-md-6 col-lg-2">
                    <h6 class="mb-3 mb-md-4 text-gold">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-beige text-decoration-none small">Home</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}" class="text-beige text-decoration-none small">Collection</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-beige text-decoration-none small">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-beige text-decoration-none small">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-6 col-md-6 col-lg-3">
                    <h6 class="mb-3 mb-md-4 text-gold">Customer Service</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-beige text-decoration-none small">Shipping Info</a></li>
                        <li class="mb-2"><a href="#" class="text-beige text-decoration-none small">Returns</a></li>
                        <li class="mb-2"><a href="#" class="text-beige text-decoration-none small">Size Guide</a></li>
                        <li class="mb-2"><a href="#" class="text-beige text-decoration-none small">FAQs</a></li>
                    </ul>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                    <h6 class="mb-3 mb-md-4 text-gold">Contact Info</h6>
                    <ul class="list-unstyled text-beige small">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Cairo, Egypt</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@sitrin.com</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 border-gold-subtle">
            
            <div class="row g-2">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <p class="mb-2 mb-md-0 text-beige small">&copy; 2026 SITRIN. All rights reserved.</p>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <p class="mb-0 text-beige small">Crafted with <i class="bi bi-heart-fill text-danger"></i> for Ramadan</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary rounded-circle" title="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <script>
        // Update cart count
        function updateCartCount() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cartCount').textContent = data.count;
                });
        }
        
        // Update cart count on page load
        updateCartCount();
    </script>
    
    @stack('scripts')
</body>
</html>
