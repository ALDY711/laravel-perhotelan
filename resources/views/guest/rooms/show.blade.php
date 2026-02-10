@extends('layouts.guest')

@section('title', $roomType->name)

@push('styles')
<style>
    .room-gallery {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
    }
    
    .room-gallery img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .room-gallery:hover img {
        transform: scale(1.03);
    }
    
    .room-gallery .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background: linear-gradient(to top, rgba(22, 33, 62, 0.8) 0%, transparent 100%);
    }
    
    .room-gallery .gallery-badge {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
    }
    
    .info-card {
        padding: 2rem;
    }
    
    .info-card h4 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .info-card h4 i {
        color: var(--primary-gold);
    }
    
    .amenity-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .amenity-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: rgba(201, 169, 89, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(201, 169, 89, 0.1);
        transition: all 0.3s ease;
    }
    
    .amenity-item:hover {
        background: rgba(201, 169, 89, 0.1);
        border-color: rgba(201, 169, 89, 0.2);
        transform: translateX(5px);
    }
    
    .amenity-item i {
        color: var(--primary-gold);
        font-size: 1.1rem;
    }
    
    .booking-card {
        position: sticky;
        top: 100px;
    }
    
    .booking-card .price-display {
        background: linear-gradient(135deg, rgba(201, 169, 89, 0.15) 0%, rgba(201, 169, 89, 0.05) 100%);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(201, 169, 89, 0.2);
    }
    
    .booking-card .price-amount {
        font-size: 2.25rem;
        font-weight: 800;
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .booking-info {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .booking-info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .booking-info-item:last-child {
        border-bottom: none;
    }
    
    .booking-info-item .label {
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .booking-info-item .label i {
        color: var(--primary-gold);
    }
    
    .total-section {
        background: rgba(201, 169, 89, 0.1);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(201, 169, 89, 0.2);
    }
    
    .breadcrumb-premium {
        background: rgba(22, 33, 62, 0.5);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(201, 169, 89, 0.1);
    }
    
    .breadcrumb-premium a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-premium a:hover {
        color: var(--primary-gold);
    }
    
    .breadcrumb-premium .separator {
        margin: 0 0.75rem;
        color: rgba(255, 255, 255, 0.3);
    }
    
    .breadcrumb-premium .current {
        color: var(--primary-gold);
    }
</style>
@endpush

@section('content')
<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-premium">
            <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Beranda</a>
            <span class="separator"><i class="bi bi-chevron-right"></i></span>
            <a href="{{ route('rooms.index') }}">Kamar</a>
            <span class="separator"><i class="bi bi-chevron-right"></i></span>
            <span class="current">{{ $roomType->name }}</span>
        </nav>
        
        <div class="row g-5">
            <!-- Room Images & Description -->
            <div class="col-lg-7">
                <div class="card-premium room-gallery mb-4">
                    @if($roomType->image)
                        <img src="{{ Storage::url($roomType->image) }}" alt="{{ $roomType->name }}">
                    @else
                        <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 450px;">
                            <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                    <div class="gallery-overlay"></div>
                    <div class="gallery-badge">
                        <span class="badge badge-gold px-3 py-2">
                            <i class="bi bi-star-fill me-1"></i>Premium Room
                        </span>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="card-premium info-card mb-4">
                    <h4><i class="bi bi-info-circle"></i> Deskripsi</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        {{ $roomType->description ?: 'Nikmati kenyamanan dan kemewahan di kamar ini. Dilengkapi dengan fasilitas modern dan pemandangan yang menakjubkan untuk pengalaman menginap yang tak terlupakan.' }}
                    </p>
                </div>
                
                <!-- Amenities -->
                @if($roomType->amenities && count($roomType->amenities) > 0)
                    <div class="card-premium info-card">
                        <h4><i class="bi bi-stars"></i> Fasilitas</h4>
                        <div class="amenity-list">
                            @foreach($roomType->amenities as $amenity)
                                <div class="amenity-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Booking Card -->
            <div class="col-lg-5">
                <div class="card-premium booking-card p-4">
                    <h3 class="mb-2">{{ $roomType->name }}</h3>
                    
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>{{ $availableRooms->count() }} kamar tersedia
                        </span>
                        <span class="badge bg-secondary">
                            <i class="bi bi-people me-1"></i>Maks. {{ $roomType->capacity }} tamu
                        </span>
                    </div>
                    
                    <div class="price-display text-center">
                        <small class="text-muted d-block mb-1">Harga per malam</small>
                        <span class="price-amount">{{ $roomType->formatted_price }}</span>
                    </div>
                    
                    <div class="booking-info">
                        <div class="booking-info-item">
                            <span class="label">
                                <i class="bi bi-calendar-event"></i>Check-in
                            </span>
                            <strong>{{ $checkIn->format('d M Y') }}</strong>
                        </div>
                        <div class="booking-info-item">
                            <span class="label">
                                <i class="bi bi-calendar-check"></i>Check-out
                            </span>
                            <strong>{{ $checkOut->format('d M Y') }}</strong>
                        </div>
                        <div class="booking-info-item">
                            <span class="label">
                                <i class="bi bi-moon-stars"></i>Durasi
                            </span>
                            <strong>{{ $nights }} malam</strong>
                        </div>
                    </div>
                    
                    <div class="total-section d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">Total Pembayaran</span>
                        <span class="text-gold h4 mb-0 fw-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($availableRooms->count() > 0)
                        @auth
                            <a href="{{ route('booking.create', ['roomType' => $roomType->id, 'check_in' => $checkIn->format('Y-m-d'), 'check_out' => $checkOut->format('Y-m-d')]) }}" 
                               class="btn btn-gold btn-lg w-100 py-3">
                                <i class="bi bi-calendar-check me-2"></i>Pesan Sekarang
                            </a>
                            <p class="text-center text-muted small mt-3 mb-0">
                                <i class="bi bi-shield-check me-1"></i>Pembayaran aman & terenkripsi
                            </p>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-gold btn-lg w-100 py-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Memesan
                            </a>
                            <p class="text-muted text-center small mt-3 mb-0">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-gold fw-medium">Daftar di sini</a>
                            </p>
                        @endauth
                    @else
                        <button class="btn btn-secondary btn-lg w-100 py-3" disabled>
                            <i class="bi bi-x-circle me-2"></i>Tidak Tersedia
                        </button>
                        <p class="text-center text-muted small mt-3 mb-0">
                            Kamar tidak tersedia untuk tanggal yang dipilih
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
