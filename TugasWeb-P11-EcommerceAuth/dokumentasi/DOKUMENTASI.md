# Dokumentasi Tugas Rutin 11 — E-Commerce DB + Secure Auth

| | |
|---|---|
| **Nama** | Raymond Diaz Purba |
| **NIM** | 4253250022 |
| **Repo** | TugasWeb-P11-EcommerceAuth |

---

## Bagian A — Database & Eloquent

### 1. Migrations 7 Tabel E-Commerce + FK Constraints

Menjalankan migration dan seeder:

![migrate](screenshots/01-migrate-seed.png)

Daftar tabel di database `db_ecommerce_p11`:

![tabel](screenshots/02-phpmyadmin-tabel.png)

Relasi foreign key antar tabel (phpMyAdmin Designer):

![designer](screenshots/03-phpmyadmin-designer.png)

### 2. Seeders + Factories (50+ Produk)

Data produk hasil seeder dengan nama, harga, dan deskripsi yang realistis (total 60 produk, lihat jumlah baris tabel `products` pada gambar daftar tabel di atas):

![data products](screenshots/04-data-products.png)

### 3. Model + Relationships + Scope

Model Product berisi relasi `belongsTo` / `hasMany` dan scope `active()`, `inStock()`, `priceBetween()`:

![model product](screenshots/05-kode-model-product.png)

### 4. Dokumentasi 5 Query Tinker

**Query 1** — Produk aktif, ada stok, harga 100rb–300rb:

![tinker 1](screenshots/06-tinker-1.png)

**Query 2** — Jumlah produk tiap kategori:

![tinker 2](screenshots/07-tinker-2.png)

**Query 3** — Jumlah order selesai dan total pendapatan:

![tinker 3](screenshots/08-tinker-3.png)

**Query 4** — Riwayat order milik user beserta jumlah item tiap order:

![tinker 4](screenshots/09-tinker-4.png)

**Query 5** — 5 produk dengan rata-rata rating tertinggi:

![tinker 5](screenshots/10-tinker-5.png)

---

## Bagian B — Auth & Security

### 5. Install Breeze (Login / Register / Logout)

Halaman login dari Laravel Breeze:

![login](screenshots/11a-login.png)

Setelah login berhasil masuk ke dashboard. Role user yang login (admin) ditampilkan beserta menu yang bisa diakses:

![dashboard admin](screenshots/11-dashboard-admin.png)

### 6 & 7. Multi-role + PostPolicy

Dashboard saat login sebagai editor. Menu Admin tidak muncul karena editor tidak punya akses ke halaman admin:

![dashboard editor](screenshots/11b-dashboard-editor.png)

Login sebagai editor: tombol Edit/Hapus hanya muncul di post milik sendiri (diatur oleh PostPolicy):

![posts editor](screenshots/12-posts-editor.png)

Editor mencoba membuka halaman edit post milik editor lain → 403 Forbidden:

![editor 403](screenshots/13-editor-403.png)

### 8. Route Protection + Testing Incognito 2 Role

Admin (browser biasa) dan user (incognito) login bersamaan. Menu yang tampil berbeda sesuai role:

![dashboard 2 role](screenshots/14a-dashboard-2-role.png)

Kiri: user (incognito) membuka `/admin` ditolak dengan 403 oleh middleware role. Kanan: admin (browser biasa) membuka `/admin` berhasil masuk ke Panel Admin:

![incognito](screenshots/14-incognito-2-role.png)

---

## Bonus

### Filament Admin Panel

![filament](screenshots/15-filament.png)

### Demo Eager Loading

Tanpa eager loading terjadi masalah N+1 (41 query), dengan `with()` cukup 4 query:

![eager loading](screenshots/16-eager-loading.png)
