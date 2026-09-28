<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $request->user()->posts()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(4),
            'body' => $validated['body'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupdate.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
