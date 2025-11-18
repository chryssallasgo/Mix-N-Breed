<?php

declare(strict_types=1);

use Flasher\Prime\Configuration;

return Configuration::from([
    // Default notification library (e.g., 'flasher', 'toastr', 'noty', 'notyf', 'sweetalert')
    'default' => 'toastr',
    // Theme configuration
    'themes' => [
        'flasher' => [
            'options' => [
                'timeout' => 5000,
                'position' => 'top-right',
            ],
        ],
        'emerald' => [
            'options' => [
                'timeout' => 3000,
                'position' => 'bottom-right',
            ],
        ],
    ],
    'plugins' => [
        'noty' => [
            'scripts' => [
                '/vendor/flasher/noty.min.js',
                '/vendor/flasher/flasher-noty.min.js'
            ],
            'styles' => [
                '/vendor/flasher/noty.css',
                '/vendor/flasher/mint.css'
            ],
            'options' => [
                // Optional: Add global options here
                // 'layout' => 'topRight'
            ],
        ],
    ],
    // Auto-convert Laravel session flash messages
    'auto_create_from_session' => true,

    // Automatically render notifications
    'auto_render' => true,

    // Type mappings for Laravel notifications
    'types_mapping' => [
        'success' => 'success',
        'error' => 'error',
        'warning' => 'warning',
        'info' => 'info',
    ],
    // Path to the main PHPFlasher JavaScript file
    'main_script' => '/vendor/flasher/flasher.min.js',

    // List of CSS files to style your notifications
    'styles' => [
        '/vendor/flasher/flasher.min.css',
    ],

    // Set global options for all notifications (optional)
    // 'options' => [
    //     'timeout' => 5000, // Time in milliseconds before the notification disappears
    //     'position' => 'top-right', // Where the notification appears on the screen
    // ],

    // Automatically inject JavaScript and CSS assets into your HTML pages
    'inject_assets' => true,

    // Enable message translation using Laravel's translation service
    'translate' => true,

    // URL patterns to exclude from asset injection and flash_bag conversion
    'excluded_paths' => [],

    // Map Laravel flash message keys to notification types
    'flash_bag' => [
        'success' => ['success'],
        'error' => ['error', 'danger'],
        'warning' => ['warning', 'alarm'],
        'info' => ['info', 'notice', 'alert'],
    ],

    // Set criteria to filter which notifications are displayed (optional)
    // 'filter' => [
    //     'limit' => 5, // Maximum number of notifications to show at once
    // ],

    // Define notification presets to simplify notification creation (optional)
    // 'presets' => [
    //     'entity_saved' => [
    //         'type' => 'success',
    //         'title' => 'Entity saved',
    //         'message' => 'Entity saved successfully',
    //     ],
    // ],
]);
