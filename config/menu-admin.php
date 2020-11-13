<?php

return [
    'items' => [
        'dashboard' => [
            'icon' => 'fa-tachometer-alt',
            'item' => 'Dashboard',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],

        'home' => [
            'icon' => null,
            'item' => 'Home',
            'route' => 'dashboard.home',
            'permission' => 'dashboard.home',
            'father' => 'dashboard',
        ],

        'admins' => [
            'icon' => 'fa-users-cog',
            'item' => 'Admins',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],

        'list_admins' => [
            'icon' => null,
            'item' => 'List Admins',
            'route' => 'admin.list',
            'permission' => 'admins.list',
            'father' => 'admins',
        ],

        'register_admin' => [
            'icon' => null,
            'item' => 'Register Admin',
            'route' => 'admin.register',
            'permission' => 'admins.register',
            'father' => 'admins',
        ],

        'reset_password' => [
            'icon' => null,
            'item' => 'Reset Password',
            'route' => 'admin.list',
            'permission' => 'admins.reset',
            'father' => 'admins',
        ],

        'ban_admin' => [
            'icon' => null,
            'item' => 'Ban Admin',
            'route' => 'admin.list',
            'permission' => 'admins.ban',
            'father' => 'admins',
        ],

        'customers' => [
            'icon' => 'fa-users-cog',
            'item' => 'Customers',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],

        'list_customers' => [
            'icon' => null,
            'item' => 'List Customers',
            'route' => 'customer.list',
            'permission' => 'customers.list',
            'father' => 'customers',
        ],

        'ban_customer' => [
            'icon' => null,
            'item' => 'Ban Customer',
            'route' => 'customer.list',
            'permission' => 'customers.ban',
            'father' => 'customers',
        ],

        'products' => [
            'icon' => 'fa-shopping-bag',
            'item' => 'Products',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],

        'list_products' => [
            'icon' => null,
            'item' => 'List Products',
            'route' => 'product.list',
            'permission' => 'products.list',
            'father' => 'products',
        ],
    ],
/********************************************************/
    'new-items' => [
        'dashboard' => [
            'icon' => 'fa-tachometer-alt',
            'item' => 'Dashboard',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],
        'sub_dashboard' => [
            'icon' => null,
            'item' => 'Sub Dashboard',
            'route' => null,
            'permission' => null,
            'father' => 'dashboard',
        ],
        'sub_home' => [
            'icon' => null,
            'item' => 'Sub Home',
            'route' => 'dashboard.home',
            'permission' => 'customer.list',
            'father' => 'sub_dashboard',
        ],
        'home' => [
            'icon' => null,
            'item' => 'Home',
            'route' => 'dashboard.home',
            'permission' => 'dashboard.home',
            'father' => 'dashboard',
        ],
        'admins' => [
            'icon' => 'fa-users-cog',
            'item' => 'Admins',
            'route' => null,
            'permission' => null,
            'father' => null,
        ],
        'list_admins' => [
            'icon' => null,
            'item' => 'List Admins',
            'route' => 'admin.list',
            'permission' => 'admins.list',
            'father' => 'admins',
        ],
        'register_admin' => [
            'icon' => null,
            'item' => 'Register Admin',
            'route' => 'admin.register',
            'permission' => 'admins.register',
            'father' => 'admins',
        ],
        'reset_password' => [
            'icon' => null,
            'item' => 'Reset Password',
            'route' => 'admin.list',
            'permission' => 'admins.reset',
            'father' => 'admins',
        ],
        'ban_admin' => [
            'icon' => null,
            'item' => 'Ban Admin',
            'route' => 'admin.list',
            'permission' => 'admins.ban',
            'father' => 'admins',
        ],
    ]
];
