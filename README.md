# SIORMA (Sistem Informasi Organisasi Mahasiswa STTC)

SIORMA adalah platform berbasis web terintegrasi yang dirancang sebagai pusat informasi resmi bagi seluruh organisasi mahasiswa (Ormawa) di Sekolah Tinggi Teknologi Cipasung (STTC). Aplikasi ini bertujuan untuk mengatasi masalah fragmentasi informasi dengan menyatukan direktori, visi-misi, struktur kepengurusan, serta pelaporan dokumentasi kegiatan dalam satu wadah yang terpusat, aman, dan mudah diakses oleh publik.

## 🚀 Fitur Utama

- **Sentralisasi Informasi Ormawa**: Direktori terpusat untuk profil, visi-misi, struktur organisasi, dan program kerja seluruh Ormawa STTC.
- **Aksesibilitas Publik**: Pencarian dan penyaringan kategori ormawa yang mudah tanpa mengharuskan pengguna umum melakukan login.
- **Manajemen Data Terstruktur**: Dasbor admin khusus bagi pengurus ormawa untuk memperbarui data dan dokumentasi kegiatan secara real-time.
- **Keamanan Terautentikasi**: Sistem pembatasan hak akses yang memastikan manipulasi data hanya dapat dilakukan oleh pihak yang berwenang.

## 🛠️ Teknologi yang Digunakan

- **Backend / Web Framework**: CodeIgniter 4 (PHP Full-Stack Framework)
- **Frontend / Desain**: HTML5 & Vanilla CSS (Kustom Tanpa Framework CSS)
- **Database**: MySQL / MariaDB
- **Ikon & Tipografi**: FontAwesome Icons & Google Fonts (Inter)

## 💻 Persyaratan Sistem

Untuk menjalankan aplikasi ini secara lokal, pastikan perangkat Anda memenuhi syarat berikut:
- PHP versi 8.2 atau yang lebih baru
- Ekstensi PHP diaktifkan: `intl`, `mbstring`, `json`, `mysqlnd`
- Web Server (XAMPP / Apache lokal)

## 🔧 Cara Instalasi di Lokal (Development)

1. **Clone Repositori**
```bash
   git clone https://github.com/lutfiismail47/siorma.git
```

2. **Konfigurasi Environment**
- Salin file `env` menjadi `.env`.
- Ubah `CI_ENVIRONMENT` menjadi `development`.
- Sesuaikan konfigurasi `database.default.hostname`, `database.default.database`, `database.default.username`, dan `database.default.password`.

3. **Impor Database**
- Buat database baru bernama siorma di phpMyAdmin.
- Impor file SQL proyek (jika ada di dalam folder) ke database tersebut.

4. **Jalankan Aplikasi**
Arahkan web server lokal (Apache) Anda ke folder `public/` di dalam proyek ini, atau jalankan perintah bawaan jika diperlukan.

*Proyek ini dikembangkan sebagai bagian dari tugas akademis Sekolah Tinggi Teknologi Cipasung (STTC).*