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
            'price' => fake()->numberBetween(5, 150) * 1000,
            'stock' => fake()->numberBetween(10, 200),
            'weight' => fake()->numberBetween(100, 1500),
            'is_active' => fake()->boolean(95), // 95% aktif
        ];
    }

    // bikin deskripsi produk camilan / snack khas Medan yang realistis
    public static function buatDeskripsi($name)
    {
        $pembuka = [
            "$name 100% Halal, higienis, dan terbuat dari bahan-bahan pilihan berkualitas.",
            "Nikmati kelezatan $name khas Medan dengan cita rasa gurih, renyah, dan bikin nagih.",
            "$name cocok sebagai teman ngemil santai, sajian keluarga, maupun oleh-oleh khas.",
            "Produk $name siap kirim dengan stok selalu fresh dan masa simpan terjamin.",
        ];

        $keterangan = [
            'Kemasan kedap udara rapat dan aman.',
            'Packing aman dilengkapi bubble wrap dan kardus pelindung.',
            'Ready Medan, pengiriman cepat setiap hari kerja.',
            'Rasa gurih pas di lidah, renyah mantap tanpa bahan pengawet berbahaya.',
            'Order sebelum jam 15.00 WIB dikirim langsung di hari yang sama.',
        ];

        return fake()->randomElement($pembuka) . ' ' . fake()->randomElement($keterangan);
    }

    // produk yang stoknya habis
    public function habis(): static
    {
        return $this->state(fn () => ['stock' => 0]);
    }
}

