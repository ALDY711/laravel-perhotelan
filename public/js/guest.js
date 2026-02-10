/**
 * Grand Hotel - Guest Layout JavaScript
 * Main JS file for guest-facing pages
 */

// =====================
// Navbar Scroll Effect
// =====================
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNavbar');
    const scrollToTop = document.getElementById('scrollToTop');
    
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    
    // Show/hide scroll to top button
    if (scrollToTop) {
        if (window.scrollY > 300) {
            scrollToTop.classList.add('visible');
        } else {
            scrollToTop.classList.remove('visible');
        }
    }
});

// =====================
// Scroll to Top
// =====================
document.addEventListener('DOMContentLoaded', function() {
    const scrollToTop = document.getElementById('scrollToTop');
    if (scrollToTop) {
        scrollToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// =====================
// Smooth Scroll for Anchor Links
// =====================
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

// =====================
// Toast Notification System
// =====================
function showToast(type, title, message, duration = 5000) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
    const icons = {
        success: 'bi-check-circle-fill',
        error: 'bi-x-circle-fill',
        warning: 'bi-exclamation-triangle-fill',
        info: 'bi-info-circle-fill'
    };
    
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            <i class="bi ${icons[type]}"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
        <div class="toast-progress" style="animation-duration: ${duration}ms"></div>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('hiding');
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// =====================
// Lightbox Functionality
// =====================
let currentImageIndex = 0;
let lightboxImages = [];

function openLightbox(imgSrc, caption = '', images = []) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    
    if (!lightbox || !lightboxImg) return;
    
    lightboxImages = images.length > 0 ? images : [{ src: imgSrc, caption: caption }];
    currentImageIndex = images.findIndex(img => img.src === imgSrc) || 0;
    
    lightboxImg.src = imgSrc;
    if (lightboxCaption) lightboxCaption.textContent = caption;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function nextImage() {
    if (lightboxImages.length > 1) {
        currentImageIndex = (currentImageIndex + 1) % lightboxImages.length;
        updateLightboxImage();
    }
}

function prevImage() {
    if (lightboxImages.length > 1) {
        currentImageIndex = (currentImageIndex - 1 + lightboxImages.length) % lightboxImages.length;
        updateLightboxImage();
    }
}

function updateLightboxImage() {
    const lightboxImg = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    if (lightboxImg) lightboxImg.src = lightboxImages[currentImageIndex].src;
    if (lightboxCaption) lightboxCaption.textContent = lightboxImages[currentImageIndex].caption;
}

// Keyboard navigation for lightbox
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});

// Close lightbox on backdrop click
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });
    }
});

// =====================
// Confirmation Modal
// =====================
function showConfirm(title, message, type = 'warning', callback) {
    const modalEl = document.getElementById('confirmModal');
    if (!modalEl) return;
    
    const modal = new bootstrap.Modal(modalEl);
    const iconEl = document.getElementById('confirmIcon');
    const titleEl = document.getElementById('confirmTitle');
    const messageEl = document.getElementById('confirmMessage');
    const confirmBtn = document.getElementById('confirmBtn');
    
    const icons = {
        warning: 'bi-exclamation-triangle',
        danger: 'bi-trash',
        info: 'bi-question-circle'
    };
    
    if (iconEl) {
        iconEl.className = `confirm-icon ${type}`;
        iconEl.innerHTML = `<i class="bi ${icons[type]}"></i>`;
    }
    if (titleEl) titleEl.textContent = title;
    if (messageEl) messageEl.textContent = message;
    
    if (confirmBtn) {
        confirmBtn.onclick = function() {
            modal.hide();
            if (callback) callback();
        };
    }
    
    modal.show();
}

// =====================
// Animated Counter
// =====================
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number, .counter-value');
    
    counters.forEach(counter => {
        const target = counter.innerText;
        const numericTarget = parseInt(target.replace(/[^\d]/g, ''));
        
        if (isNaN(numericTarget) || numericTarget === 0) return;
        
        let count = 0;
        const increment = Math.max(1, Math.ceil(numericTarget / 100));
        
        const updateCount = () => {
            if (count < numericTarget) {
                count += increment;
                if (count > numericTarget) count = numericTarget;
                counter.innerText = target.replace(/\d+/, count);
                requestAnimationFrame(updateCount);
            }
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(counter);
    });
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    animateCounters();
});
