<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // akun buat testing, password semua: password
        User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.test',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Editor Toko',
            'email' => 'editor@toko.test',
            'role' => 'editor',
        ]);

        User::factory()->create([
            'name' => 'Budi Pembeli',
            'email' => 'user@toko.test',
            'role' => 'user',
        ]);

        // editor tambahan (buat ngetes editor ga bisa edit post editor lain)
        User::factory()->create([
            'name' => 'Sari Editor',
            'email' => 'editor2@toko.test',
            'role' => 'editor',
        ]);

        // pembeli random
        User::factory(15)->create();
    }
}
