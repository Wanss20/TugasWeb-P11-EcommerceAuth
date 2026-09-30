@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Beranda</a> /
        <a href="{{ route('products.index') }}" class="hover:text-purple-600">Produk</a> /
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-purple-600">{{ $product->category->name }}</a> /
        <span class="text-gray-800">{{ Str::limit($product->name, 30) }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        {{-- Product Image --}}
        <div class="bg-gray-100 rounded-3xl overflow-hidden h-96 relative shadow-inner border border-gray-100">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @if($product->discount_price)
            <div class="absolute top-4 left-4 badge-discount text-white px-4 py-1.5 rounded-full text-sm font-bold shadow">-{{ $product->discount_percentage }}%</div>
            @endif
            @if($product->is_featured)
            <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-4 py-1.5 rounded-full text-sm font-bold shadow">⭐ Featured</div>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium mb-3">{{ $product->category->icon }} {{ $product->category->name }}</span>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

            <div class="flex items-end gap-3 mb-6">
                <span class="text-4xl font-bold text-purple-600">{{ $product->formatted_price }}</span>
                @if($product->discount_price)
                <span class="text-xl text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="badge-discount text-white px-3 py-1 rounded-full text-sm font-bold">Hemat {{ $product->discount_percentage }}%</span>
                @endif
            </div>

            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full {{ $product->stock > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                    <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                        {{ $product->stock > 0 ? "Stok tersedia: {$product->stock} pcs" : 'Stok habis' }}
                    </span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-2">📝 Deskripsi</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description }}</p>
            </div>

            {{-- Admin Actions --}}
            @auth
            <div class="flex gap-3">
                @can('update', $product)
                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-semibold transition shadow">✏️ Edit Produk</a>
                @endcan
                @can('delete', $product)
                <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-semibold transition shadow">🗑️ Hapus</button>
                </form>
                @endcan
            </div>
            @endauth
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
    <section class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($relatedProducts as $related)
            <a href="{{ route('products.show', $related) }}" class="bg-white rounded-2xl overflow-hidden card-hover shadow-sm border border-gray-100 group">
                <div class="h-36 bg-gray-100 overflow-hidden relative">
                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <div class="p-4">
                    <h3 class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $related->name }}</h3>
                    <span class="text-purple-600 font-bold text-sm mt-2 block">{{ $related->formatted_price }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
