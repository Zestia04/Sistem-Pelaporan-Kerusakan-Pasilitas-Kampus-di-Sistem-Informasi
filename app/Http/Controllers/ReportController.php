<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // ==========================================
    // AREA MAHASISWA (USER)
    // ==========================================
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard', compact('reports'));
    }

    public function create()
    {
        return view('user.report_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'location' => 'required',
            'priority' => 'required|in:rendah,sedang,tinggi',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('report_images', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => 'pending',
            'priority' => $request->priority,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil terkirim!');
    }

    // ==========================================
    // AREA ADMIN SARPRAS
    // ==========================================
    
    // 1. Dashboard Admin (DIUBAH: Ditambahkan pengambilan data 5 laporan terbaru)
    public function adminIndex()
    {
        $total = Report::count();
        $pending = Report::where('status', 'pending')->count();
        $proses = Report::where('status', 'proses')->count();
        $selesai = Report::where('status', 'selesai')->count();
        
        // Mengambil 5 data laporan terbaru beserta relasi usernya
        $latest_reports = Report::with('user')
                                ->latest()
                                ->take(5)
                                ->get();
        
        return view('admin.dashboard', compact('total', 'pending', 'proses', 'selesai', 'latest_reports'));
    }

// 2. Halaman Semua Laporan (DIUBAH: Menyembunyikan status selesai & ditolak)
    public function adminPendingReports(Request $request)
    {
        // PERUBAHAN DI SINI: Menggunakan whereNotIn agar status 'selesai' dan 'ditolak' tidak muncul
        $query = Report::with('user')->whereNotIn('status', ['selesai', 'ditolak']);

        // Filter: Pencarian Judul atau Nama Pelapor - TETAP
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter: Status - TETAP
        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        // Filter: Prioritas - TETAP
        if ($request->filled('priority') && $request->priority != 'semua') {
            $query->where('priority', $request->priority);
        }

        // Filter: Kategori - TETAP
        if ($request->filled('category') && $request->category != 'semua') {
            $query->where('category', $request->category);
        }

        $reports = $query->latest()->get();
        return view('admin.reports_pending', compact('reports'));
    }

    // 3. Halaman Laporan Selesai (DIUBAH: Menampilkan status selesai DAN ditolak)
    public function adminCompletedReports()
    {
        // PERUBAHAN DI SINI: Menggunakan whereIn agar menampung data 'selesai' dan 'ditolak' sekaligus
        $reports = Report::with('user')->whereIn('status', ['selesai', 'ditolak'])->latest()->get();
        return view('admin.reports_completed', compact('reports'));
    }

    // 4. Menampilkan Detail Laporan (Untuk laporan selesai) - TETAP
    public function adminShow(int $id)
    {
        $report = Report::findOrFail($id);
        return view('admin.report_detail', compact('report'));
    }

    // Menampilkan halaman form edit - TETAP
    public function edit(int $id)
    {
        $report = Report::findOrFail($id);
        return view('admin.report_edit', compact('report'));
    }

   // Memproses form update dari halaman edit - DIUBAH (Ditambahkan Catatan Admin)
    public function update(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        $request->validate([
            'status'          => 'required|in:pending,proses,selesai,ditolak',
            'priority'        => 'required|in:rendah,sedang,tinggi',
            'admin_note'      => 'nullable|string', // 1. TAMBAHAN: Validasi input catatan admin
            'progress_image'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'completed_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload foto saat diproses (jika ada) - TETAP
        if ($request->hasFile('progress_image')) {
            // Hapus foto lama jika ada
            if ($report->progress_image) {
                Storage::disk('public')->delete($report->progress_image);
            }
            $report->progress_image = $request->file('progress_image')->store('report_progress', 'public');
        }

        // Upload foto saat selesai (jika ada) - TETAP
        if ($request->hasFile('completed_image')) {
            // Hapus foto lama jika ada
            if ($report->completed_image) {
                Storage::disk('public')->delete($report->completed_image);
            }
            $report->completed_image = $request->file('completed_image')->store('report_completed', 'public');
        }

        // Update status, prioritas, dan catatan admin
        $report->status = $request->status;
        $report->priority = $request->priority;
        $report->admin_note = $request->admin_note; // 2. TAMBAHAN: Menyimpan string catatan ke database
        $report->save();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil diperbarui dan foto bukti telah disimpan!');
    }
}