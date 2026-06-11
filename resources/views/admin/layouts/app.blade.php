<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Pelaporan Sarpras</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* 1. GLOBAL LAYOUT & LOCK VIEWPORT (Mengunci halaman agar pas 1 layar penuh) */
        body { 
            background-color: #FAF8ED !important; 
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
            height: 100vh; 
            overflow: hidden; /* Mematikan scroll bar browser utama */
        }

        /* 2. OVERRIDE SIDEBAR PREMIUM & BERKARAKTER (Kunci Tinggi & Scroll Internal) */
        .sidebar { 
            height: 100vh; 
            width: 260px; 
            background: linear-gradient(180deg, #800000 0%, #3A0000 100%) !important;
            border-right: none !important;
            box-shadow: 4px 0 25px rgba(128, 0, 0, 0.15) !important;
            flex-shrink: 0;
            overflow-y: auto; /* Jika menu sidebar banyak, hanya sidebarnya saja yang bisa di-scroll */
        }
        .sidebar .nav-link {
            border-radius: 12px !important;
            margin: 4px 10px !important;
            padding: 10px 16px !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: rgba(250, 248, 237, 0.7) !important;
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

        /* 3. AREA KONTEN UTAMA (Sistem Flex Bergerak Vertikal Dinamis) */
        .content-area { 
            flex-grow: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow: hidden; 
        }
        .main-content { 
            flex-grow: 1; 
            padding: 20px 30px; 
            overflow-y: auto; /* Pengaman: Jika dibuka di monitor kecil, area dalam konten ini saja yang ber-scroll, bodi luar tetap diam */
            background-color: #FAF8ED !important;
        }
        
        /* 4. DESIGN ELEMENT & UTILITIES */
        .text-maroon-main {
            color: #800000 !important;
            letter-spacing: -0.5px;
        }

        /* 5. KARTU STATISTIK INTERAKTIF (3D GLASSMORPHISM) */
        .card-custom-stats {
            background: #ffffff !important;
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 25px rgba(128, 0, 0, 0.02) !important;
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
            height: 4px;
            background: currentColor;
            opacity: 0.8;
        }
        .card-custom-stats:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 15px 30px rgba(128, 0, 0, 0.08) !important;
        }
        .icon-shape {
            width: 48px;
            height: 48px;
            background: #FAF8ED;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: all 0.3s ease;
        }
        .card-custom-stats:hover .icon-shape {
            transform: rotate(-10deg) scale(1.05);
        }
        .footer-admin { background: white; text-align: center; padding: 15px; border-top: 1px solid #dee2e6; }
    </style>
</head>
<body class="d-flex">

    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 shadow-lg">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-2 mt-2">
            <i class="bi bi-tools fs-4 me-2" style="color: #FAF8ED !important;"></i>
            <span class="fs-5 fw-bold" style="color: #FAF8ED !important; letter-spacing: 0.5px;">Admin Panel</span>
        </a>
        <hr style="border-color: rgba(250, 248, 237, 0.15);">
        
        <ul class="nav flex-column mb-auto gap-1">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.reports.pending') }}" class="nav-link {{ request()->routeIs('admin.reports.pending') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-data me-2"></i> Semua Laporan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.reports.completed') }}" class="nav-link {{ request()->routeIs('admin.reports.completed') ? 'active' : '' }}">
                    <i class="bi bi-check2-circle me-2"></i> Laporan Selesai
                </a>
            </li>
        </ul>
        
        <hr style="border-color: rgba(250, 248, 237, 0.15);">
        <form action="{{ route('logout') }}" method="POST" class="mb-2">
            @csrf
            <button type="submit" class="btn btn-danger w-100 shadow-sm rounded-3 py-2 fw-semibold" style="background-color: #dc3545; border: none;">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
        </form>
    </div>

    <div class="content-area">
        <div class="main-content">
            @yield('content')
        </div>

    
        <footer class="footer-admin">
            <p class="mb-0 text-muted small">&copy; {{ date('Y') }} Sistem Pelaporan Sarpras Kampus. Hak Cipta Dilindungi.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>