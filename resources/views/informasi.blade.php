<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelaporan Kerusakan Fasilitas Kampus - UIN STS Jambi</title>
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
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Mencegah scroll agar pas satu layar */
        }
        .hero-gradient {
            background: radial-gradient(circle at 20% 50%, rgba(128, 0, 0, 0.05) 0%, transparent 50%);
        }
        .image-shadow {
            box-shadow: 0 50px 100px -20px rgba(128, 0, 0, 0.25), 0 30px 60px -30px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-ivory font-sans text-gray-800 hero-gradient">

    <nav class="absolute top-0 w-full flex justify-between items-center px-12 py-6 z-50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/LOGO UIN JAMBI.png') }}" alt="Logo" class="h-12 shadow-sm rounded-full">
            <img src="{{ asset('img/logo-prodi.jpeg') }}" alt="Logo" class="h-12 shadow-sm rounded-full">
            <span class="font-black text-maroon text-xl tracking-tight uppercase"> SI UIN STS Jambi</span>
        </div>
  <div class="flex items-center gap-4">
    <a href="{{ route('login') }}" class="px-6 py-2 text-maroon font-bold hover:text-red-700 transition-all uppercase text-sm">Login</a>
    <a href="/register" class="px-8 py-2.5 bg-maroon text-white font-bold rounded-full shadow-lg hover:bg-red-900 transition-all uppercase text-sm tracking-wide">Register</a>
</div>
    </nav>

    <main class="h-screen w-full flex items-center px-12 lg:px-24">
        <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div class="space-y-8 animate-fade-in-left">
                <div class="space-y-2">
                    <h2 class="text-maroon font-black text-5xl lg:text-6xl leading-[1.1] uppercase drop-shadow-sm">
                        Sistem Pelaporan <br>
                        <span class="text-red-600">Kerusakan</span> Fasilitas <br>
                        Kampus
                    </h2>
                    <p class="text-maroon text-2xl lg:text-3xl font-bold italic border-l-4 border-maroon pl-4 mt-4">
                        Lantai 6 Sistem Informasi
                    </p>
                </div>

                <p class="text-gray-600 text-lg font-medium max-w-lg leading-relaxed uppercase tracking-tight opacity-80">
                    Memudahkan perbaikan dan pemeliharaan sarana prasarana demi kenyamanan akademik yang maksimal.
                </p>

                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-maroon font-bold">
                        <div class="w-6 h-6 bg-maroon text-white rounded-full flex items-center justify-center text-[10px]">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-sm">PELAPORAN KERUSAKAN CEPAT & MUDAH</span>
                    </div>
                    <div class="flex items-center gap-3 text-maroon font-bold">
                        <div class="w-6 h-6 bg-maroon text-white rounded-full flex items-center justify-center text-[10px]">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-sm">PANTAU STATUS PERBAIKAN REAL-TIME</span>
                    </div>
                    <div class="flex items-center gap-3 text-maroon font-bold">
                        <div class="w-6 h-6 bg-maroon text-white rounded-full flex items-center justify-center text-[10px]">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-sm">KATEGORI FASILITAS TERSTRUKTUR</span>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="/register" class="inline-block bg-maroon text-white px-12 py-5 rounded-xl font-black text-lg shadow-2xl hover:bg-red-900 transition-all hover:-translate-y-2 uppercase tracking-widest">
                        Daftar Sekarang
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center lg:justify-end items-center group">
                <div class="absolute -z-10 w-[110%] h-[110%] bg-maroon/5 rounded-full blur-3xl group-hover:bg-maroon/10 transition-all duration-700"></div>
                
                <div class="relative p-4 bg-white rounded-[3rem] image-shadow transition-transform duration-500 group-hover:scale-[1.02]">
                    <div class="overflow-hidden rounded-[2.2rem] border-[10px] border-maroon">
                        <img src="{{ asset('img/GEDUNG-UIN.png') }}" 
                             alt="Gedung UIN STS Jambi" 
                             class="w-[450px] lg:w-[550px] aspect-[4/3] object-cover transition-transform duration-1000 group-hover:scale-110">
                    </div>

                    <div class="absolute -top-6 -right-6 bg-white p-5 rounded-2xl shadow-2xl border border-gray-100 flex flex-col items-center gap-2 animate-bounce-slow">
                        <div class="w-12 h-12 bg-maroon text-white rounded-full flex items-center justify-center">
                            <i class="fas fa-tools text-xl"></i>
                        </div>
                        <span class="text-[10px] font-black text-maroon uppercase tracking-tighter">Quick Report</span>
                    </div>
                </div>

               
            </div>
        </div>
    </main>

    <footer class="absolute bottom-0 w-full bg-white/60 backdrop-blur-md border-t border-maroon/10 py-6 z-50">
        <div class="container mx-auto px-12 lg:px-24 flex flex-col md:flex-row justify-between items-center gap-6">
            
            <div class="flex items-center gap-4">
                <div class="bg-maroon text-white p-2 rounded-lg shadow-md">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-maroon uppercase tracking-widest leading-none">Sistem Informasi</p>
                    <p class="text-xs font-bold text-gray-500 mt-1">&copy; 2026 UIN STS JAMBI.</p>
                </div>
            </div>

            <div class="flex items-center gap-3 bg-white/80 px-5 py-2 rounded-full shadow-sm border border-maroon/5">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-xs animate-pulse">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="text-left">
                    <p class="text-[9px] font-black text-gray-400 uppercase leading-none">Hubungi Kami</p>
                    <p class="text-xs font-black text-maroon">+62 812-3456-7890</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <p class="text-[10px] font-black text-maroon uppercase tracking-tighter mr-2 hidden lg:block">Ikuti Kami:</p>
                <div class="flex gap-2">
                    <a href="#" class="w-10 h-10 bg-white border border-maroon/10 rounded-xl flex items-center justify-center text-maroon hover:bg-maroon hover:text-white transition-all duration-300 shadow-sm hover:-translate-y-1">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white border border-maroon/10 rounded-xl flex items-center justify-center text-maroon hover:bg-maroon hover:text-white transition-all duration-300 shadow-sm hover:-translate-y-1">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white border border-maroon/10 rounded-xl flex items-center justify-center text-maroon hover:bg-maroon hover:text-white transition-all duration-300 shadow-sm hover:-translate-y-1">
                        <i class="fab fa-youtube text-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </footer>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 4s ease-in-out infinite;
        }
        @keyframes fade-in-left {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-left {
            animation: fade-in-left 1s ease-out forwards;
        }
    </style>
</body>
</html>