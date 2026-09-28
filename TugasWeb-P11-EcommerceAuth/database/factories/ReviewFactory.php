<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $komentar = [
            'Barang sesuai deskripsi, pengiriman cepat.',
            'Kualitas oke banget untuk harga segini.',
            'Packing rapi, recommended seller!',
            'Lumayan, tapi pengirimannya agak lama.',
            'Barang bagus, bakal order lagi.',
            'Kurang sesuai ekspektasi, warnanya beda dikit.',
            'Mantap, original dan berfungsi normal.',
            'Respon penjual cepat, puas belanja di sini.',
        ];

        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->randomElement($komentar),
        ];
    }
}
