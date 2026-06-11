@extends('admin.layouts.app')

@section('title', 'Laporan Selesai')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* 1. GLOBAL FONT OVERRIDE UNTUK HALAMAN INI */
    .content-wrapper,
    .card,
    .table,
    h4,
    h5,
    p,
    span,
    small,
    badge {
        font-family: inherit !important;
    }

    /* 2. OVERRIDE SIDEBAR PREMIUM & BERKARAKTER */
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

    /* 3. STYLE KETIKA MENU AKTIF */
    [class*="sidebar-dark-"] .nav-sidebar>.nav-item>.nav-link.active,
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

    /* 4. FORCE BACKGROUND HALAMAN MENJADI CREAM LEMBUT */
    body,
    .content-wrapper,
    .main-panel,
    .dashboard-wrapper {
        background-color: #fdfbf6 !important;
    }

    /* 5. MENYAMAKAN HEADLINE JUDUL SEPERTI DI DASHBOARD */
    .sub-judul-dashboard {
        font-size: 0.88rem !important;
        font-weight: 500 !important;
        color: #6c757d !important;
    }

    /* 6. PRESISI TIPOGRAFI HEADER TABEL (BOLDER SEPERTI DASHBOARD) */
    .table-premium thead th {
        background: #800000 !important;
        color: #ffffff !important;
        border: none !important;
        text-transform: uppercase !important;
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        /* Diubah ke 700 (Bold) agar tegas menyerupai TH dashboard */
        letter-spacing: 0.6px !important;
        padding: 14px 20px !important;
        vertical-align: middle !important;
    }

    /* 7. RE-STYLING FONT ISI TABEL (DIUBAH KE BOLD JELAS & TEGAS) */
    .text-table-main {
        color: #212529 !important;
        font-weight: 700 !important;
        font-size: 1.05rem !important;
        /* Ubah dari 0.92rem menjadi 1.05rem (atau pakai px, misal: 16px) */
    }

    .text-table-sub {
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        /* Sedikit dinaikkan ke 500 agar sub-teks tidak terlalu tipis */
        color: #6c757d !important;
    }

    /* UTILITAS WARNA TEXT & EFFEK ROW */
    .text-maroon {
        color: #800000 !important;
    }

    .tr-premium:hover {
        background-color: #fffdf9 !important;
    }
</style>

<div class="card shadow-sm border-0 mb-4" style="background: #ffffff; border-left: 5px solid #800000 !important; border-radius: 16px;">
    <div class="card-body d-flex align-items-center p-3">
        <div class="p-3 rounded-circle mr-3" style="background: rgba(128, 0, 0, 0.08); color: #800000;">
            <i class="fas fa-check-circle fa-2x"></i>
        </div>
        <div>
            <h4 class="font-weight-bold mb-1" style="color: #3A0000; font-size: 1.35rem; letter-spacing: -0.3px;">Laporan Selesai</h4>
            <p class="sub-judul-dashboard mb-0">Arsip laporan fasilitas yang telah berhasil ditangani atau diputuskan tindakannya.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: #ffffff; overflow: hidden;">

    <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
        <h5 class="font-weight-bold mb-0" style="color: #3A0000; font-size: 1.05rem; letter-spacing: -0.2px;">
            <i class="fas fa-archive mr-2 text-maroon"></i> Data Arsip Laporan Selesai
        </h5>
    </div>

    <div class="table-responsive px-3 pb-3">
        <table class="table table-hover align-middle mb-0 table-premium" style="min-width: 900px;">
            <thead>
                <tr>
                    <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; padding-left: 24px;">Tanggal Selesai</th>
                    <th>Pelapor</th>
                    <th>Judul & Lokasi</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th class="text-center" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Aksi</th>
                </tr>
            </thead>
            <tbody style="background: #ffffff;">

                @forelse($reports as $report)
                <tr class="tr-premium" style="transition: all 0.2s;">
                    <td style="padding: 16px 20px; padding-left: 24px; vertical-align: middle;">
                        <span class="text-table-main d-block">
                            {{ $report->updated_at->format('d M Y') }}
                        </span>
                        <small class="text-muted text-table-sub">
                            <i class="far fa-clock mr-1"></i> {{ $report->updated_at->format('H:i') }} WIB
                        </small>
                    </td>

                    <td style="vertical-align: middle;">
                        <span class="text-table-main d-block">
                            {{ $report->user->name }}
                        </span>
                        <span class="badge badge-light border text-muted px-2 py-0.5 text-table-sub" style="border-radius: 6px; font-weight: 500; background-color: #f8f9fa;">
                            ID: {{ $report->user->identity_number }}
                        </span>
                    </td>

                    <td style="vertical-align: middle;">
                        <span class="text-table-main d-block" style="text-transform: capitalize;">
                            {{ $report->title }}
                        </span>
                        <small class="text-danger font-weight-bold text-table-sub" style="font-weight: 600 !important;">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $report->location }}
                        </small>
                    </td>

                    <td style="vertical-align: middle;">
                        <span class="badge px-3 py-2" style="background: #FFF5F5; color: #800000; border: 1px solid rgba(128, 0, 0, 0.15); border-radius: 8px; font-weight: 700; font-size: 0.78rem;">
                            <i class="fas fa-bookmark mr-1 text-danger" style="font-size: 0.72rem;"></i> {{ $report->category }}
                        </span>
                    </td>

                    <td style="vertical-align: middle;">
                        @if($report->status == 'ditolak')
                        <span class="badge px-3 py-2 text-danger d-inline-flex align-items-center" style="background: #FFEBEE; border-radius: 8px; font-weight: 800; font-size: 0.78rem; letter-spacing: 0.3px;">
                            <i class="fas fa-times-circle mr-1" style="font-size: 0.75rem;"></i> Ditolak
                        </span>
                        @else
                        <span class="badge px-3 py-2 text-success d-inline-flex align-items-center" style="background: #E8F5E9; border-radius: 8px; font-weight: 800; font-size: 0.78rem; letter-spacing: 0.3px;">
                            <i class="fas fa-check-circle mr-1" style="font-size: 0.75rem;"></i> Selesai
                        </span>
                        @endif
                    </td>

                    <td style="vertical-align: middle;" class="text-center">
                        <a href="{{ route('admin.report.show', $report->id) }}" class="btn btn-sm text-white px-3 py-1.5 font-weight-bold" style="background: #800000; border-radius: 8px; box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15); transition: all 0.2s; font-size: 0.82rem; font-weight: 700 !important;">
                            <i class="fas fa-eye mr-1" style="font-size: 0.75rem;"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted" style="background: #ffffff;">
                        <div class="mb-2" style="color: rgba(128, 0, 0, 0.2);">
                            <i class="fas fa-folder-open fa-3x"></i>
                        </div>
                        <span class="font-weight-bold d-block" style="font-size: 0.95rem;">Belum Ada Data Arsip</span>
                        <small class="text-muted text-table-sub">Semua laporan yang selesai atau ditolak akan muncul di sini.</small>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection