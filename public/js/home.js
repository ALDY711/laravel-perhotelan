/**
 * Grand Hotel - Home Page JavaScript
 * JS file specifically for the home/landing page
 */

// =====================
// Promotional Banner Countdown Timer
// =====================
function startCountdown() {
    const hoursEl = document.getElementById('countHours');
    const minutesEl = document.getElementById('countMinutes');
    const secondsEl = document.getElementById('countSeconds');

    if (!hoursEl || !minutesEl || !secondsEl) return;

    // Set countdown to end of day
    const now = new Date();
    const endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59);

    function updateCountdown() {
        const now = new Date();
        const diff = endOfDay - now;

        if (diff <= 0) return;

        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        hoursEl.textContent = hours.toString().padStart(2, '0');
        minutesEl.textContent = minutes.toString().padStart(2, '0');
        secondsEl.textContent = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
}

// =====================
// Close Promotional Banner
// =====================
function closePromoBanner() {
    const banner = document.getElementById('promoBanner');
    if (!banner) return;

    banner.style.transition = 'all 0.3s ease';
    banner.style.transform = 'translateY(-100%)';
    banner.style.opacity = '0';

    setTimeout(() => {
        banner.style.display = 'none';
    }, 300);

    // Save to localStorage to remember closing
    localStorage.setItem('promoBannerClosed', 'true');
    localStorage.setItem('promoBannerClosedDate', new Date().toDateString());
}

// =====================
// Check if banner should be shown
// =====================
function checkPromoBanner() {
    const banner = document.getElementById('promoBanner');
    if (!banner) return;

    const closedDate = localStorage.getItem('promoBannerClosedDate');
    const today = new Date().toDateString();

    if (closedDate === today) {
        banner.style.display = 'none';
    } else {
        localStorage.removeItem('promoBannerClosed');
        localStorage.removeItem('promoBannerClosedDate');
    }
}

// =====================
// Animated Stats Counter
// =====================
function animateHomeCounters() {
    const counters = document.querySelectorAll('.stat-number');
    const speed = 150;

    counters.forEach(counter => {
        const target = counter.innerText;
        const numericTarget = parseInt(target.replace(/[^\d]/g, ''));

        if (isNaN(numericTarget) || numericTarget === 0) return;

        let count = 0;
        const increment = Math.max(1, Math.ceil(numericTarget / speed));

        const updateCount = () => {
            if (count < numericTarget) {
                count += increment;
                if (count > numericTarget) count = numericTarget;
                counter.innerText = target.replace(/\d+/, count);
                requestAnimationFrame(updateCount);
            }
        };

        // Start animation when element is in viewport
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

// =====================
// Parallax Effect for Hero Section
// =====================
function initParallax() {
    const hero = document.querySelector('.hero-section');
    if (!hero) return;

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const rate = scrolled * 0.3;

        if (scrolled < hero.offsetHeight) {
            hero.style.backgroundPositionY = `${rate}px`;
        }
    });
}

// =====================
// Room Card Hover Effects
// =====================
function initRoomCardEffects() {
    const roomCards = document.querySelectorAll('.room-card');

    roomCards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.querySelector('.room-image img')?.classList.add('zoomed');
        });

        card.addEventListener('mouseleave', function () {
            this.querySelector('.room-image img')?.classList.remove('zoomed');
        });
    });
}

// =====================
// Smooth Scroll for CTA Buttons
// =====================
function initSmoothScroll() {
    const ctaButtons = document.querySelectorAll('[data-scroll-to]');

    ctaButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const targetId = this.getAttribute('data-scroll-to');
            const target = document.querySelector(targetId);

            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// =====================
// Search Form Date Validation
// =====================
function initSearchForm() {
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');

    if (checkInInput && checkOutInput) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        checkInInput.setAttribute('min', today);

        // Update check-out minimum when check-in changes
        checkInInput.addEventListener('change', function () {
            const checkInDate = new Date(this.value);
            checkInDate.setDate(checkInDate.getDate() + 1);
            const minCheckOut = checkInDate.toISOString().split('T')[0];
            checkOutInput.setAttribute('min', minCheckOut);

            // Clear check-out if it's before new minimum
            if (checkOutInput.value && checkOutInput.value < minCheckOut) {
                checkOutInput.value = minCheckOut;
            }
        });
    }
}

// =====================
// Lazy Loading for Room Images
// =====================
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    }, { rootMargin: '50px 0px' });

    images.forEach(img => imageObserver.observe(img));
}

// =====================
// Initialize All Home Page Functions
// =====================
document.addEventListener('DOMContentLoaded', function () {
    startCountdown();
    checkPromoBanner();
    animateHomeCounters();
    initParallax();
    initRoomCardEffects();
    initSmoothScroll();
    initSearchForm();
    initLazyLoading();

    // Add loaded class to body for entrance animations
    document.body.classList.add('page-loaded');
});

// =====================
// Expose functions globally
// =====================
window.closePromoBanner = closePromoBanner;
