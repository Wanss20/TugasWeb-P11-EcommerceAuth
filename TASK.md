# 📌 Tugas Rutin 11 — E-Commerce DB + Secure Auth

> **Bobot Penilaian:** Tugas Rutin = 33% (12 tugas) — tiap pertemuan dinilai terpisah!  
> **Target Repo:** `TugasWeb-P11-EcommerceAuth`

---

## 📋 Ringkasan Requirement

### ✅ Bagian A — Database & Eloquent
1. **Migrations 7 Tabel E-Commerce + Foreign Key Constraints**
   - Rancang minimal 7 tabel e-commerce yang saling berelasi lengkap dengan *Foreign Key constraints* & *onDelete cascade/restrict/set null*.
   - Contoh rekomendasi tabel:
     1. `users` (sudah bawaan Laravel + kolom `role`)
     2. `categories`
     3. `products`
     4. `orders`
     5. `order_items`
     6. `reviews` / `product_reviews`
     7. `payments` / `categories_products` / `cart_items`
2. **Seeders + Factories (50+ Produk Realistis)**
   - Buat Factory untuk produk menggunakan Faker.
   - Buat Seeder yang meng-generate minimal **50 data produk realistis** beserta kategori dan relasi terkait.
3. **Model + Relationships + Minimal 1 Scope**
   - Lengkapi model masing-masing tabel dengan relasi Eloquent (`hasMany`, `belongsTo`, `belongsToMany`, dsb.).
   - Tambahkan minimal 1 Local Query Scope pada model (contoh: `scopeInStock()`, `scopeActive()`, `scopeFilterByCategory()`, atau `scopePopular()`).
4. **Dokumentasi 5 Query Tinker (Screenshot)**
   - Jalankan `php artisan tinker` dan uji minimal 5 query Eloquent (relasi, scope, aggregation, filtering, eager loading).
   - Simpan screenshot hasil eksekusi query.

---

### ✅ Bagian B — Auth & Security
5. **Install Laravel Breeze**
   - Pasang Laravel Breeze untuk fitur autentikasi bawaan (*Login, Register, Logout, Profile Management, Reset Password*).
6. **Multi-Role (`admin`, `editor`, `user`) + Custom Middleware**
   - Tambahkan sistem role (contoh: kolom `role` dengan default `user` atau enum `['admin', 'editor', 'user']`).
   - Buat Custom Middleware (misal: `RoleMiddleware` atau `EnsureUserHasRole`) untuk membatasi akses route berdasarkan role.
7. **Policy untuk Otorisasi Edit/Delete**
   - Buat Policy (misal: `ProductPolicy` atau `PostPolicy`) untuk otorisasi aksi `edit`, `update`, dan `delete` (misal: hanya Admin/Editor atau pemilik data yang boleh mengedit/menghapus).
8. **Route Protection + Testing Incognito 2 Role**
   - Lindungi route dengan middleware `auth`, `verified`, dan custom middleware role.
   - Uji coba dengan 2 browser / mode Incognito untuk membuktikan perbedaan hak akses antar-role.

---

### ⭐ Fitur Bonus (Nilai Tambahan)
- **Filament Admin Panel**: Pasang dan konfigurasi panel admin menggunakan Filament.
- **Eager Loading Demo**: Demonstrasi perbandingan performa query (*preventing N+1 problem*) menggunakan `with()`.

---

## 🎯 Rubrik Penilaian

| Aspek | Kriteria | Skor |
| :--- | :--- | :--- |
| **Fungsionalitas** | Semua requirement pertemuan berjalan sempurna | **90 – 100** |
| | Mayoritas fitur berjalan, minor bug | 75 – 89 |
| | Beberapa fitur berjalan, banyak bug | 60 – 74 |
| | Aplikasi tidak berjalan | < 60 |
| **Kualitas Kode & MVC** | MVC konsisten, validasi & keamanan benar, clean code | **90 – 100** |
| | MVC cukup baik, keamanan benar | 75 – 89 |
| | Logika menumpuk di route/view, validasi minim | 60 – 74 |
| | Tidak mengikuti MVC / tidak aman | < 60 |
| **Ketepatan Waktu** | Tepat deadline (100) · Telat 1–3 hari (80) · >3 hari (60) | **100** |

---

## 🚀 Panduan Step-by-Step Pengerjaan

### Tahap 1: Setup Proyek & Laravel Breeze
1. Install project baru Laravel jika belum ada:
   ```bash
   composer create-project laravel/laravel .
   ```
2. Konfigurasi database di file `.env` (MySQL / PostgreSQL / SQLite).
3. Install Laravel Breeze (Blade/Alpine atau React/Vue):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install && npm run build
   ```

---

### Tahap 2: Database Migration (7 Tabel & Multi-Role)
1. **Tambahkan kolom role pada tabel `users`**:
   Tambahkan kolom `role` (`enum('admin', 'editor', 'user')->default('user')` atau `string`).
2. **Buat 6 tabel e-commerce lainnya**:
   - `categories` (id, name, slug, description, timestamps)
   - `products` (id, category_id, name, slug, price, stock, description, is_active, timestamps)
   - `orders` (id, user_id, total_amount, status, timestamps)
   - `order_items` (id, order_id, product_id, quantity, unit_price, timestamps)
   - `reviews` (id, user_id, product_id, rating, comment, timestamps)
   - `payments` (id, order_id, payment_method, status, amount, timestamps)
3. Pastikan semua relasi Foreign Key (`constrained()->onDelete('cascade')`) terpasang dengan benar.
4. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```

