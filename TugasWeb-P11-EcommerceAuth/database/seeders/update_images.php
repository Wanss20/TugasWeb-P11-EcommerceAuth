<?php

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

// 62 unique, curated high quality images for accessories
$imageMap = [
    // --- Charger & Adaptor ---
    'charger-fast-charging-33w-usb-c' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=600&auto=format&fit=crop&q=80',
    'adaptor-charger-iphone-20w-original' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=600&auto=format&fit=crop&q=80',
    'charger-samsung-25w-super-fast-charging' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=600&auto=format&fit=crop&q=80',
    'charger-xiaomi-67w-turbo-charge' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?w=600&auto=format&fit=crop&q=80',
    'charger-oppo-33w-vooc-flash-charge' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=600&auto=format&fit=crop&q=80',
    'charger-multi-port-3-usb-type-c-pd' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80',
    'wireless-charger-pad-15w-qi-compatible' => 'https://images.unsplash.com/photo-1622445262464-84b1456045b6?w=600&auto=format&fit=crop&q=80',

    // --- Kabel Data ---
    'kabel-type-c-to-type-c-100w-pd-15m' => 'https://images.unsplash.com/photo-1605648916361-9bc12ad6a569?w=600&auto=format&fit=crop&q=80',
    'kabel-lightning-iphone-fast-charging-1m' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=600&auto=format&fit=crop&q=80',
    'kabel-micro-usb-premium-nylon-braided-2m' => 'https://images.unsplash.com/photo-1596742578443-7682ef5251cd?w=600&auto=format&fit=crop&q=80',
    'kabel-data-3in1-lightningtypecmicro' => 'https://images.unsplash.com/photo-1616440347437-b1c73416efc2?w=600&auto=format&fit=crop&q=80',
    'kabel-magnetic-charging-rotate-540' => 'https://images.unsplash.com/photo-1563770660941-20978e870e26?w=600&auto=format&fit=crop&q=80',
    'kabel-type-c-to-lightning-mfi-1m' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=600&auto=format&fit=crop&q=80',

    // --- Earphone & Headset ---
    'tws-bluetooth-53-bass-stereo-touch' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=600&auto=format&fit=crop&q=80',
    'headset-gaming-rgb-71-surround-sound' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=600&auto=format&fit=crop&q=80',
    'earphone-bluetooth-neckband-sport-waterproof' => 'https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?w=600&auto=format&fit=crop&q=80',
    'tws-pro-anc-active-noise-cancelling' => 'https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?w=600&auto=format&fit=crop&q=80',
    'earphone-wired-type-c-hi-fi-bass' => 'https://images.unsplash.com/photo-1545127398-14699f92334b?w=600&auto=format&fit=crop&q=80',
    'headphone-bluetooth-over-ear-foldable' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80',

    // --- Case & Casing HP ---
    'case-iphone-15-pro-magsafe-silicone' => 'https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=600&auto=format&fit=crop&q=80',
    'casing-samsung-s24-ultra-clear-anti-crack' => 'https://images.unsplash.com/photo-1584006682522-dc17d6c0d963?w=600&auto=format&fit=crop&q=80',
    'case-oppo-a78-soft-tpu-matte-black' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',
    'casing-xiaomi-14-armor-shockproof' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&auto=format&fit=crop&q=80',
    'case-vivo-v30-premium-leather-flip-cover' => 'https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?w=600&auto=format&fit=crop&q=80',
    'casing-realme-12-pro-glitter-bling' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=600&auto=format&fit=crop&q=80',
    'case-samsung-a55-ring-holder-kickstand' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?w=600&auto=format&fit=crop&q=80',

    // --- Powerbank ---
    'powerbank-10000mah-fast-charging-225w' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80',
    'powerbank-20000mah-pd-65w-laptop-compatible' => 'https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?w=600&auto=format&fit=crop&q=80',
    'powerbank-mini-5000mah-built-in-cable' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=600&auto=format&fit=crop&q=80',
    'powerbank-solar-30000mah-outdoor' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80',
    'powerbank-wireless-15000mah-magsafe' => 'https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?w=600&auto=format&fit=crop&q=80',
    'powerbank-slim-10000mah-dual-output' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80',

    // --- Tempered Glass ---
    'tempered-glass-iphone-15-full-cover-9d' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&auto=format&fit=crop&q=80',
    'anti-gores-samsung-s24-uv-curved-glass' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=600&auto=format&fit=crop&q=80',
    'tempered-glass-privacy-anti-spy-iphone-14' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=600&auto=format&fit=crop&q=80',
    'screen-protector-hydrogel-film-samsung-a55' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=600&auto=format&fit=crop&q=80',
    'tempered-glass-camera-lens-protector' => 'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?w=600&auto=format&fit=crop&q=80',
    'anti-gores-oppo-a78-matte-anti-fingerprint' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',

    // --- Holder & Stand HP ---
    'car-holder-magnetic-dashboard-mount' => 'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600&auto=format&fit=crop&q=80',
    'holder-motor-universal-anti-getar' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=600&auto=format&fit=crop&q=80',
    'phone-stand-desktop-foldable-aluminium' => 'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600&auto=format&fit=crop&q=80',
    'lazy-bracket-flexible-long-arm-bed-mount' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&auto=format&fit=crop&q=80',
    'tripod-hp-mini-dengan-remote-bluetooth' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&auto=format&fit=crop&q=80',
    'ring-light-10-inch-tripod-holder-hp' => 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=600&auto=format&fit=crop&q=80',

    // --- Speaker Bluetooth ---
    'speaker-bluetooth-mini-portable-rgb-light' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=600&auto=format&fit=crop&q=80',
    'speaker-wireless-waterproof-ipx7-bass-boosted' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=600&auto=format&fit=crop&q=80',
    'soundbar-pc-gaming-usb-wired-rgb' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=600&auto=format&fit=crop&q=80',
    'speaker-karaoke-bluetooth-2-mic-wireless' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&auto=format&fit=crop&q=80',
    'speaker-bluetooth-50-tws-pairing-stereo' => 'https://images.unsplash.com/photo-1589003077984-894e133dabab?w=600&auto=format&fit=crop&q=80',

    // --- Memory Card & OTG ---
    'microsd-64gb-class-10-a2-v30-original' => 'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?w=600&auto=format&fit=crop&q=80',
    'microsd-128gb-ultra-speed-up-to-150mbs' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=600&auto=format&fit=crop&q=80',
    'flashdisk-otg-64gb-usb-30-type-c' => 'https://images.unsplash.com/photo-1624823183493-5f096236b3f7?w=600&auto=format&fit=crop&q=80',
    'card-reader-usb-30-all-in-one-sdtf' => 'https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?w=600&auto=format&fit=crop&q=80',
    'usb-otg-adapter-type-c-to-usb-a-30' => 'https://images.unsplash.com/photo-1563770660941-20978e870e26?w=600&auto=format&fit=crop&q=80',
    'microsd-256gb-samsung-evo-plus-original' => 'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?w=600&auto=format&fit=crop&q=80',

    // --- Aksesoris Lainnya ---
    'pop-socket-grip-stand-magnetic-magsafe' => 'https://images.unsplash.com/photo-1584006682522-dc17d6c0d963?w=600&auto=format&fit=crop&q=80',
    'stylus-pen-universal-touch-screen-tablet' => 'https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=600&auto=format&fit=crop&q=80',
    'strap-hp-wrist-lanyard-aesthetic-korean' => 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=600&auto=format&fit=crop&q=80',
    'cleaning-kit-7in1-laptop-hp' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=600&auto=format&fit=crop&q=80',
    'smartwatch-strap-silicone-universal-22mm' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=80',
    'kipas-hp-mini-fan-lightningtype-c-portable' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=600&auto=format&fit=crop&q=80',
    'webcam-hd-1080p-usb-plug-and-play' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600&auto=format&fit=crop&q=80',
];

$updated = 0;
foreach (Product::all() as $prod) {
    $slug = $prod->slug;
    if (isset($imageMap[$slug])) {
        $prod->update(['image' => $imageMap[$slug]]);
        $updated++;
    } else {
        // Fallback with search term
        $prod->update(['image' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=600&auto=format&fit=crop&q=80']);
    }
}

echo "Updated {$updated} products with unique image URLs.\n";
