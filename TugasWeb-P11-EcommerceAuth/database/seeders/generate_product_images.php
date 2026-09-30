<?php

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

$outputDir = __DIR__ . '/../../public/images/products';
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

// Visual theme and icon definition for all 62 products
$productVisuals = [
    // --- Charger & Adaptor ---
    'charger-fast-charging-33w-usb-c' => [
        'bg' => ['#4f46e5', '#312e81'],
        'accent' => '#fbbf24',
        'type' => 'charger',
        'badge' => '33W Turbo',
        'label' => 'FAST CHARGER',
        'sub' => 'USB-C Quick Charge 3.0'
    ],
    'adaptor-charger-iphone-20w-original' => [
        'bg' => ['#f3f4f6', '#e5e7eb'],
        'accent' => '#111827',
        'type' => 'apple_adapter',
        'badge' => '20W PD',
        'label' => 'iPHONE ADAPTOR',
        'sub' => 'Power Delivery USB-C'
    ],
    'charger-samsung-25w-super-fast-charging' => [
        'bg' => ['#1e293b', '#0f172a'],
        'accent' => '#38bdf8',
        'type' => 'charger',
        'badge' => '25W Super Fast',
        'label' => 'SAMSUNG CHARGER',
        'sub' => 'Type-C Super Fast 25W'
    ],
    'charger-xiaomi-67w-turbo-charge' => [
        'bg' => ['#ff6900', '#c2410c'],
        'accent' => '#ffffff',
        'type' => 'charger',
        'badge' => '67W Turbo',
        'label' => 'XIAOMI TURBO CHARGER',
        'sub' => 'HyperCharge 67 Watt'
    ],
    'charger-oppo-33w-vooc-flash-charge' => [
        'bg' => ['#059669', '#064e3b'],
        'accent' => '#34d399',
        'type' => 'charger',
        'badge' => '33W SuperVOOC',
        'label' => 'OPPO FLASH CHARGE',
        'sub' => 'VOOC Fast Charging 33W'
    ],
    'charger-multi-port-3-usb-type-c-pd' => [
        'bg' => ['#3b82f6', '#1e3a8a'],
        'accent' => '#93c5fd',
        'type' => 'multi_charger',
        'badge' => '4-in-1 Ports',
        'label' => 'MULTI-PORT CHARGER',
        'sub' => '3x USB-A + 1x Type-C PD'
    ],
    'wireless-charger-pad-15w-qi-compatible' => [
        'bg' => ['#8b5cf6', '#4c1d95'],
        'accent' => '#c084fc',
        'type' => 'wireless_pad',
        'badge' => '15W Fast Qi',
        'label' => 'WIRELESS CHARGER',
        'sub' => 'Fast Qi Magnetic Pad'
    ],

    // --- Kabel Data ---
    'kabel-type-c-to-type-c-100w-pd-15m' => [
        'bg' => ['#0f172a', '#1e1b4b'],
        'accent' => '#38bdf8',
        'type' => 'cable',
        'badge' => '100W PD / 1.5M',
        'label' => 'TYPE-C TO TYPE-C',
        'sub' => 'Braided Fast Charging Cable'
    ],
    'kabel-lightning-iphone-fast-charging-1m' => [
        'bg' => ['#1e293b', '#334155'],
        'accent' => '#f43f5e',
        'type' => 'cable',
        'badge' => '2.4A Fast / 1M',
        'label' => 'LIGHTNING CABLE',
        'sub' => 'iPhone Fast Charging Cable'
    ],
    'kabel-micro-usb-premium-nylon-braided-2m' => [
        'bg' => ['#374151', '#111827'],
        'accent' => '#10b981',
        'type' => 'cable',
        'badge' => '2.4A / 2 Meter',
        'label' => 'MICRO USB CABLE',
        'sub' => 'Nylon Braided Heavy Duty'
    ],
    'kabel-data-3in1-lightningtypecmicro' => [
        'bg' => ['#d97706', '#78350f'],
        'accent' => '#fef08a',
        'type' => 'cable_3in1',
        'badge' => '3-in-1 Universal',
        'label' => '3-IN-1 DATA CABLE',
        'sub' => 'Lightning + Type-C + Micro'
    ],
    'kabel-magnetic-charging-rotate-540' => [
        'bg' => ['#7c3aed', '#3b0764'],
        'accent' => '#a7f3d0',
        'type' => 'cable_magnetic',
        'badge' => '540° Rotation',
        'label' => 'MAGNETIC CABLE',
        'sub' => 'LED Magnetic Rotating Cable'
    ],
    'kabel-type-c-to-lightning-mfi-1m' => [
        'bg' => ['#2563eb', '#1e3a8a'],
        'accent' => '#60a5fa',
        'type' => 'cable',
        'badge' => 'MFi Certified',
        'label' => 'TYPE-C TO LIGHTNING',
        'sub' => 'Power Delivery Fast Charge'
    ],

    // --- Earphone & Headset ---
    'tws-bluetooth-53-bass-stereo-touch' => [
        'bg' => ['#18181b', '#09090b'],
        'accent' => '#22c55e',
        'type' => 'tws',
        'badge' => 'Bluetooth 5.3',
        'label' => 'TWS WIRELESS EARBUDS',
        'sub' => 'Deep Bass Stereo & Touch Control'
    ],
    'headset-gaming-rgb-71-surround-sound' => [
        'bg' => ['#1e1b4b', '#0f172a'],
        'accent' => '#ec4899',
        'type' => 'headset_gaming',
        'badge' => '7.1 Surround',
        'label' => 'RGB GAMING HEADSET',
        'sub' => 'Noise Cancelling Mic + RGB'
    ],
    'earphone-bluetooth-neckband-sport-waterproof' => [
        'bg' => ['#065f46', '#022c22'],
        'accent' => '#6ee7b7',
        'type' => 'neckband',
        'badge' => 'IPX5 Waterproof',
        'label' => 'SPORT NECKBAND',
        'sub' => 'Magnetic Earbuds 20H Playtime'
    ],
    'tws-pro-anc-active-noise-cancelling' => [
        'bg' => ['#312e81', '#1e1b4b'],
        'accent' => '#818cf8',
        'type' => 'tws',
        'badge' => 'Active ANC',
        'label' => 'TWS PRO ANC',
        'sub' => 'Hybrid Noise Cancellation'
    ],
    'earphone-wired-type-c-hi-fi-bass' => [
        'bg' => ['#334155', '#0f172a'],
        'accent' => '#38bdf8',
        'type' => 'earphone_wired',
        'badge' => 'Hi-Fi DAC',
        'label' => 'WIRED TYPE-C EARPHONE',
        'sub' => 'HD Microphone & Metal Housing'
    ],
    'headphone-bluetooth-over-ear-foldable' => [
        'bg' => ['#475569', '#1e293b'],
        'accent' => '#f59e0b',
        'type' => 'headphone',
        'badge' => 'Over-Ear Foldable',
        'label' => 'WIRELESS HEADPHONE',
        'sub' => '40mm Driver Bass Booster'
    ],

    // --- Case & Casing HP ---
    'case-iphone-15-pro-magsafe-silicone' => [
        'bg' => ['#1e1b4b', '#312e81'],
        'accent' => '#a5b4fc',
        'type' => 'phone_case',
        'badge' => 'MagSafe Ready',
        'label' => 'iPHONE 15 PRO CASE',
        'sub' => 'Liquid Silicone Soft Touch'
    ],
    'casing-samsung-s24-ultra-clear-anti-crack' => [
        'bg' => ['#0f766e', '#134e4a'],
        'accent' => '#5eead4',
        'type' => 'phone_case',
        'badge' => 'Anti Crack 4 Corner',
        'label' => 'SAMSUNG S24 ULTRA',
        'sub' => 'Crystal Clear Hybrid Case'
    ],
    'case-oppo-a78-soft-tpu-matte-black' => [
        'bg' => ['#18181b', '#27272a'],
        'accent' => '#a1a1aa',
        'type' => 'phone_case',
        'badge' => 'Matte TPU',
        'label' => 'OPPO A78 CASE',
        'sub' => 'Ultra Slim Anti Fingerprint'
    ],
    'casing-xiaomi-14-armor-shockproof' => [
        'bg' => ['#991b1b', '#450a0a'],
        'accent' => '#fca5a5',
        'type' => 'phone_case',
        'badge' => 'Armor Shockproof',
        'label' => 'XIAOMI 14 ARMOR',
        'sub' => 'Heavy Duty Military Grade'
    ],
    'case-vivo-v30-premium-leather-flip-cover' => [
        'bg' => ['#78350f', '#451a03'],
        'accent' => '#fde68a',
        'type' => 'phone_case',
        'badge' => 'Leather Flip',
        'label' => 'VIVO V30 CASE',
        'sub' => 'Wallet Card Slot & Kickstand'
    ],
    'casing-realme-12-pro-glitter-bling' => [
        'bg' => ['#831843', '#500724'],
        'accent' => '#f472b6',
        'type' => 'phone_case',
        'badge' => 'Glitter Bling',
        'label' => 'REALME 12 PRO',
        'sub' => 'Sparkle Diamond Protective Case'
    ],
    'case-samsung-a55-ring-holder-kickstand' => [
        'bg' => ['#1e3a8a', '#172554'],
        'accent' => '#60a5fa',
        'type' => 'phone_case',
        'badge' => 'Ring Holder',
        'label' => 'SAMSUNG A55 CASE',
        'sub' => 'Magnetic Ring 360° Stand'
    ],

    // --- Powerbank ---
    'powerbank-10000mah-fast-charging-225w' => [
        'bg' => ['#0f172a', '#1e293b'],
        'accent' => '#38bdf8',
        'type' => 'powerbank',
        'badge' => '10.000 mAh / 22.5W',
        'label' => 'FAST POWERBANK',
        'sub' => 'Digital LED Display & Dual USB'
    ],
    'powerbank-20000mah-pd-65w-laptop-compatible' => [
        'bg' => ['#18181b', '#09090b'],
        'accent' => '#ef4444',
        'type' => 'powerbank',
        'badge' => '20.000 mAh / 65W PD',
        'label' => 'LAPTOP POWERBANK',
        'sub' => 'Supports MacBook & Heavy Devices'
    ],
    'powerbank-mini-5000mah-built-in-cable' => [
        'bg' => ['#059669', '#064e3b'],
        'accent' => '#6ee7b7',
        'type' => 'powerbank',
        'badge' => '5.000 mAh Pocket',
        'label' => 'MINI POWERBANK',
        'sub' => 'Built-in Lightning & Type-C Cable'
    ],
    'powerbank-solar-30000mah-outdoor' => [
        'bg' => ['#854d0e', '#422006'],
        'accent' => '#facc15',
        'type' => 'powerbank',
        'badge' => '30.000 mAh Solar',
        'label' => 'SOLAR POWERBANK',
        'sub' => 'Outdoor Rugged + LED Flashlight'
    ],
    'powerbank-wireless-15000mah-magsafe' => [
        'bg' => ['#4338ca', '#312e81'],
        'accent' => '#a5b4fc',
        'type' => 'powerbank',
        'badge' => '15.000 mAh MagSafe',
        'label' => 'WIRELESS POWERBANK',
        'sub' => 'Strong Magnetic Snap-on'
    ],
    'powerbank-slim-10000mah-dual-output' => [
        'bg' => ['#334155', '#1e293b'],
        'accent' => '#cbd5e1',
        'type' => 'powerbank',
        'badge' => '10.000 mAh Ultra Slim',
        'label' => 'SLIM POWERBANK',
        'sub' => 'Aluminium Body Dual USB Output'
    ],

    // --- Tempered Glass ---
    'tempered-glass-iphone-15-full-cover-9d' => [
        'bg' => ['#1e1b4b', '#0f172a'],
        'accent' => '#60a5fa',
        'type' => 'tempered_glass',
        'badge' => '9D Full Cover',
        'label' => 'iPHONE 15 TEMPERED',
        'sub' => 'Anti Gores 9H Hardness Glass'
    ],
    'anti-gores-samsung-s24-uv-curved-glass' => [
        'bg' => ['#0f766e', '#115e59'],
        'accent' => '#2dd4bf',
        'type' => 'tempered_glass',
        'badge' => 'UV Optical Glue',
        'label' => 'SAMSUNG S24 UV GLASS',
        'sub' => '3D Curved Screen Protector'
    ],
    'tempered-glass-privacy-anti-spy-iphone-14' => [
        'bg' => ['#18181b', '#09090b'],
        'accent' => '#a855f7',
        'type' => 'tempered_glass',
        'badge' => 'Privacy Anti Spy',
        'label' => 'PRIVACY GLASS',
        'sub' => 'Anti Intip 28° Angle Shield'
    ],
    'screen-protector-hydrogel-film-samsung-a55' => [
        'bg' => ['#0369a1', '#075985'],
        'accent' => '#38bdf8',
        'type' => 'hydrogel',
        'badge' => 'Self-Healing Film',
        'label' => 'HYDROGEL FILM',
        'sub' => 'Ultra Clear Flexible Protector'
    ],
    'tempered-glass-camera-lens-protector' => [
        'bg' => ['#3f3f46', '#18181b'],
        'accent' => '#fbbf24',
        'type' => 'lens_protector',
        'badge' => 'Camera Lens 9H',
        'label' => 'LENS PROTECTOR',
        'sub' => 'Diamond Ring Camera Glass'
    ],
    'anti-gores-oppo-a78-matte-anti-fingerprint' => [
        'bg' => ['#1e293b', '#0f172a'],
        'accent' => '#4ade80',
        'type' => 'tempered_glass',
        'badge' => 'Matte Anti Glare',
        'label' => 'OPPO A78 MATTE',
        'sub' => 'Smooth Touch for Mobile Gaming'
    ],

    // --- Holder & Stand HP ---
    'car-holder-magnetic-dashboard-mount' => [
        'bg' => ['#1e293b', '#0f172a'],
        'accent' => '#38bdf8',
        'type' => 'holder_car',
        'badge' => 'Magnetic 360°',
        'label' => 'CAR PHONE HOLDER',
        'sub' => 'Dashboard & AC Vent Magnetic Mount'
    ],
    'holder-motor-universal-anti-getar' => [
        'bg' => ['#7f1d1d', '#450a0a'],
        'accent' => '#f87171',
        'type' => 'holder_motor',
        'badge' => 'Anti-Vibration',
        'label' => 'HOLDER MOTOR HP',
        'sub' => 'Handlebar Mount Anti Begal'
    ],
    'phone-stand-desktop-foldable-aluminium' => [
        'bg' => ['#334155', '#1e293b'],
        'accent' => '#94a3b8',
        'type' => 'stand_desktop',
        'badge' => 'Solid Aluminium',
        'label' => 'DESKTOP STAND',
        'sub' => 'Foldable Angle & Height Adjust'
    ],
    'lazy-bracket-flexible-long-arm-bed-mount' => [
        'bg' => ['#581c87', '#3b0764'],
        'accent' => '#d8b4fe',
        'type' => 'lazy_bracket',
        'badge' => 'Flexible Arm 100cm',
        'label' => 'LAZY BRACKET HP',
        'sub' => 'Bed & Desk Gooseneck Mount'
    ],
    'tripod-hp-mini-dengan-remote-bluetooth' => [
        'bg' => ['#14532d', '#052e16'],
        'accent' => '#4ade80',
        'type' => 'tripod',
        'badge' => 'Bluetooth Remote',
        'label' => 'MINI TRIPOD HP',
        'sub' => 'Selfie Stick & Desktop Tripod'
    ],
    'ring-light-10-inch-tripod-holder-hp' => [
        'bg' => ['#831843', '#500724'],
        'accent' => '#fb7185',
        'type' => 'ring_light',
        'badge' => '10 Inch 3 Mode',
        'label' => 'RING LIGHT SET',
        'sub' => 'Live Streaming Tripod Stand'
    ],

    // --- Speaker Bluetooth ---
    'speaker-bluetooth-mini-portable-rgb-light' => [
        'bg' => ['#18181b', '#09090b'],
        'accent' => '#a855f7',
        'type' => 'speaker_rgb',
        'badge' => 'RGB Light Show',
        'label' => 'MINI RGB SPEAKER',
        'sub' => '360° Surround Sound & Bass'
    ],
    'speaker-wireless-waterproof-ipx7-bass-boosted' => [
        'bg' => ['#0e7490', '#155e75'],
        'accent' => '#22d3ee',
        'type' => 'speaker_waterproof',
        'badge' => 'IPX7 Waterproof',
        'label' => 'OUTDOOR SPEAKER',
        'sub' => 'Shockproof Heavy Bass 24H'
    ],
    'soundbar-pc-gaming-usb-wired-rgb' => [
        'bg' => ['#1e1b4b', '#0f172a'],
        'accent' => '#f43f5e',
        'type' => 'soundbar',
        'badge' => 'Gaming Soundbar',
        'label' => 'PC SOUNDBAR RGB',
        'sub' => 'Stereo 3D Audio & USB Power'
    ],
    'speaker-karaoke-bluetooth-2-mic-wireless' => [
        'bg' => ['#701a75', '#4a044e'],
        'accent' => '#f0abfc',
        'type' => 'speaker_karaoke',
        'badge' => '2 Wireless Mic',
        'label' => 'KARAOKE SPEAKER',
        'sub' => 'Echo Effect & Vocal Cut'
    ],
    'speaker-bluetooth-50-tws-pairing-stereo' => [
        'bg' => ['#1e3a8a', '#172554'],
        'accent' => '#60a5fa',
        'type' => 'speaker_tws',
        'badge' => 'TWS Dual Pair',
        'label' => 'TWS BT SPEAKER',
        'sub' => 'True Wireless Stereo Pairing'
    ],

    // --- Memory Card & OTG ---
    'microsd-64gb-class-10-a2-v30-original' => [
        'bg' => ['#991b1b', '#450a0a'],
        'accent' => '#fca5a5',
        'type' => 'microsd',
        'badge' => '64GB / V30 A2',
        'label' => 'MICROSD 64GB',
        'sub' => 'Class 10 4K UHD Video Support'
    ],
    'microsd-128gb-ultra-speed-up-to-150mbs' => [
        'bg' => ['#c2410c', '#7c2d12'],
        'accent' => '#fed7aa',
        'type' => 'microsd',
        'badge' => '128GB / 150MB/s',
        'label' => 'MICROSD 128GB',
        'sub' => 'Ultra High Speed Transfer'
    ],
    'flashdisk-otg-64gb-usb-30-type-c' => [
        'bg' => ['#334155', '#0f172a'],
        'accent' => '#38bdf8',
        'type' => 'flashdisk_otg',
        'badge' => 'Dual USB 3.0 + Type-C',
        'label' => 'FLASHDISK OTG 64GB',
        'sub' => 'Metal Swivel Flash Drive'
    ],
    'card-reader-usb-30-all-in-one-sdtf' => [
        'bg' => ['#1e293b', '#0f172a'],
        'accent' => '#a7f3d0',
        'type' => 'card_reader',
        'badge' => 'USB 3.0 SD/TF',
        'label' => 'CARD READER ALL-IN-1',
        'sub' => 'High Speed Memory Card Adapter'
    ],
    'usb-otg-adapter-type-c-to-usb-a-30' => [
        'bg' => ['#475569', '#1e293b'],
        'accent' => '#e2e8f0',
        'type' => 'otg_adapter',
        'badge' => 'Type-C to USB 3.0',
        'label' => 'MINI OTG ADAPTER',
        'sub' => 'Plug & Play Metal Connector'
    ],
    'microsd-256gb-samsung-evo-plus-original' => [
        'bg' => ['#1e3a8a', '#172554'],
        'accent' => '#fbbf24',
        'type' => 'microsd',
        'badge' => '256GB EVO PLUS',
        'label' => 'SAMSUNG MICROSD 256GB',
        'sub' => '130MB/s Full HD & 4K Ready'
    ],

    // --- Aksesoris Lainnya ---
    'pop-socket-grip-stand-magnetic-magsafe' => [
        'bg' => ['#be185d', '#831843'],
        'accent' => '#fbcfe8',
        'type' => 'popsocket',
        'badge' => 'MagSafe Grip',
        'label' => 'POP SOCKET MAGSAFE',
        'sub' => 'Foldable Phone Grip Stand'
    ],
    'stylus-pen-universal-touch-screen-tablet' => [
        'bg' => ['#0f766e', '#134e4a'],
        'accent' => '#99f6e4',
        'type' => 'stylus',
        'badge' => 'Precision Nib',
        'label' => 'UNIVERSAL STYLUS PEN',
        'sub' => 'High Sensitivity for Tablet & Phone'
    ],
    'strap-hp-wrist-lanyard-aesthetic-korean' => [
        'bg' => ['#db2777', '#9d174d'],
        'accent' => '#fdf2f8',
        'type' => 'strap',
        'badge' => 'Korean Aesthetic',
        'label' => 'WRIST STRAP LANYARD',
        'sub' => 'Beaded Phone Charm Hand Strap'
    ],
    'cleaning-kit-7in1-laptop-hp' => [
        'bg' => ['#0284c7', '#0369a1'],
        'accent' => '#bae6fd',
        'type' => 'cleaning_kit',
        'badge' => '7-in-1 Kit',
        'label' => 'CLEANING KIT 7-IN-1',
        'sub' => 'Brush, Pen, Spray for Screen & Buds'
    ],
    'smartwatch-strap-silicone-universal-22mm' => [
        'bg' => ['#374151', '#1f2937'],
        'accent' => '#f97316',
        'type' => 'watch_strap',
        'badge' => 'Silicone 22mm',
        'label' => 'SMARTWATCH STRAP',
        'sub' => 'Breathable Soft Sport Band'
    ],
    'kipas-hp-mini-fan-lightningtype-c-portable' => [
        'bg' => ['#0d9488', '#115e59'],
        'accent' => '#5eead4',
        'type' => 'fan',
        'badge' => 'Mini Plug-in Fan',
        'label' => 'KIPAS HP PORTABLE',
        'sub' => 'Lightning & Type-C Silent Breeze'
    ],
    'webcam-hd-1080p-usb-plug-and-play' => [
        'bg' => ['#1e1b4b', '#0f172a'],
        'accent' => '#38bdf8',
        'type' => 'webcam',
        'badge' => 'Full HD 1080P',
        'label' => 'USB WEBCAM 1080P',
        'sub' => 'Built-in Mic & Privacy Cover'
    ],
];

