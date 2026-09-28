<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalProduk = Product::count();
        $totalOrder = Order::count();
        $pendapatan = Order::status('completed')->sum('total_price');

        $orderTerbaru = Order::with('user')->latest()->take(5)->get();

        return view('admin.index', compact('totalUser', 'totalProduk', 'totalOrder', 'pendapatan', 'orderTerbaru'));
    }

    public function users()
    {
        $users = User::orderBy('role')->orderBy('name')->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,user',
        ]);

        // biar admin ga ga sengaja nurunin role dirinya sendiri
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Tidak bisa mengubah role akun sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Role {$user->name} diubah jadi {$request->role}.");
    }
}
