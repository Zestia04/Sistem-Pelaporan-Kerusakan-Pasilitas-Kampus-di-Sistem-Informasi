<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN UTAMA / LANDING PAGE ---
Route::get('/', function () {
    return view('informasi');
})->name('informasi');


// --- 2. GUEST AREA (Halaman khusus pengunjung yang BELUM LOGIN) ---
Route::middleware('guest')->group(function () {
    
   // Route untuk menampilkan form (GET)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Route untuk memproses data dari form (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    // Alur Login menggunakan identity_number (NIM/NIP)
   // Jalur untuk menampilkan halaman login
// Jalur untuk menampilkan halaman login (Lokasi: resources/views/auth/login.blade.php)
// 1. Jalur untuk MENAMPILKAN halaman login (Sudah ada)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 2. TAMBAHKAN INI: Jalur untuk MEMPROSES data login saat tombol diklik
Route::post('/login', [AuthController::class, 'login']);
});


// --- 3. AUTH AREA (Halaman khusus yang SUDAH LOGIN) ---
Route::middleware('auth')->group(function () {

    // Proses Logout (Hanya bisa lewat POST untuk keamanan)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- AREA USER / PELAPOR (Mahasiswa & Dosen) ---
    Route::prefix('user')->name('user.')->group(function () {
        
        // Dashboard: Melihat histori laporan pribadi
        Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
        
        // Fitur Melapor: Menampilkan Form & Proses Simpan
        Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
        Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
        
        // Detail Laporan
        Route::get('/report/{id}', [ReportController::class, 'show'])->name('report.show');

        // Ganti route feedback lama di web.php dengan ini
    Route::post('/feedback/{id}', function (\Illuminate\Http\Request $request, $id) {
        // 1. Validasi input dari form
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // 2. Simpan ke database tabel feedbacks
        \App\Models\Feedback::create([
            'report_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

    // 3. Kembali ke halaman dengan pesan sukses asli
    return back()->with('success', 'Terima kasih! Ulasan dan rating Anda berhasil disimpan.');
})->name('feedback.store');
    });

    // --- AREA ADMIN (Petugas Sarana Prasarana / IT) ---
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // 1. Dashboard Admin: Melihat statistik laporan
        Route::get('/dashboard', [ReportController::class, 'adminIndex'])->name('dashboard');
        
        // 2. Semua Laporan (Hanya Pending & Proses + Fitur Search)
        Route::get('/reports/pending', [ReportController::class, 'adminPendingReports'])->name('reports.pending');
        
        // 3. Laporan Selesai (Hanya yang sudah berstatus selesai)
        Route::get('/reports/completed', [ReportController::class, 'adminCompletedReports'])->name('reports.completed');
        
        // Menampilkan Halaman Form Edit (Unggah foto progress & selesai)
        Route::get('/report/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
        
        // Memproses Update Data, Status, dan Foto Bukti dari halaman edit
        Route::put('/report/{id}', [ReportController::class, 'update'])->name('report.update');
        
        // Detail Laporan untuk Admin
        Route::get('/report/{id}', [ReportController::class, 'adminShow'])->name('report.show');
    });
});