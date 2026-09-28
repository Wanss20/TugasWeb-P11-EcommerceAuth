<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($buyers as $buyer) {
            $address = Address::factory()->create([
                'user_id' => $buyer->id,
                'recipient_name' => $buyer->name,
            ]);

            // tiap pembeli punya 1-3 order
            $jumlahOrder = rand(1, 3);

            for ($i = 0; $i < $jumlahOrder; $i++) {
                $order = Order::factory()->create([
                    'user_id' => $buyer->id,
                    'address_id' => $address->id,
                ]);

                $total = 0;

                // 1-4 produk per order
                foreach ($products->random(rand(1, 4)) as $product) {
                    $qty = rand(1, 3);
                    $subtotal = $product->price * $qty;

                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);

                    $total += $subtotal;
                }

                $order->update(['total_price' => $total]);

                // data pembayaran
                $sudahBayar = in_array($order->status, ['paid', 'shipped', 'completed']);

                if ($sudahBayar) {
                    $statusBayar = 'paid';
                } elseif ($order->status == 'cancelled') {
                    $statusBayar = 'failed';
                } else {
                    $statusBayar = 'unpaid';
                }

                $order->payment()->create([
                    'method' => fake()->randomElement(['transfer', 'ewallet', 'cod']),
                    'amount' => $total,
                    'status' => $statusBayar,
                    'paid_at' => $sudahBayar ? now()->subDays(rand(1, 30)) : null,
                ]);

                // kalau order selesai, pembeli kasih review
                if ($order->status == 'completed') {
                    foreach ($order->items as $item) {
                        Review::factory()->create([
                            'user_id' => $buyer->id,
                            'product_id' => $item->product_id,
                        ]);
                    }
                }
            }
        }
    }
}
