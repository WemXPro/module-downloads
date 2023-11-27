<?php

return [

    'name' => 'Downloads Module',
    'icon' => 'https://imgur.png',
    'author' => 'WemX',
    'version' => '1.0.0',
    'wemx_version' => '1.0.0',

    'elements' => [

        'user_dropdown' =>
        [
            [
                'name' => 'Downloads',
                'icon' => '<i class="bx bx-link"></i><i class="fas fa-solid fa-download"></i>',
                'href' => '/admin/downloads/index', // Adjust the route as needed
                'style' => '',
            ],
            // ... add more menu items
        ],

        'admin_menu' => 
        [
            [
                'name' => 'Downloads',
                'icon' => '<i class="fas fa-solid fa-download"></i>',
                'type' => 'dropdown',
                'items' => [
                    [
                        'name' => 'Downloads',
                        'href' => '/admin/downloads/',
                    ],
                    [
                        'name' => 'Create',
                        'href' => '/admin/downloads/create',
                    ],
                ],
            ],
            // ... add more menu items
        ],

    ],

];
