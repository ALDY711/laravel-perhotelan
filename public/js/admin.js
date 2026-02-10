/**
 * Grand Hotel - Admin Layout JavaScript
 * Main JS file for admin panel
 */

// =====================
// Animated Counter for Dashboard Stats
// =====================
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        element.textContent = Math.floor(easeOutQuart * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// =====================
// Initialize Dashboard Counters
// =====================
document.addEventListener('DOMContentLoaded', function () {
    const statsValues = document.querySelectorAll('.stat-value-lg, .mini-value, .stat-value');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const text = element.textContent;

                // Extract numeric value
                const matches = text.match(/[\d.]+/);
                if (matches) {
                    const numericValue = parseFloat(matches[0]);
                    if (!isNaN(numericValue) && numericValue > 0) {
                        const isDecimal = text.includes('.');
                        element.textContent = text.replace(/[\d.]+/, '0');

                        let current = 0;
                        const increment = numericValue / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= numericValue) {
                                current = numericValue;
                                clearInterval(timer);
                            }
                            element.textContent = text.replace(/[\d.]+/, isDecimal ? current.toFixed(1) : Math.floor(current));
                        }, 30);
                    }
                }

                observer.unobserve(element);
            }
        });
    }, { threshold: 0.1 });

    statsValues.forEach(stat => observer.observe(stat));

    // Animate occupancy bar
    setTimeout(() => {
        const occupancyFill = document.querySelector('.occupancy-bar .fill');
        if (occupancyFill) {
            occupancyFill.style.width = occupancyFill.style.width;
        }
    }, 500);
});

// =====================
// Sidebar Toggle (for mobile)
// =====================
function toggleSidebar() {
    const sidebar = document.querySelector('.admin-sidebar');
    const main = document.querySelector('.admin-main');

    if (sidebar) {
        sidebar.classList.toggle('collapsed');
    }
    if (main) {
        main.classList.toggle('expanded');
    }
}

// =====================
// Delete Confirmation
// =====================
function confirmDelete(message = 'Apakah Anda yakin ingin menghapus?') {
    return confirm(message);
}

// =====================
// Toast Notifications for Admin
// =====================
function showAdminToast(type, title, message, duration = 4000) {
    const toastContainer = document.getElementById('adminToastContainer');
    if (!toastContainer) {
        // Create container if not exists
        const container = document.createElement('div');
        container.id = 'adminToastContainer';
        container.style.cssText = 'position: fixed; top: 80px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px;';
        document.body.appendChild(container);
    }

    const icons = {
        success: 'bi-check-circle-fill',
        error: 'bi-x-circle-fill',
        warning: 'bi-exclamation-triangle-fill',
        info: 'bi-info-circle-fill'
    };

    const colors = {
        success: '#10b981',
        error: '#ef4444',
        warning: '#f59e0b',
        info: '#6366f1'
    };

    const toast = document.createElement('div');
    toast.style.cssText = `
        background: #1e293b;
        border: 1px solid rgba(255,255,255,0.1);
        border-left: 4px solid ${colors[type]};
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideIn 0.3s ease;
        color: white;
        min-width: 300px;
    `;

    toast.innerHTML = `
        <i class="bi ${icons[type]}" style="font-size: 1.5rem; color: ${colors[type]};"></i>
        <div style="flex: 1;">
            <strong style="display: block;">${title}</strong>
            <small style="color: #94a3b8;">${message}</small>
        </div>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 1.25rem;">
            <i class="bi bi-x"></i>
        </button>
    `;

    const container = document.getElementById('adminToastContainer');
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease forwards';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// Add animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100%); }
    }
`;
document.head.appendChild(style);
