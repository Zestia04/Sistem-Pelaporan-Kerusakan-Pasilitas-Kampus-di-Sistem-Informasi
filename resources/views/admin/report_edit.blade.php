@extends('admin.layouts.app')

@section('title', 'Update Laporan Fasilitas')

@section('content')
<div class="container-fluid py-2">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-maroon-main mb-1">
                <i class="bi bi-pencil-square me-2"></i>Tindakan & Update Laporan
            </h4>
            <p class="text-muted small mb-0">Kelola status perbaikan dan perbarui progres sarpras kampus.</p>
        </div>
        
        @if(request('from') == 'dashboard')
            <a href="/admin/dashboard" class="btn btn-outline-secondary btn-sm rounded-3 px-3 py-2 fw-semibold shadow-sm bg-white text-dark border-muted">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        @else
            <a href="{{ action([App\Http\Controllers\ReportController::class, 'adminPendingReports']) }}" class="btn btn-outline-secondary btn-sm rounded-3 px-3 py-2 fw-semibold shadow-sm bg-white text-dark border-muted">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Semua Laporan
            </a>
        @endif
    </div>

    <div class="row g-4">
        
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 bg-white h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center">
                    <div class="p-2 rounded-3 me-3" style="background-color: #FAF8ED; color: #800000;">
                        <i class="bi bi-info-circle-fill fs-5"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Informasi Laporan</h5>
                </div>
                
                <div class="card-body px-4 pt-3">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="text-muted small d-block mb-1">Nama Pelapor</label>
                            <span class="fw-bold text-dark">{{ $report->user->name }}</span>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small d-block mb-1">Tanggal Masuk</label>
                            <span class="fw-semibold text-dark">
                                <i class="bi bi-calendar3 me-1 text-muted"></i> {{ $report->created_at->format('d M Y, H:i') }} WIB
                            </span>
                        </div>
                        <div class="col-12">
                            <hr class="my-1 opacity-25">
                        </div>
                        <div class="col-6">
                            <label class="text-muted small d-block mb-1">Judul Masalah</label>
                            <span class="fw-bold text-maroon-main text-capitalize fs-6">{{ $report->title }}</span>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small d-block mb-1">Lokasi Fasilitas</label>
                            <span class="fw-semibold text-dark">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $report->location }}
                            </span>
                        </div>
                        <div class="col-12">
                            <hr class="my-1 opacity-25">
                        </div>
                        <div class="col-12">
                            <label class="text-muted small d-block mb-1">Kategori</label>
                            <span class="badge px-3 py-2 rounded-pill fw-medium" style="background-color: #FAF8ED; color: #800000; border: 1px solid rgba(128,0,0,0.15);">
                                <i class="bi bi-bookmark-fill me-1"></i> {{ $report->category }}
                            </span>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small d-block mb-1">Deskripsi Kerusakan</label>
                            <div class="p-3 rounded-3 bg-light text-secondary border border-light-subtle" style="font-size: 0.9rem; min-height: 60px;">
                                {{ $report->description }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="text-muted small d-block mb-2 fw-medium">Foto Bukti Kerusakan (Awal):</label>
                        <div class="position-relative overflow-hidden rounded-3 border bg-light text-center p-2" style="min-height: 150px; display: flex; align-items: center; justify-content: center;">
                            @if($report->image)
                                <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid rounded-2" style="object-fit: contain; max-height: 180px; width: 100%;" alt="Foto Bukti Awal">
                            @else
                                <div class="text-muted small py-4">
                                    <i class="bi bi-image d-block fs-3 mb-1 text-secondary opacity-50"></i> Tidak ada foto awal
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 bg-white h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center">
                    <div class="p-2 rounded-3 me-3" style="background-color: rgba(128,0,0,0.05); color: #800000;">
                        <i class="bi bi-sliders fs-5"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Tindakan Admin & Progres</h5>
                </div>

                <div class="card-body px-4 pt-3">
                    <form action="{{ route('admin.report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold text-secondary small">Ubah Status Laporan</label>
                                <select class="form-select custom-focus rounded-3 py-2-5" name="status" id="status">
                                    <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                                    <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Dalam Proses Perbaikan</option>
                                    <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai Diperbaiki</option>
                                    <option value="ditolak" {{ $report->status == 'ditolak' ? 'selected' : '' }}>Ditolak (Tidak Valid)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">Tingkat Prioritas</label>
                                <select class="form-select custom-focus rounded-3 py-2-5" name="priority">
                                    <option value="rendah" {{ $report->priority == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="sedang" {{ $report->priority == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="tinggi" {{ $report->priority == 'tinggi' ? 'selected' : '' }}>Tinggi / Darurat</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">Upload Foto Progress <span class="text-muted font-monospace text-xs">(Opsional)</span></label>
                                <input type="file" class="form-control custom-focus rounded-3" name="progress_image" accept="image/*">
                                <div class="form-text text-muted extra-small">Unggah foto saat petugas sedang mengerjakannya.</div>
                                
                                @if($report->progress_image)
                                    <div class="mt-2 p-2 bg-light rounded border d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/' . $report->progress_image) }}" width="50" class="rounded border">
                                        <span class="text-success extra-small fw-medium"><i class="bi bi-check-circle-fill"></i> Foto progress terunggah</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-success small">Upload Foto Selesai <span class="text-muted font-monospace text-xs">(Opsional)</span></label>
                                <input type="file" class="form-control custom-focus rounded-3 border-success-subtle" name="completed_image" accept="image/*">
                                <div class="form-text text-muted extra-small">Unggah foto jika fasilitas sudah selesai diperbaiki sepenuhnya.</div>
                                
                                @if($report->completed_image)
                                    <div class="mt-2 p-2 bg-light rounded border d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/' . $report->completed_image) }}" width="50" class="rounded border">
                                        <span class="text-success extra-small fw-medium"><i class="bi bi-check-circle-fill"></i> Foto selesai terunggah</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="admin_note" class="form-label fw-semibold text-secondary small">Keterangan / Catatan Tambahan Admin</label>
                                <textarea class="form-control custom-focus rounded-3" id="admin_note" name="admin_note" rows="4" placeholder="Tulis alasan jika laporan ditolak, atau catatan mengenai perkembangan perbaikan fasilitas di sini...">{{ old('admin_note', $report->admin_note) }}</textarea>
                            </div>

                            <div class="col-12 mt-4 pt-2">
                                <button type="submit" class="btn btn-premium-submit w-100 rounded-3 py-2-5 fw-bold shadow">
                                    <i class="bi bi-cloud-arrow-up-fill me-2"></i> Simpan Perubahan & Update Laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .py-2-5 { padding-top: 0.6rem !important; padding-bottom: 0.6rem !important; }
    .extra-small { font-size: 0.75rem; }
    .text-xs { font-size: 0.8rem; }
    
    .custom-focus:focus {
        border-color: #800000 !important;
        box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.15) !important;
    }
    
    .btn-premium-submit {
        background: linear-gradient(135deg, #800000 0%, #4A0000 100%) !important;
        color: #FAF8ED !important;
        border: none !important;
        transition: all 0.3s ease;
    }
    .btn-premium-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 0, 0.3) !important;
        opacity: 0.95;
    }
    .btn-premium-submit:active {
        transform: translateY(0);
    }
</style>
@endsection