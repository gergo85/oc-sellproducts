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
        'id' => 'ID',
        'name' => 'Név',
        'slug' => 'Webcím',
        'summary' => 'Összegzés',
        'content' => 'Tartalom',
        'payment' => 'Fizetés',
        'payments' => 'Fizetési lehetőségek',
        'new_payment' => 'Új fizetés',
        'payment_type' => 'Típus',
        'payment_comment' => 'Megjegyzés',
        'image' => 'Kép',
        'category' => 'Kategória',
        'price' => 'Ár',
        'currency' => 'Pénznem',
        'currency_default' => 'HUF',
        'locale' => 'Nyelv',
        'unit' => 'Mennyiség',
        'unit_piece' => 'darab',
        'is_old' => 'Kifutott?',
        'is_sale' => 'Leértékelt?',
        'sale_price' => 'Akciós ár',
        'sale_start' => 'Akció kezdete',
        'sale_end' => 'Akció vége',
        'featured' => 'Kiemelt',
        'orders' => 'Rendelések',
        'user' => 'Felhasználó',
        'products' => 'Termékek',
        'customer' => 'Vásárló',
        'first_name' => 'Vezetéknév',
        'last_name' => 'Keresztnév',
        'email' => 'Email',
        'phone' => 'Telefon',
        'billing' => 'Számlázási adatok',
        'shipping' => 'Szállítási adatok',
        'city' => 'Város',
        'zipcode' => 'Irszám.',
        'address' => 'Postai cím',
        'products' => 'Termékek',
        'new_product' => 'Új termék',
        'product' => 'Termék',
        'quantity' => 'Mennyiség',
        'comment' => 'Megjegyzés',
        'status' => 'Státusz',
        'status_active' => 'Aktív',
        'status_inactive' => 'Inaktív',
        'status_pending' => 'Folyamatban',
        'status_paid' => 'Fizetve',
        'status_closed' => 'Lezárva',
        'yes' => 'Igen',
        'no' => 'Nem'
    ],
    'list' => [
        'error_title' => 'Nincs megjeleníthető adat',
        'error_desc' => 'Elsőként hozzon létre legalább egy kategóriát.',
        'orders' => 'Rendelés|Rendelés',
        'created_at' => 'Létrehozva',
        'updated_at' => 'Módosítva'
    ],
    'button' => [
        'activate' => 'Aktiválás',
        'deactivate' => 'Deaktiválás',
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
        'deactivate' => 'A deaktiválás sikeresen megtörtént.',
        'pending' => 'A folyamatba rakás sikeresen megtörtént.',
        'paid' => 'A fizetés sikeresen megtörtént.',
        'closed' => 'A lezárás sikeresen megtörtént.',
        'delete' => 'Valóban törölni akarja?',
        'remove' => 'Az eltávolítás sikeresen megtörtént.'
    ],
    'settings' => [
        'label' => 'Termékeladás',
        'description' => 'Fizetési módok engedélyezése és beállítása.',
        'enable' => 'Fizetési mód engedélyezése',
        'name' => 'Megnevezés',
        'redirect' => 'Átirányítás',
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
        'barion_currency' => 'Pénznem',
        'barion_locale' => 'Nyelv',
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
            'barion' => 'Barion logók megjelenítése',
            'warning' => 'Nincs megjeleníthető termék.',
            'personal' => 'Személyes adatok',
            'items' => 'Tételek',
            'total' => 'Összesen',
            'payment' => 'Fizetési mód',
            'submit' => 'Rendelés'
        ],
        'logo' => [
            'name' => 'Fizetési logó',
            'description' => 'Megjeleníti a fizetéshez tartozó logót.'
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
