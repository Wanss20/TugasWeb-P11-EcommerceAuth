<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EagerLoadingDemo extends Command
{
    protected $signature = 'demo:eager-loading';
    protected $description = 'Demonstrasi perbedaan N+1 Problem vs Eager Loading';

    public function handle(): void
    {
        $this->info('');
        $this->info('========================================');
        $this->info('  EAGER LOADING DEMO - TR11');
        $this->info('========================================');
        $this->newLine();

        // ❌ N+1 Problem
        $this->warn('❌ TANPA Eager Loading (N+1 Problem):');
        DB::enableQueryLog();

        $products = Product::all();
        foreach ($products->take(5) as $product) {
            $this->line("  - {$product->name} | Kategori: {$product->category->name}");
        }

        $queries = DB::getQueryLog();
        $this->error("   Total queries: " . count($queries));
        DB::flushQueryLog();

        $this->newLine();

        // ✅ Dengan Eager Loading
        $this->info('✅ DENGAN Eager Loading:');
        DB::enableQueryLog();

        $products = Product::with('category')->get();
        foreach ($products->take(5) as $product) {
            $this->line("  - {$product->name} | Kategori: {$product->category->name}");
        }

        $queries = DB::getQueryLog();
        $this->info("   Total queries: " . count($queries));
        DB::flushQueryLog();

        $this->newLine();

        // ✅ Nested Eager Loading
        $this->info('✅ NESTED Eager Loading (Order -> OrderItems -> Product):');
        DB::enableQueryLog();

        $orders = Order::with('orderItems.product')->take(3)->get();
        foreach ($orders as $order) {
            $this->line("  Order #{$order->order_number}:");
            foreach ($order->orderItems as $item) {
                $this->line("    - {$item->product->name} x{$item->quantity}");
            }
        }

        $queries = DB::getQueryLog();
        $this->info("   Total queries: " . count($queries));
        DB::disableQueryLog();

        $this->newLine();
        $this->info('========================================');
        $this->info('  DEMO SELESAI!');
        $this->info('========================================');
    }
}
