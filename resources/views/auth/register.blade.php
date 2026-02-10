@extends('layouts.guest')

@section('title', 'Daftar')

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
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(201, 169, 89, 0.4);
        }
        50% {
            box-shadow: 0 0 0 15px rgba(201, 169, 89, 0);
        }
    }
    
    .auth-icon i {
        font-size: 2rem;
        color: var(--primary-gold);
    }
    
    .form-floating-custom {
        position: relative;
        margin-bottom: 1.25rem;
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
    
    .password-strength {
        height: 4px;
        border-radius: 2px;
        background: rgba(255, 255, 255, 0.1);
        margin-top: 0.5rem;
        overflow: hidden;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .password-strength-bar.weak { width: 33%; background: #ef4444; }
    .password-strength-bar.medium { width: 66%; background: #f59e0b; }
    .password-strength-bar.strong { width: 100%; background: #10b981; }
    
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
    
    .benefit-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(201, 169, 89, 0.1);
        border: 1px solid rgba(201, 169, 89, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        color: var(--primary-gold);
        margin: 0.25rem;
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
                    <h3 class="text-gold mb-2">Bergabunglah Bersama Kami!</h3>
                    <p class="text-muted mb-4">Daftar sekarang dan nikmati berbagai keuntungan:</p>
                    
                    <div class="feature-item">
                        <i class="bi bi-percent"></i>
                        <div>
                            <h6 class="mb-1 text-light">Diskon Member</h6>
                            <p class="small text-muted mb-0">Dapatkan potongan harga hingga 20%</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-lightning-charge"></i>
                        <div>
                            <h6 class="mb-1 text-light">Booking Cepat</h6>
                            <p class="small text-muted mb-0">Proses reservasi hanya dalam hitungan menit</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-bell"></i>
                        <div>
                            <h6 class="mb-1 text-light">Notifikasi Real-time</h6>
                            <p class="small text-muted mb-0">Update status booking langsung ke email</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <h6 class="mb-1 text-light">Pembayaran Aman</h6>
                            <p class="small text-muted mb-0">Transaksi dilindungi enkripsi 256-bit</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-muted small mb-2">Benefit Member:</p>
                        <div>
                            <span class="benefit-badge"><i class="bi bi-check-circle"></i> Gratis Sarapan</span>
                            <span class="benefit-badge"><i class="bi bi-check-circle"></i> Late Checkout</span>
                            <span class="benefit-badge"><i class="bi bi-check-circle"></i> Room Upgrade</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Register Form -->
            <div class="col-lg-5">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h2 class="text-gold mb-2">Buat Akun</h2>
                        <p class="text-muted">Daftar untuk menikmati kemudahan reservasi</p>
                    </div>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-person me-2"></i>Nama Lengkap</label>
                            <input type="text" name="name" 
                                   class="form-control form-control-premium @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                            <i class="bi bi-person input-icon"></i>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-envelope me-2"></i>Email</label>
                            <input type="email" name="email" 
                                   class="form-control form-control-premium @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                            <i class="bi bi-envelope input-icon"></i>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-lock me-2"></i>Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control form-control-premium @error('password') is-invalid @enderror" 
                                   placeholder="Buat password yang kuat" required onkeyup="checkPasswordStrength()">
                            <i class="bi bi-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="bi bi-eye" id="toggleIcon1"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrength"></div>
                            </div>
                            <small class="text-muted" id="passwordHint">Minimal 8 karakter</small>
                        </div>
                        
                        <div class="form-floating-custom">
                            <label><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control form-control-premium" 
                                   placeholder="Ulangi password Anda" required>
                            <i class="bi bi-lock-fill input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                <i class="bi bi-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                        
                        <button type="submit" class="btn btn-gold w-100 py-3 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>atau</span>
                    </div>
                    
                    <p class="text-center text-muted mb-0">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-gold fw-medium text-decoration-none">
                            Login di sini <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const password = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
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
    
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthBar = document.getElementById('passwordStrength');
        const hint = document.getElementById('passwordHint');
        
        strengthBar.className = 'password-strength-bar';
        
        if (password.length === 0) {
            hint.textContent = 'Minimal 8 karakter';
            return;
        }
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        if (strength <= 1) {
            strengthBar.classList.add('weak');
            hint.textContent = 'Password lemah';
        } else if (strength <= 2) {
            strengthBar.classList.add('medium');
            hint.textContent = 'Password cukup kuat';
        } else {
            strengthBar.classList.add('strong');
            hint.textContent = 'Password sangat kuat!';
        }
    }
</script>
@endpush
@endsection
