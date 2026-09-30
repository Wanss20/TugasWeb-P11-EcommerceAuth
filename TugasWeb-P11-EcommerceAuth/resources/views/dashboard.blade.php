@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500 mt-1">Selamat datang, <strong>{{ $user->name }}</strong>! Role: <span class="font-semibold text-purple-600">{{ ucfirst($user->role) }}</span></p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="text-3xl mb-2">📦</div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
            <p class="text-sm text-gray-500">Total Produk</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="text-3xl mb-2">📂</div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalCategories }}</p>
            <p class="text-sm text-gray-500">Kategori</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="text-3xl mb-2">✅</div>
            <p class="text-2xl font-bold text-green-600">{{ $inStockProducts }}</p>
            <p class="text-sm text-gray-500">Stok Tersedia</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="text-3xl mb-2">🏷️</div>
            <p class="text-2xl font-bold text-red-500">{{ $onSaleProducts }}</p>
            <p class="text-sm text-gray-500">Sedang Diskon</p>
        </div>
    </div>

    {{-- Admin/Editor Stats --}}
    @if(in_array($user->role, ['admin', 'editor']))
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="gradient-brand rounded-2xl p-6 text-white">
            <p class="text-4xl font-bold">{{ $totalUsers }}</p>
            <p class="text-purple-100">Total Users</p>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-6 text-white">
            <p class="text-4xl font-bold">{{ $totalOrders }}</p>
            <p class="text-green-100">Total Orders</p>
        </div>
    </div>
    @endif

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">⚡ Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">📋 Lihat Produk</a>
            @can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}" class="btn-gradient text-white px-4 py-2 rounded-xl text-sm font-medium">➕ Tambah Produk</a>
            @endcan
            <a href="{{ route('profile.edit') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">👤 Edit Profil</a>
        </div>
    </div>

    {{-- Recent Products --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">🆕 Produk Terbaru</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($recentProducts as $product)
            <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition flex flex-col justify-between">
                <div class="flex gap-3 items-center mb-2">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover shrink-0">
                    <div class="min-w-0">
                        <span class="text-xs text-purple-500 font-medium">{{ $product->category->name }}</span>
                        <h3 class="font-semibold text-sm text-gray-800 line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-purple-600 font-bold text-sm mt-0.5">{{ $product->formatted_price }}</p>
                    </div>
                </div>
                <div class="flex gap-2 mt-2 pt-2 border-t border-gray-50">
                    <a href="{{ route('products.show', $product) }}" class="text-xs bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200 transition">Detail</a>
                    @can('update', $product)
                    <a href="{{ route('products.edit', $product) }}" class="text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-lg hover:bg-purple-200 transition">Edit</a>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Orders (Admin/Editor) --}}
    @if(in_array($user->role, ['admin', 'editor']) && $recentOrders->count() > 0)
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-4">📋 Order Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Order #</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Total</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="px-4 py-3 font-mono text-xs">{{ $order->order_number }}</td>
                        <td class="px-4 py-3">{{ $order->user->name }}</td>
                        <td class="px-4 py-3 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-bold
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' :
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
