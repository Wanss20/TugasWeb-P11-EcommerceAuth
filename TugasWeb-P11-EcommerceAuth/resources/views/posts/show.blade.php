<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <p class="text-sm text-gray-500">
                    Ditulis oleh {{ $post->user->name }} &middot; {{ $post->created_at->format('d M Y H:i') }}
                </p>

                <div class="mt-4 whitespace-pre-line text-gray-800">{{ $post->body }}</div>

                <div class="mt-6 flex gap-4 text-sm">
                    <a href="{{ route('posts.index') }}" class="text-gray-600 hover:underline">&larr; Kembali</a>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600 hover:underline">Edit</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