// Helper to generate SVG icon paths for gadget types
function getGadgetIcon(string $type, string $accent): string {
    switch ($type) {
        case 'charger':
        case 'apple_adapter':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Charger body -->
                <rect x="25" y="45" width="70" height="75" rx="14" fill="#ffffff" filter="drop-shadow(0 10px 15px rgba(0,0,0,0.3))"/>
                <!-- Prongs -->
                <rect x="42" y="15" width="10" height="32" rx="4" fill="#cbd5e1"/>
                <rect x="68" y="15" width="10" height="32" rx="4" fill="#cbd5e1"/>
                <!-- Port / Accent icon -->
                <circle cx="60" cy="80" r="16" fill="{$accent}" opacity="0.2"/>
                <path d="M60 70 L52 82 L58 82 L57 92 L68 78 L62 78 Z" fill="{$accent}"/>
                <rect x="52" y="102" width="16" height="6" rx="3" fill="#94a3b8"/>
            </g>
SVG;
        case 'multi_charger':
            return <<<SVG
            <g transform="translate(140, 65)">
                <rect x="20" y="35" width="80" height="90" rx="16" fill="#ffffff" filter="drop-shadow(0 10px 15px rgba(0,0,0,0.3))"/>
                <rect x="40" y="12" width="10" height="25" rx="4" fill="#cbd5e1"/>
                <rect x="70" y="12" width="10" height="25" rx="4" fill="#cbd5e1"/>
                <!-- 4 ports -->
                <rect x="35" y="55" width="20" height="6" rx="2" fill="#3b82f6"/>
                <rect x="65" y="55" width="20" height="6" rx="2" fill="#3b82f6"/>
                <rect x="35" y="75" width="20" height="6" rx="2" fill="#3b82f6"/>
                <rect x="50" y="95" width="20" height="8" rx="4" fill="#f97316"/>
            </g>
SVG;
        case 'wireless_pad':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Base disc -->
                <ellipse cx="60" cy="80" rx="60" ry="40" fill="#ffffff" filter="drop-shadow(0 15px 20px rgba(0,0,0,0.3))"/>
                <ellipse cx="60" cy="76" rx="48" ry="30" fill="#f1f5f9"/>
                <ellipse cx="60" cy="74" rx="32" ry="20" fill="{$accent}" opacity="0.3"/>
                <!-- Qi / Lightning icon -->
                <path d="M62 60 L54 74 L60 74 L58 86 L68 70 L62 70 Z" fill="{$accent}"/>
            </g>
SVG;
        case 'cable':
        case 'cable_3in1':
        case 'cable_magnetic':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Cable coils -->
                <path d="M20 90 Q 60 20, 100 90 T 60 130" fill="none" stroke="{$accent}" stroke-width="8" stroke-linecap="round" opacity="0.6"/>
                <!-- Connector Heads -->
                <rect x="10" y="80" width="24" height="40" rx="6" fill="#ffffff" filter="drop-shadow(0 6px 10px rgba(0,0,0,0.3))"/>
                <rect x="16" y="65" width="12" height="18" rx="3" fill="#cbd5e1"/>
                <rect x="86" y="80" width="24" height="40" rx="6" fill="#ffffff" filter="drop-shadow(0 6px 10px rgba(0,0,0,0.3))"/>
                <rect x="92" y="65" width="12" height="18" rx="3" fill="#cbd5e1"/>
            </g>
SVG;
        case 'tws':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Case -->
                <rect x="25" y="45" width="70" height="60" rx="24" fill="#ffffff" filter="drop-shadow(0 12px 20px rgba(0,0,0,0.3))"/>
                <line x1="25" y1="65" x2="95" y2="65" stroke="#e2e8f0" stroke-width="2"/>
                <circle cx="60" cy="80" r="3" fill="{$accent}"/>
                <!-- Floating Earbud -->
                <ellipse cx="60" cy="28" rx="14" ry="10" fill="#ffffff" filter="drop-shadow(0 4px 8px rgba(0,0,0,0.2))"/>
                <rect x="56" y="32" width="8" height="22" rx="4" fill="#ffffff"/>
            </g>
SVG;
        case 'headset_gaming':
        case 'headphone':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Arch -->
                <path d="M20 70 A 40 40 0 0 1 100 70" fill="none" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                <!-- Earcups -->
                <rect x="12" y="60" width="20" height="40" rx="8" fill="{$accent}" filter="drop-shadow(0 8px 12px rgba(0,0,0,0.4))"/>
                <rect x="88" y="60" width="20" height="40" rx="8" fill="{$accent}" filter="drop-shadow(0 8px 12px rgba(0,0,0,0.4))"/>
                <!-- Mic -->
                <path d="M22 95 Q 40 120, 60 115" fill="none" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                <circle cx="60" cy="115" r="5" fill="{$accent}"/>
            </g>
SVG;
        case 'neckband':
        case 'earphone_wired':
            return <<<SVG
            <g transform="translate(140, 65)">
                <path d="M20 50 C 20 120, 100 120, 100 50" fill="none" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                <rect x="14" y="40" width="12" height="30" rx="6" fill="{$accent}"/>
                <rect x="94" y="40" width="12" height="30" rx="6" fill="{$accent}"/>
            </g>
SVG;
        case 'phone_case':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Phone Case Outline -->
                <rect x="30" y="20" width="60" height="105" rx="14" fill="#ffffff" filter="drop-shadow(0 12px 20px rgba(0,0,0,0.3))"/>
                <!-- Camera cutout -->
                <rect x="38" y="28" width="22" height="24" rx="6" fill="#1e293b"/>
                <circle cx="45" cy="35" r="3" fill="{$accent}"/>
                <circle cx="53" cy="35" r="3" fill="{$accent}"/>
                <circle cx="45" cy="45" r="3" fill="{$accent}"/>
                <!-- MagSafe Ring or design -->
                <circle cx="60" cy="75" r="16" fill="none" stroke="{$accent}" stroke-width="3" opacity="0.7"/>
            </g>
SVG;
        case 'powerbank':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Powerbank body -->
                <rect x="25" y="25" width="70" height="100" rx="14" fill="#ffffff" filter="drop-shadow(0 14px 22px rgba(0,0,0,0.3))"/>
                <!-- LED Digital Display -->
                <rect x="42" y="40" width="36" height="20" rx="4" fill="#0f172a"/>
                <text x="60" y="54" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="{$accent}" text-anchor="middle">100%</text>
                <!-- Ports -->
                <rect x="40" y="105" width="14" height="5" rx="2" fill="#3b82f6"/>
                <rect x="66" y="105" width="14" height="5" rx="2" fill="#3b82f6"/>
                <rect x="54" y="114" width="12" height="4" rx="2" fill="#22c55e"/>
            </g>
SVG;
        case 'tempered_glass':
        case 'hydrogel':
        case 'lens_protector':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Shield Screen -->
                <rect x="32" y="22" width="56" height="100" rx="12" fill="none" stroke="{$accent}" stroke-width="4" filter="drop-shadow(0 8px 16px rgba(0,0,0,0.3))"/>
                <rect x="36" y="26" width="48" height="92" rx="8" fill="#ffffff" opacity="0.2"/>
                <!-- Sparkle -->
                <polygon points="60,45 63,55 73,58 63,61 60,71 57,61 47,58 57,55" fill="{$accent}"/>
                <text x="60" y="95" font-family="Arial, sans-serif" font-size="11" font-weight="bold" fill="#ffffff" text-anchor="middle">9H HD</text>
            </g>
SVG;
        case 'holder_car':
        case 'holder_motor':
        case 'stand_desktop':
        case 'lazy_bracket':
        case 'tripod':
        case 'ring_light':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Stand base -->
                <rect x="25" y="105" width="70" height="12" rx="6" fill="#ffffff" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.3))"/>
                <!-- Stem -->
                <rect x="54" y="55" width="12" height="55" rx="4" fill="#cbd5e1"/>
                <!-- Clamp / Mount -->
                <rect x="35" y="30" width="50" height="30" rx="6" fill="{$accent}" filter="drop-shadow(0 8px 12px rgba(0,0,0,0.3))"/>
                <rect x="42" y="38" width="36" height="14" rx="3" fill="#ffffff"/>
            </g>
