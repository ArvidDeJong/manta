<?php

return [
    'auth' => [
        'guards' => [
            'staff' => [
                'driver' => 'session',
                'provider' => 'staff',
            ],
        ],
        'providers' => [
            'staff' => [
                'driver' => 'eloquent',
                'model' => \Darvis\Manta\Models\Staff::class,
            ],
        ],
        'passwords' => [
            'staff' => [
                'provider' => 'staff',
                'table' => 'staff_password_resets',
                'expire' => 60,
                'throttle' => 60,
            ],
        ],
    ]
];
