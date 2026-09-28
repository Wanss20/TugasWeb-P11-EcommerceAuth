<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg">Halo, <b>{{ Auth::user()->name }}</b>!</p>
                    <p class="mt-1 text-gray-600">
                        Kamu login sebagai
                        <span class="rounded bg-indigo-100 px-2 py-0.5 text-sm font-semibold text-indigo-700">{{ Auth::user()->role }}</span>
                    </p>

                    <h3 class="mt-6 font-semibold">Menu yang bisa kamu akses:</h3>
                    <ul class="mt-2 list-disc pl-6 text-gray-700">
                        <li><a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Katalog Produk</a></li>
                        <li><a href="{{ route('posts.index') }}" class="text-indigo-600 hover:underline">Baca Artikel</a></li>

                        @if (Auth::user()->hasRole('admin', 'editor'))
                            <li><a href="{{ route('posts.create') }}" class="text-indigo-600 hover:underline">Tulis Artikel Baru</a></li>
                        @endif

                        @if (Auth::user()->isAdmin())
                            <li><a href="{{ route('admin.index') }}" class="text-indigo-600 hover:underline">Panel Admin</a></li>
                            <li><a href="{{ url('/filament') }}" class="text-indigo-600 hover:underline">Filament Admin Panel</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
