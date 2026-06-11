@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* 1. GLOBAL LAYOUT & BACKGROUND KREM (Sinkron Landing Page) */
    body, .main-content, .content-wrapper, .bg-light {
        background-color: #FAF8ED !important; 
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
    }

    /* 2. OVERRIDE SIDEBAR PREMIUM & BERKARAKTER */
    .sidebar, [class*="sidebar-dark-"], .bg-dark {
        background: linear-gradient(180deg, #800000 0%, #3A0000 100%) !important;
        border-right: none !important;
        box-shadow: 4px 0 25px rgba(128, 0, 0, 0.15) !important;
    }
    .sidebar .brand-link {
        border-bottom: 1px solid rgba(250, 248, 237, 0.1) !important;
        background: rgba(0, 0, 0, 0.15) !important;
    }
    .sidebar .nav-link {
        border-radius: 12px !important;
        margin: 6px 14px !important;
        padding: 11px 16px !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        color: rgba(250, 248, 237, 0.75) !important;
        font-weight: 500 !important;
    }
    .sidebar .nav-link:hover {
        background-color: rgba(250, 248, 237, 0.1) !important;
        color: #FAF8ED !important;
        transform: translateX(5px);
    }
    .sidebar .nav-link.active {
        background: #FAF8ED !important;
        color: #800000 !important;
        font-weight: 700 !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
    }
    .sidebar .nav-link.active i {
        color: #800000 !important;
    }

    /* 3. JUDUL UTAMA & ELEMEN TEKS */
    .text-maroon-main {
        color: #800000 !important;
        letter-spacing: -0.5px;
    }

    /* 4. KARTU STATISTIK INTERAKTIF (3D GLASSMORPHISM EFFECT) */
    .card-custom-stats {
        background: #ffffff !important;
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(128, 0, 0, 0.03) !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }
    .card-custom-stats::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: currentColor;
        opacity: 0.8;
    }
    .card-custom-stats:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(128, 0, 0, 0.08) !important;
    }
    .icon-shape {
        width: 55px;
        height: 55px;
        background: #FAF8ED;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease;
    }
    .card-custom-stats:hover .icon-shape {
        transform: rotate(-10deg) scale(1.1);
    }

    /* 5. SEKSI TABEL MODERN DENGAN GRIDLINE & STRUKTUR WARNA KOLOM */
    .table-container-card {
        background: #ffffff !important;
        border: 2px solid rgba(128, 0, 0, 0.15) !important;
        border-radius: 24px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04) !important;
        position: relative !important;
        z-index: 1;
        overflow: hidden !important;
    }
    
    .table-watermark-bg {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 500px !important; 
        height: 500px !important;
        object-fit: cover !important; 
        border-radius: 50% !important; 
        opacity: 0.18 !important; /* Sedikit dinaikkan agar logo terlihat makin mantap */
        pointer-events: none !important; 
        z-index: 0 !important;
        user-select: none;
    }

    .table-responsive {
        position: relative;
        z-index: 2;
        background: transparent !important;
    }

    .table-strengthened {
        border-collapse: collapse !important;
        width: 100% !important;
    }

    .table-strengthened th, 
    .table-strengthened td {
        border: 1px solid rgba(128, 0, 0, 0.15) !important; 
        padding: 16px 16px !important;
    }

    /* Baris Judul/Header (Th) Tabel Berwarna Maroon Solid & Teks Putih */
    .table-strengthened thead th {
        background-color: #800000 !important;
        color: #ffffff !important;
        padding: 18px 16px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.8px;
        border: 1px solid #800000 !important; 
    }

    .table-strengthened thead th i {
        color: #ffffff !important;
    }

    /* PERBAIKAN UTAMA: Mengubah seluruh isi kolom menjadi Putih Transparan (rgba 255,255,255,0.6) */
    /* Ini membuat warna tabel serasi secara merata dan logo di belakangnya tidak akan terhalang */
    .table-strengthened tbody td { 
        background-color: rgba(255, 255, 255, 0.60) !important; 
        transition: background-color 0.2s ease;
    }

    /* Efek Row Hover: Sedikit menggelap tipis saat disorot agar tetap interaktif */
    .table-strengthened tbody tr:hover td {
        background-color: rgba(128, 0, 0, 0.06) !important; 
    }
    /* 5. UTILITAS WARNA TEXT & TOMBOL */
    .text-maroon { 
        color: #800000 !important; 
    }

    /* 6. BUTTON SELEKTIF */
    .btn-maroon-theme {
        background: #800000 !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        border-radius: 12px !important;
        padding: 8px 20px !important;
        transition: all 0.3s ease;
    }
    .btn-maroon-theme:hover {
        background: #500000 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 20px rgba(128, 0, 0, 0.25) !important;
        transform: translateY(-2px);
    }
    .btn-update-action {
        padding: 6px 14px !important;
        border-radius: 8px !important;
        font-size: 0.85rem !important;
    }

    /* 7. BADGE KATEGORI & STATUS */
    .badge-category {
        background: rgba(250, 248, 237, 0.8) !important;
        color: #800000 !important;
        border: 1px solid rgba(128, 0, 0, 0.15) !important;
        padding: 6px 12px !important;
        border-radius: 8px !important;
        font-weight: 600;
    }
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
    }
    .dot-pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
