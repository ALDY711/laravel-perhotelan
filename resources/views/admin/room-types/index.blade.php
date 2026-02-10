@extends('layouts.admin')

@section('page-title', 'Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Tipe Kamar</h4>
    <a href="{{ route('admin.room-types.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Tipe Kamar
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nama</th>
                        <th>Harga/Malam</th>
                        <th>Kapasitas</th>
                        <th>Jumlah Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $roomType)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($roomType->image)
                                        <img src="{{ Storage::url($roomType->image) }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-image text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $roomType->name }}</strong>
                                        <div class="text-muted small">{{ Str::limit($roomType->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $roomType->formatted_price }}</td>
                            <td>{{ $roomType->capacity }} tamu</td>
                            <td>
                                <span class="badge bg-primary">{{ $roomType->rooms_count }} kamar</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.room-types.show', $roomType) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST" 
                                          onsubmit="return confirm('Hapus tipe kamar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada tipe kamar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($roomTypes->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $roomTypes->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
