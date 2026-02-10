@extends('layouts.guest')

@section('title', 'Login')

@push('styles')
<style>
    .auth-section {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 3rem 0;
    }
    
    .auth-card {
        background: rgba(22, 33, 62, 0.85);
        backdrop-filter: blur(30px);
        border: 1px solid rgba(201, 169, 89, 0.2);
        border-radius: 24px;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-gold);
    }
    
    .auth-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(201, 169, 89, 0.08) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .auth-header {
        position: relative;
        z-index: 1;
    }
    
    .auth-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(201, 169, 89, 0.2) 0%, rgba(201, 169, 89, 0.05) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        border: 2px solid rgba(201, 169, 89, 0.3);
    }
    
    .auth-icon i {
        font-size: 2rem;
        color: var(--primary-gold);
    }
    
    .form-floating-custom {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating-custom label {
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-floating-custom .form-control-premium {
        padding-left: 3rem;
    }
    
    .form-floating-custom .input-icon {
        position: absolute;
        left: 1rem;
        bottom: 1rem;
        color: var(--primary-gold);
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .form-floating-custom .form-control-premium:focus + .input-icon,
    .form-floating-custom .form-control-premium:not(:placeholder-shown) + .input-icon {
        color: var(--primary-gold);
        transform: scale(1.1);
    }
    
    .password-toggle {
        position: absolute;
        right: 1rem;
        bottom: 1rem;
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0;
        transition: color 0.3s ease;
    }
    
    .password-toggle:hover {
        color: var(--primary-gold);
    }
    
    .divider {
        display: flex;
        align-items: center;
        margin: 2rem 0;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201, 169, 89, 0.3), transparent);
    }
    
    .divider span {
        padding: 0 1rem;
        color: var(--text-muted);
        font-size: 0.875rem;
    }
    
    .auth-features {
        display: none;
    }
    
    @media (min-width: 992px) {
        .auth-features {
            display: block;
            height: 100%;
            background: linear-gradient(135deg, rgba(201, 169, 89, 0.05) 0%, rgba(22, 33, 62, 0.5) 100%);
            border-radius: 24px;
            padding: 3rem;
            border: 1px solid rgba(201, 169, 89, 0.15);
        }
        
        .auth-features h3 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .feature-item i {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(201, 169, 89, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            flex-shrink: 0;
        }
    }
    
    .form-check-input:checked {
        background-color: var(--primary-gold);
        border-color: var(--primary-gold);
    }
    
    .form-check-label {
        color: var(--text-muted);
    }
</style>
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center align-items-stretch g-4">
            <!-- Features Side (Desktop) -->
            <div class="col-lg-5">
                <div class="auth-features h-100">
                    <h3 class="text-gold mb-2">Selamat Datang Kembali!</h3>
                    <p class="text-muted mb-4">Login untuk mengakses fitur lengkap Grand Hotel:</p>
                    
                    <div class="feature-item">
                        <i class="bi bi-calendar-check"></i>
                        <div>
                            <h6 class="mb-1 text-light">Reservasi Mudah</h6>
                            <p class="small text-muted mb-0">Pesan kamar dengan cepat dan mudah</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-clock-history"></i>
                        <div>
                            <h6 class="mb-1 text-light">Riwayat Booking</h6>
                            <p class="small text-muted mb-0">Lihat semua riwayat reservasi Anda</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-gift"></i>
                        <div>
                            <h6 class="mb-1 text-light">Promo Eksklusif</h6>
                            <p class="small text-muted mb-0">Dapatkan diskon khusus member</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-headset"></i>
                        <div>
                            <h6 class="mb-1 text-light">Support 24/7</h6>
                            <p class="small text-muted mb-0">Bantuan kapan saja Anda butuhkan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Login Form -->
            <div class="col-lg-5">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h2 class="text-gold mb-2">Login</h2>
                        <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-envelope me-2"></i>Email</label>
                            <input type="email" name="email" 
                                   class="form-control form-control-premium @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                            <i class="bi bi-envelope input-icon"></i>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-lock me-2"></i>Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control form-control-premium @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password Anda" required>
                            <i class="bi bi-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-gold w-100 py-3 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>atau</span>
                    </div>
                    
                    <p class="text-center text-muted mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-gold fw-medium text-decoration-none">
                            Daftar Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (password.type === 'password') {
            password.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            password.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
@endpush
@endsection
