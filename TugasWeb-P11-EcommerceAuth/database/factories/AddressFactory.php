<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            'user_id' => User::factory(),
            'recipient_name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'address' => $faker->streetAddress(),
            'city' => $faker->city(),
            'postal_code' => $faker->postcode(),
        ];
    }
}
