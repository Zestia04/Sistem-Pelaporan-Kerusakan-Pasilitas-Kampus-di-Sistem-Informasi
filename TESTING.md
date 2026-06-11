# Dokumentasi Pengujian Sistem

## A. Skenario Positif (Positive Test Cases)
[cite_start]Pengujian untuk seluruh alur utama web pelaporan kerusakan fasilitas sesuai prosedur yang benar[cite: 1, 2].

| ID Test Case | Modul | Deskripsi Pengujian | Langkah-langkah & Input | Hasil yang Diharapkan |
| :--- | :--- | :--- | :--- | :--- |
| TC-WEB-POS-01 | Autentikasi | Login User | [cite_start]Input NIM/Email & password valid, klik "Login"[cite: 3]. | [cite_start]Masuk ke Dashboard User[cite: 3]. |
| TC-WEB-POS-02 | Pelaporan | Kirim laporan | [cite_start]Isi form & unggah foto .jpg, klik "Kirim"[cite: 3]. | [cite_start]Status Pending, notifikasi sukses[cite: 3]. |
| TC-WEB-POS-03 | Tracking | Memantau status | [cite_start]Klik menu "Tracking Laporan"[cite: 3]. | [cite_start]Status laporan sesuai[cite: 3]. |
| TC-WEB-POS-04 | Admin | Verifikasi Admin | [cite_start]Ubah status ke "Terverifikasi", prioritas "Tinggi"[cite: 3]. | [cite_start]Ter-update di database[cite: 3]. |
| TC-WEB-POS-05 | Admin | Selesai laporan | [cite_start]Ubah status ke "Selesai" & upload foto perbaikan[cite: 3]. | [cite_start]Status selesai, tampil di dashboard[cite: 3]. |
| TC-WEB-POS-06 | Autentikasi | Logout sistem | [cite_start]Klik "Logout"[cite: 3]. | [cite_start]Sesi dihapus, kembali ke Login[cite: 3]. |

## B. Skenario Negatif (Negative Test Cases)
[cite_start]Pengujian keamanan dan validasi agar sistem tidak *crash* atau diretas[cite: 4, 5].

| ID Test Case | Modul | Deskripsi Pengujian | Langkah-langkah & Input | Hasil yang Diharapkan |
| :--- | :--- | :--- | :--- | :--- |
| TC-WEB-NEG-01 | Keamanan | Bypass URL | [cite_start]Coba akses URL Admin setelah logout[cite: 6]. | [cite_start]Redirect ke Login[cite: 6]. |
| TC-WEB-NEG-02 | Autentikasi | Kredensial salah | [cite_start]Input NIM/password salah[cite: 6]. | [cite_start]Pesan error "Login Gagal"[cite: 6]. |
| TC-WEB-NEG-03 | Pelaporan | Form kosong | [cite_start]Klik "Kirim" dengan form kosong[cite: 6]. | [cite_start]Peringatan field wajib diisi[cite: 6]. |
| TC-WEB-NEG-04 | Pelaporan | Ekstensi file | [cite_start]Unggah file .php/.js/.exe[cite: 6]. | [cite_start]Validasi memblokir file[cite: 6]. |
| TC-WEB-NEG-05 | Admin | Penolakan | [cite_start]Klik "Ditolak" tanpa alasan[cite: 6]. | [cite_start]Wajib mengisi alasan[cite: 6]. |
| TC-WEB-NEG-06 | Keamanan | Uji XSS | [cite_start]Input script di deskripsi[cite: 6]. | [cite_start]Script tidak tereksekusi[cite: 6]. |

## C. Skenario Edge (Boundary Test Cases)
[cite_start]Pengujian nilai batas untuk memastikan tidak ada *bug* pada limit parameter[cite: 7, 8].

| ID Test Case | Modul | Deskripsi Pengujian | Langkah-langkah & Input | Hasil yang Diharapkan |
| :--- | :--- | :--- | :--- | :--- |
| TC-WEB-EDG-01 | Pelaporan | Min. deskripsi | [cite_start]Input tepat 50 karakter[cite: 9]. | [cite_start]Lolos validasi[cite: 9]. |
| TC-WEB-EDG-02 | Pelaporan | Bawah batas min. | [cite_start]Input tepat 49 karakter[cite: 9]. | [cite_start]Ditolak[cite: 9]. |
| TC-WEB-EDG-03 | Pelaporan | Batas maks. foto | [cite_start]Upload file tepat 5 MB[cite: 9]. | [cite_start]Sukses, < 5 detik[cite: 9]. |
| TC-WEB-EDG-04 | Pelaporan | Lebih batas maks. | [cite_start]Upload file 5,1 MB[cite: 9]. | [cite_start]Ditolak sistem[cite: 9]. |
| TC-WEB-EDG-05 | Autentikasi | Session Timeout | [cite_start]Idle 30 menit 1 detik[cite: 9]. | [cite_start]Sesi expired[cite: 9]. |
| TC-WEB-EDG-06 | Pelaporan | Batas judul | [cite_start]Input tepat 255 karakter[cite: 9]. | [cite_start]Disimpan, tidak terpotong[cite: 9]. |
|.
.|