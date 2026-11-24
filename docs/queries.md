# Query Tinker Pertemuan 2

Jalankan dari root proyek:

```bash
php artisan tinker
```

## Produk aktif dengan stok lebih dari 0

```php
\App\Models\Product::active()
    ->where('stock', '>', 0)
    ->get();
```

## Produk beserta kategorinya

```php
\App\Models\Product::with('category')
    ->latest()
    ->paginate(15);
```

## Lima produk termahal

```php
\App\Models\Product::orderByDesc('price')
    ->limit(5)
    ->get();
```

## Jumlah produk per kategori

```php
\App\Models\Category::withCount('products')
    ->get();
```

## Urutan UUID dan waktu dibuat

```php
\App\Models\Product::orderBy('id')->pluck('id', 'created_at');
\App\Models\Product::orderBy('created_at')->pluck('id', 'created_at');
```

Hasil produk pertama seeding menggunakan UUID v7:

```text
"01a20d55-9266-70ed-b611-e14905658e78"
```
