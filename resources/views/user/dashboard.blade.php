<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Riwayat Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-maroon: #800000;
            --gradient-maroon: linear-gradient(135deg, #800000 0%, #b30000 100%);
            --bg-soft: #faf6ee; 
        }

        body { 
            background-color: var(--bg-soft);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Top Navigation Header */
        .navbar-custom {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .navbar-brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f2c59;
            letter-spacing: -0.3px;
        }

        /* Buttons styling */
        .btn-primary { 
            background: var(--gradient-maroon) !important; 
            border: none !important;
            box-shadow: 0 4px 12px rgba(128, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(128, 0, 0, 0.3);
        }
        .btn-outline-danger {
            border-radius: 8px;
            transition: all 0.2s;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: var(--gradient-maroon);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(128, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        /* Modernized Cards */
        .stats-card { 
            border: 1px solid rgba(0,0,0,0.03); 
            border-radius: 16px; 
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
            background: white;
        }
        .stats-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 12px 20px rgba(0,0,0,0.05) !important;
        }

        /* Table Design Workspace */
        .table-container { 
            background: white; 
            border-radius: 16px; 
            padding: 24px 0 0 0; 
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden; 
        }

        .table-header-title {
            padding: 0 24px 24px 24px;
        }

        .table thead th {
            background-color: var(--primary-maroon) !important;
            color: #ffffff !important;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            padding: 18px 24px; 
            border: none !important;
            border-radius: 0 !important; 
        }

        .table tbody td {
            padding: 18px 24px;
            color: #495057;
        }
        .table-hover tbody tr:hover {
            background-color: #fdfaf4;
        }

        .badge-priority { 
            font-size: 0.75rem; 
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
            letter-spacing: 0.3px;
        }
        .img-detail { max-height: 220px; width: 100%; object-fit: cover; border-radius: 12px; }

        .status-pill {
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spin-icon {
            display: inline-block;
            animation: spin 2s linear infinite;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input { display: none; }
        .star-rating label { font-size: 1.75rem; color: #ddd; cursor: pointer; padding: 0 0.1rem; transition: color 0.2s; }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label { color: #ffc107; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR / TOP HEADER -->
<nav class="navbar navbar-custom sticky-top py-3">
    <div class="container-fluid px-4 px-md-5">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <!-- Logo UIN Jambi -->
            <img src="{{ asset('img/LOGO UIN JAMBI.png') }}" alt="Logo UIN" style="height: 45px; object-fit: contain;">
            
            <!-- REVISI: Menambahkan Logo Prodi (Silakan ubah 'src' dengan file logo prodi lokal/aset Anda) -->
            <img src="{{ asset('img/logo-prodi.jpeg') }}" alt="Logo Prodi" style="height: 45px; object-fit: contain;" class="me-2">
            
            <span class="navbar-brand-text">SI UIN STS Jambi</span>
        </a>
        
        <div class="d-flex align-items-center gap-3">
            <!-- Notification Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light bg-white border position-relative rounded-circle p-0 d-flex align-items-center justify-content-center" type="button" id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px;">
                    <i class="bi bi-bell text-secondary fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-top: 6px; margin-left: -6px; padding: 4px 6px; font-size: 0.65rem;">
                        1
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 mt-2" aria-labelledby="dropdownNotif" style="width: 320px; border-radius: 12px;">
                    <li><h6 class="dropdown-header fw-bold text-dark">Notifikasi Terbaru</h6></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <div class="dropdown-item p-2 rounded bg-light-subtle">
                            <div class="d-flex align-items-start">
                                <div class="bg-success text-white rounded-circle p-1 me-2 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                    <i class="bi bi-check-lg small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 small text-dark fw-semibold">Status laporan diperbarui!</p>
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Laporan sarpras Anda telah selesai diperbaiki.</small>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <a href="{{ route('user.report.create') }}" class="btn btn-primary px-3 py-2 btn-sm rounded-3 fw-medium">
                <i class="bi bi-plus-lg me-1"></i> Laporan Baru
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2 fw-medium">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT WRAPPER -->
<main class="flex-grow-1 py-4 d-flex flex-column justify-content-start">
    <div class="container-fluid flex-grow-1 d-flex flex-column gap-4 px-4 px-md-5">
        
        <!-- WELCOME BANNER -->
        <div class="welcome-banner p-3 p-md-4 text-white">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge bg-white bg-opacity-25 text-white mb-1 px-3 py-1.5 rounded-pill fw-semibold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Dashboard Mahasiswa</span>
                    <h2 class="fw-bold mb-1" style="font-size: 1.75rem;">Selamat Datang, {{ Auth::user()->name }}</h2>
                    <p class="mb-0 text-white-50 small" style="font-size: 0.875rem;">Sistem terintegrasi untuk memantau status dan perbaikan fasilitas utama di lingkungan kampus.</p>
                </div>
            </div>
        </div>

        <!-- STATS CARDS SECTION -->
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card stats-card shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small mb-2" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Laporan</h6>
                            <h1 class="fw-extrabold mb-0 text-dark" style="font-size: 2.5rem;">{{ $reports->count() }}</h1>
                        </div>
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-file-earmark-text fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small mb-2" style="font-size: 0.8rem; letter-spacing: 0.5px;">Sedang Diproses</h6>
                            <h1 class="fw-extrabold mb-0 text-dark" style="font-size: 2.5rem;">{{ $reports->where('status', 'proses')->count() }}</h1>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-clock-history fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small mb-2" style="font-size: 0.8rem; letter-spacing: 0.5px;">Selesai Diperbaiki</h6>
                            <h1 class="fw-extrabold mb-0 text-dark" style="font-size: 2.5rem;">{{ $reports->where('status', 'selesai')->count() }}</h1>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-check2-circle fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE WORKSPACE CONTAINER -->
        <div class="table-container shadow-sm flex-grow-1 d-flex flex-column mb-3">
            <div class="table-header-title d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-hdd-stack me-2 text-secondary"></i>Riwayat Aktivitas Laporan</h5>
                <span class="text-muted small">Update otomatis</span>
            </div>
            
            @if(session('success'))
                <div class="px-4 mb-2">
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-left: 4px solid #198754 !important;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul & Kategori</th>
                            <th>Lokasi</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td class="text-secondary fw-medium" style="font-size: 0.9rem;">{{ $report->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">{{ $report->title }}</div>
                                <small class="text-muted bg-light px-2 py-0.5 rounded border-0" style="font-size: 0.75rem;">{{ $report->category }}</small>
                            </td>
                            <td>
                                <span class="d-flex align-items-center gap-1 text-secondary" style="font-size: 0.9rem;">
                                    <i class="bi bi-geo-alt-fill text-danger small"></i> {{ $report->location }}
                                </span>
                            </td>
                            <td>
                                @if($report->priority == 'tinggi')
                                    <span class="badge bg-danger bg-opacity-10 text-danger badge-priority">Tinggi</span>
                                @elseif($report->priority == 'sedang')
                                    <span class="badge bg-warning bg-opacity-10 text-warning text-dark badge-priority">Sedang</span>
                                @else
                                    <span class="badge bg-info bg-opacity-10 text-info text-dark badge-priority">Rendah</span>
                                @endif
                            </td>
                            
                            <td>
                                @if($report->status == 'pending')
                                    <span class="status-pill text-secondary"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                                @elseif($report->status == 'proses')
                                    <span class="status-pill text-warning"><i class="bi bi-gear-fill spin-icon"></i> Diproses</span>
                                @elseif($report->status == 'selesai')
                                    <span class="status-pill text-success"><i class="bi bi-check-circle-fill"></i> Selesai</span>
                                @elseif($report->status == 'ditolak')
                                    <span class="status-pill text-danger"><i class="bi bi-x-circle-fill"></i> Ditolak</span>
                                @endif
                            </td>
                            
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-light border px-3 rounded-2 fw-medium shadow-sm text-dark" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $report->id }}">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL DETAIL -->
                        <div class="modal fade" id="modalDetail{{ $report->id }}" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
                            <div class="modal-lg modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                    <div class="modal-header text-white" style="background: var(--gradient-maroon);">
                                        <h5 class="modal-title fw-bold" id="modalDetailLabel"><i class="bi bi-info-circle me-2"></i>Detail Tracking Laporan</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="position-relative mb-4 px-5 pt-2">
                                            <div class="progress position-absolute start-0 top-50 translate-y-50 w-100" style="height: 4px; z-index: 0; transform: translateY(-50%);">
                                                <div class="progress-bar 
                                                    @if($report->status == 'proses') w-50 bg-warning 
                                                    @elseif($report->status == 'selesai') w-100 bg-success 
                                                    @elseif($report->status == 'ditolak') w-100 bg-danger
                                                    @else w-0 @endif" 
                                                    role="progressbar" style="transition: width 0.5s ease;">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
                                                <div class="text-center bg-white px-2">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-1 text-white" style="width: 36px; height: 36px; margin: 0 auto; background-color: var(--primary-maroon);">
                                                        <i class="bi bi-file-earmark-text-fill fs-6"></i>
                                                    </div>
                                                    <span class="fw-bold text-dark" style="font-size: 0.8rem;">Diajukan</span>
                                                </div>
                                                <div class="text-center bg-white px-2">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-1 @if($report->status == 'proses' || $report->status == 'selesai') bg-warning text-dark @else bg-light text-muted border @endif" style="width: 36px; height: 36px; margin: 0 auto;">
                                                        <i class="bi bi-gear-fill fs-6 @if($report->status == 'proses') spin-icon @endif"></i>
                                                    </div>
                                                    <span class="@if($report->status == 'proses' || $report->status == 'selesai') fw-bold text-dark @else text-muted @endif" style="font-size: 0.8rem;">Diproses</span>
                                                </div>
                                                <div class="text-center bg-white px-2">
                                                    @if($report->status == 'ditolak')
                                                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center shadow-sm mb-1" style="width: 36px; height: 36px; margin: 0 auto;">
                                                            <i class="bi bi-x-circle-fill fs-6"></i>
                                                        </div>
                                                        <span class="fw-bold text-danger" style="font-size: 0.8rem;">Ditolak</span>
                                                    @else
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-1 @if($report->status == 'selesai') bg-success text-white @else bg-light text-muted border @endif" style="width: 36px; height: 36px; margin: 0 auto;">
                                                            <i class="bi bi-check-circle-fill fs-6"></i>
                                                        </div>
                                                        <span class="@if($report->status == 'selesai') fw-bold text-success @else text-muted @endif" style="font-size: 0.8rem;">Selesai</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="text-muted my-4">
                                        <div class="row">
                                            <div class="col-md-5 mb-3 border-end">
                                                <label class="text-muted small d-block">Judul Laporan</label>
                                                <p class="fw-bold text-dark fs-5 mb-3">{{ $report->title }}</p>
                                                <label class="text-muted small d-block">Kategori & Lokasi</label>
                                                <p class="fw-semibold mb-3 text-dark">{{ $report->category }} | <span class="text-primary">{{ $report->location }}</span></p>
                                                <label class="text-muted small d-block">Status Saat Ini</label>
                                                <p class="mb-3">
                                                    @if($report->status == 'pending') <span class="badge bg-secondary">Menunggu Verifikasi</span>
                                                    @elseif($report->status == 'proses') <span class="badge bg-warning text-dark">Sedang Diproses</span>
                                                    @elseif($report->status == 'selesai') <span class="badge bg-success">Selesai Diperbaiki</span>
                                                    @elseif($report->status == 'ditolak') <span class="badge bg-danger">Laporan Ditolak</span>
                                                    @endif
                                                </p>
                                                <label class="text-muted small d-block">Deskripsi Kejadian</label>
                                                <p class="bg-light p-3 rounded border text-secondary" style="font-size: 0.9rem; white-space: pre-line;">{{ $report->description }}</p>
                                            </div>
                                            <div class="col-md-7 ps-md-4">
                                                <label class="text-muted small d-block mb-2 fw-bold text-uppercase">Dokumentasi Bukti</label>
                                                <div class="row g-2 mb-4">
                                                    <div class="col-6 text-center">
                                                        <span class="d-block text-muted mb-1 fw-bold" style="font-size: 0.75rem;">FOTO AWAL:</span>
                                                        @if($report->image) <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid img-detail border shadow-sm" alt="Bukti Awal">
                                                        @else
                                                            <div class="bg-light d-flex align-items-center justify-content-center border rounded" style="height: 130px;"><span class="text-muted small">Tidak ada foto</span></div>
                                                        @endif
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <span class="d-block text-success mb-1 fw-bold" style="font-size: 0.75rem;">FOTO PERBAIKAN:</span>
                                                        @if($report->completed_image) <img src="{{ asset('storage/' . $report->completed_image) }}" class="img-fluid img-detail border shadow-sm" alt="Bukti Selesai">
                                                        @else
                                                            <div class="bg-light d-flex align-items-center justify-content-center border rounded text-muted" style="height: 130px; background-color: #fafafa;"><span class="small"><i class="bi bi-image"></i> Belum ada foto</span></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="text-muted my-3">
                                                <div class="mb-2">
                                                    <label class="text-dark small d-block mb-1 fw-bold"><i class="bi bi-chat-left-text-fill text-primary"></i> CATATAN ADMIN:</label>
                                                    @if($report->admin_note)
                                                        <div class="p-3 bg-light rounded border" style="border-left: 4px solid #0d6efd !important; font-size: 0.9rem;"><span class="text-dark fw-bold" style="white-space: pre-line;">{{ $report->admin_note }}</span></div>
                                                    @else
                                                        <div class="p-2 bg-light rounded border text-muted small text-center" style="font-style: italic;">Belum ada catatan tambahan dari admin.</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary px-4 rounded-3" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-clipboard-x fs-1 d-block mb-2 text-black-50"></i> Belum ada riwayat aktivitas laporan data.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER SECTION -->
<!-- REVISI: Tetap menggunakan latar putih solid dengan layout fluid penuh ke ujung layar -->
<footer class="bg-white border-top py-4 mt-auto shadow-sm">
    <!-- REVISI: Mengubah container-xl menjadi container-fluid px-4 px-md-5 agar ditarik penuh ke paling kiri dan paling kanan -->
    <div class="container-fluid px-4 px-md-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
        
        <!-- Sisi Paling Kiri: Branding Informasi Kuliah -->
        <div class="d-flex align-items-center gap-3">
            <div class="text-white p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--gradient-maroon);">
                <i class="bi bi-mortarboard-fill fs-5"></i>
            </div>
            <div>
                <p class="mb-0 fw-bold uppercase tracking-wider small" style="color: var(--primary-maroon); letter-spacing: 0.5px;">SISTEM INFORMASI</p>
                <p class="mb-0 small text-muted">&copy; 2026 UIN STS JAMBI.</p>
            </div>
        </div>

        <!-- Sisi Tengah: Kontak Pintas Tetap Center Secara Fleksibel -->
        <div class="d-flex align-items-center gap-3 bg-light px-4 py-2 rounded-pill border shadow-sm">
            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="bi bi-telephone-fill small"></i>
            </div>
            <div class="text-start">
                <p class="mb-0 text-muted text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 0.5px;">Hubungi Kami</p>
                <p class="mb-0 fw-bold small" style="color: var(--primary-maroon);">+62 812-3456-7890</p>
            </div>
        </div>

        <!-- Sisi Paling Kanan: Media Sosial Media -->
        <div class="d-flex align-items-center gap-2">
            <p class="mb-0 small fw-bold text-muted d-none d-lg-block me-1">Ikuti Kami:</p>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-light border d-flex align-items-center justify-content-center p-0 rounded-3 shadow-sm" style="width: 38px; height: 38px; color: var(--primary-maroon);"><i class="bi bi-instagram fs-5"></i></a>
                <a href="#" class="btn btn-light border d-flex align-items-center justify-content-center p-0 rounded-3 shadow-sm" style="width: 38px; height: 38px; color: var(--primary-maroon);"><i class="bi bi-facebook fs-5"></i></a>
                <a href="#" class="btn btn-light border d-flex align-items-center justify-content-center p-0 rounded-3 shadow-sm" style="width: 38px; height: 38px; color: var(--primary-maroon);"><i class="bi bi-youtube fs-5"></i></a>
            </div>
        </div>
        
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>