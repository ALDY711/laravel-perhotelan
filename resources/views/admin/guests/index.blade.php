@extends('layouts.admin')

@section('page-title', 'Daftar Tamu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Tamu</h4>
</div>

<!-- Search -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.guests.index') }}" method="GET" class="row g-3">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau telepon..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i>Cari
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
                        <th class="ps-4">Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Total Reservasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $guest)
                        <tr>
                            <td class="ps-4">
                                <strong>{{ $guest->name }}</strong>
                            </td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->phone }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $guest->reservations_count ?? $guest->reservations->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.guests.show', $guest) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data tamu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($guests->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $guests->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
