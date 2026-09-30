<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Produk terinspirasi dari toko Shopee ksn2806 (aksesoris HP & elektronik)
     */
    public function run(): void
    {
        // ==================== USERS (3 roles) ====================
        $admin = User::factory()->create([
            'name' => 'Admin KSN Store',
            'email' => 'admin@ksn.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $editor = User::factory()->create([
            'name' => 'Editor KSN',
            'email' => 'editor@ksn.com',
            'password' => bcrypt('password'),
            'role' => 'editor',
        ]);

        $user = User::factory()->create([
            'name' => 'Pembeli Biasa',
            'email' => 'user@ksn.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Extra users
        User::factory(5)->create(['role' => 'user']);

        // ==================== CATEGORIES ====================
        $categories = [
            ['name' => 'Charger & Adaptor', 'slug' => 'charger-adaptor', 'description' => 'Charger HP fast charging, adaptor original', 'icon' => '🔌'],
            ['name' => 'Kabel Data', 'slug' => 'kabel-data', 'description' => 'Kabel USB Type-C, Lightning, Micro USB', 'icon' => '🔗'],
            ['name' => 'Earphone & Headset', 'slug' => 'earphone-headset', 'description' => 'Earphone bluetooth, TWS, headset gaming', 'icon' => '🎧'],
            ['name' => 'Case & Casing HP', 'slug' => 'case-casing-hp', 'description' => 'Soft case, hard case, anti crack', 'icon' => '📱'],
            ['name' => 'Powerbank', 'slug' => 'powerbank', 'description' => 'Powerbank 10000mAh, 20000mAh fast charging', 'icon' => '🔋'],
            ['name' => 'Tempered Glass', 'slug' => 'tempered-glass', 'description' => 'Screen protector, anti gores, privacy glass', 'icon' => '🛡️'],
            ['name' => 'Holder & Stand HP', 'slug' => 'holder-stand-hp', 'description' => 'Holder motor, car holder, lazy bracket', 'icon' => '📲'],
            ['name' => 'Speaker Bluetooth', 'slug' => 'speaker-bluetooth', 'description' => 'Speaker portable, mini speaker, soundbar', 'icon' => '🔊'],
            ['name' => 'Memory Card & OTG', 'slug' => 'memory-card-otg', 'description' => 'MicroSD, flashdisk OTG, card reader', 'icon' => '💾'],
            ['name' => 'Aksesoris Lainnya', 'slug' => 'aksesoris-lainnya', 'description' => 'Ring holder, pop socket, stylus pen', 'icon' => '🎁'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // ==================== PRODUCTS (60+ produk realistis ala Shopee ksn2806) ====================
        $products = [
            // Charger & Adaptor
            ['category' => 'charger-adaptor', 'name' => 'Charger Fast Charging 33W USB-C', 'price' => 89000, 'discount_price' => 65000, 'stock' => 150],
            ['category' => 'charger-adaptor', 'name' => 'Adaptor Charger iPhone 20W Original', 'price' => 125000, 'discount_price' => 99000, 'stock' => 80],
            ['category' => 'charger-adaptor', 'name' => 'Charger Samsung 25W Super Fast Charging', 'price' => 149000, 'discount_price' => 115000, 'stock' => 60],
            ['category' => 'charger-adaptor', 'name' => 'Charger Xiaomi 67W Turbo Charge', 'price' => 175000, 'discount_price' => 139000, 'stock' => 45],
            ['category' => 'charger-adaptor', 'name' => 'Charger OPPO 33W VOOC Flash Charge', 'price' => 135000, 'discount_price' => null, 'stock' => 90],
            ['category' => 'charger-adaptor', 'name' => 'Charger Multi Port 3 USB + Type-C PD', 'price' => 95000, 'discount_price' => 79000, 'stock' => 120],
            ['category' => 'charger-adaptor', 'name' => 'Wireless Charger Pad 15W Qi Compatible', 'price' => 85000, 'discount_price' => 69000, 'stock' => 70],

            // Kabel Data
            ['category' => 'kabel-data', 'name' => 'Kabel Type-C to Type-C 100W PD 1.5M', 'price' => 45000, 'discount_price' => 35000, 'stock' => 200],
            ['category' => 'kabel-data', 'name' => 'Kabel Lightning iPhone Fast Charging 1M', 'price' => 55000, 'discount_price' => 42000, 'stock' => 180],
            ['category' => 'kabel-data', 'name' => 'Kabel Micro USB Premium Nylon Braided 2M', 'price' => 35000, 'discount_price' => 25000, 'stock' => 250],
            ['category' => 'kabel-data', 'name' => 'Kabel Data 3in1 (Lightning+TypeC+Micro)', 'price' => 39000, 'discount_price' => null, 'stock' => 160],
            ['category' => 'kabel-data', 'name' => 'Kabel Magnetic Charging Rotate 540°', 'price' => 49000, 'discount_price' => 38000, 'stock' => 95],
            ['category' => 'kabel-data', 'name' => 'Kabel Type-C to Lightning MFi 1M', 'price' => 79000, 'discount_price' => 65000, 'stock' => 75],

            // Earphone & Headset
            ['category' => 'earphone-headset', 'name' => 'TWS Bluetooth 5.3 Bass Stereo Touch', 'price' => 89000, 'discount_price' => 59000, 'stock' => 130],
            ['category' => 'earphone-headset', 'name' => 'Headset Gaming RGB 7.1 Surround Sound', 'price' => 175000, 'discount_price' => 135000, 'stock' => 40],
            ['category' => 'earphone-headset', 'name' => 'Earphone Bluetooth Neckband Sport Waterproof', 'price' => 79000, 'discount_price' => 55000, 'stock' => 100],
            ['category' => 'earphone-headset', 'name' => 'TWS Pro ANC Active Noise Cancelling', 'price' => 259000, 'discount_price' => 199000, 'stock' => 35],
            ['category' => 'earphone-headset', 'name' => 'Earphone Wired Type-C Hi-Fi Bass', 'price' => 45000, 'discount_price' => null, 'stock' => 200],
            ['category' => 'earphone-headset', 'name' => 'Headphone Bluetooth Over-Ear Foldable', 'price' => 195000, 'discount_price' => 155000, 'stock' => 50],

            // Case & Casing HP
            ['category' => 'case-casing-hp', 'name' => 'Case iPhone 15 Pro MagSafe Silicone', 'price' => 89000, 'discount_price' => 69000, 'stock' => 100],
            ['category' => 'case-casing-hp', 'name' => 'Casing Samsung S24 Ultra Clear Anti Crack', 'price' => 35000, 'discount_price' => 25000, 'stock' => 200],
            ['category' => 'case-casing-hp', 'name' => 'Case OPPO A78 Soft TPU Matte Black', 'price' => 29000, 'discount_price' => null, 'stock' => 180],
            ['category' => 'case-casing-hp', 'name' => 'Casing Xiaomi 14 Armor Shockproof', 'price' => 55000, 'discount_price' => 42000, 'stock' => 120],
            ['category' => 'case-casing-hp', 'name' => 'Case Vivo V30 Premium Leather Flip Cover', 'price' => 75000, 'discount_price' => 59000, 'stock' => 85],
            ['category' => 'case-casing-hp', 'name' => 'Casing Realme 12 Pro Glitter Bling', 'price' => 39000, 'discount_price' => 29000, 'stock' => 150],
            ['category' => 'case-casing-hp', 'name' => 'Case Samsung A55 Ring Holder Kickstand', 'price' => 49000, 'discount_price' => null, 'stock' => 140],

            // Powerbank
            ['category' => 'powerbank', 'name' => 'Powerbank 10000mAh Fast Charging 22.5W', 'price' => 159000, 'discount_price' => 125000, 'stock' => 65],
            ['category' => 'powerbank', 'name' => 'Powerbank 20000mAh PD 65W Laptop Compatible', 'price' => 350000, 'discount_price' => 285000, 'stock' => 30],
            ['category' => 'powerbank', 'name' => 'Powerbank Mini 5000mAh Built-in Cable', 'price' => 89000, 'discount_price' => 69000, 'stock' => 100],
            ['category' => 'powerbank', 'name' => 'Powerbank Solar 30000mAh Outdoor', 'price' => 250000, 'discount_price' => 189000, 'stock' => 25],
            ['category' => 'powerbank', 'name' => 'Powerbank Wireless 15000mAh MagSafe', 'price' => 225000, 'discount_price' => 179000, 'stock' => 40],
            ['category' => 'powerbank', 'name' => 'Powerbank Slim 10000mAh Dual Output', 'price' => 129000, 'discount_price' => null, 'stock' => 80],

            // Tempered Glass
            ['category' => 'tempered-glass', 'name' => 'Tempered Glass iPhone 15 Full Cover 9D', 'price' => 35000, 'discount_price' => 25000, 'stock' => 200],
            ['category' => 'tempered-glass', 'name' => 'Anti Gores Samsung S24 UV Curved Glass', 'price' => 89000, 'discount_price' => 69000, 'stock' => 80],
            ['category' => 'tempered-glass', 'name' => 'Tempered Glass Privacy Anti Spy iPhone 14', 'price' => 45000, 'discount_price' => 35000, 'stock' => 150],
            ['category' => 'tempered-glass', 'name' => 'Screen Protector Hydrogel Film Samsung A55', 'price' => 25000, 'discount_price' => null, 'stock' => 300],
            ['category' => 'tempered-glass', 'name' => 'Tempered Glass Camera Lens Protector', 'price' => 19000, 'discount_price' => 15000, 'stock' => 250],
            ['category' => 'tempered-glass', 'name' => 'Anti Gores OPPO A78 Matte Anti Fingerprint', 'price' => 29000, 'discount_price' => 22000, 'stock' => 180],

            // Holder & Stand HP
            ['category' => 'holder-stand-hp', 'name' => 'Car Holder Magnetic Dashboard Mount', 'price' => 55000, 'discount_price' => 42000, 'stock' => 100],
            ['category' => 'holder-stand-hp', 'name' => 'Holder Motor Universal Anti Getar', 'price' => 65000, 'discount_price' => 49000, 'stock' => 80],
            ['category' => 'holder-stand-hp', 'name' => 'Phone Stand Desktop Foldable Aluminium', 'price' => 45000, 'discount_price' => 35000, 'stock' => 120],
            ['category' => 'holder-stand-hp', 'name' => 'Lazy Bracket Flexible Long Arm Bed Mount', 'price' => 79000, 'discount_price' => null, 'stock' => 70],
            ['category' => 'holder-stand-hp', 'name' => 'Tripod HP Mini dengan Remote Bluetooth', 'price' => 59000, 'discount_price' => 45000, 'stock' => 90],
            ['category' => 'holder-stand-hp', 'name' => 'Ring Light 10 inch + Tripod + Holder HP', 'price' => 149000, 'discount_price' => 119000, 'stock' => 35],

            // Speaker Bluetooth
            ['category' => 'speaker-bluetooth', 'name' => 'Speaker Bluetooth Mini Portable RGB Light', 'price' => 89000, 'discount_price' => 65000, 'stock' => 75],
            ['category' => 'speaker-bluetooth', 'name' => 'Speaker Wireless Waterproof IPX7 Bass Boosted', 'price' => 175000, 'discount_price' => 139000, 'stock' => 45],
            ['category' => 'speaker-bluetooth', 'name' => 'Soundbar PC Gaming USB Wired RGB', 'price' => 125000, 'discount_price' => 95000, 'stock' => 55],
            ['category' => 'speaker-bluetooth', 'name' => 'Speaker Karaoke Bluetooth + 2 Mic Wireless', 'price' => 350000, 'discount_price' => 275000, 'stock' => 20],
            ['category' => 'speaker-bluetooth', 'name' => 'Speaker Bluetooth 5.0 TWS Pairing Stereo', 'price' => 135000, 'discount_price' => null, 'stock' => 60],

            // Memory Card & OTG
            ['category' => 'memory-card-otg', 'name' => 'MicroSD 64GB Class 10 A2 V30 Original', 'price' => 89000, 'discount_price' => 69000, 'stock' => 120],
            ['category' => 'memory-card-otg', 'name' => 'MicroSD 128GB Ultra Speed Up to 150MB/s', 'price' => 149000, 'discount_price' => 115000, 'stock' => 80],
            ['category' => 'memory-card-otg', 'name' => 'Flashdisk OTG 64GB USB 3.0 + Type-C', 'price' => 79000, 'discount_price' => null, 'stock' => 100],
            ['category' => 'memory-card-otg', 'name' => 'Card Reader USB 3.0 All-in-One SD/TF', 'price' => 35000, 'discount_price' => 25000, 'stock' => 150],
            ['category' => 'memory-card-otg', 'name' => 'USB OTG Adapter Type-C to USB-A 3.0', 'price' => 19000, 'discount_price' => 15000, 'stock' => 250],
            ['category' => 'memory-card-otg', 'name' => 'MicroSD 256GB Samsung EVO Plus Original', 'price' => 259000, 'discount_price' => 215000, 'stock' => 40],

            // Aksesoris Lainnya
            ['category' => 'aksesoris-lainnya', 'name' => 'Pop Socket Grip Stand Magnetic MagSafe', 'price' => 35000, 'discount_price' => 25000, 'stock' => 180],
            ['category' => 'aksesoris-lainnya', 'name' => 'Stylus Pen Universal Touch Screen Tablet', 'price' => 45000, 'discount_price' => 35000, 'stock' => 120],
            ['category' => 'aksesoris-lainnya', 'name' => 'Strap HP Wrist Lanyard Aesthetic Korean', 'price' => 15000, 'discount_price' => null, 'stock' => 300],
            ['category' => 'aksesoris-lainnya', 'name' => 'Cleaning Kit 7in1 Laptop & HP', 'price' => 29000, 'discount_price' => 22000, 'stock' => 100],
            ['category' => 'aksesoris-lainnya', 'name' => 'Smartwatch Strap Silicone Universal 22mm', 'price' => 35000, 'discount_price' => 25000, 'stock' => 140],
            ['category' => 'aksesoris-lainnya', 'name' => 'Kipas HP Mini Fan Lightning/Type-C Portable', 'price' => 25000, 'discount_price' => 19000, 'stock' => 200],
            ['category' => 'aksesoris-lainnya', 'name' => 'Webcam HD 1080P USB Plug and Play', 'price' => 159000, 'discount_price' => 125000, 'stock' => 45],
        ];

        $imageMap = [
            'charger-fast-charging-33w-usb-c' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=600&auto=format&fit=crop&q=80',
            'adaptor-charger-iphone-20w-original' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=600&auto=format&fit=crop&q=80',
            'charger-samsung-25w-super-fast-charging' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=600&auto=format&fit=crop&q=80',
            'charger-xiaomi-67w-turbo-charge' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?w=600&auto=format&fit=crop&q=80',
            'charger-oppo-33w-vooc-flash-charge' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=600&auto=format&fit=crop&q=80',
            'charger-multi-port-3-usb-type-c-pd' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80',
            'wireless-charger-pad-15w-qi-compatible' => 'https://images.unsplash.com/photo-1622445262464-84b1456045b6?w=600&auto=format&fit=crop&q=80',
            'kabel-type-c-to-type-c-100w-pd-15m' => 'https://images.unsplash.com/photo-1605648916361-9bc12ad6a569?w=600&auto=format&fit=crop&q=80',
            'kabel-lightning-iphone-fast-charging-1m' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=600&auto=format&fit=crop&q=80',
            'kabel-micro-usb-premium-nylon-braided-2m' => 'https://images.unsplash.com/photo-1596742578443-7682ef5251cd?w=600&auto=format&fit=crop&q=80',
            'kabel-data-3in1-lightningtypecmicro' => 'https://images.unsplash.com/photo-1616440347437-b1c73416efc2?w=600&auto=format&fit=crop&q=80',
            'kabel-magnetic-charging-rotate-540' => 'https://images.unsplash.com/photo-1563770660941-20978e870e26?w=600&auto=format&fit=crop&q=80',
            'kabel-type-c-to-lightning-mfi-1m' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=600&auto=format&fit=crop&q=80',
            'tws-bluetooth-53-bass-stereo-touch' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=600&auto=format&fit=crop&q=80',
            'headset-gaming-rgb-71-surround-sound' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=600&auto=format&fit=crop&q=80',
            'earphone-bluetooth-neckband-sport-waterproof' => 'https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?w=600&auto=format&fit=crop&q=80',
            'tws-pro-anc-active-noise-cancelling' => 'https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?w=600&auto=format&fit=crop&q=80',
            'earphone-wired-type-c-hi-fi-bass' => 'https://images.unsplash.com/photo-1545127398-14699f92334b?w=600&auto=format&fit=crop&q=80',
            'headphone-bluetooth-over-ear-foldable' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80',
            'case-iphone-15-pro-magsafe-silicone' => 'https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=600&auto=format&fit=crop&q=80',
            'casing-samsung-s24-ultra-clear-anti-crack' => 'https://images.unsplash.com/photo-1584006682522-dc17d6c0d963?w=600&auto=format&fit=crop&q=80',
            'case-oppo-a78-soft-tpu-matte-black' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',
            'casing-xiaomi-14-armor-shockproof' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&auto=format&fit=crop&q=80',
            'case-vivo-v30-premium-leather-flip-cover' => 'https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?w=600&auto=format&fit=crop&q=80',
            'casing-realme-12-pro-glitter-bling' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=600&auto=format&fit=crop&q=80',
            'case-samsung-a55-ring-holder-kickstand' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?w=600&auto=format&fit=crop&q=80',
            'powerbank-10000mah-fast-charging-225w' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80',
            'powerbank-20000mah-pd-65w-laptop-compatible' => 'https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?w=600&auto=format&fit=crop&q=80',
            'powerbank-mini-5000mah-built-in-cable' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=600&auto=format&fit=crop&q=80',
            'powerbank-solar-30000mah-outdoor' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80',
            'powerbank-wireless-15000mah-magsafe' => 'https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?w=600&auto=format&fit=crop&q=80',
            'powerbank-slim-10000mah-dual-output' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80',
            'tempered-glass-iphone-15-full-cover-9d' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&auto=format&fit=crop&q=80',
            'anti-gores-samsung-s24-uv-curved-glass' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=600&auto=format&fit=crop&q=80',
            'tempered-glass-privacy-anti-spy-iphone-14' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=600&auto=format&fit=crop&q=80',
            'screen-protector-hydrogel-film-samsung-a55' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=600&auto=format&fit=crop&q=80',
            'tempered-glass-camera-lens-protector' => 'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?w=600&auto=format&fit=crop&q=80',
            'anti-gores-oppo-a78-matte-anti-fingerprint' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',
            'car-holder-magnetic-dashboard-mount' => 'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600&auto=format&fit=crop&q=80',
            'holder-motor-universal-anti-getar' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=600&auto=format&fit=crop&q=80',
            'phone-stand-desktop-foldable-aluminium' => 'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600&auto=format&fit=crop&q=80',
            'lazy-bracket-flexible-long-arm-bed-mount' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&auto=format&fit=crop&q=80',
            'tripod-hp-mini-dengan-remote-bluetooth' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&auto=format&fit=crop&q=80',
            'ring-light-10-inch-tripod-holder-hp' => 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=600&auto=format&fit=crop&q=80',
            'speaker-bluetooth-mini-portable-rgb-light' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=600&auto=format&fit=crop&q=80',
            'speaker-wireless-waterproof-ipx7-bass-boosted' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=600&auto=format&fit=crop&q=80',
            'soundbar-pc-gaming-usb-wired-rgb' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=600&auto=format&fit=crop&q=80',
            'speaker-karaoke-bluetooth-2-mic-wireless' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&auto=format&fit=crop&q=80',
            'speaker-bluetooth-50-tws-pairing-stereo' => 'https://images.unsplash.com/photo-1589003077984-894e133dabab?w=600&auto=format&fit=crop&q=80',
            'microsd-64gb-class-10-a2-v30-original' => 'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?w=600&auto=format&fit=crop&q=80',
            'microsd-128gb-ultra-speed-up-to-150mbs' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=600&auto=format&fit=crop&q=80',
            'flashdisk-otg-64gb-usb-30-type-c' => 'https://images.unsplash.com/photo-1624823183493-5f096236b3f7?w=600&auto=format&fit=crop&q=80',
            'card-reader-usb-30-all-in-one-sdtf' => 'https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?w=600&auto=format&fit=crop&q=80',
            'usb-otg-adapter-type-c-to-usb-a-30' => 'https://images.unsplash.com/photo-1563770660941-20978e870e26?w=600&auto=format&fit=crop&q=80',
            'microsd-256gb-samsung-evo-plus-original' => 'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?w=600&auto=format&fit=crop&q=80',
            'pop-socket-grip-stand-magnetic-magsafe' => 'https://images.unsplash.com/photo-1584006682522-dc17d6c0d963?w=600&auto=format&fit=crop&q=80',
            'stylus-pen-universal-touch-screen-tablet' => 'https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=600&auto=format&fit=crop&q=80',
            'strap-hp-wrist-lanyard-aesthetic-korean' => 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=600&auto=format&fit=crop&q=80',
            'cleaning-kit-7in1-laptop-hp' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=600&auto=format&fit=crop&q=80',
            'smartwatch-strap-silicone-universal-22mm' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=80',
            'kipas-hp-mini-fan-lightningtype-c-portable' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',
            'webcam-hd-1080p-usb-plug-and-play' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600&auto=format&fit=crop&q=80',
        ];

        foreach ($products as $p) {
            $slug = Str::slug($p['name']);
            $category = Category::where('slug', $p['category'])->first();
            Product::create([
                'category_id' => $category->id,
                'name' => $p['name'],
                'slug' => $slug,
                'description' => $this->generateDescription($p['name']),
                'price' => $p['price'],
                'discount_price' => $p['discount_price'],
                'stock' => $p['stock'],
                'image' => '/images/products/' . $slug . '.svg',
                'is_featured' => rand(0, 4) === 0,
            ]);
        }

        // ==================== ORDERS & ORDER ITEMS ====================
        $allProducts = Product::all();
        $allUsers = User::where('role', 'user')->get();

        foreach ($allUsers as $u) {
            $orderCount = rand(1, 3);
            for ($i = 0; $i < $orderCount; $i++) {
                $orderProducts = $allProducts->random(rand(1, 4));
                $totalPrice = 0;

                $order = Order::create([
                    'user_id' => $u->id,
                    'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                    'total_price' => 0,
                    'status' => ['pending', 'processing', 'shipped', 'delivered'][rand(0, 3)],
                    'shipping_address' => 'Jl. ' . fake()->streetName() . ' No. ' . rand(1, 100) . ', ' . fake()->city(),
                ]);

                foreach ($orderProducts as $prod) {
                    $qty = rand(1, 3);
                    $price = $prod->effective_price;
                    $subtotal = $price * $qty;
                    $totalPrice += $subtotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $prod->id,
                        'quantity' => $qty,
                        'price' => $price,
                        'subtotal' => $subtotal,
                    ]);
                }

                $order->update(['total_price' => $totalPrice]);
            }
        }

        // ==================== CARTS ====================
        foreach ($allUsers->take(3) as $u) {
            $cart = Cart::create(['user_id' => $u->id]);
            $cartProducts = $allProducts->random(rand(1, 3));
            foreach ($cartProducts as $prod) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $prod->id,
                    'quantity' => rand(1, 2),
                ]);
            }
        }
    }

    private function generateDescription(string $name): string
    {
        $descriptions = [
            "Produk berkualitas tinggi {$name}. Cocok untuk kebutuhan sehari-hari dengan performa terbaik di kelasnya.",
            "{$name} hadir dengan desain premium dan material pilihan. Garansi resmi 1 tahun.",
            "Dapatkan {$name} dengan harga terjangkau. Fitur lengkap, kualitas terjamin, pengiriman cepat.",
            "{$name} - solusi terbaik untuk gadget Anda. Kompatibel dengan berbagai merk HP terkini.",
            "Original 100%! {$name} dengan teknologi terbaru. Stok terbatas, order sekarang!",
        ];
        return $descriptions[array_rand($descriptions)];
    }
}
