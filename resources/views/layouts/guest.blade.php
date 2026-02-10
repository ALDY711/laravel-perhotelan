<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hotel Reservasi') - Grand Hotel</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom Guest Styles -->
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">
    
    <style>
        :root {
            --primary-gold: #c9a959;
            --primary-gold-light: #e4d5a8;
            --primary-gold-dark: #a88c3a;
            --dark-bg: #1f1f32ff;
            --darker-bg: #2c2c46ff;
            --card-bg: #16213e;
            --card-bg-hover: #1e2a4a;
            --text-light: #f8f9fa;
            --text-muted: #adb5bd;
            --gradient-gold: linear-gradient(135deg, #c9a959 0%, #e4d5a8 50%, #c9a959 100%);
            --shadow-gold: 0 10px 40px rgba(201, 169, 89, 0.2);
            --glass-bg: rgba(22, 33, 62, 0.7);
            --glass-border: rgba(201, 169, 89, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 50%, #1a1a35 100%);
            background-attachment: fixed;
            color: var(--text-light);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated Background Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--primary-gold);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite ease-in-out;
        }
        
        .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 20s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 18s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 22s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 1s; animation-duration: 19s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 3s; animation-duration: 21s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; animation-duration: 17s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 2.5s; animation-duration: 23s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 1.5s; animation-duration: 20s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 4.5s; animation-duration: 18s; }
        .particle:nth-child(10) { left: 95%; animation-delay: 0.5s; animation-duration: 24s; }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 0.4;
            }
            50% {
                opacity: 0.2;
                transform: translateY(50vh) scale(1);
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-10vh) scale(0.5);
                opacity: 0;
            }
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        /* Enhanced Navbar Styles */
        .navbar {
            background: rgba(15, 15, 26, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar.scrolled {
            padding: 0.6rem 0;
            background: rgba(15, 15, 26, 0.95) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.02);
        }
        
        .navbar-brand i {
            -webkit-text-fill-color: var(--primary-gold);
            margin-right: 0.5rem;
        }
        
        .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gradient-gold);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover {
            color: var(--primary-gold) !important;
            background: rgba(201, 169, 89, 0.1);
        }
        
        .nav-link:hover::before {
            width: 80%;
        }
        
        /* Enhanced Button Styles */
        .btn-gold {
            background: var(--gradient-gold);
            background-size: 200% auto;
            border: none;
            color: var(--dark-bg);
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(201, 169, 89, 0.3);
        }
        
        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
            background-position: right center;
            color: var(--dark-bg);
        }
        
        .btn-gold:hover::before {
            left: 100%;
        }
        
        .btn-gold:active {
            transform: translateY(-1px);
        }
        
        .btn-outline-gold {
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
            position: relative;
            overflow: hidden;
        }
        
        .btn-outline-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--primary-gold);
            transition: width 0.3s ease;
            z-index: -1;
        }
        
        .btn-outline-gold:hover {
            color: var(--dark-bg);
            border-color: var(--primary-gold);
            transform: translateY(-2px);
        }
        
        .btn-outline-gold:hover::before {
            width: 100%;
        }
        
        /* Enhanced Card Styles with Glassmorphism */
        .card-premium {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 89, 0.5), transparent);
        }
        
        .card-premium:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 30px rgba(201, 169, 89, 0.1);
            border-color: rgba(201, 169, 89, 0.4);
            background: var(--card-bg-hover);
        }
        
        .card-premium .card-img-top {
            transition: transform 0.5s ease;
        }
        
        .card-premium:hover .card-img-top {
            transform: scale(1.05);
        }
        
        /* Hero Section Enhanced */
        .hero-section {
            background: linear-gradient(rgba(15, 15, 26, 0.6), rgba(15, 15, 26, 0.85)), 
                        url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at center, transparent 0%, var(--darker-bg) 100%);
            pointer-events: none;
        }
        
        /* Form Styles Enhanced */
        .form-control-premium {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(201, 169, 89, 0.2);
            color: var(--text-light);
            padding: 1rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }
        
        .form-control-premium:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 4px rgba(201, 169, 89, 0.15), 0 0 20px rgba(201, 169, 89, 0.1);
            color: var(--text-light);
            outline: none;
        }
        
        .form-control-premium::placeholder {
            color: var(--text-muted);
        }
        
        .form-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }
        
        /* Enhanced Footer */
        footer {
            background: linear-gradient(180deg, var(--darker-bg) 0%, #080810 100%);
            border-top: 1px solid var(--glass-border);
            padding: 4rem 0 2rem;
            position: relative;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
        }
        
        .text-gold {
            color: var(--primary-gold) !important;
        }
        
        /* Alert Styles Enhanced */
        .alert-premium {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-light);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            animation: slideInDown 0.5s ease;
        }
        
        .alert-success {
            border-color: rgba(40, 167, 69, 0.5);
            box-shadow: 0 4px 20px rgba(40, 167, 69, 0.2);
        }
        
        .alert-danger {
            border-color: rgba(220, 53, 69, 0.5);
            box-shadow: 0 4px 20px rgba(220, 53, 69, 0.2);
        }
        
        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(201, 169, 89, 0.4);
            }
            50% {
                box-shadow: 0 0 0 15px rgba(201, 169, 89, 0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        .animate-fade-left {
            animation: fadeInLeft 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        .animate-fade-right {
            animation: fadeInRight 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        .delay-5 { animation-delay: 0.5s; opacity: 0; }
        
        /* Badge Styles Enhanced */
        .badge-gold {
            background: var(--gradient-gold);
            color: var(--dark-bg);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            box-shadow: 0 4px 15px rgba(201, 169, 89, 0.3);
        }
        
        /* Dropdown Enhanced */
        .dropdown-menu {
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            padding: 0.75rem;
            animation: dropdownFade 0.3s ease;
        }
        
        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            color: var(--text-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(201, 169, 89, 1);
            color: var(--primary-gold);
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--darker-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gold-dark);
        }
        
        /* Selection Color */
        ::selection {
            background: var(--primary-gold);
            color: var(--dark-bg);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .hero-section {
                background-attachment: scroll;
                min-height: 70vh;
            }
            
            .navbar-collapse {
                background: var(--card-bg);
                border-radius: 16px;
                padding: 1rem;
                margin-top: 1rem;
                border: 1px solid var(--glass-border);
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                min-height: 60vh;
            }
            
            .display-3 {
                font-size: 2.5rem;
            }
            
            .display-5 {
                font-size: 1.75rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-building"></i> Grand Hotel
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rooms.index') }}">
                            <i class="bi bi-door-open me-1"></i>Kamar
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold ms-2" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>Daftar
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->isAdmin() || Auth::user()->isReceptionist())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider" style="border-color: var(--glass-border);"></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('my-bookings.index') }}">
                                        <i class="bi bi-calendar-check me-2"></i>Reservasi Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color: var(--glass-border);"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 80px; position: relative; z-index: 1;">
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-premium alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-premium alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-gold mb-4">
                        <i class="bi bi-building me-2"></i>Grand Hotel
                    </h4>
                    <p class="text-muted mb-4">Pengalaman menginap mewah dengan pelayanan terbaik dan fasilitas premium untuk kenyamanan Anda.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-gold btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-gold btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-gold btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-muted text-decoration-none hover-gold">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('rooms.index') }}" class="text-muted text-decoration-none hover-gold">Kamar</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Layanan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Room Service 24/7</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Spa & Wellness</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Restaurant & Bar</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-gold">Meeting Rooms</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Kontak</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill text-gold me-3 mt-1"></i>
                            <span>Jl. Hotel No. 123, Jakarta Pusat, Indonesia</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-telephone-fill text-gold me-3"></i>
                            <span>+62 21 1234567</span>
                        </li>
                    <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-gold me-3"></i>
                            <span>info@grandhotel.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: var(--glass-border); margin: 3rem 0 2rem;">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} Grand Hotel. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-muted text-decoration-none me-3 small">Privacy Policy</a>
                    <a href="#" class="text-muted text-decoration-none small">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop" title="Kembali ke atas">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Image Lightbox -->
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="bi bi-x-lg"></i>
        </button>
        <button class="lightbox-nav lightbox-prev" onclick="prevImage()">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="lightbox-nav lightbox-next" onclick="nextImage()">
            <i class="bi bi-chevron-right"></i>
        </button>
        <img src="" alt="" class="lightbox-image" id="lightboxImage">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--glass-border); border-radius: 20px;">
                <div class="modal-body text-center p-5">
                    <div class="confirm-icon mb-4" id="confirmIcon">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <h4 class="mb-3" id="confirmTitle">Konfirmasi</h4>
                    <p class="text-muted mb-4" id="confirmMessage">Apakah Anda yakin?</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-outline-gold px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-gold px-4" id="confirmBtn">Ya, Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Styles for New Features -->
    <style>
        /* Scroll to Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient-gold);
            border: none;
            color: var(--dark-bg);
            font-size: 1.25rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(201, 169, 89, 0.4);
            z-index: 999;
        }
        
        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .scroll-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(201, 169, 89, 0.5);
        }
        
        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
        }
        
        .toast-notification {
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: toastSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .toast-notification.hiding {
            animation: toastSlideOut 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        @keyframes toastSlideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes toastSlideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
        
        .toast-notification .toast-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        
        .toast-notification.success .toast-icon {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .toast-notification.error .toast-icon {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .toast-notification.warning .toast-icon {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .toast-notification.info .toast-icon {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        
        .toast-notification .toast-content {
            flex: 1;
        }
        
        .toast-notification .toast-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .toast-notification .toast-message {
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        
        .toast-notification .toast-close {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            font-size: 1rem;
            transition: color 0.2s;
        }
        
        .toast-notification .toast-close:hover {
            color: var(--text-light);
        }
        
        .toast-notification .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: var(--primary-gold);
            animation: toastProgress 5s linear forwards;
        }
        
        @keyframes toastProgress {
            from { width: 100%; }
            to { width: 0%; }
        }
        
        /* Lightbox */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .lightbox.active {
            opacity: 1;
            visibility: visible;
        }
        
        .lightbox-image {
            max-width: 90%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 8px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .lightbox.active .lightbox-image {
            transform: scale(1);
        }
        
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .lightbox-close:hover {
            background: var(--primary-gold);
            color: var(--dark-bg);
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .lightbox-prev { left: 20px; }
        .lightbox-next { right: 20px; }
        
        .lightbox-nav:hover {
            background: var(--primary-gold);
            color: var(--dark-bg);
        }
        
        .lightbox-caption {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1rem;
            text-align: center;
            padding: 0.5rem 1.5rem;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50px;
        }
        
        /* Confirmation Modal Icon */
        .confirm-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2.5rem;
        }
        
        .confirm-icon.warning {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .confirm-icon.danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .confirm-icon.info {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        
        /* Skeleton Loading */
        .skeleton {
            background: linear-gradient(90deg, var(--card-bg) 25%, var(--card-bg-hover) 50%, var(--card-bg) 75%);
            background-size: 200% 100%;
            animation: skeleton 1.5s infinite;
            border-radius: 8px;
        }
        
        @keyframes skeleton {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .skeleton-title {
            height: 1.5rem;
            width: 60%;
            margin-bottom: 1rem;
        }
        
        .skeleton-image {
            height: 200px;
            width: 100%;
        }
    </style>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            const scrollToTop = document.getElementById('scrollToTop');
            
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Show/hide scroll to top button
            if (window.scrollY > 300) {
                scrollToTop.classList.add('visible');
            } else {
                scrollToTop.classList.remove('visible');
            }
        });
        
        // Scroll to top functionality
        document.getElementById('scrollToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Smooth scroll for anchor links
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
        
        // Toast Notification System
        function showToast(type, title, message, duration = 5000) {
            const container = document.getElementById('toastContainer');
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
        
        // Lightbox functionality
        let currentImageIndex = 0;
        let lightboxImages = [];
        
        function openLightbox(imgSrc, caption = '', images = []) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');
            
            lightboxImages = images.length > 0 ? images : [{ src: imgSrc, caption: caption }];
            currentImageIndex = images.findIndex(img => img.src === imgSrc) || 0;
            
            lightboxImg.src = imgSrc;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
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
            lightboxImg.src = lightboxImages[currentImageIndex].src;
            lightboxCaption.textContent = lightboxImages[currentImageIndex].caption;
        }
        
        // Close lightbox on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        });
        
        // Close lightbox on backdrop click
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });
        
        // Confirmation Modal
        function showConfirm(title, message, type = 'warning', callback) {
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            const iconEl = document.getElementById('confirmIcon');
            const titleEl = document.getElementById('confirmTitle');
            const messageEl = document.getElementById('confirmMessage');
            const confirmBtn = document.getElementById('confirmBtn');
            
            const icons = {
                warning: 'bi-exclamation-triangle',
                danger: 'bi-trash',
                info: 'bi-question-circle'
            };
            
            iconEl.className = `confirm-icon ${type}`;
            iconEl.innerHTML = `<i class="bi ${icons[type]}"></i>`;
            titleEl.textContent = title;
            messageEl.textContent = message;
            
            confirmBtn.onclick = function() {
                modal.hide();
                if (callback) callback();
            };
            
            modal.show();
        }
        
        // Auto-show toast for session messages
        @if(session('success'))
            showToast('success', 'Berhasil!', '{{ session('success') }}');
        @endif
        
        @if(session('error'))
            showToast('error', 'Error!', '{{ session('error') }}');
        @endif
    </script>
    
    <!-- Custom Guest Scripts -->
    <script src="{{ asset('js/guest.js') }}"></script>
    
    @stack('scripts')
</body>
</html>

