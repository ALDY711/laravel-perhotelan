@extends('layouts.admin')

@section('page-title', 'Detail Tamu')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.guests.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-person" style="font-size: 2rem;"></i>
                </div>
                <h4>{{ $guest->name }}</h4>
                <p class="text-muted mb-0">{{ $guest->email }}</p>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="mb-3">
                    <strong class="text-muted d-block">Telepon</strong>
                    <span>{{ $guest->phone }}</span>
                </div>
                @if($guest->address)
                    <div class="mb-3">
                        <strong class="text-muted d-block">Alamat</strong>
                        <span>{{ $guest->address }}</span>
                    </div>
                @endif
                @if($guest->id_card_number)
                    <div>
                        <strong class="text-muted d-block">No. Identitas</strong>
                        <span>{{ $guest->id_card_number }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Riwayat Reservasi</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Kode Booking</th>
                                <th>Kamar</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guest->reservations as $reservation)
                                <tr>
                                    <td class="ps-4">
                                        <a href="{{ route('admin.reservations.show', $reservation) }}">
                                            {{ $reservation->booking_code }}
                                        </a>
                                    </td>
                                    <td>{{ $reservation->room->room_number }} - {{ $reservation->room->roomType->name }}</td>
                                    <td>{{ $reservation->check_in->format('d/m/Y') }} - {{ $reservation->check_out->format('d/m/Y') }}</td>
                                    <td>{{ $reservation->formatted_total_price }}</td>
                                    <td>{!! $reservation->status_badge !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Belum ada riwayat reservasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
