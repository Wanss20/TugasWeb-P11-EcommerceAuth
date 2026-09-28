<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $judul = [
            'Promo Gajian Diskon Sampai 50%',
            'Tips Memilih HP Sesuai Budget',
            'Gratis Ongkir ke Seluruh Indonesia',
            'Cara Merawat Sepatu Sneakers Biar Awet',
            'Flash Sale Elektronik Setiap Jumat',
            'Rekomendasi Peralatan Dapur untuk Anak Kos',
            'Produk Olahraga Terlaris Bulan Ini',
            'Voucher Cashback untuk Pembeli Baru',
            'Tips Belanja Online yang Aman',
            'Koleksi Fashion Terbaru Minggu Ini',
        ];

        $isi = [
            'Buat kamu yang lagi cari barang dengan harga miring, ini saat yang pas buat belanja.',
            'Promo ini berlaku untuk semua pembeli selama persediaan masih ada.',
            'Jangan lupa cek halaman produk secara berkala biar ga ketinggalan info terbaru.',
            'Semua produk yang dijual sudah dicek kualitasnya sebelum dikirim ke pembeli.',
            'Kalau ada pertanyaan, kamu bisa hubungi admin toko lewat halaman kontak.',
            'Pastikan alamat pengiriman sudah benar sebelum checkout.',
        ];

        $title = fake()->randomElement($judul);

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'body' => implode("\n\n", fake()->randomElements($isi, 3)),
        ];
    }
}