---

### Tahap 3: Model, Relationships, dan Local Scopes
1. Buat Model untuk setiap tabel (`Category`, `Product`, `Order`, `OrderItem`, `Review`, `Payment`).
2. Definisikan relasi di Model:
   - `User` hasMany `Order`, `Review`
   - `Category` hasMany `Product`
   - `Product` belongsTo `Category`, hasMany `OrderItem`, `Review`
   - `Order` belongsTo `User`, hasMany `OrderItem`, hasOne `Payment`
   - `OrderItem` belongsTo `Order`, belongsTo `Product`
   - `Review` belongsTo `User`, belongsTo `Product`
   - `Payment` belongsTo `Order`
3. Tambahkan Local Scope di model `Product`, contoh:
   ```php
   public function scopeInStock($query) {
       return $query->where('stock', '>', 0);
   }

   public function scopeActive($query) {
       return $query->where('is_active', true);
   }
   ```

---

### Tahap 4: Factories & Seeders (50+ Data Realistis)
1. Buat Factory untuk `Category`, `Product`, `Review`, dll.
2. Buat `DatabaseSeeder` untuk:
   - Akun default untuk setiap role (`admin@example.com`, `editor@example.com`, `user@example.com`).
   - Minimal 5+ Kategori.
   - Minimal **50+ Produk realistis** (menggunakan data Faker barang/elektronik/fashion).
   - Dummy orders & reviews.
3. Jalankan seeding:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

### Tahap 5: Eksekusi 5 Query Tinker & Screenshot
Jalankan `php artisan tinker` dan dokumentasikan 5 query, contoh:
1. Menampilkan produk yang sedang *in-stock* menggunakan scope:
   ```php
   Product::inStock()->get();
   ```
2. Mengambil produk beserta nama kategorinya (Eager Loading):
   ```php
   Product::with('category')->take(5)->get();
   ```
3. Mengambil semua order milik user tertentu:
   ```php
   User::first()->orders()->with('items.product')->get();
   ```
4. Mengambil review produk dengan rating tertinggi:
   ```php
   Product::first()->reviews()->where('rating', '>=', 4)->get();
   ```
5. Menghitung total penjualan / rata-rata rating:
   ```php
   Product::withAvg('reviews', 'rating')->get();
   ```

---

### Tahap 6: Custom Middleware (Multi-Role)
1. Generate middleware:
   ```bash
   php artisan make:middleware RoleMiddleware
   ```
2. Buat logika pengecekan role di middleware (`$roles` parameter).
3. Daftarkan middleware alias di `bootstrap/app.php` (Laravel 11) atau `app/Http/Kernel.php` (Laravel 10):
   ```php
   'role' => \App\Http\Middleware\RoleMiddleware::class,
   ```

---

### Tahap 7: Authorization Policy
1. Generate Policy:
   ```bash
   php artisan make:policy ProductPolicy --model=Product
   ```
2. Definisikan metode `viewAny`, `update`, `delete` (hanya `admin` / `editor` atau pemilik data yang boleh update/delete).
3. Terapkan policy pada Controller menggunakan `$this->authorize('update', $product)` atau `Gate::authorize()`.

---

### Tahap 8: Route Protection & Testing Multi-Role
1. Kelompokkan route berdasarkan hak akses:
   - Public: Katalog produk, detail produk.
   - User: Checkout, riwayat order, beri review.
   - Editor: Create & edit produk.
   - Admin: Akses penuh (dashboard, delete produk, manage order & user).
2. Lakukan pengujian di browser (Window normal untuk `admin`, Incognito untuk `user` biasa).
3. Dokumentasikan bukti akses diizinkan / 403 Forbidden.

---

### Tahap 9 (Bonus): Filament Admin Panel & Eager Loading Demo
1. Pasang Filament v3 (opsional):
   ```bash
   composer require filament/filament:"^3.2" -W
   php artisan filament:install --panels
   ```
2. Buat Resource Filament untuk Product & Category.
3. Buat halaman demo perbandingan query N+1 vs Eager Loading menggunakan `with()`.

---

## 📦 Checklist Penyerahan Tugas
- [x] Migrations 7 tabel e-commerce + FK constraints
- [x] 50+ Dummy Products via Factory & Seeder (78 produk real Shopee Toko Medan)
- [x] Eloquent Relationships & Query Scope
- [x] Screenshot 5 Query Tinker
- [x] Laravel Breeze terpasang & berfungsi
- [x] Multi-Role (`admin`, `editor`, `user`) + Custom Middleware
- [x] Policy untuk otorisasi Edit/Delete
- [x] Route protection teruji di 2 role berbeda (Incognito)
- [x] Clean code & struktur MVC yang konsisten
- [x] *(Bonus)* Filament Admin Panel & Eager Loading Demo
