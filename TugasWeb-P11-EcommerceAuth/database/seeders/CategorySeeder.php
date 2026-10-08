<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Kerupuk & Keripik' => 'Aneka kerupuk lekor, keripik opak, emping aceh, kulit ikan patin, usus crispy, dan kerupuk seblak khas Medan',
            'Makaroni & Camilan Pedas' => 'Makaroni pedas gurih, basreng daun jeruk, sosreng, stik balado, mie gulung pedas, dan siomay kering',
            'Kue, Biskuit & Pastry' => 'Sus coklat lumer, cookies monsta, bronis mini coklat, curut keju, kue raja manis, dan wafer astor',
            'Coklat, Permen & Manisan' => 'Coklat almond toples, bonibol coklat, donatello chruncy ball, permen somboy, somboi iris, dan manisan buah plum',
            'Kacang & Biji-bijian' => 'Kacang arab, kacang tojin medan, kacang arcis polong, kacang madu lihin, dan kacang mete gurih',
            'Madu, Minuman & Herbal' => 'Madu murni herbal super, susu kambing etawa, dan aneka minuman herbal khas nusantara',
        ];

        foreach ($categories as $name => $desc) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
            ]);
        }
    }
}

