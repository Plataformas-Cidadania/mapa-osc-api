<?php
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
        //'passwords' => 'tb_usuario',
    ],
    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Portal\Usuario::class
        ]
    ]
];
