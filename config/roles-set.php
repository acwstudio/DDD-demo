<?php

return [
    'seeds' => [
        'roles' => ['super-admin', 'administrator', 'manager', 'moderator', 'writer', 'probationer'],
        'names' => ['Andrey', 'John', 'Bill', 'George', 'James', 'Tom'],
        'permissions' => [
            'super-admin' => [
                'admins' => ['list', 'register', 'reset', 'delete', 'ban'],
                'customers' => ['view', 'create', 'edit', 'delete', 'ban'],
            ],
            'administrator' => [
                'admins' => ['list', 'reset'],
                'customers' => ['view', 'create', 'edit', 'delete', 'ban'],
            ],
            'manager' => [
                'admins' => ['list', 'reset'],
                'customers' => ['view'],
            ],
            'moderator' => [
                'admins' => ['list', 'reset'],
                'customers' => ['view', 'ban'],
            ],
            'writer' => [
                'admins' => ['list', 'reset'],
                'customers' => ['view'],
            ],
            'probationer' => [
                'admins' => ['list'],
                'customers' => ['view'],
            ],
        ]
    ]
];
