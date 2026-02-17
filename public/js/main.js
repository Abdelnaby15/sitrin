/* ====================================
   SITRIN Main JavaScript
   ==================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'flex';
                backToTopBtn.style.alignItems = 'center';
                backToTopBtn.style.justifyContent = 'center';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 50) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });
    }
    
    // ===== Collection Carousel Auto-Rotation =====
    initCollectionCarousels();
    
    // Add to Cart Animation
    const addToCartForms = document.querySelectorAll('form[action*="cart.add"]');
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (button) {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check-circle me-2"></i>Added!';
                button.disabled = true;
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 1500);
            }
        });
    });
    
    // Image Lazy Loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Product Image Gallery
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    
    // Newsletter Form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Show success message (you can replace with actual API call)
            alert('Thank you for subscribing! You will receive our latest updates.');
            this.reset();
        });
    }
    
    // Price Range Filter Animation
    const priceInputs = document.querySelectorAll('input[name="min_price"], input[name="max_price"]');
    priceInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.style.borderColor = '#C9A961';
        });
        
        input.addEventListener('blur', function() {
            this.style.borderColor = '';
        });
    });
    
    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Product Card Hover Effect Enhancement
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
    
    // Search Input Focus Effect
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.transition = 'transform 0.2s ease';
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    }
    
    // Loading State for Forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                submitBtn.disabled = true;
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;
                }, 5000);
            }
        });
    });
    
});

// Utility Functions

// Format Price
function formatPrice(price) {
    return 'EGP ' + parseFloat(price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// Update Cart Count
function updateCartCount() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.getElementById('cartCount');
            if (cartCountElement) {
                cartCountElement.textContent = data.count;
                
                // Animate the count update
                cartCountElement.style.animation = 'none';
                setTimeout(() => {
                    cartCountElement.style.animation = 'pulse 0.5s';
                }, 10);
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
}

// Show Toast Notification
function showToast(message, type = 'success') {
    const toastHTML = `
        <div class="toast align-items-center text-white bg-${type} border-0 position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    const toastContainer = document.createElement('div');
    toastContainer.innerHTML = toastHTML;
    document.body.appendChild(toastContainer);
    
    const toastElement = toastContainer.querySelector('.toast');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Remove from DOM after hidden
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastContainer.remove();
    });
}

// Add Product to Cart via AJAX (for future enhancement)
function addToCartAjax(productId, quantity = 1, size = null, color = null) {
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    if (size) formData.append('size', size);
    if (color) formData.append('color', color);
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                showToast('Product added to cart!', 'success');
            } else {
                showToast(data.message || 'Error adding product to cart', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error adding product to cart', 'danger');
        });
    }
}

// ===== Collection Carousel Auto-Rotation =====
function initCollectionCarousels() {
    const carouselCards = document.querySelectorAll('.collection-carousel-card');
    console.log('Found carousel cards:', carouselCards.length);
    
    carouselCards.forEach((card, cardIndex) => {
        const images = card.querySelectorAll('.carousel-image');
        const indicators = card.querySelectorAll('.indicator');
        
        console.log(`Carousel ${cardIndex}: ${images.length} images, ${indicators.length} indicators`);
        
        if (images.length <= 1) {
            console.log(`Skipping carousel ${cardIndex} - only ${images.length} image(s)`);
            return;
        }
        
        let currentIndex = 0;
        let intervalId = null;
        
        // Start auto-rotation
        function startRotation() {
            intervalId = setInterval(() => {
                // Remove active class from current image and indicator
                images[currentIndex].classList.remove('active');
                if (indicators[currentIndex]) {
                    indicators[currentIndex].classList.remove('active');
                }
                
                // Move to next image
                currentIndex = (currentIndex + 1) % images.length;
                
                // Add active class to new image and indicator
                images[currentIndex].classList.add('active');
                if (indicators[currentIndex]) {
                    indicators[currentIndex].classList.add('active');
                }
                
                console.log(`Carousel ${cardIndex} - showing image ${currentIndex}`);
            }, 3000 + (cardIndex * 500));
        }
        
        startRotation();
        
        // Pause on hover
        card.addEventListener('mouseenter', () => {
            console.log(`Pausing carousel ${cardIndex}`);
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
        });
        
        // Resume on mouse leave
        card.addEventListener('mouseleave', () => {
            console.log(`Resuming carousel ${cardIndex}`);
            if (!intervalId) {
                startRotation();
            }
        });
        
        // Click indicators to jump to specific image
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                console.log(`Clicked indicator ${index} on carousel ${cardIndex}`);
                
                images[currentIndex].classList.remove('active');
                if (indicators[currentIndex]) {
                    indicators[currentIndex].classList.remove('active');
                }
                
                currentIndex = index;
                
                images[currentIndex].classList.add('active');
                if (indicators[currentIndex]) {
                    indicators[currentIndex].classList.add('active');
                }
            });
        });
    });
}
