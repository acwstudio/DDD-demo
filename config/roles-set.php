<?php

return [
    'seeds' => [
        'roles' => ['super-admin', 'administrator', 'manager', 'moderator', 'writer', 'probationer'],
        'names' => ['Andrey', 'John', 'Bill', 'George', 'James', 'Tom'],
        'permissions' => [
            'super-admin' => [
                'admins' => ['list', 'register', 'reset', 'delete', 'ban'],
                'customers' => ['list', 'create', 'edit', 'delete', 'ban'],
                'dashboard' => ['home'],
            ],
            'administrator' => [
                'admins' => ['list', 'reset'],
                'customers' => ['list', 'create', 'edit', 'delete', 'ban'],
                'dashboard' => ['home'],
            ],
            'manager' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
            ],
            'moderator' => [
                'admins' => ['list'],
                'customers' => ['list', 'ban'],
                'dashboard' => ['home'],
            ],
            'writer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
            ],
            'probationer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
            ],
        ]
    ]
];
