@extends('layouts.admin')

@section('page-title', 'Edit Tipe Kamar')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Form Edit Tipe Kamar</div>
            <div class="card-body">
                <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Tipe Kamar <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $roomType->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="3">{{ old('description', $roomType->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga per Malam <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price_per_night" class="form-control @error('price_per_night') is-invalid @enderror"
                                       value="{{ old('price_per_night', $roomType->price_per_night) }}" required>
                            </div>
                            @error('price_per_night')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kapasitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                                       value="{{ old('capacity', $roomType->capacity) }}" min="1" required>
                                <span class="input-group-text">tamu</span>
                            </div>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fasilitas</label>
                        <div class="row">
                            @php $currentAmenities = old('amenities', $roomType->amenities ?? []); @endphp
                            @foreach(['WiFi', 'AC', 'TV', 'Kulkas', 'Safe Box', 'Bathtub', 'Balkon', 'Pemandangan Kota', 'Sarapan', 'Kolam Renang'] as $amenity)
                                <div class="col-md-4 col-6 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}" class="form-check-input" id="amenity_{{ $loop->index }}"
                                               {{ in_array($amenity, $currentAmenities) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="amenity_{{ $loop->index }}">{{ $amenity }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Gambar</label>
                        @if($roomType->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($roomType->image) }}" class="rounded" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Update
                        </button>
                        <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
