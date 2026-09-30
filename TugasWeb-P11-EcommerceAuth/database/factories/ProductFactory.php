<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(rand(2, 4), true);
        $price = fake()->numberBetween(15000, 500000);
        $hasDiscount = fake()->boolean(30);

        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(100, 9999),
            'description' => fake()->paragraphs(2, true),
            'price' => $price,
            'discount_price' => $hasDiscount ? round($price * fake()->randomFloat(2, 0.5, 0.85)) : null,
            'stock' => fake()->numberBetween(0, 200),
            'image' => null,
            'is_featured' => fake()->boolean(20),
        ];
    }
}
