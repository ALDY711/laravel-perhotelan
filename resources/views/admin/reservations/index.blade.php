@extends('layouts.admin')

@section('page-title', 'Reservasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Reservasi</h4>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.reservations.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari kode booking atau nama tamu..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                    <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Kode Booking</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td class="ps-4">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="fw-medium text-decoration-none">
                                    {{ $reservation->booking_code }}
                                </a>
                            </td>
                            <td>
                                <strong>{{ $reservation->guest->name }}</strong>
                                <div class="text-muted small">{{ $reservation->guest->email }}</div>
                            </td>
                            <td>{{ $reservation->room->room_number }} - {{ $reservation->room->roomType->name }}</td>
                            <td>{{ $reservation->check_in->format('d/m/Y') }}</td>
                            <td>{{ $reservation->check_out->format('d/m/Y') }}</td>
                            <td>{{ $reservation->formatted_total_price }}</td>
                            <td>{!! $reservation->status_badge !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($reservation->status === 'confirmed')
                                        <form action="{{ route('admin.reservations.checkin', $reservation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Check In">
                                                <i class="bi bi-box-arrow-in-right"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($reservation->status === 'checked_in')
                                        <form action="{{ route('admin.reservations.checkout', $reservation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Check Out">
                                                <i class="bi bi-box-arrow-right"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada reservasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($reservations->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $reservations->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
