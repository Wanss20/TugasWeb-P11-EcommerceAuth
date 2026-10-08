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
            'Promo Gajian Diskon Spesial Camilan Khas Medan Sampai 50%',
            'Rekomendasi Oleh-Oleh Khas Medan Paling Populer & Tahan Lama',
            'Gratis Ongkir Ekstra untuk Pengiriman Snack ke Seluruh Nusantara',
            'Sensasi Gurih Renyah Kerupuk Lekor dan Seblak Daun Jeruk',
            'Flash Sale Aneka Keripik & Kacang Gurih Setiap Akhir Pekan',
            'Tips Menyimpan Snack & Camilan Kering Biar Tetap Renyah Tahan Lama',
            'Varian Baru Sus Coklat Lumer & Duosus yang Wajib Kamu Coba',
            'Voucher Cashback Spesial untuk Pembelian Paket Hampers Camilan',
            'Keunggulan Madu Murni Herbal & Susu Kambing Etawa untuk Kesehatan',
            'Daftar Camilan Pedas Gurih Terlaris yang Bikin Nagih',
        ];

        $isi = [
            'Buat kamu penikmat cemilan gurih dan pedas, nikmati promo menarik dengan harga terbaik langsung dari toko kami.',
            'Semua produk diproduksi higienis, 100% Halal, dan selalu dikirim dalam kondisi fresh.',
            'Packing pengiriman selalu dilapisi bubble wrap tebal dan kardus pengaman agar snack sampai tanpa remuk.',
            'Jangan lewatkan flash sale dan voucher diskon terbatas dengan mengecek katalog produk kami.',
            'Untuk pesanan dalam jumlah banyak atau hampers oleh-oleh, silakan hubungi admin toko.',
            'Pastikan alamat pengiriman dan detail nomor telepon sudah benar sebelum melakukan pembayaran.',
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