SVG;
        case 'speaker_rgb':
        case 'speaker_waterproof':
        case 'soundbar':
        case 'speaker_karaoke':
        case 'speaker_tws':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Speaker Cylinder -->
                <rect x="30" y="35" width="60" height="85" rx="18" fill="#ffffff" filter="drop-shadow(0 14px 22px rgba(0,0,0,0.3))"/>
                <!-- Speaker Grille -->
                <circle cx="60" cy="62" r="16" fill="{$accent}"/>
                <circle cx="60" cy="62" r="8" fill="#0f172a"/>
                <circle cx="60" cy="95" r="10" fill="{$accent}" opacity="0.7"/>
                <circle cx="60" cy="95" r="4" fill="#0f172a"/>
            </g>
SVG;
        case 'microsd':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Card -->
                <path d="M35 35 L75 35 L85 45 L85 105 L35 105 Z" fill="#1e293b" filter="drop-shadow(0 10px 18px rgba(0,0,0,0.4))"/>
                <rect x="35" y="35" width="50" height="20" fill="{$accent}"/>
                <text x="60" y="50" font-family="Arial, sans-serif" font-size="9" font-weight="bold" fill="#ffffff" text-anchor="middle">MicroSD</text>
                <!-- Gold pins -->
                <rect x="40" y="90" width="5" height="12" fill="#fbbf24"/>
                <rect x="48" y="90" width="5" height="12" fill="#fbbf24"/>
                <rect x="56" y="90" width="5" height="12" fill="#fbbf24"/>
                <rect x="64" y="90" width="5" height="12" fill="#fbbf24"/>
                <rect x="72" y="90" width="5" height="12" fill="#fbbf24"/>
            </g>
