<?php

/**
 * Example usage of the 'maverick_register_widget_areas' filter.
 * Adds an additional sidebar/widget area.
 */

add_filter('maverick_register_widget_areas', 'maverick_register_widget_areas_extension');

function maverick_register_widget_areas_extension($sidebars)
{
    $sidebars['sidebar-footer'] = [
        'name'          => __('Footer Sidebar', 'maverick'),
        'id'            => 'sidebar-footer',
        'description'   => __('Appears in the footer area.', 'maverick'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ];

    return $sidebars;
};
