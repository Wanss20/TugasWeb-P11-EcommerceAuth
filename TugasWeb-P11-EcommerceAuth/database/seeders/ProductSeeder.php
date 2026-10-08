<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // format: Kategori => [ Nama Produk => [ 'price' => int, 'weight' => int, 'stock' => int ] ]
        $data = [
            'Kerupuk & Keripik' => [
                'READY MEDAN | HALAL | KERUPUK LEKOR KHAS MEDAN 250 GR' => ['price' => 14900, 'weight' => 250, 'stock' => 95],
                'READY MEDAN | HALAL | KERUPUK KULIT IKAN PATIN 100 GR' => ['price' => 13500, 'weight' => 100, 'stock' => 120],
                'KERIPIK OPAK SAMBAL PEDAS MANIS 250 GR' => ['price' => 14000, 'weight' => 250, 'stock' => 80],
                'KERIPIK OPAK SAMBAL ANUGRAH KEMASAN 500 GR' => ['price' => 28000, 'weight' => 500, 'stock' => 50],
                'READY MEDAN | HALAL | KERIPIK USUS CRISPY DAN RENYAH 250 GR' => ['price' => 28500, 'weight' => 250, 'stock' => 65],
                'READY MEDAN | HALAL | KERIPIK USUS CRISPY PEDAS 500 GR' => ['price' => 54900, 'weight' => 500, 'stock' => 40],
                'PECAHAN EMPING ACEH PEDAS MANIS 250 GR' => ['price' => 17000, 'weight' => 250, 'stock' => 75],
                'READY MEDAN | HALAL | EMPING GEPREK JAPIN KHAS MEDAN' => ['price' => 14900, 'weight' => 200, 'stock' => 60],
                'READY MEDAN | HALAL | KERUPUK JENGKOL RENYAH GURIH' => ['price' => 15900, 'weight' => 250, 'stock' => 45],
                'READY MEDAN | HALAL | KERUPUK IKAN TENGGIRI KHAS MEDAN' => ['price' => 19900, 'weight' => 250, 'stock' => 85],
                'READY MEDAN | HALAL | KERIPIK TEMPE ANEKA RASA RENYAH' => ['price' => 34999, 'weight' => 400, 'stock' => 55],
                'READY MEDAN | HALAL | KERIPIK KUPING GAJAH COKLAT KLASIK' => ['price' => 21500, 'weight' => 300, 'stock' => 70],
                'READY MEDAN | HALAL | KERUPUK LEKOR MENTAH 1 KG' => ['price' => 57000, 'weight' => 1000, 'stock' => 30],
                'READY MEDAN | HALAL | ANEKA KRIPIK BUAH DAN SAYUR SEGAR' => ['price' => 17999, 'weight' => 200, 'stock' => 90],
                'READY MEDAN | HALAL | SALE LIDAH PISANG CRISPY' => ['price' => 19900, 'weight' => 250, 'stock' => 60],
            ],
            'Makaroni & Camilan Pedas' => [
                'READY MEDAN | HALAL | TAIKO KREZZ GURIPANG 4 VARIAN RASA' => ['price' => 26900, 'weight' => 300, 'stock' => 150],
                'READY MEDAN | HALAL | TAIKO KREZZ GURIPANG VARIAN JAGUNG' => ['price' => 25999, 'weight' => 300, 'stock' => 110],
                '(2 BUNGKUS) READY MEDAN | SNACK TAIKO KREZZ PEDAS DAGING SAPI' => ['price' => 47900, 'weight' => 600, 'stock' => 40],
                'READY MEDAN | HALAL | KERUPUK SEBLAK MIX DAUN JERUK 500 GR' => ['price' => 29999, 'weight' => 500, 'stock' => 130],
                'READY MEDAN | HALAL | KERUPUK SEBLAK PEDAS DAUN JERUK 250 GR' => ['price' => 8999, 'weight' => 250, 'stock' => 140],
                'READY MEDAN | HALAL | KERUPUK SEBLAK EKSTRA PEDAS 1 KG' => ['price' => 58500, 'weight' => 1000, 'stock' => 35],
                'READY MEDAN | HALAL | KERUPUK SEBLAK KERING DAUN JERUK 500 GR' => ['price' => 30000, 'weight' => 500, 'stock' => 85],
                'READY MEDAN | HALAL | KERUPUK SEBLAK KERING PEDAS GURIH' => ['price' => 17900, 'weight' => 250, 'stock' => 95],
                'READY MEDAN | HALAL | BASRENG PEDAS DAUN JERUK CRISPY' => ['price' => 19900, 'weight' => 250, 'stock' => 160],
                'READY MEDAN | HALAL | SOSRENG SOSIS GORENG RENYAH 250 GR' => ['price' => 21900, 'weight' => 250, 'stock' => 105],
                'READY MEDAN | HALAL | SOSRENG SOSIS GORENG PEDAS 150 GR' => ['price' => 10900, 'weight' => 150, 'stock' => 80],
                'READY MEDAN | HALAL | SOSRENG KEMASAN 500 GR BIKIN NAGIH' => ['price' => 39900, 'weight' => 500, 'stock' => 50],
                'STIK BALADO STIK PEDAS MOGIDON 500 GR' => ['price' => 30500, 'weight' => 500, 'stock' => 65],
                'READY MEDAN | HALAL | MAKARONI PEDAS NIKMAT DAUN JERUK' => ['price' => 18900, 'weight' => 250, 'stock' => 115],
                'READY MEDAN | HALAL | MAKARONI BANTET PEDAS GURIH' => ['price' => 12900, 'weight' => 200, 'stock' => 125],
                'READY MEDAN | HALAL | MAKARONI SPIRAL PEDAS DAUN JERUK' => ['price' => 34900, 'weight' => 500, 'stock' => 70],
                'READY MEDAN | HALAL | MAKARONI BONCABE PEDAS MANIS' => ['price' => 9900, 'weight' => 150, 'stock' => 90],
                'MAKARONI PEDAS OMEX ISI 3 KG EKONOMIS' => ['price' => 110000, 'weight' => 3000, 'stock' => 25],
                'READY MEDAN | HALAL | MAKARONI PEDAS GURIH 1 KG' => ['price' => 46000, 'weight' => 1000, 'stock' => 45],
                'READY MEDAN | HALAL | SIOMAY KERING PEDAS NAMPOL 500 GR' => ['price' => 34900, 'weight' => 500, 'stock' => 60],
                'READY MEDAN | HALAL | SIOMAY KERING PEDAS NAGIH KEMASAN SEDANG' => ['price' => 18900, 'weight' => 250, 'stock' => 85],
                'READY MEDAN | HALAL | MIE GULUNG PEDAS NAMPOL 150 GR' => ['price' => 10900, 'weight' => 150, 'stock' => 110],
                'READY MEDAN | HALAL | MIE GULUNG PEDAS DAUN JERUK 300 GR' => ['price' => 20900, 'weight' => 300, 'stock' => 95],
                'READY MEDAN | HALAL | MIE GULUNG RENYAH 1 KG' => ['price' => 43900, 'weight' => 1000, 'stock' => 40],
                'MIE LIDI PEDAS TIPIS ISI 25 BUNGKUS' => ['price' => 34999, 'weight' => 500, 'stock' => 75],
                'READY MEDAN | HALAL | CAKAR AYAM SNACK GURIH PEDAS REMPAH' => ['price' => 9900, 'weight' => 150, 'stock' => 80],
                'READY MEDAN | KEKETO SNACK KENTANG VARIAN RASA' => ['price' => 43500, 'weight' => 500, 'stock' => 50],
                'READY MEDAN | HALAL | SNACK JADUL KHAS MEDAN RENYAH' => ['price' => 17900, 'weight' => 250, 'stock' => 90],
                'READY MEDAN | HALAL | ORONG-ORONG MEDAN GURIH 225 GR' => ['price' => 15000, 'weight' => 225, 'stock' => 100],
            ],
            'Kue, Biskuit & Pastry' => [
                'READY MEDAN | HALAL | SUS COKLAT LUMER KHAS MEDAN 500 GR' => ['price' => 39900, 'weight' => 500, 'stock' => 135],
                'READY MEDAN | HALAL | KUE SOES COKLAT KEMASAN 1 KG' => ['price' => 70000, 'weight' => 1000, 'stock' => 45],
                'READY MEDAN | DUOSUS KEMASAN MINI BANTAL' => ['price' => 3000, 'weight' => 50, 'stock' => 200],
                'READY MEDAN | DUOSUS COKLAT SUS KERING 1 DUS' => ['price' => 132500, 'weight' => 2000, 'stock' => 30],
                'HALAL | YAM COOKIES MONSTA 700 GR RASA MANTAP' => ['price' => 77900, 'weight' => 700, 'stock' => 50],
                'READY MEDAN | WAFER ASTOR DUO RASA SPESIAL 500 GR' => ['price' => 30000, 'weight' => 500, 'stock' => 75],
                'CURUT KEJU PREMIUM SARIKAYA GABUS KEJU GURIH' => ['price' => 22900, 'weight' => 300, 'stock' => 80],
                'READY MEDAN | HALAL | BRONIS COKLAT MINI LUMER ISI 12 PCS' => ['price' => 8500, 'weight' => 150, 'stock' => 110],
                'READY MEDAN | HALAL | KUE RAJA MANIS KHAS MELAYU MEDAN' => ['price' => 12000, 'weight' => 200, 'stock' => 60],
                'SUMPIA UDANG PEDAS CHILI SPRING ROLL SARIKAYA' => ['price' => 49900, 'weight' => 500, 'stock' => 55],
                'READY MEDAN | POPCORN CARAMEL PREMIUM 500 GR' => ['price' => 67500, 'weight' => 500, 'stock' => 40],
            ],
            'Coklat, Permen & Manisan' => [
                'COKLAT ALMOND ECERAN PER TOPLES' => ['price' => 24999, 'weight' => 300, 'stock' => 90],
                'PROMO !!! KING COKLAT ALMOND TOPLES BESAR' => ['price' => 89900, 'weight' => 800, 'stock' => 35],
                'KING\'S MEGABALL / BONIBOL COKLAT TOPLES' => ['price' => 74999, 'weight' => 750, 'stock' => 45],
                'READY MEDAN | BOLA BISKUIT COKLAT MANIS 350 GR' => ['price' => 24900, 'weight' => 350, 'stock' => 80],
                'DONATELLO CHRUNCHY CRISPY BALL COKLAT' => ['price' => 26000, 'weight' => 300, 'stock' => 70],
                'READY MEDAN | HALAL | APOLO ROKA COKLAT ISI 70 PCS' => ['price' => 80000, 'weight' => 500, 'stock' => 40],
                'PERMEN SOMBOY MADU NARAYA ISI 10' => ['price' => 10800, 'weight' => 100, 'stock' => 120],
                'READY MEDAN | SOMBOI IRIS HALUS KEMASAN 50 GR' => ['price' => 13500, 'weight' => 50, 'stock' => 100],
                'READY MEDAN | HALAL | PERMEN ASEM MANIS KLASIK' => ['price' => 17000, 'weight' => 200, 'stock' => 85],
                'BON BON ASEM MANIS PEDAS ISI 12 PCS' => ['price' => 12500, 'weight' => 150, 'stock' => 90],
                'PERMEN JELLY STARWAY MIXED PASTILLES 500 GR' => ['price' => 75000, 'weight' => 500, 'stock' => 50],
                'READY | HALAL | AGAR AGAR RASA BUAH JELLY SEGAR' => ['price' => 19900, 'weight' => 300, 'stock' => 110],
                'READY MEDAN | HALAL | MANISAN JADUL WARNA WARNI' => ['price' => 29900, 'weight' => 350, 'stock' => 60],
                'READY MEDAN | HALAL | MANISAN BUAH PLUM KERING PREMIUM' => ['price' => 95000, 'weight' => 500, 'stock' => 30],
            ],
            'Kacang & Biji-bijian' => [
                'KACANG ARAB / KACANG BALI / KACANG OVEN GURIH 300 GR' => ['price' => 17000, 'weight' => 300, 'stock' => 85],
                'READY MEDAN | HALAL | KACANG ARCIS POLONG RASA LEZAT ALAMI' => ['price' => 25000, 'weight' => 350, 'stock' => 90],
                'READY MEDAN | HALAL | KACANG TOJIN RENYAH BAWANG GURIH 300 GR' => ['price' => 22000, 'weight' => 300, 'stock' => 95],
                'KACANG MADU / KACANG LIHIN / KACANG MANIS 500 GR' => ['price' => 34900, 'weight' => 500, 'stock' => 70],
                'KACANG METE / KACANG KORO BAWANG 500 GR' => ['price' => 32500, 'weight' => 500, 'stock' => 65],
                'READY MEDAN | HALAL | KACANG CAMPUR GURIH 500 GR' => ['price' => 15000, 'weight' => 500, 'stock' => 80],
            ],
            'Madu, Minuman & Herbal' => [
                'READY MEDAN | MADU ADZ DZIKRO HERBAL SUPER 1 KG' => ['price' => 110000, 'weight' => 1000, 'stock' => 40],
                'SR12 GOMILKU SUSU KAMBING ETAWA PACK' => ['price' => 215000, 'weight' => 600, 'stock' => 25],
                'READY | HALAL | MAKANAN SEHAT BUNGA TELANG KERING 100 GR' => ['price' => 16900, 'weight' => 100, 'stock' => 75],
            ],
        ];

        foreach ($data as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($products as $name => $details) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . Str::random(4),
                    'description' => ProductFactory::buatDeskripsi($name),
                    'price' => $details['price'],
                    'stock' => $details['stock'],
                    'weight' => $details['weight'],
                    'is_active' => true,
                ]);
            }
        }
    }
}

