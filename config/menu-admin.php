<?php
//$row = collect();
return [
    'items' => [

        'Dashboard' => ['icon' => 'fa-tachometer-alt', 'item' => 'Dashboard', 'route' => null, 'permission' => null,
            'Home' => [
                'icon' => null, 'item' => 'Home', 'route' => 'dashboard.home', 'permission' => 'dashboard.home'
            ],
        ],

        'Admins' => ['icon' => 'fa-users-cog', 'item' => 'Admins', 'route' => null, 'permission' => null,
            'List Admins' => [
                'icon' => null, 'item' => 'List Admins', 'route' => 'admin.list', 'permission' => 'admins.list'
            ],
            'Register Admin' => [
                'icon' => null, 'item' => 'Register Admin', 'route' => 'admin.register',
                'permission' => 'admins.register'
            ],
            'Reset Password' => [
                'icon' => null, 'item' => 'Reset Password', 'route' => 'admin.list', 'permission' => 'admins.reset'
            ],
            'Ban Admin' => ['icon' => null, 'item' => 'Ban Admin', 'route' => 'admin.list',
                'permission' => 'admins.ban'],
        ],

        'Customers' => ['icon' => 'fa-users-cog', 'item' => 'Customers', 'route' => null, 'permission' => null,
            'List Customers' => [
                'icon' => null, 'item' => 'List Customers', 'route' => 'customer.list',
                'permission' => 'customers.list'
            ],
//            'Register Admin' => ['icon' => null, 'item' => 'Register Admin', 'route' => 'admin.register'],
//            'Reset Password' => ['icon' => null, 'item' => 'Reset Password', 'route' => 'admin.list'],
//            'Ban Admin' => ['icon' => null, 'item' => 'Ban Admin', 'route' => 'admin.list'],
        ]
    ],

    'test-items' => [

        'Dashboard' => ['icon' => 'fa-tachometer-alt', 'item' => 'Dashboard', 'route' => null,
            'Home' => ['icon' => null, 'item' => 'Home', 'route' => 'dashboard.home'],
            'Sub Dashboard' => ['icon' => null, 'item' => 'Sub Dashboard', 'route' => null,
                'Sub Home' => ['icon' => null, 'item' => 'Sub Home', 'route' => 'dashboard.subhome']
            ],
        ],

        'Admins' => ['icon' => 'fa-users-cog', 'item' => 'Admins', 'route' => null,
            'List Admins' => ['icon' => null, 'item' => 'List Admins', 'route' => 'admin.list'],
            'Register Admin' => ['icon' => null, 'item' => 'Register Admin', 'route' => 'admin.register'],
            'Reset Password' => ['icon' => null, 'item' => 'Reset Password', 'route' => 'admin.list'],
            'Ban Admin' => ['icon' => null, 'item' => 'Ban Admin', 'route' => 'admin.ban'],
        ]
    ]
];
