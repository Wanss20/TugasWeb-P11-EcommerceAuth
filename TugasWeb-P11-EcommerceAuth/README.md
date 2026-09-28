# TugasWeb-P11-EcommerceAuth

Tugas Rutin Pertemuan 11 — E-Commerce DB + Secure Auth (Laravel 12 + Breeze + Filament)

## Cara Menjalankan

1. Nyalakan **MySQL** di XAMPP
2. Buat database `db_ecommerce_p11` (sudah diatur di `.env`)
3. Jalankan:

```bash
composer install
npm install && npm run build
php artisan migrate:fresh --seed
php artisan serve
```

4. Buka http://127.0.0.1:8000

## Akun Testing

Password semua akun: `password`

| Role   | Email              |
|--------|--------------------|
| admin  | admin@toko.test    |
| editor | editor@toko.test   |
| editor | editor2@toko.test  |
| user   | user@toko.test     |

---

## Bagian A — Database & Eloquent

### 1. Migrations (7 tabel e-commerce + FK)

| Tabel         | Foreign Key                                                   |
|---------------|---------------------------------------------------------------|
| categories    | -                                                             |
| products      | category_id → categories (restrict on delete)                 |
| addresses     | user_id → users (cascade)                                     |
| orders        | user_id → users (cascade), address_id → addresses (set null)  |
| order_items   | order_id → orders (cascade), product_id → products (restrict) |
| payments      | order_id → orders (cascade, unique)                           |
| reviews       | user_id → users (cascade), product_id → products (cascade)    |

Tambahan: kolom `role` di tabel `users`, dan tabel `posts` (untuk PostPolicy).

### 2. Seeders + Factories

- `UserSeeder` → 4 akun testing + 15 pembeli random
- `CategorySeeder` → 6 kategori
- `ProductSeeder` → **60 produk** dengan nama & harga realistis (stok, berat, deskripsi dari factory)
- `OrderSeeder` → alamat, order, order item, pembayaran, dan review untuk tiap pembeli
- `PostSeeder` → artikel dari admin & editor

### 3. Model, Relasi, Scope

- `Category` hasMany `Product`
- `Product` belongsTo `Category`, hasMany `OrderItem`, hasMany `Review`
- `User` hasMany `Address`, `Order`, `Review`, `Post`
- `Order` belongsTo `User` & `Address`, hasMany `OrderItem` (`items`), hasOne `Payment`
- `OrderItem` belongsTo `Order` & `Product`

Scope:
- `Product::active()` — produk yang aktif
- `Product::inStock()` — stok > 0
- `Product::priceBetween($min, $max)` — filter harga
- `Order::status('completed')` — filter status order

### 4. Query Tinker

Jalankan `php artisan tinker`, lalu screenshot hasil tiap query:

```php
// 1. Produk aktif, ada stok, harga 100rb - 300rb (pakai 3 scope)
Product::active()->inStock()->priceBetween(100000, 300000)->take(5)->get(['id', 'name', 'price', 'stock']);

// 2. Jumlah produk tiap kategori
Category::select('id', 'name')->withCount('products')->get();

// 3. Jumlah order selesai & total pendapatannya
[Order::status('completed')->count(), Order::status('completed')->sum('total_price')];

// 4. Riwayat order milik user tertentu beserta jumlah itemnya
User::where('email', 'user@toko.test')->first()->orders()->select('id', 'user_id', 'order_number', 'total_price', 'status')->withCount('items')->get();

// 5. 5 produk dengan rata-rata rating tertinggi
Product::select('id', 'name')->has('reviews')->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')->take(5)->get();
```

---

## Bagian B — Auth & Security

### 5. Breeze
Login, register, logout, profile dari Laravel Breeze (Blade).

### 6. Multi-role + Custom Middleware
- Middleware: `app/Http/Middleware/RoleMiddleware.php`
- Didaftarkan di `bootstrap/app.php` dengan alias `role`
- Cara pakai: `->middleware('role:admin')` atau `->middleware('role:admin,editor')`

### 7. PostPolicy
`app/Policies/PostPolicy.php`

| Aksi          | admin | editor               | user |
|---------------|-------|----------------------|------|
| lihat post    | ✅    | ✅                   | ✅   |
| buat post     | ✅    | ✅                   | ❌   |
| edit / hapus  | ✅ semua | ✅ post sendiri saja | ❌   |

### 8. Route Protection

| URL                    | Akses                  |
|------------------------|------------------------|
| /products, /posts      | semua user yang login  |
| /posts/create, edit    | admin, editor (+ policy) |
| /admin/*               | admin saja             |
| /filament              | admin saja             |

**Testing incognito 2 role:**
1. Browser biasa → login `admin@toko.test` → bisa buka `/admin`, bisa edit/hapus semua post
2. Jendela incognito → login `user@toko.test` → buka `/admin` → muncul **403 Forbidden**, tombol edit/hapus post tidak muncul
3. (opsional) login `editor@toko.test` → bisa edit post sendiri, tapi buka `/posts/{id}/edit` punya editor lain → **403**

Automated test: `php artisan test --filter=RoleAccessTest`

---

## Bonus

- **Filament admin panel** → http://127.0.0.1:8000/filament (login pakai akun admin). CRUD Kategori, Produk, Order.
- **Demo eager loading** → http://127.0.0.1:8000/admin/eager-loading
  Bandingin jumlah query tanpa `with()` (41 query, masalah N+1) vs pakai `with()` (4 query).
