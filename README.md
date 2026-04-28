# Pampang PHP — Setup Guide

## Struktur Folder
```
pampang-php/
├── index.php              ← entry point
├── .htaccess              ← URL routing
├── app/
│   ├── core/              ← Router, Controller, Database, bootstrap
│   ├── controllers/       ← semua controller
│   ├── models/            ← semua model
│   └── views/             ← semua halaman HTML/PHP
│       ├── partials/      ← header & footer publik
│       ├── admin/         ← halaman admin
│       └── public/        ← halaman publik
└── public/
    ├── assets/            ← CSS, JS, gambar, font, audio
    └── uploads/           ← foto yang diupload admin
```

## Setup di Laragon (Lokal)

1. Salin folder `pampang-php` ke `C:\laragon\www\`
2. Pastikan database `pampang` sudah ada (dari langkah sebelumnya)
3. Buka browser → `http://localhost/pampang-php`

## Setup di Hosting

1. Upload seluruh isi folder `pampang-php` ke `public_html/`
2. Edit `app/core/Database.php` — sesuaikan kredensial database:
   ```php
   $this->conn = new mysqli('localhost', 'user_db', 'pass_db', 'nama_db');
   ```
3. Edit `app/core/bootstrap.php` — sesuaikan BASE_URL:
   ```php
   define('BASE_URL', 'https://domainmu.com');
   ```
4. Edit `.htaccess` — hapus baris `RewriteBase /pampang-php/`, ganti jadi:
   ```
   RewriteBase /
   ```

## Login Admin
- URL: `/login`
- Email: `admin@gmail.com`
- Password: `admin123`
