<?php

/**
 * Sample extension for scripts and styles
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom scripts and styles
 *
 * @param array $scripts_styles The scripts and styles array.
 * @return array Modified scripts and styles array.
 */
function maverick_add_custom_scripts_styles(array $scripts_styles): array
{
    // Add a custom script
    $scripts_styles['scripts'][] = [
        'handle'    => 'maverick-custom',
        'src'       => get_template_directory_uri() . '/assets/js/custom.js',
        'deps'      => ['jquery'],
        'ver'       => '1.0.0',
        'in_footer' => true,
    ];

    // Add a custom style
    $scripts_styles['styles'][] = [
        'handle' => 'maverick-custom',
        'src'    => get_template_directory_uri() . '/assets/css/custom.css',
        'deps'   => [],
        'ver'    => '1.0.0',
        'media'  => 'all',
    ];

    return $scripts_styles;
}

add_filter('maverick_register_scripts_styles', 'maverick_add_custom_scripts_styles');
