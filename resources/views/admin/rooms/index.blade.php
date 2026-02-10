@extends('layouts.admin')

@section('page-title', 'Daftar Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Daftar Kamar</h4>
        <p class="text-muted mb-0 small">Kelola semua kamar hotel Anda</p>
    </div>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kamar
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Lantai</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-door-closed"></i>
                                    </div>
                                    <strong>{{ $room->room_number }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                    {{ $room->roomType->name }}
                                </span>
                            </td>
                            <td>
                                <i class="bi bi-building text-muted me-1"></i>
                                Lantai {{ $room->floor }}
                            </td>
                            <td>{!! $room->status_badge !!}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus kamar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-door-open text-muted d-block mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted mb-2">Belum Ada Kamar</h5>
                                <p class="text-muted small mb-3">Mulai tambahkan kamar untuk hotel Anda</p>
                                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg me-1"></i>Tambah Kamar
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($rooms->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $rooms->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