SVG;
        case 'flashdisk_otg':
        case 'card_reader':
        case 'otg_adapter':
            return <<<SVG
            <g transform="translate(140, 65)">
                <rect x="35" y="45" width="50" height="60" rx="8" fill="#ffffff" filter="drop-shadow(0 10px 16px rgba(0,0,0,0.3))"/>
                <rect x="45" y="25" width="30" height="22" rx="3" fill="#cbd5e1"/>
                <rect x="50" y="30" width="8" height="6" fill="#1e293b"/>
                <rect x="62" y="30" width="8" height="6" fill="#1e293b"/>
                <!-- Type C other side -->
                <rect x="47" y="105" width="26" height="14" rx="4" fill="{$accent}"/>
            </g>
SVG;
        case 'popsocket':
            return <<<SVG
            <g transform="translate(140, 65)">
                <circle cx="60" cy="75" r="38" fill="{$accent}" filter="drop-shadow(0 12px 20px rgba(0,0,0,0.3))"/>
                <circle cx="60" cy="75" r="28" fill="#ffffff"/>
                <circle cx="60" cy="75" r="18" fill="{$accent}"/>
            </g>
SVG;
        case 'stylus':
            return <<<SVG
            <g transform="translate(140, 65)">
                <!-- Pen Body -->
                <rect x="56" y="20" width="8" height="105" rx="4" fill="#ffffff" filter="drop-shadow(0 8px 14px rgba(0,0,0,0.3))"/>
                <polygon points="56,125 64,125 60,135" fill="{$accent}"/>
                <!-- Power LED ring -->
                <circle cx="60" cy="35" r="3" fill="{$accent}"/>
            </g>
