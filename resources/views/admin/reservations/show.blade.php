@extends('layouts.admin')

@section('page-title', 'Detail Reservasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
    <div class="d-flex gap-2">
        @if($reservation->status === 'confirmed')
            <form action="{{ route('admin.reservations.checkin', $reservation) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Check In
                </button>
            </form>
        @endif
        @if($reservation->status === 'checked_in')
            <form action="{{ route('admin.reservations.checkout', $reservation) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>Check Out
                </button>
            </form>
        @endif
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Informasi Reservasi</span>
                {!! $reservation->status_badge !!}
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Kode Booking</strong>
                        <span class="h4 text-primary">{{ $reservation->booking_code }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Tanggal Reservasi</strong>
                        <span>{{ $reservation->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="mb-3">Detail Kamar</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Tipe Kamar</strong>
                        <span>{{ $reservation->room->roomType->name }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Nomor Kamar</strong>
                        <span>{{ $reservation->room->room_number }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Lantai</strong>
                        <span>{{ $reservation->room->floor }}</span>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="mb-3">Detail Tanggal</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Check-in</strong>
                        <span>{{ $reservation->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Check-out</strong>
                        <span>{{ $reservation->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Durasi</strong>
                        <span>{{ $reservation->nights }} malam</span>
                    </div>
                </div>
                
                @if($reservation->special_requests)
                    <hr>
                    <h6 class="mb-2">Permintaan Khusus</h6>
                    <p class="mb-0">{{ $reservation->special_requests }}</p>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">Data Tamu</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Nama</strong>
                        <span>{{ $reservation->guest->name }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Email</strong>
                        <span>{{ $reservation->guest->email }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Telepon</strong>
                        <span>{{ $reservation->guest->phone }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted d-block">Jumlah Tamu</strong>
                        <span>{{ $reservation->total_guests }} orang</span>
                    </div>
                    @if($reservation->guest->address)
                        <div class="col-12">
                            <strong class="text-muted d-block">Alamat</strong>
                            <span>{{ $reservation->guest->address }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Pembayaran</div>
            <div class="card-body">
                <div class="mb-3">
                    <strong class="text-muted d-block">Status</strong>
                    {!! $reservation->payment->status_badge !!}
                </div>
                <div class="mb-3">
                    <strong class="text-muted d-block">Metode Pembayaran</strong>
                    <span>{{ $reservation->payment->payment_method_label }}</span>
                </div>
                @if($reservation->payment->payment_date)
                    <div class="mb-3">
                        <strong class="text-muted d-block">Tanggal Pembayaran</strong>
                        <span>{{ $reservation->payment->payment_date->format('d M Y, H:i') }}</span>
                    </div>
                @endif
                <hr>
                <div class="mb-3">
                    <strong class="text-muted d-block">{{ $reservation->room->roomType->formatted_price }} x {{ $reservation->nights }} malam</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="h5 mb-0">Total</span>
                    <span class="h4 text-primary mb-0">{{ $reservation->formatted_total_price }}</span>
                </div>
                
                @if($reservation->payment->payment_status === 'pending')
                    <hr>
                    <form action="{{ route('admin.payments.update', $reservation->payment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="payment_status" value="paid">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-lg me-1"></i>Konfirmasi Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
