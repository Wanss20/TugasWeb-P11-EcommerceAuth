<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KSN Store') - Aksesoris HP Terlengkap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-brand { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-card { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .gradient-dark { background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%); }
        .glass { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.1); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .badge-discount { background: linear-gradient(135deg, #f5576c, #ff6b6b); }
        .btn-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s; }
        .btn-gradient:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); transform: scale(1.02); }
        .text-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .nav-glass { backdrop-filter: blur(20px); background: rgba(15, 12, 41, 0.85); border-bottom: 1px solid rgba(255,255,255,0.08); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    {{-- NAVBAR --}}
    <nav class="nav-glass fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl gradient-brand flex items-center justify-center">
                        <span class="text-white font-bold text-lg">K</span>
                    </div>
                    <span class="text-white font-bold text-xl">KSN<span class="text-purple-400">Store</span></span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Produk</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Dashboard</a>
                        <div class="flex items-center gap-3 ml-4">
                            <div class="flex items-center gap-2 glass rounded-full px-4 py-2">
                                <div class="w-7 h-7 rounded-full gradient-brand flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-white text-sm">{{ Auth::user()->name }}</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ Auth::user()->role === 'admin' ? 'bg-red-500/20 text-red-400' : (Auth::user()->role === 'editor' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-red-400 transition text-sm">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition text-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn-gradient text-white px-5 py-2 rounded-full text-sm font-semibold">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg" id="flash-msg">{{ session('success') }}</div>
        <script>setTimeout(() => document.getElementById('flash-msg').remove(), 3000);</script>
    @endif

    <main class="pt-16">
        @yield('content')
    </main>

    <footer class="gradient-dark text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl gradient-brand flex items-center justify-center"><span class="text-white font-bold text-lg">K</span></div>
                        <span class="font-bold text-xl">KSN<span class="text-purple-400">Store</span></span>
                    </div>
                    <p class="text-gray-400 text-sm">Toko aksesoris HP terlengkap dan terpercaya. Produk original, harga terbaik.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Produk</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Shopee: ksn2806</li>
                        <li>ksn.store@mail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-6 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} KSN Store &mdash; TR 11 E-Commerce Auth</p>
            </div>
        </div>
    </footer>
</body>
</html>
