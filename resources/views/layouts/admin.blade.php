<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - SITRIN</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar bg-dark-green text-white">
            <div class="sidebar-header p-4 border-bottom border-gold-subtle">
                <h4 class="text-gold mb-0">SITRIN Admin</h4>
            </div>
            
            <nav class="sidebar-nav p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam me-2"></i>Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-tags me-2"></i>Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-cart-check me-2"></i>Orders
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a href="{{ route('home') }}" class="nav-link text-beige">
                            <i class="bi bi-arrow-left me-2"></i>Back to Website
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Navigation -->
            <nav class="navbar navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link d-lg-none" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <span class="text-muted">{{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <main class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
