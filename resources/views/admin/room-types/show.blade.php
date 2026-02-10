@extends('layouts.admin')

@section('page-title', 'Detail Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.room-types.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
    <div class="btn-group">
        <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @if($roomType->image)
                    <img src="{{ Storage::url($roomType->image) }}" class="rounded w-100 mb-4" style="max-height: 300px; object-fit: cover;">
                @endif
                
                <h3>{{ $roomType->name }}</h3>
                <p class="text-muted">{{ $roomType->description ?: 'Tidak ada deskripsi' }}</p>
                
                <hr>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Harga per Malam</strong>
                        <span class="h5 text-primary">{{ $roomType->formatted_price }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Kapasitas</strong>
                        <span>{{ $roomType->capacity }} tamu</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block">Jumlah Kamar</strong>
                        <span class="badge bg-primary">{{ $roomType->rooms->count() }} kamar</span>
                    </div>
                </div>
                
                @if($roomType->amenities && count($roomType->amenities) > 0)
                    <hr>
                    <h5>Fasilitas</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($roomType->amenities as $amenity)
                            <span class="badge bg-secondary">{{ $amenity }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Daftar Kamar</div>
            <div class="card-body p-0">
                @forelse($roomType->rooms as $room)
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <div>
                            <strong>Kamar {{ $room->room_number }}</strong>
                            <small class="text-muted d-block">Lantai {{ $room->floor }}</small>
                        </div>
                        {!! $room->status_badge !!}
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        Belum ada kamar
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
