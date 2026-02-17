@extends('layouts.app')

@section('title', 'Contact Us - SITRIN')

@section('content')
<!-- Contact Hero -->
<section class="contact-hero bg-beige py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-dark-green mb-3">Get In Touch</h1>
        <p class="lead text-muted">We'd love to hear from you. Let us know how we can help.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="bg-white p-5 rounded-3 shadow-sm">
                    <h3 class="text-dark-green mb-4">Send Us a Message</h3>
                    
                    <form action="{{ route('contact.store') }}" method="POST">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Subject *</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Message *</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="contact-info">
                    <h3 class="text-dark-green mb-4">Contact Information</h3>
                    
                    <div class="info-card bg-white p-4 rounded-3 shadow-sm mb-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="icon-wrapper bg-gold-subtle p-3 rounded-circle me-3">
                                <i class="bi bi-geo-alt-fill text-gold fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Our Location</h5>
                                <p class="text-muted mb-0">Cairo, Egypt</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start">
                            <div class="icon-wrapper bg-gold-subtle p-3 rounded-circle me-3">
                                <i class="bi bi-clock-fill text-gold fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Business Hours</h5>
                                <p class="text-muted mb-1">Saturday - Thursday: 10 AM - 8 PM</p>
                                <p class="text-muted mb-0">Friday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="bg-dark-green text-white p-4 rounded-3">
                        <h5 class="mb-3">Follow Us</h5>
                        <p class="text-beige mb-3 small">Stay connected for the latest collections and Ramadan inspiration</p>
                        <div class="social-links d-flex gap-3">
                            <a href="https://www.instagram.com/women_wearrs?igsh=MXR3b2loZWFnazBzbQ%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer" class="btn btn-light btn-sm rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="https://www.tiktok.com/@veloraa_veil?_r=1&_t=ZS-93yQwUbxJdH" target="_blank" rel="noopener noreferrer" class="btn btn-light btn-sm rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-gold-subtle text-gold mb-3 px-4 py-2">FAQs</span>
            <h2 class="display-5 fw-bold text-dark-green mb-3">Frequently Asked Questions</h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                What are your shipping options?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We offer fast shipping across Egypt. Most orders are delivered within 2-3 business days. Shipping cost is EGP 50 for all orders.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                What is your return policy?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We offer a 7-day easy return policy. Items must be unworn, unwashed, and in their original condition with all tags attached.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you offer cash on delivery?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! We offer cash on delivery for all orders. You can also choose to pay via bank transfer.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                How do I choose the right size?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Each product page includes detailed size information. If you need help, please contact us and we'll be happy to assist you in finding the perfect fit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
