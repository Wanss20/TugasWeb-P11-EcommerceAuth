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
            'Camilannya renyah dan gurih banget, bumbu daun jeruknya nendang!',
            'Kualitas top! Rasa khas oleh-oleh Medannya berasa banget.',
            'Packing rapi pakai bubble wrap tebal, snack sampai dengan aman tidak remuk.',
            'Enak banget, pedas manisnya pas dan bikin nagih!',
            'Barang fresh, expired date masih lama. Recommended seller!',
            'Langsung habis dimakan sekeluarga, pasti bakal repeat order lagi.',
            'Pengiriman dari Medan cepat sekali, rasa mantap jiwa!',
            'Respon penjual ramah, produk original halal dan higienis.',
        ];

        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->randomElement($komentar),
        ];
    }
}

