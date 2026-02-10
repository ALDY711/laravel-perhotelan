@extends('layouts.guest')

@section('title', 'Buat Reservasi')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Booking Form -->
            <div class="col-lg-8">
                <div class="card-premium p-4">
                    <h3 class="mb-4">Form Reservasi</h3>
                    
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $availableRooms->first()->id }}">
                        <input type="hidden" name="check_in" value="{{ $checkIn->format('Y-m-d') }}">
                        <input type="hidden" name="check_out" value="{{ $checkOut->format('Y-m-d') }}">
                        
                        <!-- Room Selection -->
                        @if($availableRooms->count() > 1)
                            <div class="mb-4">
                                <label class="form-label">Pilih Nomor Kamar</label>
                                <select name="room_id" class="form-control form-control-premium @error('room_id') is-invalid @enderror">
                                    @foreach($availableRooms as $room)
                                        <option value="{{ $room->id }}">
                                            Kamar {{ $room->room_number }} (Lantai {{ $room->floor }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        
                        <h5 class="mb-3 mt-4">Data Tamu</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-premium @error('name') is-invalid @enderror"
                                       value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control form-control-premium @error('email') is-invalid @enderror"
                                       value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control form-control-premium @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" placeholder="+62" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Tamu <span class="text-danger">*</span></label>
                                <select name="total_guests" class="form-control form-control-premium @error('total_guests') is-invalid @enderror" required>
                                    @for($i = 1; $i <= $roomType->capacity; $i++)
                                        <option value="{{ $i }}">{{ $i }} Tamu</option>
                                    @endfor
                                </select>
                                @error('total_guests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control form-control-premium" rows="2">{{ old('address') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor KTP/Identitas</label>
                                <input type="text" name="id_card_number" class="form-control form-control-premium"
                                       value="{{ old('id_card_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="payment_method" class="form-control form-control-premium @error('payment_method') is-invalid @enderror" required>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                    <option value="debit_card">Kartu Debit</option>
                                    <option value="e_wallet">E-Wallet</option>
                                    <option value="cash">Bayar di Hotel</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Permintaan Khusus</label>
                                <textarea name="special_requests" class="form-control form-control-premium" rows="3"
                                          placeholder="Contoh: Kamar bebas rokok, early check-in, dll.">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>
                        
                        <hr class="my-4" style="border-color: rgba(201, 169, 89, 0.2);">
                        
                        <button type="submit" class="btn btn-gold btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Konfirmasi Reservasi
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Booking Summary -->
            <div class="col-lg-4">
                <div class="card-premium p-4 position-sticky" style="top: 100px;">
                    <h5 class="mb-4">Ringkasan Reservasi</h5>
                    
                    <div class="mb-3">
                        @if($roomType->image)
                            <img src="{{ Storage::url($roomType->image) }}" class="w-100 rounded" alt="{{ $roomType->name }}" style="height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <h5>{{ $roomType->name }}</h5>
                    <p class="text-muted small">{{ Str::limit($roomType->description, 80) }}</p>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Check-in</span>
                            <span>{{ $checkIn->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Check-out</span>
                            <span>{{ $checkOut->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Durasi</span>
                            <span>{{ $nights }} malam</span>
                        </div>
                    </div>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">{{ $roomType->formatted_price }} x {{ $nights }} malam</span>
                        <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    
                    <hr style="border-color: rgba(201, 169, 89, 0.2);">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">Total Pembayaran</span>
                        <span class="text-gold h4 mb-0">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
