# Dokumentasi Pengujian Sistem Pelaporan

<<<<<<< HEAD
## A. Skenario Positif (Positive Test Cases)
<<<<<<< HEAD
Menguji seluruh alur utama web saat pengguna (User maupun Admin) menggunakan sistem sesuai dengan prosedur yang benar.
=======
[cite_start]Pengujian untuk seluruh alur utama web pelaporan kerusakan fasilitas sesuai prosedur yang benar[cite: 1, 2].
=======
## A. Skenario Positif(Positive Test Cases)
[cite_start]Pengujian untuk seluruh alur utama web sesuai prosedur yang benar[cite: 1, 2].
>>>>>>> 13ac7a5 (tes pull)


| ID Test Case | Modul | Skenario Pengujian | Hasil yang Diharapkan | Gambar Bukti |
| :--- | :--- | :--- | :--- | :--- |
| TC-WEB-POS-01 | Autentikasi | Login sebagai User (Mahasiswa/Dosen) | Sesi dibuat, masuk ke Dashboard User. | ![Bukti TC-POS-01](./assets/login.png)(./assets/dasboard-user.png) |
| TC-WEB-POS-02 | Pelaporan | Mengirim laporan kerusakan | Laporan tersimpan, status Pending. | ![Bukti TC-POS-02](./assets/laporan.png) |
| TC-WEB-POS-03 | Tracking | Memantau riwayat & status | Menampilkan laporan dengan status sesuai. | ![Bukti TC-POS-03](./assets/traking.png) |
| TC-WEB-POS-04 | Admin | Verifikasi dan atur prioritas | Status & prioritas ter-update di database. | ![Bukti TC-POS-04](./assets/cari.png) |
| TC-WEB-POS-05 | Admin | Penyelesaian penanganan laporan | Status Selesai, user melihat perubahan. | ![Bukti TC-POS-05](./assets/selesai.png) |
| TC-WEB-POS-06 | Autentikasi | Logout sistem dengan aman | Sesi aktif dihapus, kembali ke Login. | ![Bukti TC-POS-06](./assets/logout.png) |

---

<<<<<<< HEAD
## B. Skenario Negatif (Negative Test Cases)
Menguji keamanan dan validasi untuk memastikan sistem tidak *crash* atau diretas saat menerima input yang dilarang.
=======
## B. Skenario Negatif(Negative Test Cases)
[cite_start]Pengujian keamanan dan validasi agar sistem tidak *crash* atau diretas[cite: 4, 5].


| ID Test Case | Modul | Skenario Pengujian | Hasil yang Diharapkan | Gambar Bukti |
| :--- | :--- | :--- | :--- | :--- |
| TC-WEB-NEG-01 | Keamanan | Bypass URL halaman Admin | Sistem memblokir & redirect ke Login. | ![Bukti TC-NEG-01](./assets/login.png) |
| TC-WEB-NEG-02 | Autentikasi | Login dengan kredensial salah | Tampil pesan "Login Gagal". | ![Bukti TC-NEG-02](./assets/gagallog.png) |
| TC-WEB-NEG-03 | Pelaporan | Submit form dengan data kosong | Sistem menahan form, muncul peringatan. | ![Bukti TC-NEG-03](./assets/warning.png) |
| TC-WEB-NEG-04 | Pelaporan | Upload file ekstensi berbahaya | Validasi gagal mengunggah file selain jpg/png. kembali ke form | ![Bukti TC-NEG-04](./assets/laporan.png) |
| TC-WEB-NEG-05 | Admin | Penolakan laporan | Harus Mengisi keterangan penolakan. | ![Bukti TC-NEG-05](./assets/tolak.png) |
| TC-WEB-NEG-06 | Keamanan | Uji kerentanan XSS | Script disimpan sebagai teks biasa. | ![Bukti TC-NEG-06](./assets/cattntolak.png) |

---

<<<<<<< HEAD
## C. Skenario Edge (Boundary Test Cases)
Pengujian nilai batas untuk memastikan tidak ada *bug* pada limit parameter sistem.
=======
## C. Skenario Edge(Boundary Test Cases)
[cite_start]Pengujian nilai batas untuk memastikan tidak ada *bug* pada limit parameter[cite: 7, 8].


| ID Test Case | Modul | Skenario Pengujian | Hasil yang Diharapkan | Gambar Bukti |
| :--- | :--- | :--- | :--- | :--- |
<<<<<<< HEAD
| TC-WEB-EDG-01 | Pelaporan | Batas minimal deskripsi (50 char) | Lolos validasi & berhasil dikirim. | ![Bukti TC-EDG-01](./assets/riwayat-user.png) |
| TC-WEB-EDG-02 | Pelaporan | Kurang dari batas minimal (49 char) | Sistem menolak pengiriman kembali ke form pelaporan kosong. | ![Bukti TC-EDG-02](./assets/laporan.png) |
| TC-WEB-EDG-03 | Pelaporan | Batas maksimal ukuran foto (2 MB) | Upload sukses (response < 5 detik). | ![Bukti TC-EDG-03](./assets/riwayat-user.png) |
| TC-WEB-EDG-04 | Pelaporan | Melebihi batas maksimal (2,1 MB) | Sistem menolak pengiriman kembali ke form pelaporan kosong. | ![Bukti TC-EDG-04](./assets/laporan.png) |
| TC-WEB-EDG-05 | Autentikasi | Batas kadaluarsa sesi (30m 1s) | Sesi expired ke halaman Leanding page. | ![Bukti TC-EDG-05](./assets/leanding-page.png) |
| TC-WEB-EDG-06 | Pelaporan | Batas maksimal Judul (255 char) | Data tersimpan, teks tidak terpotong. | ![Bukti TC-EDG-06](./assets/proses.png) |
=======

