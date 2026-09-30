@extends('layouts.app')
@section('title', 'Semua Produk')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Semua Produk</h1>
            <p class="text-gray-500 mt-1">{{ $products->total() }} produk ditemukan</p>
        </div>
        <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                   class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
            <button type="submit" class="btn-gradient text-white px-5 py-2 rounded-xl text-sm font-medium">Cari</button>
        </form>
    </div>

    <div class="flex flex-col md:flex-row gap-6">
        {{-- Sidebar Categories --}}
        <div class="w-full md:w-64 shrink-0">
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 sticky top-24">
                <h3 class="font-bold text-gray-900 mb-4">📂 Kategori</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="block px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-purple-100 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            Semua Kategori
                        </a>
                    </li>
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                           class="block px-3 py-2 rounded-lg text-sm {{ request('category') === $cat->slug ? 'bg-purple-100 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            {{ $cat->icon }} {{ $cat->name }} <span class="text-gray-400">({{ $cat->products_count }})</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

                @can('create', App\Models\Product::class)
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('products.create') }}" class="btn-gradient text-white w-full block text-center px-4 py-2 rounded-xl text-sm font-semibold">+ Tambah Produk</a>
                </div>
                @endcan
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="flex-1">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($products as $product)
                <div class="bg-white rounded-2xl overflow-hidden card-hover shadow-sm border border-gray-100 group">
                    <a href="{{ route('products.show', $product) }}">
                        <div class="h-48 bg-gray-100 overflow-hidden relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @if($product->discount_price)
                            <div class="absolute top-2 right-2 badge-discount text-white px-2 py-0.5 rounded-full text-xs font-bold shadow">-{{ $product->discount_percentage }}%</div>
                            @endif
                            @if($product->stock <= 0)
                            <div class="absolute inset-0 bg-black/50 backdrop-blur-xs flex items-center justify-center"><span class="text-white font-bold text-sm bg-red-600 px-3 py-1 rounded-full">HABIS</span></div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <span class="text-xs text-purple-500 font-medium">{{ $product->category->name }}</span>
                        <a href="{{ route('products.show', $product) }}">
                            <h3 class="text-sm font-semibold text-gray-800 mt-1 line-clamp-2 hover:text-purple-600 transition">{{ $product->name }}</h3>
                        </a>
                        <div class="mt-2">
                            <span class="text-purple-600 font-bold">{{ $product->formatted_price }}</span>
                            @if($product->discount_price)
                            <span class="text-gray-400 line-through text-xs ml-1">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Stok: {{ $product->stock }}</p>

                        {{-- Admin/Editor Actions --}}
                        @auth
                        <div class="flex gap-2 mt-3">
                            @can('update', $product)
                            <a href="{{ route('products.edit', $product) }}" class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg hover:bg-yellow-200 transition">✏️ Edit</a>
                            @endcan
                            @can('delete', $product)
                            <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200 transition">🗑️ Hapus</button>
                            </form>
                            @endcan
                        </div>
                        @endauth
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-gray-400 text-lg">Tidak ada produk ditemukan.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">{{ $products->withQueryString()->links() }}</div>
        </div>
    </div>
</div>
@endsection
