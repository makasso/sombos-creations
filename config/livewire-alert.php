<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
        'timerProgressBar' => true,
        'showCloseButton' => true,
    ],
    'success' => [
        'icon' => 'success',
        'iconColor' => '#28a745',
    ],
    'error' => [
        'icon' => 'error',
        'iconColor' => '#dc3545',
    ],
    'warning' => [
        'icon' => 'warning',
        'iconColor' => '#f59e0b',
    ],
    'info' => [
        'icon' => 'info',
        'iconColor' => '#3b82f6',
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
    ]
];

