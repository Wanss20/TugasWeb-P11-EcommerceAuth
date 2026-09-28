<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik' => 'HP, laptop, dan aksesoris elektronik',
            'Fashion Pria' => 'Baju, celana, dan sepatu pria',
            'Fashion Wanita' => 'Pakaian dan aksesoris wanita',
            'Makanan & Minuman' => 'Snack, kopi, dan minuman kemasan',
            'Peralatan Rumah' => 'Perabot dan alat dapur',
            'Olahraga' => 'Perlengkapan olahraga dan outdoor',
        ];

        foreach ($categories as $name => $desc) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
            ]);
        }
    }
}
