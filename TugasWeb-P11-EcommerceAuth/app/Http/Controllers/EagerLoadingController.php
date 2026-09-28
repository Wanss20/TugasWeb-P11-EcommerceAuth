<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class EagerLoadingController extends Controller
{
    // bandingin jumlah query antara lazy loading (N+1) sama eager loading
    public function index()
    {
        // 1. tanpa eager loading
        DB::flushQueryLog();
        DB::enableQueryLog();

        $orders = Order::take(20)->get();
        foreach ($orders as $order) {
            $order->user->name;          // query tiap loop
            $order->items->count();      // query tiap loop
        }

        $queryLazy = DB::getQueryLog();
        DB::disableQueryLog();

        // 2. pakai eager loading with()
        DB::flushQueryLog();
        DB::enableQueryLog();

        $orders = Order::with(['user', 'items.product'])->take(20)->get();
        foreach ($orders as $order) {
            $order->user->name;
            $order->items->count();
        }

        $queryEager = DB::getQueryLog();
        DB::disableQueryLog();

        return view('admin.eager', compact('orders', 'queryLazy', 'queryEager'));
    }
}
