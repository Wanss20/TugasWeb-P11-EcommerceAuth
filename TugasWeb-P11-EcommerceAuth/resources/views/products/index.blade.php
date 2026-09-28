<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Katalog Produk</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- filter --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                    class="rounded-md border-gray-300 text-sm shadow-sm">

                <select name="category" class="rounded-md border-gray-300 text-sm shadow-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="rounded-md bg-gray-800 px-4 py-2 text-sm text-white">Filter</button>
            </form>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($products as $product)
                    <div class="rounded-lg bg-white p-4 shadow-sm">
                        <span class="text-xs text-indigo-600">{{ $product->category->name }}</span>
                        <h3 class="mt-1 font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="mt-2 text-lg font-bold text-orange-600">{{ $product->harga_rupiah }}</p>
                        <div class="mt-2 flex justify-between text-xs text-gray-500">
                            <span>
                                @if ($product->stock > 0)
                                    Stok: {{ $product->stock }}
                                @else
                                    <span class="text-red-500">Stok habis</span>
                                @endif
                            </span>
                            <span>{{ $product->reviews_count }} ulasan</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Produk tidak ditemukan.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
