@extends('layouts.guest')

@section('title', 'Selamat Datang')

@push('styles')
<!-- Home Page Specific Styles -->
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<!-- Promotional Banner -->
<div class="promo-banner" id="promoBanner">
    <div class="container">
        <div class="promo-content">
            <span class="promo-text">
                <i class="bi bi-gift-fill"></i>
                <strong>PROMO SPESIAL!</strong> Diskon 20% untuk pemesanan hari ini
            </span>
            <div class="promo-countdown">
                <span class="countdown-item" id="countHours">00</span>:
                <span class="countdown-item" id="countMinutes">00</span>:
                <span class="countdown-item" id="countSeconds">00</span>
            </div>
            <a href="{{ route('rooms.index') }}" class="btn btn-sm px-3" style="background: var(--dark-bg); color: var(--primary-gold);">
                Pesan Sekarang <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <button class="promo-close" onclick="closePromoBanner()">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <div class="animate-fade-in">
                    <span class="badge badge-gold mb-4 px-4 py-2">
                        <i class="bi bi-star-fill me-2"></i>Hotel Bintang 5
                    </span>
                    <h1 class="display-3 fw-bold mb-4 hero-title">
                        Pengalaman Menginap 
                        <span class="text-gold d-block">yang Tak Terlupakan</span>
                    </h1>
                    <p class="lead mb-4 text-muted" style="font-size: 1.2rem; line-height: 1.8;">
                        Nikmati kemewahan sejati di Grand Hotel. Pelayanan bintang lima dengan fasilitas premium untuk liburan atau perjalanan bisnis Anda yang sempurna.
                    </p>
                    
                    <a href="{{ route('rooms.index') }}" class="btn btn-gold btn-lg px-5">
                        <i class="bi bi-door-open me-2"></i>Lihat Kamar Kami
                    </a>
                </div>
            </div>
            
            <div class="col-lg-5 d-none d-lg-block">
                <div class="row g-4 stagger-animation">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">{{ $stats['total_rooms'] }}+</div>
                            <small class="text-muted d-block">Kamar Tersedia</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">{{ $stats['room_types'] }}</div>
                            <small class="text-muted d-block">Tipe Kamar</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">24/7</div>
                            <small class="text-muted d-block">Room Service</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">5★</div>
                            <small class="text-muted d-block">Rating Hotel</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" style="background: linear-gradient(180deg, rgba(22, 33, 62, 0.3) 0%, rgba(22, 33, 62, 0.6) 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-gold mb-3">Fasilitas Unggulan</span>
            <h2 class="display-5 fw-bold section-title">Mengapa Memilih <span class="text-gold">Kami?</span></h2>
        </div>
        
        <div class="row g-4 stagger-animation">
            <div class="col-md-6 col-lg-3">
                <div class="card-premium feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <h5 class="mb-3">WiFi Super Cepat</h5>
                    <p class="text-muted small mb-0">Internet berkecepatan tinggi hingga 1Gbps di seluruh area hotel</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-premium feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cup-hot"></i>
                    </div>
                    <h5 class="mb-3">Sarapan Premium</h5>
                    <p class="text-muted small mb-0">Nikmati sarapan prasmanan internasional setiap pagi</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-premium feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-car-front"></i>
                    </div>
                    <h5 class="mb-3">Parkir VIP</h5>
                    <p class="text-muted small mb-0">Area parkir luas dengan keamanan 24 jam dan valet service</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-premium feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-water"></i>
                    </div>
                    <h5 class="mb-3">Infinity Pool</h5>
                    <p class="text-muted small mb-0">Kolam renang infinity dengan pemandangan kota yang memukau</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-gold mb-3">Galeri Kami</span>
            <h2 class="display-5 fw-bold section-title">Lihat <span class="text-gold">Suasana</span> Hotel</h2>
        </div>
        
        <div class="row g-3">
            <div class="col-md-8">
                <div class="gallery-item" style="height: 350px; background: linear-gradient(135deg, var(--card-bg) 0%, var(--card-bg-hover) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border);">
                    <div class="text-center">
                        <i class="bi bi-images text-gold" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3 mb-0">Lobby & Reception</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="gallery-item" style="height: 165px; background: linear-gradient(135deg, var(--card-bg) 0%, var(--card-bg-hover) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border);">
                            <div class="text-center">
                                <i class="bi bi-water text-gold" style="font-size: 2rem;"></i>
                                <p class="text-muted small mt-2 mb-0">Pool</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item" style="height: 165px; background: linear-gradient(135deg, var(--card-bg) 0%, var(--card-bg-hover) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border);">
                            <div class="text-center">
                                <i class="bi bi-cup-straw text-gold" style="font-size: 2rem;"></i>
                                <p class="text-muted small mt-2 mb-0">Restaurant</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background: linear-gradient(180deg, rgba(22, 33, 62, 0.3) 0%, rgba(22, 33, 62, 0.6) 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-gold mb-3">Testimoni</span>
            <h2 class="display-5 fw-bold section-title">Apa Kata <span class="text-gold">Tamu Kami?</span></h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card h-100">
                    <div class="stars mb-3">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted mb-4">"Pelayanan luar biasa! Kamar sangat bersih dan nyaman. Staff ramah dan membantu. Pasti akan kembali lagi."</p>
                    <div class="author">
                        <div class="author-avatar">JD</div>
                        <div>
                            <strong class="d-block">John Doe</strong>
                            <small class="text-muted">Business Traveler</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card h-100">
                    <div class="stars mb-3">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted mb-4">"Lokasi strategis, fasilitas lengkap, dan harga sangat worth it. Sarapan prasmanannya enak banget!"</p>
                    <div class="author">
                        <div class="author-avatar">AS</div>
                        <div>
                            <strong class="d-block">Andi Susanto</strong>
                            <small class="text-muted">Family Vacation</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card h-100">
                    <div class="stars mb-3">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <p class="text-muted mb-4">"Infinity pool-nya amazing! Pemandangan sunset dari rooftop bar tidak ada duanya. Highly recommended!"</p>
                    <div class="author">
                        <div class="author-avatar">SW</div>
                        <div>
                            <strong class="d-block">Sarah Wijaya</strong>
                            <small class="text-muted">Honeymoon Trip</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="cta-section">
            <h2 class="display-6 fw-bold mb-3 position-relative">Siap untuk Pengalaman Luar Biasa?</h2>
            <p class="text-muted mb-4 position-relative" style="max-width: 500px; margin: 0 auto;">
                Jelajahi pilihan kamar kami dan temukan akomodasi yang sempurna untuk Anda.
            </p>
            <a href="{{ route('rooms.index') }}" class="btn btn-gold btn-lg px-5 position-relative">
                <i class="bi bi-door-open me-2"></i>Lihat Semua Kamar
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Home Page Specific Scripts -->
<script src="{{ asset('js/home.js') }}"></script>
@endpush
