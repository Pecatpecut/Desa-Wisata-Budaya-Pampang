<a name="top"></a>

<div align="center">

<img src="documentation/readme-screenshots/00-readme-banner.png" alt="Banner README Desa Wisata Budaya Pampang" width="1100">

</div>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Bootstrap_5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5" />
  <img src="https://img.shields.io/badge/Vue-4FC08D?style=for-the-badge&logo=vuedotjs&logoColor=white" alt="Vue" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
</p>

<h1 id="judul-utama">Desa Wisata Budaya Pampang — Situs Web Profil Wisata</h1>

Repositori ini memuat dokumentasi resmi pengembangan situs web profil wisata **Desa Wisata Budaya Pampang** di Samarinda untuk kebutuhan Proyek Akhir PBW. Implementasi disusun dengan pendekatan PHP native berbasis MVC (custom framework), MySQL sebagai basis data, Bootstrap 5 untuk antarmuka responsif, serta Vue dan JavaScript pada komponen interaktif tertentu.

---

## Kontributor

<div align="center">

| Muhammad Rizky Febrianto | Chiqo Nanda Rial Pratama | Daffa Syahrandy Husain | Marcela Persa Linthin  |
|:---:|:---:|:---:|:---:|
| <img width="120" height="120" alt="image" src="https://github.com/user-attachments/assets/f7b1fc90-c4f6-4dec-aba7-22302facdb82" />  |  <img width="120" height="120" alt="image" src="https://github.com/user-attachments/assets/7e3c1968-4f0b-4fac-9230-f0d4efb2ab26" /> | <img width="120" height="120" alt="image" src="https://github.com/user-attachments/assets/63138184-b71c-4397-9ee5-61844d2c0105" /> | <img width="120" height="120" alt="image" src="https://github.com/user-attachments/assets/919c6bf0-e7ad-41ac-9ff1-8578206282d1" />
| **2409116045** | **2409116046** | **2409116069** | **2409116072** |
| Sistem Informasi B '24 | Sistem Informasi B '24 | Sistem Informasi B '24 | Sistem Informasi B '24 |

</div>

---

## Daftar Isi

