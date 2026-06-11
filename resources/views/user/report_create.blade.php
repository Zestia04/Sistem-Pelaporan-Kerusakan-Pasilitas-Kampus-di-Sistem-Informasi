<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Baru - Sistem Pelaporan Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: '#800000',
                        ivory: '#FFFFF0',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-ivory font-sans text-gray-800 p-4 md:p-10">

    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-maroon uppercase tracking-tight">Form Pelaporan</h1>
                <p class="text-gray-500 font-bold uppercase tracking-wider text-xs mt-1">Sistem Pelaporan Sarpras Kampus</p>
            </div>
            <a href="{{ route('user.dashboard') }}" class="text-maroon hover:text-red-900 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-maroon/5 p-8 md:p-10">
            <form action="{{ route('user.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-maroon uppercase tracking-wider">Judul Laporan</label>
                    <input type="text" name="title" required placeholder="Contoh: Kerusakan Proyektor atau AC Mati"
                        class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-maroon focus:ring-4 focus:ring-maroon/10 transition-all">
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-black text-maroon uppercase tracking-wider">Kategori</label>
                        <select name="category" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-maroon focus:ring-4 focus:ring-maroon/10 transition-all">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sarana & Prasarana">Sarana & Prasarana</option>
                            <option value="Alat Laboratorium">Alat Laboratorium</option>
                            <option value="Fasilitas Umum">Fasilitas Umum</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-black text-maroon uppercase tracking-wider">Lokasi</label>
                        <input type="text" name="location" required placeholder="Contoh: Lab Komputer 1"
                            class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-maroon focus:ring-4 focus:ring-maroon/10 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-black text-maroon uppercase tracking-wider">Kepentingan</label>
                        <select name="priority" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-maroon focus:ring-4 focus:ring-maroon/10 transition-all">
                            <option value="rendah">Biasa (Rendah)</option>
                            <option value="sedang">Mendesak (Sedang)</option>
                            <option value="tinggi">Sangat Darurat (Tinggi)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-maroon uppercase tracking-wider">Deskripsi Kerusakan</label>
                    <textarea name="description" rows="5" required placeholder="Jelaskan detail kerusakan..."
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-maroon focus:ring-4 focus:ring-maroon/10 transition-all"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-maroon uppercase tracking-wider">Foto Bukti Kerusakan</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-maroon file:text-white hover:file:bg-red-900 cursor-pointer bg-gray-50 border border-gray-200 rounded-2xl">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Format: JPG, PNG, JPEG. Maksimal: 2MB.</p>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-maroon text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-maroon/20 hover:bg-red-900 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>