SVG;
        case 'strap':
        case 'watch_strap':
            return <<<SVG
            <g transform="translate(140, 65)">
                <path d="M40 30 Q 60 130, 80 30" fill="none" stroke="{$accent}" stroke-width="12" stroke-linecap="round" filter="drop-shadow(0 8px 15px rgba(0,0,0,0.3))"/>
                <circle cx="60" cy="85" r="8" fill="#ffffff"/>
            </g>
SVG;
        case 'cleaning_kit':
        case 'fan':
        case 'webcam':
        default:
            return <<<SVG
            <g transform="translate(140, 65)">
                <circle cx="60" cy="75" r="36" fill="#ffffff" filter="drop-shadow(0 10px 18px rgba(0,0,0,0.3))"/>
                <circle cx="60" cy="75" r="22" fill="{$accent}"/>
                <circle cx="60" cy="75" r="10" fill="#0f172a"/>
            </g>
SVG;
    }
}

// Generate SVG for all products
$count = 0;
foreach (Product::all() as $product) {
    $slug = $product->slug;
    $v = $productVisuals[$slug] ?? [
        'bg' => ['#4f46e5', '#312e81'],
        'accent' => '#fbbf24',
        'type' => 'charger',
        'badge' => 'Original',
        'label' => strtoupper($product->name),
        'sub' => $product->category ? $product->category->name : 'Accessories'
    ];

    $bg1 = $v['bg'][0];
    $bg2 = $v['bg'][1];
    $accent = $v['accent'];
    $badge = htmlspecialchars($v['badge']);
    $label = htmlspecialchars($v['label']);
    $sub = htmlspecialchars($v['sub']);
    $iconSvg = getGadgetIcon($v['type'], $accent);

    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" width="100%" height="100%">
    <defs>
        <linearGradient id="grad_{$product->id}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="{$bg1}" />
            <stop offset="100%" stop-color="{$bg2}" />
        </linearGradient>
        <radialGradient id="glow_{$product->id}" cx="50%" cy="40%" r="50%">
            <stop offset="0%" stop-color="{$accent}" stop-opacity="0.25"/>
            <stop offset="100%" stop-color="{$bg2}" stop-opacity="0"/>
        </radialGradient>
        <filter id="shadow_{$product->id}" x="-20%" y="-20%" width="140%" height="140%">
            <feDropShadow dx="0" dy="8" stdDeviation="6" flood-color="#000000" flood-opacity="0.3"/>
        </filter>
    </defs>
    
    <!-- Background Card -->
    <rect width="400" height="300" rx="16" fill="url(#grad_{$product->id})" />
    <circle cx="200" cy="130" r="140" fill="url(#glow_{$product->id})" />

    <!-- Top Badge -->
    <rect x="24" y="20" width="130" height="28" rx="14" fill="#000000" opacity="0.4"/>
    <text x="89" y="38" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="11" font-weight="700" fill="#ffffff" text-anchor="middle">★ {$badge}</text>

    <!-- Gadget Illustration -->
    {$iconSvg}

    <!-- Bottom Glass Info Bar -->
    <rect x="16" y="215" width="368" height="68" rx="14" fill="#ffffff" fill-opacity="0.12" stroke="#ffffff" stroke-opacity="0.2" stroke-width="1" filter="url(#shadow_{$product->id})"/>
    
    <!-- Text Labels -->
    <text x="32" y="244" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="14" font-weight="800" fill="#ffffff" letter-spacing="0.5">{$label}</text>
    <text x="32" y="264" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="11" font-weight="500" fill="{$accent}">{$sub}</text>
    <text x="368" y="254" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="18" font-weight="900" fill="#ffffff" text-anchor="end">KSN</text>
</svg>
SVG;

    $filePath = $outputDir . '/' . $slug . '.svg';
    file_put_contents($filePath, $svg);

    // Update database record
    $product->update([
        'image' => '/images/products/' . $slug . '.svg'
    ]);
    $count++;
}

echo "Successfully created {$count} high-resolution tailored SVG product graphics.\n";
