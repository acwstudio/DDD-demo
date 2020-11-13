<?php

return [
    'seeds' => [
        'roles' => [
            'super-admin', 'administrator', 'manager', 'moderator', 'writer', 'probationer'
        ],
        'names' => ['Andrey', 'John', 'Bill', 'George', 'James', 'Tom'],
        'permissions' => [
            'super-admin' => [
                'admins' => ['list', 'register', 'reset', 'delete', 'ban'],
                'customers' => ['list', 'register', 'reset', 'delete', 'ban'],
                'dashboard' => ['home'],
                'product' => ['list', 'create', 'show', 'edit', 'delete', 'archive', 'published'],
            ],
            'administrator' => [
                'admins' => ['list', 'reset'],
                'customers' => ['list', 'register', 'reset', 'delete', 'ban'],
                'dashboard' => ['home'],
                'product' => ['list', 'create', 'show', 'edit', 'delete', 'archive', 'published'],
            ],
            'manager' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'product' => ['list', 'create', 'show', 'edit', 'archive'],
            ],
            'moderator' => [
                'admins' => ['list'],
                'customers' => ['list', 'ban'],
                'dashboard' => ['home'],
                'product' => ['list', 'show', 'published'],
            ],
            'writer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'product' => ['list', 'create', 'show', 'edit'],
            ],
            'probationer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'product' => ['list', 'show'],
            ],
        ]
    ]
];
