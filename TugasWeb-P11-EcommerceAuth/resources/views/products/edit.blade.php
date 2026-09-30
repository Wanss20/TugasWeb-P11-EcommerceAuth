@extends('layouts.app')
@section('title', 'Edit: ' . $product->name)
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">✏️ Edit Produk</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
            <select name="category_id" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Diskon (Rp)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 text-purple-600 rounded">
                    <span class="text-sm font-medium text-gray-700">⭐ Produk Unggulan</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-xl font-semibold">Update Produk</button>
            <a href="{{ route('products.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
