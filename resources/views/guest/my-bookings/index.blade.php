@extends('layouts.guest')

@section('title', 'Reservasi Saya')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Reservasi <span class="text-gold">Saya</span></h2>
        
        @if($reservations->isEmpty())
            <div class="card-premium text-center py-5">
                <i class="bi bi-calendar-x display-1 text-muted"></i>
                <h4 class="mt-3">Belum Ada Reservasi</h4>
                <p class="text-muted">Anda belum memiliki reservasi. Pesan kamar sekarang!</p>
                <a href="{{ route('rooms.index') }}" class="btn btn-gold mt-3">
                    <i class="bi bi-search me-2"></i>Cari Kamar
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach($reservations as $reservation)
                    <div class="col-12">
                        <div class="card-premium p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 mb-3 mb-md-0">
                                    @if($reservation->room->roomType->image)
                                        <img src="{{ Storage::url($reservation->room->roomType->image) }}" class="rounded w-100" alt="" style="height: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="text-gold fw-bold">{{ $reservation->booking_code }}</span>
                                        {!! $reservation->status_badge !!}
                                    </div>
                                    <h5 class="mb-1">{{ $reservation->room->roomType->name }}</h5>
                                    <p class="text-muted mb-0 small">
                                        <i class="bi bi-door-open me-1"></i>Kamar {{ $reservation->room->room_number }}
                                        <span class="mx-2">|</span>
                                        <i class="bi bi-calendar me-1"></i>{{ $reservation->check_in->format('d M') }} - {{ $reservation->check_out->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="col-md-2 text-md-center mb-3 mb-md-0">
                                    <span class="text-muted small d-block">Total</span>
                                    <span class="text-gold fw-bold">{{ $reservation->formatted_total_price }}</span>
                                </div>
                                <div class="col-md-2 text-md-end">
                                    <a href="{{ route('my-bookings.show', $reservation->booking_code) }}" class="btn btn-outline-gold btn-sm">
                                        Detail <i class="bi bi-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($reservations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $reservations->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
