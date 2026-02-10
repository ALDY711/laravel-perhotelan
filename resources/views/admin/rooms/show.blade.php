@extends('layouts.admin')

@section('page-title', 'Detail Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-warning">
        <i class="bi bi-pencil me-1"></i>Edit
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="display-1 mb-3">🚪</div>
                <h3>Kamar {{ $room->room_number }}</h3>
                {!! $room->status_badge !!}
                
                <hr>
                
                <div class="text-start">
                    <div class="mb-2">
                        <strong class="text-muted">Tipe Kamar:</strong>
                        <span class="d-block">{{ $room->roomType->name }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-muted">Harga:</strong>
                        <span class="d-block text-primary">{{ $room->roomType->formatted_price }}/malam</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-muted">Lantai:</strong>
                        <span class="d-block">{{ $room->floor }}</span>
                    </div>
                    <div>
                        <strong class="text-muted">Kapasitas:</strong>
                        <span class="d-block">{{ $room->roomType->capacity }} tamu</span>
                    </div>
                </div>
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
                                <th>Tamu</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($room->reservations as $reservation)
                                <tr>
                                    <td class="ps-4">
                                        <a href="{{ route('admin.reservations.show', $reservation) }}">
                                            {{ $reservation->booking_code }}
                                        </a>
                                    </td>
                                    <td>{{ $reservation->guest->name }}</td>
                                    <td>{{ $reservation->check_in->format('d/m/Y') }}</td>
                                    <td>{{ $reservation->check_out->format('d/m/Y') }}</td>
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
