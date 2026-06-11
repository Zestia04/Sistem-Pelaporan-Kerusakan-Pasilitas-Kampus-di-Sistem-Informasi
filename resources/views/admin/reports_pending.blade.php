@extends('admin.layouts.app')

@section('title', 'Semua Laporan')

@section('content')
<style>
    /* Memaksa seluruh kolom header tabel menjadi maroon premium dan teks putih */
    .table thead th {
        background: linear-gradient(90deg, #800000 0%, #800000 100%) !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
        font-size: 0.85rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.5px !important;
        padding: 15px 20px !important;
        border: none !important;
    }
</style>
<div class="container-fluid dashboard-wrapper px-4 py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <div>
            <h3 class="fw-bold text-maroon mb-1" style="font-weight: 800 !important; letter-spacing: -0.5px;">Kelola Semua Laporan</h3>
            <p class="text-muted small mb-0" style="font-size: 0.9rem; color: #6c757d !important;">Tinjau, verifikasi, dan perbarui laporan yang masuk secara real-time.</p>
        </div>
        <div class="card border-0 shadow-sm rounded-3 px-3 py-2 bg-white d-none d-md-flex flex-row align-items-center gap-2 border-start border-4" style="border-color: #800000 !important; background-color: #ffffff !important;">
            <span class="text-muted small fw-medium">Waktu Server:</span>
            <div class="badge rounded-2 px-2 py-1" style="background-color: #fff5f5; color: #800000; font-weight: 600; font-size: 0.85rem;">
                <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y') }}
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="background-color: #ffffff !important; border: 1px solid #eadecc !important;">
        <form action="{{ route('admin.reports.pending') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-bold text-maroon mb-2" style="font-size: 0.75rem; letter-spacing: 0.8px;"><i class="bi bi-search me-1"></i> KATA KUNCI</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted" style="border-color: #eadecc; background-color: #fdfcf9;"><i class="bi bi-search" style="font-size: 0.85rem; color: #800000;"></i></span>
                    <input type="text" name="search" class="form-control form-control-custom ps-2" placeholder="Judul / nama pelapor..." value="{{ request('search') }}">
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-bold text-maroon mb-2" style="font-size: 0.75rem; letter-spacing: 0.8px;"><i class="bi bi-info-circle me-1"></i> STATUS</label>
                <select name="status" class="form-select form-control-custom">
                    <option value="semua">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-bold text-maroon mb-2" style="font-size: 0.75rem; letter-spacing: 0.8px;"><i class="bi bi-exclamation-triangle me-1"></i> PRIORITAS</label>
                <select name="priority" class="form-select form-control-custom">
                    <option value="semua">Semua Prioritas</option>
                    <option value="rendah" {{ request('priority') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ request('priority') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ request('priority') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-bold text-maroon mb-2" style="font-size: 0.75rem; letter-spacing: 0.8px;"><i class="bi bi-tags me-1"></i> KATEGORI</label>
                <select name="category" class="form-select form-control-custom">
                    <option value="semua">Semua Kategori</option>
                    <option value="Sarana & Prasarana" {{ request('category') == 'Sarana & Prasarana' ? 'selected' : '' }}>Sarpras</option>
                    <option value="IT" {{ request('category') == 'IT' ? 'selected' : '' }}>IT</option>
                </select>
            </div>

            <div class="col-lg-3 col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-maroon w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 py-2 shadow-sm">
                    <i class="bi bi-filter-left fs-5"></i> Cari
                </button>
                <a href="{{ route('admin.reports.pending') }}" class="btn btn-outline-custom w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4" style="overflow: hidden; background-color: #ffffff !important; border: 1px solid #eadecc !important;">
        <div class="table-container-card">
            <img src="{{ asset('img/logo-prodi.png') }}" alt="Watermark" class="table-watermark-bg">
            
            <div class="table-responsive" style="position: relative; z-index: 2;">
                <table class="table align-middle mb-0" style="border-collapse: separate;">
                    <thead>
                        <tr style="background-color: #fdfaf9 !important; border-bottom: 2px solid #eadecc !important;">
                            <th class="ps-4 py-3 text-maroon" style="width: 15%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">TANGGAL</th>
                            <th class="py-3 text-maroon" style="width: 22%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">PELAPOR</th>
                            <th class="py-3 text-maroon" style="width: 32%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">LAPORAN & LOKASI</th>
                            <th class="py-3 text-maroon" style="width: 15%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">KATEGORI</th>
                            <th class="py-3 text-maroon" style="width: 16%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">STATUS & PRIORITAS</th>
                            <th class="text-center pe-4 py-3 text-maroon" style="width: 10%; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.5px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr class="align-middle transition-row">
                            <td class="ps-4 py-3.5">
                                <span class="fw-bold d-block text-dark" style="font-size: 0.9rem;">{{ $report->created_at->format('d M Y') }}</span>
                                <small class="text-muted d-flex align-items-center gap-1 mt-0.5" style="font-size: 0.78rem;">
                                    <i class="bi bi-clock text-secondary"></i> {{ $report->created_at->format('H:i') }} WIB
                                </small>
                            </td>
                            
                            <td class="py-3.5">
                                <span class="fw-bold d-block text-dark mb-1" style="font-size: 0.92rem;">{{ $report->user->name }}</span>
                                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.72rem; font-weight: 500; border-color: #eadecc !important;">
                                    ID: {{ $report->user->identity_number }}
                                </span>
                            </td>
                            
                            <td class="py-3.5 pe-3">
                                <span class="fw-bold text-dark d-block mb-1 text-truncate-custom" style="font-size: 0.95rem; max-width: 320px;">{{ $report->title }}</span>
                                <div class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-2 text-muted" style="font-size: 0.78rem; border: 1px solid #eadecc; background-color: #fdfcf9;">
                                    <i class="bi bi-geo-alt-fill text-danger" style="font-size: 0.8rem;"></i> {{ $report->location }}
                                </div>
                            </td>
                            
                            <td class="py-3.5">
                                <span class="badge rounded-pill px-3 py-1.5" style="background-color: #fff5f5; color: #800000; border: 1px solid #ffd8d8; font-weight: 600; font-size: 0.78rem;">
                                    <i class="bi bi-bookmark-fill me-1" style="font-size: 0.7rem; opacity: 0.8;"></i> {{ $report->category }}
                                </span>
                            </td>
                            
                            <td class="py-3.5">
                                @if($report->priority == 'tinggi')
                                    <span class="badge px-2 py-1 mb-1.5 d-inline-flex align-items-center rounded-1 fw-bold" style="background-color: #fff5f5; color: #e03131; font-size: 0.72rem;">• TINGGI</span>
                                @elseif($report->priority == 'sedang')
                                    <span class="badge px-2 py-1 mb-1.5 d-inline-flex align-items-center rounded-1 fw-bold" style="background-color: #fff9db; color: #f08c00; font-size: 0.72rem;">• SEDANG</span>
                                @else
                                    <span class="badge px-2 py-1 mb-1.5 d-inline-flex align-items-center rounded-1 fw-bold" style="background-color: #e7f5ff; color: #1c7ed6; font-size: 0.72rem;">• RENDAH</span>
                                @endif
                                
                                <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                    @if($report->status == 'pending')
                                        <span class="rounded-circle" style="width: 7px; height: 7px; background-color: #fd7e14;"></span>
                                        <small class="fw-bold" style="font-size: 0.82rem; color: #fd7e14 !important;">Pending</small>
                                    @elseif($report->status == 'proses')
                                        <span class="rounded-circle" style="width: 7px; height: 7px; background-color: #228be6;"></span>
                                        <small class="fw-bold" style="font-size: 0.82rem; color: #228be6 !important;">Diproses</small>
                                    @else
                                        <span class="rounded-circle" style="width: 7px; height: 7px; background-color: #40c057;"></span>
                                        <small class="fw-bold" style="font-size: 0.82rem; color: #40c057 !important;">{{ ucfirst($report->status) }}</small>
                                    @endif
                                </div>
                            </td>
                            
                            <td class="text-center pe-4 py-3.5">
                                <a href="{{ url('admin/report/' . $report->id . '/edit?from=all_reports') }}" class="btn btn-action-edit btn-sm rounded-2 fw-semibold shadow-sm d-inline-flex align-items-center justify-content-center" style="font-size: 0.82rem; padding: 0.45rem 0.85rem;">
                                    <i class="bi bi-pencil-square me-1"></i> Update
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted bg-light bg-opacity-25">
                                <div class="py-4">
                                    <div class="mb-3 d-inline-flex p-3 rounded-circle" style="background-color: #fff5f5; color: #800000;">
                                        <i class="bi bi-folder-x" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <p class="fw-bold mb-1 text-dark" style="font-size: 1rem;">Tidak ada laporan yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
   /* 1. OVERRIDE SIDEBAR PREMIUM & BERKARAKTER (BERLAKU UNTUK SEMUA HALAMAN) */
    .sidebar, 
    .main-sidebar, 
    [class*="sidebar-dark-"], 
    .bg-dark {
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

    /* 2. STYLE KETIKA MENU AKTIF (MENJADI PILL CREAM) */
    [class*="sidebar-dark-"] .nav-sidebar > .nav-item > .nav-link.active,
    .sidebar .nav-link.active {
        background: #FAF8ED !important;
        background-color: #FAF8ED !important;
        color: #800000 !important;
        font-weight: 700 !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
        opacity: 1 !important;
    }
    .sidebar .nav-link.active i {
        color: #800000 !important;
        opacity: 1 !important;
    }

    /* 3. FORCE BACKGROUND HALAMAN MENJADI CREAM LEMBUT */
    body, .content-wrapper, .main-panel, .dashboard-wrapper {
        background-color: #fdfbf6 !important; 
    }

    /* 4. FORCE BACKGROUND HALAMAN UTAMA MENJADI CREAM LEMBUT */
    body, 
    .content-wrapper, 
    .main-panel, 
    .dashboard-wrapper {
        background-color: #fdfbf6 !important; 
    }

    /* 5. UTILITAS WARNA TEXT & TOMBOL */
    .text-maroon { 
        color: #800000 !important; 
    }
    
    .btn-maroon {
        background-color: #800000 !important;
        border-color: #800000 !important;
        color: #ffffff !important;
        border-radius: 8px !important;
    }
    .btn-maroon:hover {
        background-color: #600000 !important;
        box-shadow: 0 4px 12px rgba(128, 0, 0, 0.25) !important;
    }

    .form-control-custom {
        background-color: #fdfcf9 !important;
        border: 1px solid #eadecc !important;
        border-radius: 8px !important;
        padding: 0.55rem 0.85rem;
        color: #2d3748;
    }
    .form-control-custom:focus {
        border-color: #800000 !important;
        box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1) !important;
    }
    
    .btn-outline-custom {
        border: 1px solid #eadecc !important;
        background-color: #ffffff;
        color: #4a5568;
        border-radius: 8px !important;
    }

    .transition-row:hover {
        background-color: #fffdf9 !important; 
    }

    .table-container-card { position: relative; }
    .table-watermark-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 250px;
        height: auto;
        opacity: 0.03;
        pointer-events: none;
        z-index: 1;
    }
    

    .btn-action-edit {
        background-color: #ffffff;
        border: 1px solid #800000;
        color: #800000;
    }
    .btn-action-edit:hover {
        background-color: #800000;
        color: #ffffff;
    }

    .text-truncate-custom {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection