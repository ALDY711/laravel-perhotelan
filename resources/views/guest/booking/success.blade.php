@extends('layouts.guest')

@section('title', 'Reservasi Berhasil')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-premium p-5 text-center">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg text-white" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    
                    <h2 class="mb-3">Reservasi Berhasil!</h2>
                    <p class="text-muted mb-4">Terima kasih telah melakukan reservasi di Grand Hotel</p>
                    
                    <div class="bg-dark rounded p-3 mb-4">
                        <p class="mb-1 text-muted small">Kode Booking</p>
                        <h3 class="text-gold mb-0">{{ $reservation->booking_code }}</h3>
                    </div>
                </div>
                
                <div class="card-premium p-4 mt-4">
                    <h5 class="mb-4">Detail Reservasi</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Tipe Kamar</span>
                            <strong>{{ $reservation->room->roomType->name }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Nomor Kamar</span>
                            <strong>{{ $reservation->room->room_number }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Check-in</span>
                            <strong>{{ $reservation->check_in->format('d M Y') }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Check-out</span>
                            <strong>{{ $reservation->check_out->format('d M Y') }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Jumlah Tamu</span>
                            <strong>{{ $reservation->total_guests }} orang</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Durasi</span>
                            <strong>{{ $reservation->nights }} malam</strong>
                        </div>
                    </div>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <h5 class="mb-4">Data Tamu</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Nama</span>
                            <strong>{{ $reservation->guest->name }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Email</span>
                            <strong>{{ $reservation->guest->email }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Telepon</span>
                            <strong>{{ $reservation->guest->phone }}</strong>
                        </div>
                    </div>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <h5 class="mb-4">Pembayaran</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Metode Pembayaran</span>
                            <strong>{{ $reservation->payment->payment_method_label }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Status Pembayaran</span>
                            {!! $reservation->payment->status_badge !!}
                        </div>
                        <div class="col-12">
                            <span class="text-muted small d-block">Total Pembayaran</span>
                            <span class="text-gold h3">{{ $reservation->formatted_total_price }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3 mt-4 justify-content-center">
                    <a href="{{ route('my-bookings.index') }}" class="btn btn-gold">
                        <i class="bi bi-list-ul me-2"></i>Lihat Reservasi Saya
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-gold">
                        <i class="bi bi-house me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
