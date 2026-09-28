<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/products')->assertRedirect('/login');
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_user_biasa_tidak_bisa_buka_halaman_admin(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/posts/create')->assertForbidden();
        $this->actingAs($user)->get('/products')->assertOk();
    }

    public function test_editor_bisa_tulis_post_tapi_tidak_bisa_buka_admin(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)->get('/posts/create')->assertOk();
        $this->actingAs($editor)->get('/admin')->assertForbidden();

        $this->actingAs($editor)->post('/posts', [
            'title' => 'Promo Akhir Bulan',
            'body' => 'Diskon 50% untuk semua produk elektronik.',
        ])->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', ['title' => 'Promo Akhir Bulan', 'user_id' => $editor->id]);
    }

    public function test_editor_cuma_bisa_edit_post_sendiri(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);
        $editorLain = User::factory()->create(['role' => 'editor']);

        $postSendiri = Post::factory()->create(['user_id' => $editor->id]);
        $postOrangLain = Post::factory()->create(['user_id' => $editorLain->id]);

        $this->actingAs($editor)->get("/posts/{$postSendiri->id}/edit")->assertOk();
        $this->actingAs($editor)->get("/posts/{$postOrangLain->id}/edit")->assertForbidden();
        $this->actingAs($editor)->delete("/posts/{$postOrangLain->id}")->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $postOrangLain->id]);
    }

    public function test_admin_bisa_edit_dan_hapus_semua_post(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create();

        $this->actingAs($admin)->get('/admin')->assertOk();
        $this->actingAs($admin)->get("/posts/{$post->id}/edit")->assertOk();
        $this->actingAs($admin)->delete("/posts/{$post->id}")->assertRedirect('/posts');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
