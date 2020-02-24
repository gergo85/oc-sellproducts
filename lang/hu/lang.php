<?php

return [
    'plugin' => [
        'name' => 'Termékeladás',
        'description' => 'Egyszerű eladás űrlap segítségével.',
        'author' => 'Szabó Gergő'
    ],
    'menu' => [
        'orders' => 'Rendelések',
        'reports' => 'Jelentések',
        'products' => 'Termékek',
        'category' => 'Kategóriák',
        'settings' => 'Beállítások'
    ],
    'title' => [
        'orders' => 'rendelés',
        'reports' => 'jelentés',
        'products' => 'termék',
        'category' => 'kategória'
    ],
    'new' => [
        'orders' => 'Új rendelés',
        'products' => 'Új termék',
        'category' => 'Új kategória'
    ],
    'form' => [
        // Általános
        'id' => 'ID',
        'name' => 'Név',
        'slug' => 'Webcím',
        'summary' => 'Összegzés',
        'content' => 'Tartalom',
        'image' => 'Kép',
        'status' => 'Státusz',
        'status_active' => 'Aktív',
        'status_inactive' => 'Inaktív',
        'featured' => 'Kiemelt',
        'yes' => 'Igen',
        'no' => 'Nem',
        // Kategória
        'payments' => 'Fizetési lehetőségek',
        'new_payment' => 'Új fizetés',
        'payment_type' => 'Típus',
        'payment_comment' => 'Megjegyzés',
        'currency' => 'Pénznem',
        'currency_default' => 'HUF',
        'locale' => 'Nyelv',
        'locale_hu' => 'Magyar',
        'locale_en' => 'Angol',
        'locale_de' => 'Német',
        'locale_sl' => 'Szlovén',
        'locale_sk' => 'Szlovák',
        'locale_fr' => 'Francia',
        'locale_cs' => 'Cseh',
        'locale_el' => 'Görög',
        // Termékek
        'category' => 'Kategória',
        'unit_price' => 'Egységár',
        'unit' => 'Egység',
        'unit_piece' => 'darab',
        'quantity' => 'Mennyiség',
        'is_sale' => 'Leértékelt?',
        'sale_price' => 'Akciós ár',
        'sale_start' => 'Akció kezdete',
        'sale_end' => 'Akció vége',
        'orders' => 'Rendelések',
        // Rendelések
        'customer' => 'Vásárló',
        'full_name' => 'Teljes név',
        'first_name' => 'Vezetéknév',
        'last_name' => 'Keresztnév',
        'email' => 'Email',
        'phone' => 'Telefon',
        'billing' => 'Számlázási adatok',
        'shipping' => 'Szállítási adatok',
        'zipcode' => 'Irszám.',
        'city' => 'Város',
        'address' => 'Postai cím',
        'products' => 'Termékek',
        'new_product' => 'Új termék',
        'product' => 'Termék',
        'price_total' => 'Teljes ár',
        'comment' => 'Megjegyzés',
        'payment' => 'Fizetés',
        'status_pending' => 'Folyamatban',
        'status_paid' => 'Fizetve',
        'status_closed' => 'Lezárva',
        'status_cancelled' => 'Törölve'
    ],
    'list' => [
        'warning_title' => 'Teendők',
        'warning_orders' => 'Hozzon létre egy terméket &raquo;',
        'warning_products' => 'Hozzon létre egy kategóriát &raquo;',
        'orders' => 'Rendelés|Rendelés',
        'received' => 'Beérkezett',
        'created_at' => 'Létrehozva',
        'updated_at' => 'Módosítva'
    ],
    'button' => [
        'activate' => 'Aktiválás',
        'inactivate' => 'Inaktiválás',
        'pending' => 'Folyamatban',
        'active' => 'Aktív',
        'inactive' => 'Inaktív',
        'reorder' => 'Sorrend',
        'previous' => 'Előző',
        'next' => 'Következő',
        'return' => 'Vissza'
    ],
    'flash' => [
        'activate' => 'Az aktiválás sikeresen megtörtént.',
        'inactivate' => 'Az inaktiválás sikeresen megtörtént.',
        'pending' => 'A folyamatba rakás sikeresen megtörtént.',
        'paid' => 'A fizetés sikeresen megtörtént.',
        'closed' => 'A lezárás sikeresen megtörtént.',
        'cancelled' => 'A törlés sikeresen megtörtént.',
        'delete' => 'Valóban törölni akarja?',
        'remove' => 'Az eltávolítás sikeresen megtörtént.'
    ],
    'settings' => [
        'label' => 'Termékeladás',
        'description' => 'Fizetési módok engedélyezése és beállítása.',
        'enable' => 'Fizetési mód engedélyezése',
        'name' => 'Megnevezés',
        'redirect' => 'Átirányítás',
        'none' => '-- nincs --',
        'barion_label' => 'Barion',
        'barion_value' => 'Barion fizetés',
        'barion_mode' => 'Működés típusa',
        'barion_mode_test' => 'Teszt',
        'barion_mode_prod' => 'Éles',
        'barion_email' => 'Email cím',
        'barion_key' => 'Titkos azonosító (POSKey)',
        'barion_pixel' => 'Pixel kód',
        'barion_type' => 'Pénzküldés típusa',
        'barion_type_immediate' => 'Azonnali',
        'barion_redirect' => 'Visszatérési webcím',
        'barion_callback' => 'Visszahívási webcím',
        'transfer_label' => 'Átutalás',
        'transfer_value' => 'Banki átutalás',
        'cash_label' => 'Készpénz',
        'cash_value' => 'Készpénzes fizetés'
    ],
    'component' => [
        'form' => [
            'name' => 'Űrlap generálása',
            'description' => 'Termékek megjelenítése eladáshoz.',
            'total' => 'Összegzés mutatása a termékek alatt',
            'billing' => 'Számlázási adatok mutatása',
            'shipping' => 'Szállítási adatok mutatása',
            'comment' => 'Megjegyzés mező mutatása',
            'warning' => 'Nincs megjeleníthető termék.',
            'personal' => 'Személyes adatok',
            'no_billing' => 'Megegyezik a szállítási adatokkal',
            'no_shipping' => 'Személyesen veszem át',
            'items' => 'Tételek',
            'total' => 'Összesen',
            'payment' => 'Fizetési mód',
            'submit' => 'Tovább a fizetéshez'
        ],
        'logo' => [
            'name' => 'Fizetési logó',
            'description' => 'Megjeleníti a fizetéshez tartozó logót.',
            'barion' => 'Barion logó megjelenítése',
            'barion_size' => 'A kép szélessége'
        ]
    ],
    'permission' => [
        'orders' => 'Rendelések kezelése',
        'reports' => 'Jelentések megtekintése',
        'products' => 'Termékek kezelése',
        'category' => 'KAtegóriák kezelése',
        'settings' => 'Beállítások kezelése'
    ]
];
