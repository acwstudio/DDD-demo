<?php

return [
    'items' => [
        'Dashboard' => ['Home'],
        'Admins' => ['List Admins', 'Register Admin', 'Reset Password', 'Ban Admin'],
        'Customers' => ['List Customers'],
//        'Products' => ['List Products', 'New Product'],
    ],

    'icons' => [
        'Dashboard' => 'fa-tachometer-alt',
        'Admins' => 'fa-users-cog',
        'Customers' => 'fa-users-cog',
//        'Products' => 'fa-receipt',
    ],

    'routes' => [
        'home' => 'dashboard.home',
        'list_admins' => 'admin.list',
        'register_admin' => 'admin.register',
        'reset_password' => 'admin.list',
        'ban_admin' => 'admin.list',
        'list_customers' => 'customer.list',
//        'ban_customer' => 'customer.ban',
//        'list_products' => 'product.list',
//        'new_product' => 'product.new'
    ]
];
