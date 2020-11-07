<?php
//$row = collect();
return [
    'items' => [

        'Dashboard' => ['icon' => 'fa-tachometer-alt', 'item' => 'Dashboard', 'route' => null,
            'Home' => ['icon' => null, 'item' => 'Home', 'route' => 'dashboard.home'],
        ],

        'Admins' => ['icon' => 'fa-users-cog', 'item' => 'Admins', 'route' => null,
            'List Admins' => ['icon' => null, 'item' => 'List Admins', 'route' => 'admin.list'],
            'Register Admin' => ['icon' => null, 'item' => 'Register Admin', 'route' => 'admin.register'],
            'Reset Password' => ['icon' => null, 'item' => 'Reset Password', 'route' => 'admin.list'],
            'Ban Admin' => ['icon' => null, 'item' => 'Ban Admin', 'route' => 'admin.list'],
        ],

        'Customers' => ['icon' => 'fa-users-cog', 'item' => 'Customers', 'route' => null,
            'List Customers' => ['icon' => null, 'item' => 'List Customers', 'route' => 'customer.list'],
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
