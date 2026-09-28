<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => self::buatDeskripsi($name),
            'price' => fake()->numberBetween(10, 500) * 1000,
            'stock' => fake()->numberBetween(0, 150),
            'weight' => fake()->numberBetween(100, 3000),
            'is_active' => fake()->boolean(90), // 90% aktif
        ];
    }

    // bikin deskripsi bahasa indonesia (faker lorem cuma ada bahasa latin)
    public static function buatDeskripsi($name)
    {
        $pembuka = [
            "$name original dengan kualitas terjamin.",
            "Jual $name, barang baru dan bergaransi.",
            "$name ready stock, siap kirim hari ini.",
            "Dapatkan $name dengan harga terbaik.",
        ];

        $keterangan = [
            'Barang dicek dulu sebelum dikirim.',
            'Packing aman pakai bubble wrap.',
            'Pengiriman dari Jakarta.',
            'Bisa COD di beberapa kota.',
            'Order sebelum jam 3 sore dikirim di hari yang sama.',
        ];

        return fake()->randomElement($pembuka) . ' ' . fake()->randomElement($keterangan);
    }

    // produk yang stoknya habis
    public function habis(): static
    {
        return $this->state(fn () => ['stock' => 0]);
    }
}
