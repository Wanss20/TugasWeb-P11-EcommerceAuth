<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Artikel & Promo</h2>

            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700">
                    + Tulis Artikel
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Penulis</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr class="border-t">
                                <td class="px-4 py-3">
                                    <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:underline">{{ $post->title }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $post->user->name }}
                                    <span class="text-xs text-gray-400">({{ $post->user->role }})</span>
                                </td>
                                <td class="px-4 py-3">{{ $post->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{-- tombol cuma muncul kalau lolos PostPolicy --}}
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    @endcan

                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus post ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @endcan

                                    @cannot('update', $post)
                                        <span class="text-gray-400">-</span>
                                    @endcannot
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
