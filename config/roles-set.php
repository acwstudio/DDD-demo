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
                'products' => ['list', 'create', 'show', 'edit', 'delete', 'archived', 'published'],
            ],
            'administrator' => [
                'admins' => ['list', 'reset'],
                'customers' => ['list', 'register', 'reset', 'delete', 'ban'],
                'dashboard' => ['home'],
                'products' => ['list', 'create', 'show', 'edit', 'delete', 'archived', 'published'],
            ],
            'manager' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'products' => ['list', 'create', 'show', 'edit', 'archived'],
            ],
            'moderator' => [
                'admins' => ['list'],
                'customers' => ['list', 'ban'],
                'dashboard' => ['home'],
                'products' => ['list', 'show', 'published'],
            ],
            'writer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'products' => ['list', 'create', 'show', 'edit'],
            ],
            'probationer' => [
                'admins' => ['list'],
                'customers' => ['list'],
                'dashboard' => ['home'],
                'products' => ['list', 'show'],
            ],
        ]
    ]
];
