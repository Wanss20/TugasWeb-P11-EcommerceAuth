<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // katalog produk, bisa diakses semua user yang login
    public function index(Request $request)
    {
        $categories = Category::all();

        // pakai scope active() + eager loading category biar ga N+1
        $query = Product::with('category')->withCount('reviews')->active();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }
}
