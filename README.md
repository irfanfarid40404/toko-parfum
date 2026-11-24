# Toko Parfum

Proyek Laravel 13, Svelte 5, dan Inertia untuk manajemen kategori, produk, dan pesanan parfum.

## Persyaratan

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan pnpm
- SQLite

## Instalasi

```bash
composer install
pnpm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
composer run dev
```

Halaman dapat dibuka di `http://127.0.0.1:8000/tentang`.

## Alur Request `/tentang`

1. Browser membuka `/tentang`.
2. `public/index.php` menjadi pintu masuk aplikasi dan memuat autoloader Composer.
3. `bootstrap/app.php` membuat aplikasi, menentukan file route, dan mengaktifkan middleware web serta Inertia.
4. `routes/web.php` mencocokkan method `GET` dan URL `/tentang` ke `AboutController`.
5. Middleware grup `web` memproses session, cookie, dan CSRF. Middleware Inertia menyiapkan shared props.
6. `App\Http\Controllers\AboutController::__invoke()` dijalankan.
7. Controller mengambil `app.name`, versi Laravel, dan daftar fitur.
8. `Inertia::render('About', [...])` memilih komponen [About.svelte](/Volumes/Disk%20Extern/toko-parfum/resources/js/pages/About.svelte) dan mengirimkan props.
9. Pada kunjungan pertama, browser menerima respons HTML lengkap dengan data halaman Inertia.
10. Pada navigasi Link dengan header `X-Inertia`, server mengirim respons JSON berisi `component`, `props`, `url`, dan `version`.
11. Svelte 5 mengganti komponen halaman tanpa reload penuh dan merender nilai props pada [About.svelte](/Volumes/Disk%20Extern/toko-parfum/resources/js/pages/About.svelte).

Urutan file yang dilewati:

```text
Browser
  -> public/index.php
  -> bootstrap/app.php
  -> routes/web.php
  -> app/Http/Controllers/AboutController.php
  -> Inertia
  -> resources/js/pages/About.svelte
  -> Browser
```
