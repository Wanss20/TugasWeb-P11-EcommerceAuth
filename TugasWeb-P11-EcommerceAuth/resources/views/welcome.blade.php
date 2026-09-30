@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

{{-- HERO SECTION --}}
<section class="gradient-dark text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-500 rounded-full filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-24 relative z-10">
        <div class="text-center">
            <span class="inline-block px-4 py-1.5 rounded-full glass text-sm text-purple-300 mb-6">🛍️ Aksesoris HP Original & Terlengkap</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Temukan Aksesoris<br>
                <span class="text-gradient">Gadget Terbaik</span>
            </h1>
            <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                Dari charger fast charging sampai earphone TWS — semua tersedia di KSN Store dengan harga bersahabat.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="btn-gradient text-white px-8 py-3 rounded-full font-semibold text-lg shadow-xl">
                    Belanja Sekarang →
                </a>
                <a href="{{ route('products.index', ['category' => 'charger-adaptor']) }}" class="glass text-white px-8 py-3 rounded-full font-medium text-lg hover:bg-white/20 transition">
                    🔌 Charger
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900">Kategori Produk</h2>
        <p class="text-gray-500 mt-2">Cari aksesoris berdasarkan kategori</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
           class="bg-white rounded-2xl p-5 text-center card-hover shadow-sm border border-gray-100 group">
            <div class="text-3xl mb-3">{{ $category->icon }}</div>
            <h3 class="font-semibold text-gray-800 text-sm group-hover:text-purple-600 transition">{{ $category->name }}</h3>
            <p class="text-xs text-gray-400 mt-1">{{ $category->products_count }} produk</p>
        </a>
        @endforeach
    </div>
</section>

{{-- ON SALE --}}
@if($onSaleProducts->count() > 0)
<section class="bg-gradient-to-r from-red-500 to-pink-500 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-white">🔥 Flash Sale</h2>
                <p class="text-red-100 text-sm">Diskon spesial hari ini!</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-white bg-white/20 px-5 py-2 rounded-full text-sm font-medium hover:bg-white/30 transition">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($onSaleProducts as $product)
            <a href="{{ route('products.show', $product) }}" class="bg-white rounded-2xl overflow-hidden card-hover shadow-lg group">
                <div class="h-44 bg-gray-100 overflow-hidden relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute top-2 left-2 badge-discount text-white px-2.5 py-0.5 rounded-full text-xs font-bold shadow">
                        -{{ $product->discount_percentage }}%
                    </div>
                </div>
                <div class="p-4">
                    <span class="text-xs text-purple-600 font-medium">{{ $product->category->name }}</span>
                    <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 mt-1">{{ $product->name }}</h3>
                    <div class="mt-2">
                        <span class="text-red-500 font-bold text-lg">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        <span class="text-gray-400 line-through text-xs ml-1">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FEATURED PRODUCTS --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">⭐ Produk Unggulan</h2>
            <p class="text-gray-500 mt-1">Pilihan terbaik untuk kamu</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-gradient text-white px-5 py-2 rounded-full text-sm font-semibold">Semua Produk →</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach($featuredProducts as $product)
        <a href="{{ route('products.show', $product) }}" class="bg-white rounded-2xl overflow-hidden card-hover shadow-sm border border-gray-100 group">
            <div class="h-48 bg-gray-100 overflow-hidden relative">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                @if($product->discount_price)
                <div class="absolute top-2 right-2 badge-discount text-white px-2.5 py-0.5 rounded-full text-xs font-bold shadow">
                    -{{ $product->discount_percentage }}%
                </div>
                @endif
                @if($product->is_featured)
                <div class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2.5 py-0.5 rounded-full text-xs font-bold shadow">⭐ Featured</div>
                @endif
            </div>
            <div class="p-4">
                <span class="text-xs text-purple-500 font-medium">{{ $product->category->name }}</span>
                <h3 class="text-sm font-semibold text-gray-800 mt-1 line-clamp-2">{{ $product->name }}</h3>
                <div class="mt-3 flex items-end gap-2">
                    <span class="text-purple-600 font-bold">{{ $product->formatted_price }}</span>
                    @if($product->discount_price)
                    <span class="text-gray-400 line-through text-xs">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <span class="text-xs {{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                        {{ $product->stock > 0 ? "Stok: {$product->stock}" : 'Habis' }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- LATEST PRODUCTS --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">🆕 Produk Terbaru</h2>
            <p class="text-gray-500 mt-2">Baru ditambahkan di toko kami</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($latestProducts as $product)
            <a href="{{ route('products.show', $product) }}" class="bg-white rounded-2xl overflow-hidden card-hover shadow-sm group">
                <div class="h-44 bg-gray-100 overflow-hidden relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <div class="p-4">
                    <span class="text-xs text-gray-400">{{ $product->category->name }}</span>
                    <h3 class="text-sm font-semibold text-gray-800 mt-1 line-clamp-2">{{ $product->name }}</h3>
                    <span class="text-purple-600 font-bold mt-2 block">{{ $product->formatted_price }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
