@extends('layouts.admin')

@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* Enhanced Dashboard Styling */
    .dashboard-welcome {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(168, 85, 247, 0.1) 100%);
        border: 1px solid rgba(99, 102, 241, 0.2);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-welcome::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .dashboard-welcome h2 {
        margin: 0 0 0.5rem;
        font-weight: 700;
    }
    
    .stat-card-premium {
        border-radius: 20px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }
    
    .stat-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .stat-card-premium .stat-icon-lg {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1rem;
    }
    
    .stat-card-premium .stat-value-lg {
        font-size: 2.25rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
        line-height: 1;
    }
    
    .stat-card-premium .stat-label-lg {
        font-size: 0.875rem;
        opacity: 0.8;
    }
    
    .stat-card-premium .stat-trend {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 50px;
        margin-top: 0.5rem;
    }
    
    .stat-card-premium .stat-trend.up {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
    }
    
    .stat-card-premium .stat-trend.down {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }
    
    .stat-card-purple {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
    }
    
    .stat-card-green {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
    }
    
    .stat-card-orange {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: white;
    }
    
    .stat-card-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        color: white;
    }
    
    .stat-card-premium .stat-icon-lg {
        background: rgba(255, 255, 255, 0.2);
    }
    
    /* Quick Actions */
    .quick-action {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
        display: block;
    }
    
    .quick-action:hover {
        transform: translateY(-5px);
        border-color: rgba(99, 102, 241, 0.5);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
        color: white;
    }
    
    .quick-action .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 1.5rem;
    }
    
    .quick-action .action-title {
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    /* Activity Timeline */
    .activity-timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #6366f1, #10b981, #f59e0b);
    }
    
    .activity-item {
        position: relative;
        padding: 1rem 0;
        padding-left: 1rem;
    }
    
    .activity-item::before {
        content: '';
        position: absolute;
        left: -1.5rem;
        top: 1.25rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #6366f1;
        border: 3px solid #1e293b;
    }
    
    .activity-item:nth-child(2)::before { background: #10b981; }
    .activity-item:nth-child(3)::before { background: #f59e0b; }
    .activity-item:nth-child(4)::before { background: #3b82f6; }
    
    /* Occupancy Chart */
    .occupancy-bar {
        height: 12px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.1);
        overflow: hidden;
        margin-bottom: 0.5rem;
    }
    
    .occupancy-bar .fill {
        height: 100%;
        border-radius: 6px;
        background: linear-gradient(90deg, #10b981, #34d399);
        transition: width 1s ease-out;
    }
    
    /* Mini Stats Row */
    .mini-stat {
        text-align: center;
        padding: 1rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .mini-stat .mini-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
    }
    
    .mini-stat .mini-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
    }
</style>
@endpush

@section('content')
<!-- Welcome Banner -->
<div class="dashboard-welcome">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h2>Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-muted mb-0">Berikut ringkasan aktivitas hotel Anda hari ini</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <span class="badge bg-primary bg-opacity-20 text-primary px-3 py-2">
                <i class="bi bi-calendar3 me-1"></i>{{ now()->format('l, d F Y') }}
            </span>
        </div>
    </div>
</div>

<!-- Main Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-premium stat-card-purple">
            <div class="stat-icon-lg">
                <i class="bi bi-door-open"></i>
            </div>
            <div class="stat-value-lg">{{ $stats['total_rooms'] }}</div>
            <div class="stat-label-lg">Total Kamar</div>
            <span class="stat-trend up">
                <i class="bi bi-graph-up"></i> Aktif
            </span>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-premium stat-card-green">
            <div class="stat-icon-lg">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-value-lg">{{ $stats['available_rooms'] }}</div>
            <div class="stat-label-lg">Kamar Tersedia</div>
            @php
                $occupancyRate = $stats['total_rooms'] > 0 ? round((($stats['total_rooms'] - $stats['available_rooms']) / $stats['total_rooms']) * 100) : 0;
            @endphp
            <span class="stat-trend {{ $occupancyRate > 70 ? 'up' : 'down' }}">
                <i class="bi bi-{{ $occupancyRate > 70 ? 'graph-up' : 'graph-down' }}"></i> {{ $occupancyRate }}% Okupansi
            </span>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-premium stat-card-orange">
            <div class="stat-icon-lg">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-value-lg">{{ $stats['pending_reservations'] }}</div>
            <div class="stat-label-lg">Menunggu Konfirmasi</div>
            <span class="stat-trend {{ $stats['pending_reservations'] > 0 ? 'down' : 'up' }}">
                <i class="bi bi-exclamation-circle"></i> Perlu Tindakan
            </span>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-premium stat-card-blue">
            <div class="stat-icon-lg">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-value-lg">{{ number_format($stats['monthly_revenue'] / 1000000, 1) }}M</div>
            <div class="stat-label-lg">Pendapatan Bulan Ini</div>
            <span class="stat-trend up">
                <i class="bi bi-graph-up-arrow"></i> +12% dari bulan lalu
            </span>
        </div>
    </div>
</div>

<!-- Quick Actions & Mini Stats -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-lightning-charge text-warning"></i>
                    <span>Aksi Cepat</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.reservations.index', ['status' => 'pending']) }}" class="quick-action">
                            <div class="action-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                                <i class="bi bi-clock text-dark"></i>
                            </div>
                            <div class="action-title">Reservasi Pending</div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.rooms.create') }}" class="quick-action">
                            <div class="action-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                <i class="bi bi-plus-lg text-white"></i>
                            </div>
                            <div class="action-title">Tambah Kamar</div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.guests.index') }}" class="quick-action">
                            <div class="action-icon" style="background: linear-gradient(135deg, #10b981, #34d399);">
                                <i class="bi bi-people text-white"></i>
                            </div>
                            <div class="action-title">Lihat Tamu</div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.payments.index') }}" class="quick-action">
                            <div class="action-icon" style="background: linear-gradient(135deg, #3b82f6, #60a5fa);">
                                <i class="bi bi-credit-card text-white"></i>
                            </div>
                            <div class="action-title">Pembayaran</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pie-chart text-info"></i>
                    <span>Statistik Hari Ini</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="mini-stat">
                            <div class="mini-value text-success">{{ $stats['today_checkins'] }}</div>
                            <div class="mini-label"><i class="bi bi-box-arrow-in-right me-1"></i>Check-in</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mini-stat">
                            <div class="mini-value text-danger">{{ $stats['today_checkouts'] }}</div>
                            <div class="mini-label"><i class="bi bi-box-arrow-right me-1"></i>Check-out</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mini-stat">
                            <div class="mini-value text-primary">{{ $stats['total_guests'] }}</div>
                            <div class="mini-label"><i class="bi bi-people me-1"></i>Total Tamu</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mini-stat">
                            <div class="mini-value text-warning">{{ $stats['total_reservations'] }}</div>
                            <div class="mini-label"><i class="bi bi-calendar-check me-1"></i>Reservasi</div>
                        </div>
                    </div>
                </div>
                
                <!-- Occupancy Bar -->
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">Tingkat Okupansi</small>
                        <small class="text-success fw-bold">{{ $occupancyRate }}%</small>
                    </div>
                    <div class="occupancy-bar">
                        <div class="fill" style="width: {{ $occupancyRate }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Reservations -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar3 text-primary"></i>
                    <span>Reservasi Terbaru</span>
                </div>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-arrow-right me-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Kode Booking</th>
                                <th>Tamu</th>
                                <th>Kamar</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_reservations as $reservation)
                                <tr>
                                    <td class="ps-4">
                                        <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-primary fw-semibold text-decoration-none">
                                            <i class="bi bi-ticket-detailed me-1"></i>{{ $reservation->booking_code }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-gradient text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.8rem; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                                {{ strtoupper(substr($reservation->guest->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block" style="font-size: 0.875rem;">{{ $reservation->guest->name }}</strong>
                                                <small class="text-muted">{{ $reservation->guest->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                            {{ $reservation->room->room_number }}
                                        </span>
                                        <small class="text-muted d-block">{{ $reservation->room->roomType->name }}</small>
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar2 text-muted me-1"></i>
                                        {{ $reservation->check_in->format('d/m/Y') }}
                                    </td>
                                    <td>{!! $reservation->status_badge !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="bi bi-inbox text-muted d-block mb-2" style="font-size: 2.5rem;"></i>
                                        <span class="text-muted">Belum ada reservasi</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Check-ins -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-right-circle text-success"></i>
                    <span>Check-in Akan Datang</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="activity-timeline p-3">
                    @forelse($upcoming_checkins as $index => $reservation)
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong class="d-block">{{ $reservation->guest->name }}</strong>
                                    <small class="text-muted">
                                        <i class="bi bi-door-open me-1"></i>Kamar {{ $reservation->room->room_number }}
                                    </small>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    {{ $reservation->check_in->format('d M') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x text-muted d-block mb-3" style="font-size: 3rem;"></i>
                            <p class="text-muted mb-0">Tidak ada check-in yang akan datang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Animated Counter for Dashboard Stats
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            element.textContent = Math.floor(easeOutQuart * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    // Initialize animated counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        const statsValues = document.querySelectorAll('.stat-value-lg, .mini-value');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const text = element.textContent;
                    
                    // Extract numeric value
                    const matches = text.match(/[\d.]+/);
                    if (matches) {
                        const numericValue = parseFloat(matches[0]);
                        if (!isNaN(numericValue) && numericValue > 0) {
                            const isDecimal = text.includes('.');
                            element.textContent = text.replace(/[\d.]+/, '0');
                            
                            let current = 0;
                            const increment = numericValue / 50;
                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= numericValue) {
                                    current = numericValue;
                                    clearInterval(timer);
                                }
                                element.textContent = text.replace(/[\d.]+/, isDecimal ? current.toFixed(1) : Math.floor(current));
                            }, 30);
                        }
                    }
                    
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.1 });
        
        statsValues.forEach(stat => observer.observe(stat));
        
        // Animate occupancy bar
        setTimeout(() => {
            const occupancyFill = document.querySelector('.occupancy-bar .fill');
            if (occupancyFill) {
                occupancyFill.style.width = occupancyFill.style.width;
            }
        }, 500);
    });
</script>
@endpush
@endsection
