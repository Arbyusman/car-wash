# CAR Wash

Sistem manajemen cuci mobil berbasis Laravel dan Node.js.

## 🚀 Menjalankan Proyek

### 1. Clone Repositori
Clone repositori ke komputer lokal Anda:

```bash
git clone https://github.com/Arbyusman/car-wash.git
cd car-wash
```

### 2. Instalasi Dependensi
Pastikan **Composer** dan **Node.js** telah terinstal, lalu jalankan perintah berikut:

#### Instal dependensi Laravel
```bash
composer install
```

#### Instal dependensi Node.js
```bash
npm install
```

### 3. Konfigurasi Lingkungan
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:

```bash
cp .env.example .env
```

### 4. Menyiapkan Database
Pastikan koneksi database telah dikonfigurasi di `.env`, lalu jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

Jika tidak ingin menggunakan migrasi, Anda dapat mengimpor database dari direktori `db` secara manual.

### 5. Generate Application Key
Jalankan perintah berikut untuk menghasilkan application key:

```bash
php artisan key:generate
```

### 6. Menjalankan Server
Bangun aset frontend dan jalankan server development:

```bash
npm run build
```

Proyek kini siap dijalankan di lingkungan lokal Anda. 🚀

