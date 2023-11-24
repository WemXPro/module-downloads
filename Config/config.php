<?php

return [
    'name' => 'Downloads Module',
    'icon' => 'https://imgur.png',
    'author' => 'Wemx',
    'version' => '1.0.0',
    'wemx_version' => '1.0.0',

    'elements' => [
        'main_menu' => [
            [
                'name' => 'Downloads',
                'icon' => '<i class="fa-solid fa-download"></i>',
                'href' => '/downloads', // Direct URL instead of route function
                'style' => '',
            ],
            // Add more menu items as needed
        ],

        'user_dropdown' => [
            [
                'name' => 'Downloads Module',
                'icon' => '<i class="fas fa-cog"></i>',
                'href' => '/downloads/settings', // Direct URL instead of route function
                'style' => '',
            ],
            // Add more menu items as needed
        ],

        'admin_menu' => [
            [
                'name' => 'Downloads Admin',
                'icon' => '<i class="fas fa-cog"></i>',
                'href' => '/admin/downloads', // Direct URL instead of route function
                'style' => '',
            ],
            // Add more menu items as needed
        ],
    ],
];
