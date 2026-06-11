<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pelaporan Sarpras Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF7; /* Soft Cream Khas Landing Page */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Dekorasi Background Estetik (Aksen Abstrak Kampus) */
        body::before {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(122, 22, 22, 0.04) 0%, rgba(253, 251, 247, 0) 70%);
            top: -200px;
            left: -200px;
            z-index: 0;
        }
        body::after {
            content: "";
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(122, 22, 22, 0.03) 0%, rgba(253, 251, 247, 0) 70%);
            bottom: -300px;
            right: -200px;
            z-index: 0;
        }

        /* Ukuran Kotak Login Diperbesar & Lebih Premium */
        .login-card {
            max-width: 480px; /* Diperbesar dari bawaan awal */
            width: 100%;
            background: #ffffff;
            border: 1px solid rgba(122, 22, 22, 0.08);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(122, 22, 22, 0.05);
            z-index: 10;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Header Form Terintegrasi di Dalam Card */
        .login-header {
            background: linear-gradient(135deg, #7A1616 0%, #4D0A0A 100%);
            padding: 2.5rem 2rem 2rem 2rem;
            text-align: center;
            color: #FAF8ED;
        }

        /* Desain Custom Form Input */
        .form-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #A0A0A0;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        .form-control-custom {
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: 12px;
            border: 1.5px solid #EAEAEA;
            background-color: #FAFAFA;
            font-weight: 500;
            color: #2D2D2D;
            transition: all 0.3s ease;
        }
        .form-control-custom:focus {
            background-color: #fff;
            border-color: #7A1616;
            box-shadow: 0 0 0 4px rgba(122, 22, 22, 0.1);
            outline: none;
        }
        .form-control-custom:focus + i {
            color: #7A1616;
        }

        /* Desain Ukuran Tombol Dibikin Sama Persis (Identik) */
        .btn-custom {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease-in-out;
        }

        /* Tombol Masuk (Solid Maroon) */
        .btn-masuk {
            background: linear-gradient(135deg, #7A1616 0%, #611010 100%);
            color: #FAF8ED;
            border: none;
            box-shadow: 0 4px 12px rgba(122, 22, 22, 0.2);
        }
        .btn-masuk:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(122, 22, 22, 0.3);
        }

        /* Tombol Register (Outline Maroon Menyeimbangkan Komposisi Visual) */
        .btn-register {
            background-color: transparent;
            color: #7A1616;
            border: 2px solid #7A1616;
        }
        .btn-register:hover {
            background-color: rgba(122, 22, 22, 0.05);
            transform: translateY(-1px);
        }

        .brand-logo {
            width: 55px;
            height: auto;
            margin-bottom: 0.8rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
        }
    </style>
</head>
<body>

    <div class="login-card mx-3">
        <div class="login-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Logo_UIN_Sutha.png" alt="Logo UIN" class="brand-logo" onerror="this.style.display='none'">
            <h5 class="fw-bold mb-1 tracking-wide" style="letter-spacing: 0.5px;">SISTEM LOGIN</h5>
            <p class="mb-0 text-white-50 small">Pelaporan Kerusakan Sarpras Kampus</p>
        </div>

       <div class="card-body p-4 p-sm-4.5">
    <form action="{{ route('login') }}" method="POST">
        @csrf 
        
        @if($errors->any())
        <div class="alert alert-danger p-2 small text-center mb-3">
            {{ $errors->first() }}
        </div>
    @endif
        
        <label class="form-label fw-semibold text-secondary small mb-1">NIM / NIP</label>
        <div class="form-group-custom">
            <input type="text" class="form-control form-control-custom" name="username" placeholder="Masukkan NIM atau NIP Anda" required autocomplete="off">
            <i class="bi bi-person-badge-fill"></i>
        </div>

        <label class="form-label fw-semibold text-secondary small mb-1">Password</label>
        <div class="form-group-custom">
            <input type="password" class="form-control form-control-custom" name="password" placeholder="Masukkan password" required>
            <i class="bi bi-lock-fill"></i>
        </div>

        <div class="mb-4"></div>

        <div class="d-flex flex-column gap-2.5">
            <button type="submit" class="btn-custom btn-masuk">
                <i class="bi bi-box-arrow-in-right fs-5"></i> Masuk Sistem
            </button>
            
            <a href="{{ route('register') }}" class="btn-custom btn-register text-decoration-none">
                <i class="bi bi-person-plus-fill fs-5"></i> Daftar Akun Baru
            </a>
        </div>
    </form>
</div>

        <div class="text-center pb-4 text-muted extra-small" style="font-size: 0.75rem;">
            &copy; 2026 Sistem Pelaporan Sarpras Kampus.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>