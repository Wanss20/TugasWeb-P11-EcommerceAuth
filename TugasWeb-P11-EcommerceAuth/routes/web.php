<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    $featuredProducts = Product::with('category')->featured()->inStock()->take(8)->get();
    $categories = Category::withCount('products')->get();
    $latestProducts = Product::with('category')->latest()->take(8)->get();
    $onSaleProducts = Product::with('category')->onSale()->inStock()->take(4)->get();

    return view('welcome', compact('featuredProducts', 'categories', 'latestProducts', 'onSaleProducts'));
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ==================== AUTH REQUIRED ====================
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $inStockProducts = Product::inStock()->count();
        $onSaleProducts = Product::onSale()->count();
        $recentProducts = Product::with('category')->latest()->take(6)->get();

        // Admin/Editor stats
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $recentOrders = Order::with('user')->recent()->take(5)->get();

        return view('dashboard', compact(
            'user', 'totalProducts', 'totalCategories', 'inStockProducts',
            'onSaleProducts', 'recentProducts', 'totalUsers', 'totalOrders', 'recentOrders'
        ));
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ADMIN + EDITOR ROUTES ====================
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products-create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
});

// ==================== ADMIN ONLY ROUTES ====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';
