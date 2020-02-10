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
        'id' => 'ID',
        'name' => 'Name',
        'slug' => 'Slug',
        'summary' => 'Summary',
        'content' => 'Content',
        'payment' => 'Payment',
        'payments' => 'Payment types',
        'new_payment' => 'New payment',
        'payment_type' => 'Type',
        'payment_text' => 'Comment',
        'locale' => 'Locale',
        'image' => 'Image',
        'category' => 'Category',
        'price' => 'Price',
        'currency' => 'Currency',
        'currency_default' => 'EUR',
        'unit' => 'Unit',
        'unit_piece' => 'piece',
        'is_old' => 'Is old?',
        'is_sale' => 'Is sale?',
        'sale_price' => 'Sale price',
        'sale_start' => 'Sale start',
        'sale_end' => 'Sale end',
        'featured' => 'Featured',
        'orders' => 'Orders',
        'user' => 'User',
        'products' => 'Products',
        'customer' => 'Customer',
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
        'quantity' => 'Quantity',
        'comment' => 'Comment',
        'status' => 'Status',
        'status_active' => 'Active',
        'status_inactive' => 'Inactive',
        'status_pending' => 'Pending',
        'status_paid' => 'Paid',
        'status_closed' => 'Closed',
        'yes' => 'Yes',
        'no' => 'No'
    ],
    'list' => [
        'error_title' => 'There is no product to display',
        'error_desc' => 'Firstly you create at least one category.',
        'orders' => 'Order|Orders',
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
        'pending' => 'Successfully pendind those items.',
        'paid' => 'Successfully paid those items.',
        'closed' => 'Successfully closed those items.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'settings' => [
        'label' => 'Sell products',
        'description' => 'Enable and settings the payments.',
        'enable' => 'Enable this payment',
        'name' => 'Name',
        'redirect' => 'Redirect',
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
        'barion_currency' => 'Currency',
        'barion_locale' => 'Locale',
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
            'barion' => 'Show Barion payment logos',
            'warning' => 'There are no products to display.',
            'personal' => 'Personal details',
            'items' => 'Items',
            'total' => 'Total',
            'payment' => 'Payment type',
            'submit' => 'Submit'
        ],
        'logo' => [
            'name' => 'Payment logo',
            'description' => 'Display the logo of payment.'
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
