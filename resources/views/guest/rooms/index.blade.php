@extends('layouts.guest')

@section('title', 'Daftar Kamar')

@push('styles')
<style>
    .page-header {
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    
    .filter-card {
        position: sticky;
        top: 100px;
    }
    
    .price-range {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    
    .room-card {
        position: relative;
    }
    
    .room-card .room-image {
        position: relative;
        overflow: hidden;
    }
    
    .room-card .room-image img {
        transition: transform 0.5s ease;
    }
    
    .room-card:hover .room-image img {
        transform: scale(1.08);
    }
    
    .room-card .room-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(22, 33, 62, 0.95) 0%, transparent 100%);
        pointer-events: none;
    }
    
    .room-card .room-price-tag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--gradient-gold);
        color: var(--dark-bg);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 4px 15px rgba(201, 169, 89, 0.4);
        z-index: 2;
    }
    
    .room-card .room-availability {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 2;
    }
    
    .amenity-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.35rem 0.75rem;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50px;
        font-size: 0.75rem;
        color: var(--text-muted);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .amenity-tag i {
        color: var(--primary-gold);
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
    }
    
    .no-results i {
        font-size: 5rem;
        color: rgba(201, 169, 89, 0.3);
        margin-bottom: 1.5rem;
    }
    
    .filter-section-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--primary-gold);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    
    .filter-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201, 169, 89, 0.3), transparent);
        margin: 1.5rem 0;
    }
</style>
@endpush

@section('content')
<section class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge badge-gold mb-3">
                        <i class="bi bi-door-open me-1"></i>Pilih Kamar
                    </span>
                    <h1 class="display-5 fw-bold mb-2">Temukan Kamar <span class="text-gold">Sempurna</span></h1>
                    <p class="text-muted mb-0">Pilih kamar sesuai kebutuhan Anda dengan berbagai fasilitas premium</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 mb-4">
                <div class="card-premium filter-card p-4">
                    <h5 class="mb-4 d-flex align-items-center">
                        <i class="bi bi-funnel text-gold me-2"></i>Filter
                    </h5>
                    
                    <form action="{{ route('rooms.index') }}" method="GET">
                        <div class="filter-section-title">Tanggal</div>
                        
                        <div class="mb-3">
                            <label class="form-label small text-muted">
                                <i class="bi bi-calendar-event me-1"></i>Check-in
                            </label>
                            <input type="date" name="check_in" class="form-control form-control-premium"
                                   value="{{ request('check_in', $checkIn->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small text-muted">
                                <i class="bi bi-calendar-check me-1"></i>Check-out
                            </label>
                            <input type="date" name="check_out" class="form-control form-control-premium"
                                   value="{{ request('check_out', $checkOut->format('Y-m-d')) }}">
                        </div>
                        
                        <div class="filter-divider"></div>
                        <div class="filter-section-title">Kapasitas</div>
                        
                        <div class="mb-3">
                            <label class="form-label small text-muted">
                                <i class="bi bi-people me-1"></i>Jumlah Tamu
                            </label>
                            <select name="capacity" class="form-control form-control-premium">
                                <option value="">Semua</option>
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ request('capacity') == $i ? 'selected' : '' }}>
                                        {{ $i }} Tamu
                                    </option>
                                @endfor
                            </select>
                        </div>
                        
                        <div class="filter-divider"></div>
                        <div class="filter-section-title">Rentang Harga</div>
                        
                        <div class="mb-3">
                            <label class="form-label small text-muted">Harga Minimum</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255,255,255,0.05); border-color: rgba(201, 169, 89, 0.2); color: var(--primary-gold);">Rp</span>
                                <input type="number" name="min_price" class="form-control form-control-premium"
                                       placeholder="0" value="{{ request('min_price') }}" style="border-left: none;">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label small text-muted">Harga Maksimum</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255,255,255,0.05); border-color: rgba(201, 169, 89, 0.2); color: var(--primary-gold);">Rp</span>
                                <input type="number" name="max_price" class="form-control form-control-premium"
                                       placeholder="Tidak terbatas" value="{{ request('max_price') }}" style="border-left: none;">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-gold w-100 mb-2">
                            <i class="bi bi-search me-2"></i>Terapkan Filter
                        </button>
                        
                        @if(request()->hasAny(['capacity', 'min_price', 'max_price']))
                            <a href="{{ route('rooms.index', ['check_in' => $checkIn->format('Y-m-d'), 'check_out' => $checkOut->format('Y-m-d')]) }}" 
                               class="btn btn-outline-gold w-100">
                                <i class="bi bi-x-circle me-2"></i>Reset Filter
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Room List -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($roomTypes as $roomType)
                        <div class="col-md-6">
                            <div class="card-premium room-card h-100">
                                <div class="room-image">
                                    @if($roomType->image)
                                        <img src="{{ Storage::url($roomType->image) }}" class="card-img-top" alt="{{ $roomType->name }}" style="height: 220px; object-fit: cover;">
                                    @else
                                        <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 220px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="room-overlay"></div>
                                    <div class="room-price-tag">
                                        {{ $roomType->formatted_price }}/malam
                                    </div>
                                    <span class="room-availability badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>{{ $roomType->rooms_count }} tersedia
                                    </span>
                                </div>
                                
                                <div class="card-body p-4">
                                    <h4 class="mb-2">{{ $roomType->name }}</h4>
                                    <p class="text-muted small mb-3">{{ Str::limit($roomType->description, 100) }}</p>
                                    
                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        <span class="amenity-tag">
                                            <i class="bi bi-people"></i>{{ $roomType->capacity }} tamu
                                        </span>
                                        @if($roomType->amenities)
                                            @foreach(array_slice($roomType->amenities, 0, 3) as $amenity)
                                                <span class="amenity-tag">{{ $amenity }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                    
                                    <a href="{{ route('rooms.show', ['id' => $roomType->id, 'check_in' => $checkIn->format('Y-m-d'), 'check_out' => $checkOut->format('Y-m-d')]) }}" 
                                       class="btn btn-gold w-100">
                                        Lihat Detail <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card-premium no-results">
                                <i class="bi bi-search d-block"></i>
                                <h4 class="mb-2">Tidak Ada Kamar Tersedia</h4>
                                <p class="text-muted mb-4">Coba ubah filter pencarian atau tanggal reservasi Anda</p>
                                <a href="{{ route('rooms.index') }}" class="btn btn-outline-gold">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Pencarian
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($roomTypes->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $roomTypes->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
