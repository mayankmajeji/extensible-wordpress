<?php

/**
 * Register and enqueue scripts and styles with extensibility
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register and enqueue scripts and styles
 */
function maverick_register_scripts_styles(): void
{
    // Default scripts and styles array
    $scripts_styles = [
        'scripts' => [
            [
                'handle'    => 'maverick-main',
                'src'       => get_template_directory_uri() . '/assets/js/main.js',
                'deps'      => ['jquery'],
                'ver'       => '1.0.0',
                'in_footer' => true,
            ],
        ],
        'styles' => [
            [
                'handle' => 'maverick-main',
                'src'    => get_template_directory_uri() . '/assets/css/main.css',
                'deps'   => [],
                'ver'    => '1.0.0',
                'media'  => 'all',
            ],
        ],
    ];

    // Allow other plugins/themes to modify the scripts and styles
    $scripts_styles = apply_filters('maverick_register_scripts_styles', $scripts_styles);

    // Register and enqueue scripts
    if (!empty($scripts_styles['scripts'])) {
        foreach ($scripts_styles['scripts'] as $script) {
            wp_register_script(
                $script['handle'],
                $script['src'],
                $script['deps'] ?? [],
                $script['ver'] ?? null,
                $script['in_footer'] ?? true
            );
            wp_enqueue_script($script['handle']);
        }
    }

    // Register and enqueue styles
    if (!empty($scripts_styles['styles'])) {
        foreach ($scripts_styles['styles'] as $style) {
            wp_register_style(
                $style['handle'],
                $style['src'],
                $style['deps'] ?? [],
                $style['ver'] ?? null,
                $style['media'] ?? 'all'
            );
            wp_enqueue_style($style['handle']);
        }
    }
}
add_action('wp_enqueue_scripts', 'maverick_register_scripts_styles');
