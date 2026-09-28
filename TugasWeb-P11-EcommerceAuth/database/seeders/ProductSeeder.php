<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // format: nama produk => harga
        $data = [
            'Elektronik' => [
                'Samsung Galaxy A15 8/256GB' => 2899000,
                'Xiaomi Redmi Note 13 8/256GB' => 2799000,
                'iPhone 13 128GB' => 9499000,
                'Laptop Asus Vivobook 14 i5' => 8499000,
                'Lenovo IdeaPad Slim 3 Ryzen 5' => 7299000,
                'TWS Baseus Bowie E3' => 199000,
                'Powerbank Anker 10000mAh' => 329000,
                'Mouse Logitech M331 Silent' => 175000,
                'Keyboard Mechanical Rexus Legionare' => 389000,
                'Flashdisk Sandisk 64GB' => 89000,
                'Smartwatch Xiaomi Band 8' => 499000,
            ],
            'Fashion Pria' => [
                'Kemeja Flanel Kotak Lengan Panjang' => 149000,
                'Kaos Polos Cotton Combed 30s' => 55000,
                'Celana Chino Slim Fit' => 179000,
                'Jaket Bomber Pria' => 229000,
                'Sepatu Sneakers Ventela Public' => 259000,
                'Celana Jeans Levis 511' => 699000,
                'Sandal Eiger Kinetic' => 239000,
                'Topi Baseball Polos' => 45000,
                'Hoodie Oversize Basic' => 165000,
                'Dompet Kulit Pria' => 125000,
            ],
            'Fashion Wanita' => [
                'Gamis Katun Rayon Premium' => 189000,
                'Hijab Pashmina Ceruty Babydoll' => 39000,
                'Blouse Wanita Lengan Balon' => 99000,
                'Rok Plisket Panjang' => 85000,
                'Tas Selempang Wanita Kanvas' => 119000,
                'Cardigan Rajut Oversize' => 139000,
                'Flat Shoes Wanita' => 110000,
                'Kulot Highwaist Linen' => 95000,
                'Dress Midi Floral' => 175000,
                'Jam Tangan Wanita Alexandre Christie' => 899000,
            ],
            'Makanan & Minuman' => [
                'Kopi Kapal Api Special 380gr' => 32000,
                'Indomie Goreng 1 Dus (40 pcs)' => 118000,
                'Chitato Sapi Panggang 68gr' => 11500,
                'Teh Pucuk Harum 350ml (24 pcs)' => 78000,
                'Madu TJ Murni 500gr' => 67000,
                'Beras Pandan Wangi 5kg' => 82000,
                'Minyak Goreng Bimoli 2L' => 41000,
                'Susu UHT Ultra Milk Coklat 1L' => 19500,
                'Keripik Kaca Pedas 250gr' => 25000,
                'Kopi Kenangan Instant Mantan (5 sachet)' => 45000,
            ],
            'Peralatan Rumah' => [
                'Rice Cooker Miyako 1.8L' => 289000,
                'Blender Philips HR2115' => 549000,
                'Teflon Maxim Wajan 24cm' => 135000,
                'Rak Piring Stainless 2 Susun' => 159000,
                'Setrika Philips GC122' => 185000,
                'Kipas Angin Cosmos 16 inch' => 239000,
                'Sapu Lantai Nagata' => 35000,
                'Lampu LED Philips 12W' => 42000,
                'Dispenser Galon Bawah Sanken' => 1499000,
                'Set Pisau Dapur 6 pcs' => 99000,
            ],
            'Olahraga' => [
                'Sepatu Lari Ortuseight Hyperglide' => 499000,
                'Matras Yoga TPE 6mm' => 129000,
                'Dumbell Vinyl 2kg (sepasang)' => 89000,
                'Raket Badminton Yonex Muscle Power' => 459000,
                'Bola Futsal Specs Accelerator' => 229000,
                'Botol Minum Tumbler 1L' => 65000,
                'Tas Carrier Eiger 45L' => 1249000,
                'Skipping Rope Speed' => 49000,
                'Jersey Timnas Indonesia Home' => 399000,
            ],
        ];

        foreach ($data as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($products as $name => $price) {
                // pakai factory buat isi stock, berat, deskripsi dll
                Product::factory()->create([
                    'category_id' => $category->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'price' => $price,
                ]);
            }
        }
    }
}
