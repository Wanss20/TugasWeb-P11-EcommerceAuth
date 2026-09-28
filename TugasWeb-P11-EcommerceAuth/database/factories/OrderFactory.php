<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address_id' => null,
            'order_number' => 'INV-' . now()->format('Ymd') . '-' . fake()->unique()->numerify('#####'),
            'total_price' => 0, // nanti dihitung ulang di seeder
            'status' => fake()->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']),
        ];
    }
}
