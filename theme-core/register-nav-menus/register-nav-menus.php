<?php

/**
 * Register navigation menus with the ability to filter them externally.
 *
 * Add this file to your theme's functions.php or a custom plugin.
 */

function maverick_register_menus()
{
    /**
     * The default menus to register
     *
     * @var array
     */
    $menus = [
        'primary' => __('Primary Menu', 'maverick'),
        'footer'  => __('Footer Menu', 'maverick'),
    ];

    /**
     * Allow others to extend the menu list
     *
     * @param array $menus The array of menus to register.
     * @return array The filtered array of menus to register.
     */
    $menus = apply_filters('maverick_register_nav_menus', $menus);

    /**
     * Register the menus
     *
     * @param array $menus The array of menus to register.
     */
    register_nav_menus($menus);
}

add_action('after_setup_theme', 'maverick_register_menus');
