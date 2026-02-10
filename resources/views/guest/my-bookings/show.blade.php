@extends('layouts.guest')

@section('title', 'Detail Reservasi')

@push('styles')
<style>
    /* Print Styles */
    @media print {
        body {
            background: white !important;
            color: black !important;
        }
        
        .no-print {
            display: none !important;
        }
        
        .print-only {
            display: block !important;
        }
        
        .card-premium {
            background: white !important;
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }
        
        .text-gold, .text-muted {
            color: black !important;
            -webkit-text-fill-color: black !important;
        }
        
        .invoice-header {
            border-bottom: 2px solid #c9a959 !important;
        }
    }
    
    .print-only {
        display: none;
    }
    
    .invoice-header {
        text-align: center;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid rgba(201, 169, 89, 0.3);
    }
    
    .invoice-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .invoice-row:last-child {
        border-bottom: none;
    }
    
    .invoice-total {
        background: rgba(201, 169, 89, 0.1);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-top: 1rem;
    }
    
    .qr-placeholder {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 8px;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4 no-print">
                    <a href="{{ route('my-bookings.index') }}" class="btn btn-outline-gold btn-sm">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <div class="action-buttons">
                        <button onclick="window.print()" class="btn btn-outline-gold btn-sm">
                            <i class="bi bi-printer me-2"></i>Cetak Invoice
                        </button>
                        {!! $reservation->status_badge !!}
                    </div>
                </div>
                
                <div class="card-premium p-4" id="invoiceContent">
                    <!-- Invoice Header (Print) -->
                    <div class="invoice-header">
                        <div class="print-only mb-3">
                            <h2 style="color: #c9a959; margin: 0;">GRAND HOTEL</h2>
                            <p style="margin: 0; font-size: 0.875rem;">Jl. Hotel No. 123, Jakarta Pusat | +62 21 1234567</p>
                        </div>
                        <p class="mb-1 text-muted small">Kode Booking</p>
                        <h3 class="text-gold mb-0">{{ $reservation->booking_code }}</h3>
                        <p class="text-muted small mt-2 mb-0">
                            <i class="bi bi-calendar3 me-1"></i>
                            Dibuat pada {{ $reservation->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    
                    <h5 class="mb-3"><i class="bi bi-door-open text-gold me-2"></i>Detail Kamar</h5>
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
                            <strong><i class="bi bi-calendar-event text-gold me-1"></i>{{ $reservation->check_in->format('d M Y') }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Check-out</span>
                            <strong><i class="bi bi-calendar-check text-gold me-1"></i>{{ $reservation->check_out->format('d M Y') }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Durasi</span>
                            <strong>{{ $reservation->nights }} malam</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Jumlah Tamu</span>
                            <strong>{{ $reservation->total_guests }} orang</strong>
                        </div>
                    </div>
                    
                    @if($reservation->special_requests)
                        <div class="mb-3">
                            <span class="text-muted small d-block">Permintaan Khusus</span>
                            <strong>{{ $reservation->special_requests }}</strong>
                        </div>
                    @endif
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <h5 class="mb-3"><i class="bi bi-receipt text-gold me-2"></i>Rincian Pembayaran</h5>
                    
                    <div class="invoice-row">
                        <span class="text-muted">Harga per malam</span>
                        <span>{{ $reservation->room->roomType->formatted_price }}</span>
                    </div>
                    <div class="invoice-row">
                        <span class="text-muted">Jumlah malam</span>
                        <span>× {{ $reservation->nights }}</span>
                    </div>
                    
                    <div class="invoice-total d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">Total Pembayaran</span>
                        <span class="text-gold h4 mb-0 fw-bold">{{ $reservation->formatted_total_price }}</span>
                    </div>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <h5 class="mb-3"><i class="bi bi-credit-card text-gold me-2"></i>Status Pembayaran</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Metode Pembayaran</span>
                            <strong>{{ $reservation->payment->payment_method_label }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small d-block">Status</span>
                            {!! $reservation->payment->status_badge !!}
                        </div>
                    </div>
                    
                    <!-- QR Code Placeholder for verification -->
                    <div class="text-center mt-4 print-only">
                        <div class="qr-placeholder">
                            <i class="bi bi-qr-code" style="font-size: 4rem; color: #333;"></i>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Scan untuk verifikasi</p>
                    </div>
                    
                    @if($reservation->status === 'pending')
                        <hr style="border-color: rgba(201, 169, 89, 0.2);" class="no-print">
                        
                        <form action="{{ route('my-bookings.cancel', $reservation->booking_code) }}" method="POST" class="no-print"
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-x-circle me-2"></i>Batalkan Reservasi
                            </button>
                        </form>
                    @endif
                    
                    <!-- Print Footer -->
                    <div class="print-only text-center mt-4 pt-4" style="border-top: 1px dashed #ddd;">
                        <p class="small mb-1">Terima kasih telah memilih Grand Hotel</p>
                        <p class="small text-muted mb-0">www.grandhotel.com | info@grandhotel.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
