<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Pelaporan Kerusakan Fasilitas Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: '#800000',
                        ivory: '#FFFFF0',
                    },
                }
            }
        }
    </script>
    <style>
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(128, 0, 0, 0.06) 0%, transparent 60%);
        }
        .card-shadow {
            box-shadow: 0 40px 80px -15px rgba(128, 0, 0, 0.12), 0 20px 40px -20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-ivory font-sans text-gray-800 hero-gradient min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute -z-10 w-[500px] h-[500px] bg-maroon/5 rounded-full blur-3xl -top-40 -left-40"></div>
    <div class="absolute -z-10 w-[600px] h-[600px] bg-maroon/5 rounded-full blur-3xl -bottom-40 -right-40"></div>

    <div class="max-w-[480px] w-full bg-white rounded-[2.5rem] card-shadow border border-maroon/5 p-8 md:p-10 z-10 transition-all duration-300 hover:scale-[1.01]">
        
        <div class="text-center mb-6">
            <div class="flex justify-center items-center gap-3 mb-4">
                <img src="{{ asset('img/LOGO UIN JAMBI.png') }}" alt="Logo UIN" class="h-14 shadow-sm rounded-full bg-white p-0.5 border border-maroon/10">
                <img src="{{ asset('img/logo-prodi.jpeg') }}" alt="Logo Prodi" class="h-14 shadow-sm rounded-full bg-white p-0.5 border border-maroon/10">
            </div>
            <h3 class="text-maroon font-black text-2xl tracking-tight uppercase">DAFTAR AKUN</h3>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mt-1">Sistem Informasi UIN STS Jambi</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            
            <div class="space-y-1.5">
                <label class="text-xs font-black text-maroon uppercase tracking-wider block">Nama Lengkap</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-maroon transition-colors">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <input type="text" name="name" required autocomplete="off"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-maroon focus:bg-white focus:ring-4 focus:ring-maroon/10 transition-all"
                        placeholder="Masukkan Nama Lengkap Anda">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-maroon uppercase tracking-wider block">NIM / NIP</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-maroon transition-colors">
                        <i class="fas fa-id-card text-sm"></i>
                    </div>
                    <input type="text" name="username" required autocomplete="off"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-maroon focus:bg-white focus:ring-4 focus:ring-maroon/10 transition-all"
                        placeholder="Masukkan NIM atau NIP">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-maroon uppercase tracking-wider block">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-maroon transition-colors">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <input type="password" name="password" required
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-maroon focus:bg-white focus:ring-4 focus:ring-maroon/10 transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-maroon uppercase tracking-wider block">Konfirmasi Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-maroon transition-colors">
                        <i class="fas fa-check-double text-sm"></i>
                    </div>
                    <input type="password" name="password_confirmation" required
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-maroon focus:bg-white focus:ring-4 focus:ring-maroon/10 transition-all"
                        placeholder="Ulangi password anda">
                </div>
            </div>

            <div class="pt-4 space-y-3">
                <button type="submit" 
                    class="w-full bg-maroon text-white py-3.5 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg hover:bg-red-900 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus text-base"></i> Daftar Sekarang
                </button>

                <a href="/" 
                    class="w-full bg-white border-2 border-maroon/20 text-maroon py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-maroon/5 hover:border-maroon transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left text-xs"></i> Kembali ke Beranda
                </a>
            </div>

        </form>

        <div class="text-center mt-6 pt-5 border-t border-gray-100">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-tight">
                Sudah punya akun? 
                <a href="/login" class="text-maroon font-black hover:text-red-700 transition-colors ml-1">Login Di Sini</a>
            </p>
        </div>

    </div>

</body>
</html>