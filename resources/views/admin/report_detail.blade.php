@extends('admin.layouts.app')

@section('title', 'Detail Arsip Laporan - Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Detail Arsip Laporan</h3>
        <a href="{{ action([App\Http\Controllers\ReportController::class, 'adminCompletedReports']) }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-4 bg-white">
            <div class="row">
                
                <!-- KOLOM KIRI: Informasi Masalah -->
                <div class="col-md-6 border-end">
                    <h5 class="fw-bold mb-4 text-dark">Informasi Masalah</h5>
                    <table class="table table-borderless table-sm mb-0">
                        <tr><th width="150">Judul</th><td>: {{ $report->title }}</td></tr>
                        <tr><th>Pelapor</th><td>: {{ $report->user->name }}</td></tr>
                        <tr><th>Lokasi</th><td>: {{ $report->location }}</td></tr>
                        <tr><th>Kategori</th><td>: {{ $report->category }}</td></tr>
                        <tr>
                            <th>Status Akhir</th>
                            <td>: 
                                @if($report->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($report->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($report->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top;">Deskripsi</th>
                            <td>: <br><span class="text-muted">{{ $report->description }}</span></td>
                        </tr>
                    </table>
                </div>

                <!-- KOLOM KANUAN: Dokumentasi Bukti, Catatan Admin & Ulasan -->
                <div class="col-md-6 ps-4">
                    <h5 class="fw-bold mb-4 text-dark">Dokumentasi Bukti</h5>
                    
                    <!-- 1. Foto Berdampingan (Side-by-Side) -->
                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="fw-bold text-muted small mb-2">FOTO AWAL (KERUSAKAN):</label><br>
                            @if($report->image)
                                <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid rounded border shadow-sm w-100" alt="Bukti Awal" style="max-height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light p-3 rounded text-muted border small text-center d-flex align-items-center justify-content-center" style="height: 150px;">Tidak ada foto kerusakan.</div>
                            @endif
                        </div>
                        
                        <div class="col-6">
                            <label class="fw-bold text-success small mb-2">FOTO HASIL PERBAIKAN:</label><br>
                            @if($report->completed_image)
                                <img src="{{ asset('storage/' . $report->completed_image) }}" class="img-fluid rounded border shadow-sm w-100" alt="Bukti Selesai" style="max-height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light p-3 rounded text-muted border small text-center d-flex align-items-center justify-content-center text-secondary" style="height: 150px; background-color: #f8f9fa;">
                                    <span><i class="bi bi-image text-muted"></i> Tidak ada foto perbaikan.</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="text-muted my-4">

                    <!-- 2. Catatan Admin -->
                    <div class="mb-2">
                        <label class="fw-bold text-dark small mb-2">CATATAN / KETERANGAN ADMIN:</label>
                        @if($report->admin_note)
                            <div class="p-3 bg-light rounded border border-start-4 border-primary" style="border-left: 4px solid #0d6efd !important; background-color: #fdfdfd;">
                                <span class="text-dark fw-bold" style="white-space: pre-line;">{{ $report->admin_note }}</span>
                            </div>
                        @else
                            <div class="p-3 bg-light rounded border text-muted small text-center" style="font-style: italic;">
                                Tidak ada catatan tambahan dari admin untuk laporan ini.
                            </div>
                        @endif
                    </div>
                    
                    <!-- [BARU MUNCUL DISINI] 3. Tampilan Hasil Ulasan & Bintang Mahasiswa -->
                    @if($report->status == 'selesai')
                        <div class="mt-4 p-3 rounded border" style="background-color: #fffdf6; border-color: #ffeeba !important;">
                            <label class="fw-bold text-dark small mb-2">
                                <i class="bi bi-star-fill text-warning"></i> PENILAIAN & ULASAN MAHASISWA:
                            </label>
                            
                            @if($report->feedback)
                                <!-- Jika Mahasiswa Sudah Mengisi Feedback -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-warning me-2" style="font-size: 1.1rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $report->feedback->rating ? '' : 'text-muted opacity-25' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="small fw-bold text-secondary">({{ $report->feedback->rating }} / 5)</span>
                                </div>
                                <div class="p-2 bg-white rounded border shadow-sm">
                                    <p class="mb-0 small text-dark" style="font-style: italic;">
                                        "{{ $report->feedback->comment }}"
                                    </p>
                                </div>
                            @else
                                <!-- Jika Mahasiswa Belum Mengisi Feedback -->
                                <div class="p-2 bg-light rounded border text-muted small text-center" style="font-style: italic;">
                                    Pelapor belum memberikan penilaian atau ulasan untuk laporan ini.
                                </div>
                            @endif
                        </div>
                    @endif
                    
                </div> <!-- Selesai Kolom Kanan -->
                
            </div>
        </div>
    </div>
</div>
@endsection