</style>

    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
        <div>
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('img/LOGO UIN JAMBI.png') }}" alt="Logo UIN" height="80">
                <img src="{{ asset('img/logo-prodi.JPEG') }}" alt="Logo Prodi" style="height: 80px; width: 80px; border-radius: 50%; object-fit: cover; background-color: #ffffff;">
            </div>
            
            <h2 class="fw-bold text-maroon mb-1" style="font-weight: 800 !important; letter-spacing: -0.5px;">Hai, Admin <span style="font-size: 1.35rem;">👋</span></h2>
            <p class="text-muted mb-0"><i class="bi bi-shield-check text-success me-1"></i> Mode Manajemen Sarana & Prasarana Kampus</p>
        </div>
        <div class="bg-white px-3 py-2 rounded-4 shadow-sm text-end border-0" style="background-color: #fff !important; border: 1px solid #FAF8ED !important;">
            <small class="text-muted d-block fw-semibold">Waktu Server</small>
            <span class="fw-bold text-dark"><i class="bi bi-calendar3 me-1 text-danger"></i> {{ date('d M Y') }}</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom-stats text-dark p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase tracking-wider">Total Laporan</div>
                        <div class="h2 fw-extrabold mb-0 mt-2 text-dark font-monospace">{{ $total }}</div>
                    </div>
                    <div class="icon-shape text-dark">
                        <i class="bi bi-collection-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom-stats text-warning p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase tracking-wider">Menunggu</div>
                        <div class="h2 fw-extrabold mb-0 mt-2 text-warning font-monospace">{{ $pending }}</div>
                    </div>
                    <div class="icon-shape text-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom-stats text-primary p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase tracking-wider">Dalam Proses</div>
                        <div class="h2 fw-extrabold mb-0 mt-2 text-primary font-monospace">{{ $proses }}</div>
                    </div>
                    <div class="icon-shape text-primary">
                        <i class="bi bi-gear-wide-connected"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom-stats text-success p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase tracking-wider">Selesai</div>
                        <div class="h2 fw-extrabold mb-0 mt-2 text-success font-monospace">{{ $selesai }}</div>
                    </div>
                    <div class="icon-shape text-success">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show p-3" style="border-radius: 14px;" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                <div>
                    <strong class="d-block">Aksi Berhasil!</strong>
                    <span class="small">{{ session('success') }}</span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3 mt-4 d-flex align-items-center justify-content-between">
        <h5 class="fw-bold text-maroon-main m-0"><i class="bi bi-lightning-charge-fill me-1 text-warning"></i> 5 Laporan Terbaru Masuk</h5>
        <span class="badge bg-white text-muted px-3 py-2 rounded-pill shadow-sm border-0" style="background-color: #fff !important;">Real-time Stream</span>
    </div>

    <div class="card table-container-card mb-4">
        
        <img src="{{ asset('img/logo-prodi.jpeg') }}" alt="Watermark Sistem Informasi" class="table-watermark-bg">

        <div class="table-responsive">
            <table class="table table-hover table-strengthened align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 15%;"><i class="bi bi-calendar-event me-2"></i>Tanggal Masuk</th>
                        <th style="width: 18%;"><i class="bi bi-person-badge me-2"></i>Pelapor</th>
                        <th style="width: 25%;"><i class="bi bi-chat-left-text me-2"></i>Judul & Lokasi</th>
                        <th style="width: 15%;"><i class="bi bi-tags me-2"></i>Kategori</th>
                        <th style="width: 15%;"><i class="bi bi-exclamation-triangle me-2"></i>Prioritas & Status</th>
                        <th style="width: 12%;" class="text-center"><i class="bi bi-sliders me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_reports as $report)
                    <tr>
                        <td class="py-3">
                            <strong class="text-dark d-block">{{ $report->created_at->format('d M Y') }}</strong>
                            <small class="text-muted d-flex align-items-center gap-1 mt-1">
                                <i class="bi bi-clock small"></i> {{ $report->created_at->format('H:i') }} WIB
                            </small>
                        </td>
                        
                        <td>
                            <span class="fw-bold d-block text-dark">{{ $report->user->name }}</span>
                            <small class="text-muted bg-light px-2 py-0.5 rounded border small font-monospace" style="font-size: 0.75rem;">
                                ID: {{ $report->user->identity_number ?? '701240130' }}
                            </small>
                        </td>
                        
                        <td>
                            <span class="d-block fw-bold text-dark mb-1">{{ $report->title }}</span>
                            <small class="text-muted d-inline-flex align-items-center gap-1">
                                <i class="bi bi-geo-alt-fill text-danger" style="font-size: 0.85rem;"></i> {{ $report->location }}
                            </small>
                        </td>
                        
                        <td>
                            <span class="badge badge-category"><i class="bi bi-bookmark-fill me-1 small"></i>{{ $report->category }}</span>
                        </td>
                        
                        <td>
                            <span class="badge {{ $report->priority == 'tinggi' ? 'bg-danger text-white' : ($report->priority == 'sedang' ? 'bg-warning text-dark' : 'bg-info text-dark') }} mb-2 px-2 py-1" style="border-radius: 6px;">
                                <i class="bi bi-flag-fill me-1 small"></i> {{ ucfirst($report->priority) }}
                            </span>
                            
                            <div class="small">
                                @if($report->status == 'ditolak')
                                    <span class="status-indicator text-danger"><span class="dot-pulse bg-danger"></span>Ditolak</span>
                                @elseif($report->status == 'proses')
                                    <span class="status-indicator text-primary"><span class="dot-pulse bg-primary"></span>Dalam Proses</span>
                                @elseif($report->status == 'selesai')
                                    <span class="status-indicator text-success"><span class="dot-pulse bg-success"></span>Selesai</span>
                                @else
                                    <span class="status-indicator text-warning"><span class="dot-pulse bg-warning"></span>Menunggu</span>
                                @endif
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <a href="{{ route('admin.report.edit', [$report->id, 'from' => 'dashboard']) }}" class="btn btn-maroon-theme btn-update-action shadow-sm d-inline-flex align-items-center gap-1">
                                <i class="bi bi-pencil-square"></i> Update
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inboxes fs-1 d-block mb-3 opacity-40 text-maroon-main"></i>
                            <span class="fw-semibold">Belum ada laporan baru yang masuk ke dalam sistem.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($latest_reports->count() > 0)
        <div class="text-center mb-5 mt-4">
            <a href="{{ route('admin.reports.pending') }}" class="btn btn-maroon-theme px-4 py-2 shadow-sm fw-bold d-inline-flex align-items-center gap-2">
                Lihat Semua Laporan <i class="bi bi-arrow-right-short fs-5"></i>
            </a>
        </div>
    @endif
@endsection