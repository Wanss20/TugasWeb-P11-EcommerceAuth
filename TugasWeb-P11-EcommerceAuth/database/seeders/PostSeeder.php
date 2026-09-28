<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@toko.test')->first();
        $editor = User::where('email', 'editor@toko.test')->first();
        $editor2 = User::where('email', 'editor2@toko.test')->first();

        Post::factory(2)->create(['user_id' => $admin->id]);
        Post::factory(3)->create(['user_id' => $editor->id]);
        Post::factory(2)->create(['user_id' => $editor2->id]);
    }
}
