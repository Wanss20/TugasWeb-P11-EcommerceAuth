# 🛍️ TugasWeb-P11-EcommerceAuth

**Tugas Rutin 11 — E-Commerce Database + Secure Authentication**

Laravel e-commerce application dengan sistem autentikasi multi-role, menggunakan produk aksesoris HP dari toko Shopee [ksn2806](https://shopee.co.id/ksn2806).

## ✅ Fitur yang Diimplementasikan

### Bagian A — Database & Eloquent
1. ✅ **7 Migration + FK Constraints**: users (+ role), categories, products, orders, order_items, carts, cart_items
2. ✅ **Seeder + Factory (62 produk realistis)**: Produk aksesoris HP (charger, kabel, earphone, case, powerbank, dll)
3. ✅ **Model + Relationships + Scopes**: hasMany, belongsTo, hasOne + scope `inStock`, `featured`, `onSale`, `priceBetween`, `byRole`
4. ✅ **5 Query Tinker**: (Jalankan di `php artisan tinker`)

### Bagian B — Auth & Security
5. ✅ **Laravel Breeze**: Login/Register/Logout
6. ✅ **Multi-Role + Custom Middleware**: admin/editor/user + `RoleMiddleware`
7. ✅ **ProductPolicy**: Otorisasi create/update/delete berdasarkan role
8. ✅ **Route Protection**: Route group berdasarkan role + testing incognito

### ⭐ Bonus
- ✅ **Eager Loading Demo**: `php artisan demo:eager-loading`
- ✅ **Unique Design**: Glassmorphism + gradient purple theme (berbeda dari teman)

## 🚀 Instalasi

```bash
git clone <repo-url>
cd TugasWeb-P11-EcommerceAuth
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## 👤 Akun Login

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@ksn.com | password |
| Editor | editor@ksn.com | password |
| User | user@ksn.com | password |

## 📋 5 Query Tinker

```php
# 1. Ambil produk dengan eager loading kategori
App\Models\Product::with('category')->take(5)->get();

# 2. Scope: Produk yang stoknya tersedia
App\Models\Product::inStock()->count();

# 3. Scope: Produk yang sedang diskon
App\Models\Product::onSale()->get(['name','price','discount_price']);

# 4. Hitung total order per user
App\Models\User::withCount('orders')->get(['name','orders_count']);

# 5. Nested eager loading: Order + Items + Produk
App\Models\Order::with('orderItems.product')->first();
```

## 🔒 Role Permissions

| Fitur | Admin | Editor | User |
|-------|-------|--------|------|
| Lihat Produk | ✅ | ✅ | ✅ |
| Tambah Produk | ✅ | ✅ | ❌ |
| Edit Produk | ✅ | ✅ | ❌ |
| Hapus Produk | ✅ | ❌ | ❌ |
| Dashboard | ✅ | ✅ | ✅ |

## 🛠️ Tech Stack
- Laravel 12
- PHP 8.2
- SQLite
- Tailwind CSS (CDN)
- Laravel Breeze
