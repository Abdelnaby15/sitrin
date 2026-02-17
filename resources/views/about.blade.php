@extends('layouts.app')

@section('title', 'About SITRIN - Our Ramadan Story')

@section('content')
<!-- About Hero -->
<section class="about-hero bg-beige py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">Our Story</span>
                <h1 class="display-4 fw-bold text-dark-green mb-4">Where Tradition Meets Elegance</h1>
                <p class="lead text-muted mb-4">
                    SITRIN was born from a vision to celebrate the beauty of Ramadan through exquisite fashion. 
                    We believe that modesty and elegance can coexist beautifully, creating pieces that honor tradition while embracing contemporary design.
                </p>
                <p class="text-muted">
                    Each abaya in our collection is more than just a garment—it's a testament to craftsmanship, 
                    faith, and the timeless beauty of modest fashion. We pour our hearts into every design, 
                    ensuring that when you wear SITRIN, you feel both confident and connected to the blessed spirit of Ramadan.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/products/1771265608_69935e484465d.PNG') }}" alt="SITRIN Ramadan Abaya Collection" class="img-fluid rounded-4 shadow-lg" style="width: 100%; height: auto; object-fit: cover; max-height: 600px;">
            </div>
        </div>
    </div>
</section>

<!-- Ramadan Message -->
<section class="ramadan-story py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="zoom-in">
                <i class="bi bi-moon-stars-fill text-gold display-4 mb-4"></i>
                <h2 class="display-5 fw-bold text-dark-green mb-4">رمضان كريم</h2>
                <p class="lead text-muted mb-4">
                    The holy month of Ramadan is a time of reflection, gratitude, and spiritual growth. 
                    At SITRIN, we honor this blessed month by creating abayas that allow you to observe 
                    this sacred time with grace and beauty.
                </p>
                <p class="text-muted">
                    "And whoever seeks the pleasure of Allah, He will bless their efforts manifold" - Our commitment 
                    is to help you feel your most beautiful self as you observe the holy month.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="our-values py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">Our Values</span>
            <h2 class="display-5 fw-bold text-dark-green mb-3">What We Stand For</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="value-card text-center p-4 bg-white rounded-3 h-100 shadow-sm">
                    <div class="icon-wrapper mb-3">
                        <i class="bi bi-heart-fill text-gold display-4"></i>
                    </div>
                    <h4 class="text-dark-green mb-3">Quality First</h4>
                    <p class="text-muted mb-0">We use only the finest fabrics and materials, ensuring every piece is crafted to perfection.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card text-center p-4 bg-white rounded-3 h-100 shadow-sm">
                    <div class="icon-wrapper mb-3">
                        <i class="bi bi-gem text-gold display-4"></i>
                    </div>
                    <h4 class="text-dark-green mb-3">Timeless Elegance</h4>
                    <p class="text-muted mb-0">Our designs blend traditional modesty with modern sophistication for timeless appeal.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card text-center p-4 bg-white rounded-3 h-100 shadow-sm">
                    <div class="icon-wrapper mb-3">
                        <i class="bi bi-people-fill text-gold display-4"></i>
                    </div>
                    <h4 class="text-dark-green mb-3">Community Focus</h4>
                    <p class="text-muted mb-0">We're committed to serving our community and celebrating the spirit of togetherness.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card text-center p-4 bg-white rounded-3 h-100 shadow-sm">
                    <div class="icon-wrapper mb-3">
                        <i class="bi bi-shield-check text-gold display-4"></i>
                    </div>
                    <h4 class="text-dark-green mb-3">Trust & Integrity</h4>
                    <p class="text-muted mb-0">We build lasting relationships with our customers through honesty and transparency.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Craftsmanship -->
<section class="craftsmanship py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0" data-aos="fade-left">
                <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">Our Craftsmanship</span>
                <h2 class="display-5 fw-bold text-dark-green mb-4">Handcrafted with Love</h2>
                <p class="text-muted mb-4">
                    Every SITRIN abaya is a labor of love. Our skilled artisans carefully select premium fabrics, 
                    cut each piece with precision, and sew every seam with attention to detail. We don't just make clothes—we create wearable art.
                </p>
                <div class="features-list">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                        <span>Premium quality fabrics sourced ethically</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                        <span>Meticulous attention to detail in every stitch</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                        <span>Comfort-focused designs for all-day wear</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                        <span>Quality control at every stage of production</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('images/products/1771265853_69935f3db2178.PNG') }}" alt="Premium Abaya Craftsmanship" class="img-fluid rounded-4 shadow-lg" style="width: 100%; height: auto; object-fit: cover; max-height: 600px;">
            </div>
        </div>
    </div>
</section>

<!-- Our Promise -->
<section class="our-promise py-5 bg-dark-green text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="zoom-in">
                <h2 class="display-5 fw-bold mb-4">Our Promise to You</h2>
                <p class="lead mb-4">
                    At SITRIN, we promise to always put you first. From the moment you browse our collection 
                    to the day your abaya arrives at your doorstep, we're committed to providing an exceptional experience.
                </p>
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <i class="bi bi-truck display-5 text-gold mb-3"></i>
                        <h5>Fast Shipping</h5>
                        <p class="text-beige small mb-0">Quick and reliable delivery across Egypt</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-arrow-repeat display-5 text-gold mb-3"></i>
                        <h5>Easy Returns</h5>
                        <p class="text-beige small mb-0">7-day hassle-free return policy</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-headset display-5 text-gold mb-3"></i>
                        <h5>24/7 Support</h5>
                        <p class="text-beige small mb-0">Always here to assist you</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <i class="bi bi-stars text-gold display-4 mb-4"></i>
                <h2 class="display-5 fw-bold text-dark-green mb-4">Join the SITRIN Family</h2>
                <p class="lead text-muted mb-4">
                    Experience the perfect blend of tradition and elegance. Explore our Ramadan collection today.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-bag me-2"></i>Shop Collection
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg px-5">
                        <i class="bi bi-envelope me-2"></i>Contact Us
                    </a>
                </div>
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
