# 📚 ZeroStudios Book

[![CodeIgniter](https://img.shields.io/badge/Framework-CodeIgniter%203-EE4326?style=flat-square&logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4%20%7C%208.1-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/Database-MySQL%20%2F%20MariaDB-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/UI-Bootstrap%20%26%20MDB-563D7C?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](license.txt)

**ZeroStudios Book** adalah platform berbasis web untuk katalog buku, perpustakaan digital/showcase karya literatur, ulasan (review), dan portal blog artikel interaktif. Proyek ini dibangun menggunakan framework **CodeIgniter 3** dengan arsitektur MVC (Model-View-Controller) serta antarmuka modern bertema *dark aesthetic*.

Dilengkapi dengan sistem manajemen konten (CMS) penuh di panel admin dan hak akses multi-role (Administrator, Penulis, Pengguna Umum).

---

## 🌟 Fitur Utama

### 📖 1. Portal Pengguna (Frontend)
- **Katalog & Showcase Buku:** Eksplorasi koleksi buku dengan visual menarik, sinopsis mendalam, informasi penulis, dan genre.
- **Kategori & Genre Dinamis:** Filter buku berdasarkan genre (Sci-Fi, Misteri, Romansa, Fantasi, dsb.).
- **Portal Artikel & Blog:** Baca ulasan literatur, rilis terbaru, dan artikel berita dengan navigasi pagination.
- **Pencarian Cerdas (Search Bar):** Fitur pencarian instan untuk menemukan buku maupun artikel berdasarkan judul atau kata kunci.
- **Sistem Komentar & Diskusi:** Komentar interaktif pada halaman detail buku maupun artikel bagi pengguna terdaftar.
- **Halaman Statis (Custom Pages):** Halaman profil studio, ketentuan layanan, dsb., yang dapat diatur dinamis.
- **Manajemen Profil Pengguna:**
  - Registrasi & Login pengguna.
  - Perbarui informasi profil (nama, email, username).
  - Upload & ganti foto avatar pengguna.
- **Antarmuka Responsif & Modern:**
  - Desain *Dark Modern Aesthetic* yang nyaman di mata.
  - Hero Slider & Carousel menggunakan Owl Carousel.
  - Mobile-friendly dengan integrasi SlickNav.
  - Video/Media Player terintegrasi via Plyr.

---

### 🛠️ 2. Panel Manajemen (Admin & Penulis Dashboard)
- **Dashboard Ringkasan:** Statistik jumlah buku, artikel terpublikasi, total pengguna terdaftar, serta aktivitas komentar.
- **Manajemen Buku (CRUD Buku):** Tambah, sunting, ubah cover/sampul, atur genre, dan hapus data buku.
- **Manajemen Genre (CRUD Genre):** Pengelolaan genre buku lengkap dengan pembuatan slug URL otomatis.
- **Manajemen Layanan / Service Showcase:** Atur status publikasi buku (Draft / Publish) dan informasi pendukung.
- **Manajemen Artikel & Berita (CRUD Artikel):**
  - Pembuatan artikel dengan Rich Text Editor (Summernote / TinyMCE).
  - Upload gambar sampul artikel.
  - Kategorisasi dan status penerbitan (*Draft* atau *Publish*).
- **Manajemen Kategori Artikel:** Tambah dan ubah kategori untuk artikel blog.
- **Manajemen Halaman Statis (Pages):** Tambah, sunting, dan hapus halaman dinamis dengan slug custom.
- **Moderasi Komentar:** Pantau dan hapus komentar yang tidak sesuai.
- **Manajemen Pengguna (User Management):**
  - Kelola status akun pengguna (Aktif/Nonaktif).
  - Tambah akun admin, penulis, atau pengguna baru.
  - Lihat detail profil pengguna terdaftar.
- **Pengaturan Website (Branding & SEO):**
  - Atur nama website, deskripsi meta, dan favicon/logo.
  - Integrasi tautan sosial media (Facebook, Twitter/X, Instagram, GitHub).
- **Keamanan Akun:** Fitur ubah kata sandi, proteksi session, dan autentikasi multi-level.

---

### 🔐 3. Hak Akses (Role-Based Access Control)
1. **Administrator:** Kontrol penuh atas seluruh konten, manajemen pengguna, pengaturan web, dan moderasi.
2. **Penulis (Author):** Membuat dan mengelola artikel serta karya buku.
3. **Pengguna (User):** Menjelajah katalog, membaca blog, memberikan komentar, dan mengelola profil pribadi.

---

## 💻 Tech Stack

- **Backend:** PHP (>= 7.4 / 8.x kompatibel)
- **Framework:** [CodeIgniter 3.x](https://codeigniter.com/)
- **Database:** MySQL / MariaDB
- **Frontend & UI:**
  - Bootstrap 4 & Material Design for Bootstrap (MDB)
  - Owl Carousel 2 (Slider / Carousel)
  - SlickNav (Responsive Mobile Navigation)
  - Plyr (Media Player)
  - FontAwesome & Elegant Icons
  - Nice Select
- **Rich Text Editor:** Summernote & TinyMCE
- **Server:** Apache (XAMPP / Laragon / LAMP)

---

## 🗄️ Skema Database

File database tersedia di root proyek: [`zerostudio.sql`](zerostudio.sql).

| Tabel | Deskripsi |
|---|---|
| `buku` | Data master buku (judul, penulis, genre, cover, dll.) |
| `genre` | Kategori genre buku |
| `service` | Relasi publikasi buku, status, dan konten detail |
| `artikel` | Artikel berita & blog |
| `kategori` | Kategori artikel blog |
| `halaman` | Halaman statis custom (About, Contact, dll.) |
| `comment` | Komentar pengguna pada buku dan artikel |
| `pengguna` | Data pengguna, akun admin, hak akses, dan avatar |
| `pengaturan`| Konfigurasi global nama web, logo, dan sosial media |

---

## 🚀 Panduan Instalasi Lokal (Setup Guide)

### 1. Prasyarat Sistem
- Web Server: **XAMPP** / **Laragon** (Apache + MySQL)
- Versi PHP: **PHP 7.4 s/d 8.1**
- Modul Apache `mod_rewrite` aktif

### 2. Pindahkan / Clone Proyek
Letakkan folder proyek di dalam direktori web server Anda:
- **XAMPP:** `C:\xampp\htdocs\zerostudios.book`
- **Laragon:** `C:\laragon\www\zerostudios.book`

Jika melakukan clone dari Git:
```bash
git clone https://github.com/ZEROTSUDIO/zerostudios.book.git
```

### 3. Import Database
1. Buka browser dan akses **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru dengan nama `zerostudios`.
3. Pilih menu **Import**, lalu pilih file [`zerostudio.sql`](zerostudio.sql) dari folder root proyek ini.
4. Klik **Go / Kirim** dan pastikan seluruh tabel berhasil diimport.

### 4. Konfigurasi Database & Base URL
- **Konfigurasi Database** di `application/config/database.php`:
  ```php
  $db['default'] = array(
      'hostname' => 'localhost',
      'username' => 'root',
      'password' => '',
      'database' => 'zerostudios', // Sesuaikan dengan nama database Anda
      'dbdriver' => 'mysqli',
      ...
  );
  ```

- **Konfigurasi Base URL** di `application/config/config.php`:
  ```php
  // Untuk akses lokal XAMPP:
  $config['base_url'] = 'http://localhost/zerostudios.book/';
  ```

### 5. Jalankan Aplikasi
Buka peramban (browser) dan akses:
```text
http://localhost/zerostudios.book
```

---

## 🔑 Informasi Akun & Akses

| Level | Username | Password Default | Akses Login |
|---|---|---|---|
| **Admin** | `Rusdi` | *(Cek/Ubah via phpMyAdmin jika diperlukan)* | `http://localhost/zerostudios.book/login/dashboard` |
| **Penulis** | `Ambatunat` | `123` | `http://localhost/zerostudios.book/login/dashboard` |
| **User** | `nigga` / `RioKurr` | `123` | `http://localhost/zerostudios.book/login` |

> 💡 **Tips Pengaturan Kata Sandi:**
> Password disimpan dalam format hash MD5 di tabel `pengguna`. Jika Anda ingin mereset password admin menjadi `123`, jalankan query SQL berikut di phpMyAdmin:
> ```sql
> UPDATE `pengguna` SET `pengguna_password` = MD5('123') WHERE `pengguna_username` = 'Rusdi';
> ```

---

## 📁 Struktur Direktori

```plaintext
zerostudios.book/
├── application/           # Inti logika MVC CodeIgniter
│   ├── config/            # Konfigurasi database, routes, dan base url
│   ├── controllers/       # Controller (Welcome, Dashboard, Login)
│   ├── models/            # Model data (m_data, m_login)
│   └── views/             # Tampilan Antarmuka (frontend & dashboard)
├── assets/                # Asset CSS, JS, Fonts, Summernote, MDB, Vendor
├── img/                   # Folder upload gambar (user avatar, artikel, buku)
├── system/                # Core library CodeIgniter 3
├── .htaccess              # Konfigurasi rewrite URL Apache
├── index.php              # Entry point aplikasi web
├── zerostudio.sql         # File backup dump database MySQL
└── README.md              # Dokumentasi proyek
```

---

## 👤 Pengembang & Kredit

- **Repositori Resmi:** [ZEROTSUDIO/zerostudios.book](https://github.com/ZEROTSUDIO/zerostudios.book.git)
- **Pengembang:** ZeroStudios Team

---

## 📄 Lisensi
Didistribusikan di bawah lisensi MIT. Silakan gunakan dan kembangkan proyek ini untuk keperluan pembelajaran dan pengembangan lebih lanjut.
