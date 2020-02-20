<?php

return [
    'plugin' => [
        'name' => 'Sell Products',
        'description' => 'Easy to sell your products with simple form.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'orders' => 'Orders',
        'reports' => 'Reports',
        'products' => 'Products',
        'category' => 'Category',
        'settings' => 'Settings'
    ],
    'title' => [
        'orders' => 'order',
        'reports' => 'report',
        'products' => 'product',
        'category' => 'category'
    ],
    'new' => [
        'orders' => 'New order',
        'products' => 'New product',
        'category' => 'New category'
    ],
    'form' => [
        // Common
        'id' => 'ID',
        'name' => 'Name',
        'slug' => 'Slug',
        'summary' => 'Summary',
        'content' => 'Content',
        'image' => 'Image',
        'status' => 'Status',
        'status_active' => 'Active',
        'status_inactive' => 'Inactive',
        'featured' => 'Featured',
        'yes' => 'Yes',
        'no' => 'No',
        // Category
        'payments' => 'Payment types',
        'new_payment' => 'New payment',
        'payment_type' => 'Type',
        'payment_comment' => 'Comment',
        'currency' => 'Currency',
        'currency_default' => 'EUR',
        'locale' => 'Locale',
        'locale_hu' => 'Hungarian',
        'locale_en' => 'English',
        'locale_de' => 'German',
        'locale_sl' => 'Slovenian',
        'locale_sk' => 'Slovak',
        'locale_fr' => 'Francia',
        'locale_cs' => 'Czech',
        'locale_el' => 'Greek',
        // Products
        'category' => 'Category',
        'unit_price' => 'Unit price',
        'unit' => 'Unit',
        'unit_piece' => 'piece',
        'quantity' => 'Quantity',
        'is_sale' => 'Is sale?',
        'sale_price' => 'Sale price',
        'sale_start' => 'Sale start',
        'sale_end' => 'Sale end',
        'orders' => 'Orders',
        // Orders
        'customer' => 'Customer',
        'full_name' => 'Full name',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'email' => 'Email',
        'phone' => 'Phone',
        'billing' => 'Billing data',
        'shipping' => 'Shipping data',
        'zipcode' => 'Zipcode',
        'city' => 'City',
        'address' => 'Address',
        'products' => 'Products',
        'new_product' => 'New product',
        'product' => 'Product',
        'price_total' => 'Total price',
        'comment' => 'Comment',
        'payment' => 'Payment',
        'status_pending' => 'Pending',
        'status_paid' => 'Paid',
        'status_closed' => 'Closed',
        'status_cancelled' => 'Canceled'
    ],
    'list' => [
        'warning_title' => 'To Do',
        'warning_orders' => 'Create a new product &raquo;',
        'warning_products' => 'Create a new category &raquo;',
        'orders' => 'Order|Orders',
        'received' => 'Received',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        'pending' => 'Pending',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'reorder' => 'Reorder',
        'previous' => 'Previous',
        'next' => 'Next',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those items.',
        'deactivate' => 'Successfully deactivated those items.',
        'pending' => 'Successfully pendind those orders.',
        'paid' => 'Successfully paid those orders.',
        'closed' => 'Successfully closed those orders.',
        'cancelled' => 'Successfully cancelled those orders.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'settings' => [
        'label' => 'Sell products',
        'description' => 'Enable and settings the payments.',
        'enable' => 'Enable this payment',
        'name' => 'Name',
        'redirect' => 'Redirect',
        'none' => '-- none --',
        'barion_label' => 'Barion',
        'barion_value' => 'Barion payment',
        'barion_mode' => 'Mode',
        'barion_mode_test' => 'Test',
        'barion_mode_prod' => 'Production',
        'barion_email' => 'Email',
        'barion_key' => 'Secret ID (POSKey)',
        'barion_pixel' => 'Pixel Code',
        'barion_type' => 'Type of sending money',
        'barion_type_immediate' => 'Immediate',
        'barion_redirect' => 'Redirect URL',
        'barion_callback' => 'Callback URL',
        'transfer_label' => 'Transfer',
        'transfer_value' => 'Bank Transfer',
        'cash_label' => 'Cash',
        'cash_value' => 'Cash payment'
    ],
    'component' => [
        'form' => [
            'name' => 'Generated form',
            'description' => 'Display product for sell.',
            'total' => 'Show total under the products',
            'billing' => 'Show billing data',
            'shipping' => 'Show shipping data',
            'comment' => 'Show comment field',
            'warning' => 'There are no products to display.',
            'personal' => 'Personal details',
            'no_billing' => 'Same as shipping data',
            'no_shipping' => 'I will take it personally',
            'items' => 'Items',
            'total' => 'Total',
            'payment' => 'Payment type',
            'submit' => 'Continue to checkout'
        ],
        'logo' => [
            'name' => 'Payment logo',
            'description' => 'Display the logo of payment.',
            'barion' => 'Show Barion payment logo',
            'barion_size' => 'Width of image'
        ]
    ],
    'permission' => [
        'orders' => 'Manage orders',
        'reports' => 'View reports',
        'products' => 'Manage products',
        'category' => 'Manage category',
        'settings' => 'Manage settings'
    ]
];
