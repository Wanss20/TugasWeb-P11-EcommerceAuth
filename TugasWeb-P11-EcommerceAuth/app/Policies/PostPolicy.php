<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    // semua user yang login boleh lihat daftar post
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    // yang boleh bikin post cuma admin & editor
    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'editor');
    }

    // admin boleh edit semua post, editor cuma post miliknya sendiri
    public function update(User $user, Post $post): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isEditor() && $user->id === $post->user_id;
    }

    // aturannya sama kayak update
    public function delete(User $user, Post $post): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isEditor() && $user->id === $post->user_id;
    }
}
