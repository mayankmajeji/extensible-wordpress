<?php

/**
 * Example usage of the 'maverick_register_nav_menus' filter.
 * Adds a Social Menu to the list of nav menus.
 */

add_filter('maverick_register_nav_menus', 'maverick_register_nav_menus_extension');

function maverick_register_nav_menus_extension($menus)
{
    $menus['social'] = __('Social Menu', 'maverick');
    return $menus;
}