- [Kontributor](#kontributor)
- [Daftar Isi](#daftar-isi)
- [Deskripsi Situs Web](#deskripsi-situs-web)
- [Kunjungi Website Pampang](#kunjungi-website-pampang)
- [Profil Mitra](#profil-mitra)
- [Peta Laman Dan Arsitektur Informasi](#peta-laman-dan-arsitektur-informasi)
- [Fitur Utama Situs](#fitur-utama-situs)
- [Penggunaan Bootstrap 5 Dan Vue.js](#penggunaan-bootstrap-5-dan-vuejs)
- [Cara Instalasi Dan Setup Lokal](#cara-instalasi-dan-setup-lokal)
- [Struktur Proyek](#struktur-proyek)
- [Cuplikan Antarmuka Situs](#cuplikan-antarmuka-situs)
- [Verifikasi Kesesuaian Instruksi Proyek Akhir](#verifikasi-kesesuaian-instruksi-proyek-akhir)

---

## Deskripsi Situs Web

Situs web ini dirancang sebagai media informasi publik Desa Wisata Budaya Pampang, mencakup profil desa, agenda kegiatan budaya, publikasi dan berita, dokumentasi visual, serta informasi lokasi dan kontak pengelola. Struktur penyajian diprioritaskan agar ringkas, mudah dipindai, dan tetap informatif pada perangkat desktop maupun seluler.

Dalam konteks instruksi proyek PBW, komponen *detail wisata* direalisasikan melalui pemetaan multi-laman, yaitu **Tentang**, **Publikasi**, serta **Kontak**. Seluruh konten dikelola melalui panel admin dengan CRUD penuh untuk postingan, agenda, galeri, dan informasi kontak. Pendekatan ini dipilih agar setiap kelompok informasi memiliki ruang penjelasan yang lebih jelas dan tidak menumpuk pada satu halaman panjang.

---

## Kunjungi Website Pampang

Jika Anda ingin melihat pengalaman lengkapnya secara langsung, kunjungi website resmi Desa Wisata Budaya Pampang di:

<p align="center">
  <a href="http://desawisatabudayapampang">
    <img src="https://img.shields.io/badge/Kunjungi%20Website-desawisatabudayapampang-2e7d32?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Kunjungi website Desa Wisata Budaya Pampang" />
  </a>
</p>

Website ini dirancang agar pengunjung dapat memahami kekayaan budaya Desa Pampang dengan cepat melalui alur yang ringkas: mulai dari pengenalan profil desa, agenda pertunjukan budaya, publikasi dan galeri, hingga informasi kontak dan lokasi. Untuk pembaca repositori, kunjungan langsung ke situs akan memberi gambaran paling jelas tentang kualitas implementasi antarmuka, struktur informasi, dan pengalaman pengguna yang dibangun dalam proyek ini.

---

## Profil Mitra

**Desa Wisata Budaya Pampang** merupakan mitra studi kasus pada proyek ini. Desa Pampang dikenal sebagai salah satu destinasi wisata budaya unggulan di Samarinda yang merepresentasikan kehidupan dan kebudayaan suku Dayak Kenyah secara autentik.

Desa Pampang berlokasi di Samarinda, Kalimantan Timur. Dalam operasionalnya, desa wisata ini menyelenggarakan pertunjukan tarian tradisional, pameran kerajinan tangan, dan kegiatan budaya lainnya secara rutin. Situs web ini disusun untuk menjawab kebutuhan informasi publik yang paling sering dicari pengunjung: profil dan konteks wisata, jadwal agenda kegiatan, dokumentasi visual, publikasi berita, serta kanal komunikasi resmi pengelola.


---

## Peta Laman Dan Arsitektur Informasi

| Kelompok Laman | URL | Peran Informasi |
|---|---|---|
| Publik | `/` | Ringkasan awal situs, agenda terkini, galeri, dan postingan unggulan |
| Publik | `/tentang` | Profil desa, latar sejarah, dan narasi wisata budaya |
| Publik | `/publikasi` | Galeri dokumentasi visual dan artikel/berita kegiatan desa |
| Publik | `/kontak` | Peta, alamat, jam operasional, serta kanal komunikasi pengelola |
| Admin | `/login` | Titik masuk autentikasi admin |
| Admin | `/admin` | Dashboard pengelolaan ringkasan data |
| Admin | `/admin/postingan` | Manajemen artikel dan berita (CRUD) |
| Admin | `/admin/agenda` | Manajemen jadwal kegiatan budaya (CRUD) |
| Admin | `/admin/galeri` | Manajemen foto dokumentasi (CRUD + upload) |
| Admin | `/admin/kontak` | Pengelolaan informasi kontak dan operasional |
| Admin | `/admin/password` | Pengaturan keamanan akun admin |

---

## Fitur Utama Situs

| Fitur | Uraian |
|---|---|
| Profil Desa Wisata | Menyajikan identitas Desa Pampang, latar budaya, dan konteks informasi publik |
| Agenda Kegiatan | Menampilkan jadwal pertunjukan budaya dan acara desa secara terstruktur |
| Publikasi & Galeri | Menyediakan artikel berita dan dokumentasi visual kegiatan desa |
| Informasi Kontak | Menyediakan alamat, jam operasional, harga tiket, dan jalur komunikasi pengelola |
| Manajemen Konten Admin | CRUD penuh untuk postingan, agenda, galeri (file/URL), dan data kontak |
| Upload Gambar | Mendukung unggahan file gambar (JPG/PNG/WEBP/GIF, maks. 5MB) dan input URL eksternal |
| Autentikasi Admin | Login berbasis session dengan regenerasi ID session dan proteksi session fixation |
| Ganti Password Admin | Fitur ubah password dengan validasi password lama dan konfirmasi password baru |
| Tema Dayak Kenyah | Antarmuka bertema budaya Dayak dengan palet warna merah–emas dan ornamen motif tradisional |
| Audio Latar Budaya | Pemutar audio musik Dayak yang dapat diaktifkan pengunjung dari tombol navbar |
| Scroll Reveal & Parallax | Animasi scroll reveal dan efek parallax hero section untuk pengalaman visual yang imersif |
| Arsitektur MVC | Custom framework PHP native dengan pemisahan Controller, Model, View, dan Router |
| Error Handling | Halaman error khusus (404, 500, dll.) dengan pesan berbahasa Indonesia |

---

## Penggunaan Bootstrap 5 Dan Vue.js

### ⚙️ Bootstrap 5

Bootstrap 5 digunakan sebagai fondasi sistem grid dan komponen UI pada seluruh halaman publik maupun panel admin. Namun demikian, sebagian besar komponen visual — termasuk navbar, card, galeri, dan panel admin — dibangun dengan CSS kustom (`style.css`, `dayak-theme.css`, `admin.css`) untuk menghasilkan identitas visual bertema Dayak Kenyah yang tidak tersedia pada komponen Bootstrap bawaan.

Bootstrap dimanfaatkan terutama untuk:

- **Sistem grid responsif** — layout multi-kolom pada laman beranda, galeri, dan kontak menggunakan `col-md-*` dan `col-lg-*`
- **Utilitas spacing & display** — kelas seperti `d-flex`, `gap-*`, `p-*`, `mb-*` untuk efisiensi penulisan CSS
- **Komponen form** — struktur input dan tombol pada panel admin dibangun di atas elemen Bootstrap
- **Responsivitas breakpoint** — penyesuaian tampilan otomatis lintas perangkat desktop, tablet, dan mobile

File Bootstrap di-*bundle* secara lokal (`bootstrap_min.css`, `bootstrap_bundle_min.js`) sehingga situs dapat berjalan tanpa ketergantungan CDN eksternal.

---

### 🟩 Vue.js

Vue.js (versi Global Build, `vue_global_prod.js`) digunakan pada komponen interaktif yang memerlukan reaktivitas data tanpa me-*refresh* halaman. Pendekatan ini dipilih agar integrasi Vue tetap ringan tanpa memerlukan build tool seperti Vite atau Webpack.

Vue dimanfaatkan terutama untuk:

- **Komponen kalender agenda** — menampilkan dan memfilter jadwal kegiatan budaya secara interaktif berdasarkan bulan dan tanggal yang dipilih pengunjung pada laman Kontak
- **Reaktivitas data kontak** — menampilkan informasi jam operasional, harga, dan kontak secara dinamis tanpa reload halaman

Komponen Vue dideklarasikan langsung di dalam template HTML menggunakan pola `createApp` dari Vue 3 global build, sehingga dapat diintegrasikan ke dalam sistem MVC PHP native tanpa perubahan pada arsitektur backend.

---

## Cara Instalasi Dan Setup Lokal

### Prasyarat

Pastikan lingkungan pengembangan memiliki komponen berikut sebelum memulai:

- **PHP** >= 7.4 dengan ekstensi `mysqli` dan `fileinfo` aktif
- **MySQL** >= 5.7 atau **MariaDB** >= 10.3
- **Apache** dengan modul `mod_rewrite` aktif (untuk URL rewriting via `.htaccess`)
- **Git** untuk kloning repositori

> Disarankan menggunakan **XAMPP**, **Laragon**, atau **WAMP** untuk setup lokal di Windows.

---

### Langkah Instalasi

**1. Klon repositori**

```bash
git clone https://github.com/username/desa-wisata-pampang.git
cd desa-wisata-pampang
```

> Letakkan folder proyek di dalam direktori web root, misalnya `htdocs/` (XAMPP) atau `www/` (Laragon).

---

**2. Buat database dan impor skema**

Buka **phpMyAdmin** atau klien MySQL, kemudian:

```sql
CREATE DATABASE pampang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Lalu impor file skema:

```bash
mysql -u root -p pampang < sql/pampang.sql
```

---

**3. Konfigurasi koneksi database**

Proyek membaca konfigurasi dari *environment variable*. Buat file `.env` di root proyek:

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=pampang
```

> Jika menggunakan XAMPP tanpa konfigurasi ENV, nilai default pada `Database.php` sudah menggunakan `localhost`, `root`, tanpa password, dan nama database `pampang`.

---

**4. Aktifkan `mod_rewrite` pada Apache**

Buka `httpd.conf` dan pastikan baris berikut tidak terkomentari:

```apache
LoadModule rewrite_module modules/mod_rewrite.so
```

Kemudian pastikan direktori proyek mengizinkan override:

```apache
<Directory "C:/xampp/htdocs/desa-wisata-pampang">
    AllowOverride All
</Directory>
```

---

**5. Pastikan folder uploads dapat ditulis**

```bash
# Linux / macOS
chmod -R 755 public/uploads/
```

> Di Windows, pastikan folder `public/uploads/galeri/` dan `public/uploads/postingan/` sudah ada dan tidak bersifat *read-only*.

---

**6. Jalankan aplikasi**

Buka browser dan akses:

```
http://localhost/desa-wisata-pampang/
```

Untuk mengakses panel admin:

```
http://localhost/desa-wisata-pampang/login
```

> Kredensial admin default tersedia di file `sql/pampang.sql` pada bagian data awal tabel `users`.

---

## Struktur Proyek

<details>
<summary><b>Struktur Folder Inti (Ringkas)</b></summary>

```text
desa-wisata-pampang/
C:.
│   .htaccess
│   download_assets.ps1
│   index.php
│   README.md
│   
├───app
│   ├───controllers
│   │       AdminController.php
│   │       AgendaController.php
│   │       AuthController.php
│   │       GaleriController.php
│   │       KontakController.php
│   │       PasswordController.php
│   │       PostinganController.php
│   │       PublicController.php
│   │       
│   ├───core
│   │       bootstrap.php
│   │       Controller.php
│   │       Database.php
│   │       Router.php
│   │       
│   ├───models
│   │       AgendaModel.php
│   │       GaleriModel.php
│   │       KontakModel.php
│   │       PostinganModel.php
│   │       UserModel.php
│   │       
│   └───views
│       ├───admin
│       │   │   dashboard.php
│       │   │   login.php
│       │   │   password.php
│       │   │   
│       │   ├───agenda
│       │   │       index.php
│       │   │       
│       │   ├───galeri
│       │   │       index.php
│       │   │       
│       │   ├───kontak
│       │   │       index.php
│       │   │       
│       │   ├───partials
│       │   │       footer.php
│       │   │       header.php
│       │   │       
│       │   └───postingan
│       │           index.php
│       │           
│       ├───errors
│       │       403.php
│       │       404.php
│       │       500.php
│       │       generic.php
│       │       
│       └───public
│           ├───beranda
│           │       index.php
│           │       
│           ├───kontak
│           │       index.php
│           │       
│           ├───partials
│           │       footer.php
│           │       header.php
│           │       
│           ├───publikasi
│           │       index.php
│           │       
│           └───tentang
│                   index.php
│                   
└───public
    ├───assets
    │   ├───audio
    │   │       dayak.mp3
    │   │       
    │   ├───css
    │   │       admin.css
    │   │       bootstrap-icons.min.css
    │   │       bootstrap.min.css
    │   │       dayak-theme.css
    │   │       style.css
    │   │       
    │   ├───fonts
    │   │       bootstrap-icons.woff
    │   │       bootstrap-icons.woff2
    │   │       
    │   ├───images
    │   │       lamin-potrait.svg
    │   │       lamin.svg
    │   │       logo pesona indonesia.svg
    │   │       logo-pesona-indonesia-putih.svg
    │   │       motif dayak.svg
    │   │       susur-sungai.svg
    │   │       tarian.svg
    │   │       
    │   └───js
    │           admin.js
    │           bootstrap.bundle.min.js
    │           main.js
    │           vue.global.prod.js
    │           
    └───uploads
        │   .htaccess
        │   
        ├───galeri
        │       .htaccess
        │       
        └───postingan
                .htaccess
```

</details>

---

## Cuplikan Antarmuka Situs

<h3 id="cuplikan-01">1. Beranda</h3>

<div align="center">

<img src="documentation/readme-screenshots/01-beranda.png" alt="Screenshot laman Beranda Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Beranda menampilkan hero dengan efek parallax, tombol audio latar budaya Dayak, agenda terkini, galeri pilihan, dan postingan unggulan.*

<h3 id="cuplikan-02">2. Tentang</h3>

<div align="center">

<img src="documentation/readme-screenshots/02-tentang.png" alt="Screenshot laman Tentang Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Tentang menampilkan profil desa, latar sejarah, dan narasi kekayaan budaya Desa Pampang dengan ilustrasi SVG bertema Dayak.*

<h3 id="cuplikan-03">3. Publikasi</h3>

<div align="center">

<img src="documentation/readme-screenshots/03-publikasi.png" alt="Screenshot laman Publikasi Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Publikasi menampilkan galeri dokumentasi visual dan kartu artikel berita kegiatan desa.*

<h3 id="cuplikan-04">4. Kontak</h3>

<div align="center">

<img src="documentation/readme-screenshots/04-kontak.png" alt="Screenshot laman Kontak Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Kontak menampilkan kalender agenda interaktif berbasis Vue, alamat, jam operasional, harga wisata, dan kanal komunikasi resmi.*

<h3 id="cuplikan-05">5. Login Admin</h3>

<div align="center">

<img src="documentation/readme-screenshots/05-login-admin.png" alt="Screenshot laman Login Admin Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Login Admin menampilkan formulir autentikasi untuk membatasi akses panel administrasi.*

<h3 id="cuplikan-06">6. Dashboard Admin</h3>

<div align="center">

<img src="documentation/readme-screenshots/06-admin-dashboard.png" alt="Screenshot laman Dashboard Admin Desa Wisata Budaya Pampang" width="920">

</div>

*Laman Dashboard Admin menampilkan ringkasan statistik jumlah postingan, agenda, dan galeri yang terkelola.*

<h3 id="cuplikan-07">7. Manajemen Postingan</h3>

<div align="center">

<img src="documentation/readme-screenshots/07-admin-postingan.png" alt="Screenshot laman Manajemen Postingan Admin" width="920">

</div>

*Laman Manajemen Postingan menyediakan antarmuka tambah, edit, dan hapus artikel berita dengan dukungan upload thumbnail (file/URL) dan preview gambar.*

<h3 id="cuplikan-08">8. Manajemen Agenda</h3>

<div align="center">

<img src="documentation/readme-screenshots/08-admin-agenda.png" alt="Screenshot laman Manajemen Agenda Admin" width="920">

</div>

*Laman Manajemen Agenda menyediakan antarmuka pengelolaan jadwal kegiatan dan pertunjukan budaya dengan filter pencarian real-time.*

<h3 id="cuplikan-09">9. Manajemen Galeri</h3>

<div align="center">

<img src="documentation/readme-screenshots/09-admin-galeri.png" alt="Screenshot laman Manajemen Galeri Admin" width="920">

</div>

*Laman Manajemen Galeri menyediakan antarmuka drag-and-drop upload foto (file/URL) dengan preview gambar sebelum disimpan.*

<h3 id="cuplikan-10">10. Manajemen Kontak</h3>

<div align="center">

<img src="documentation/readme-screenshots/10-admin-kontak.png" alt="Screenshot laman Manajemen Kontak Admin" width="920">

</div>

*Laman Manajemen Kontak menyediakan antarmuka pengelolaan alamat, jam operasional, harga wisata, dan kontak resmi desa.*

---

## Verifikasi Kesesuaian Instruksi Proyek Akhir

| Poin Instruksi PA | Implementasi pada Repo/Situs |
|---|---|
| Berfokus pada objek pariwisata Samarinda | Studi kasus mitra: Desa Wisata Budaya Pampang (Samarinda) |
| Memuat beranda | Tersedia laman publik `/` dengan ringkasan konten utama |
| Memuat detail wisata | Dipetakan ke `/tentang`, `/publikasi`, dan `/kontak` |
| Memuat CRUD sederhana | CRUD penuh tersedia untuk postingan, agenda, galeri, dan kontak melalui panel admin |
| Menggunakan PHP dan MySQL | Basis implementasi backend dan data pada proyek ini |
| Menggunakan koneksi terpisah (`Database.php`) | Kelas Database Singleton dipisahkan di `app/core/Database.php` dengan konfigurasi ENV |
| Menggunakan session dan autentikasi admin | Akses admin melalui `/login` dengan session regeneration dan panel `/admin` |
| Responsif dengan Bootstrap 5 dan interaktif dengan Vue & JS | Bootstrap 5 untuk grid dan utilitas; Vue 3 untuk kalender agenda interaktif; JS kustom untuk parallax, audio latar, scroll reveal, drag-and-drop upload, dan 3D tilt |
| Nilai tambah MVC | Struktur kode diorganisasi dengan custom framework MVC di folder `app/` |

---

<div align="center">

<img src="documentation/readme-screenshots/11-readme-footer.png" alt="Footer visual README Desa Wisata Budaya Pampang" width="1100">

</div>

> [!NOTE]
> Dokumen ini disusun sebagai ringkasan teknis dan bukti implementasi Proyek Akhir PBW untuk penilai, mitra, dan pembaca repositori.

<p align="center"><a href="#top">Kembali ke atas</a></p>
