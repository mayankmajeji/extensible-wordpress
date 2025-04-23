<?php

/**
 * Register widget areas (sidebars) with the ability to filter them externally.
 *
 * Add this file to your theme's functions.php or a custom plugin.
 */

function maverick_register_widget_areas()
{
    /**
     * Default widget areas to register
     *
     * @var array
     */
    $sidebars = [
        'sidebar-main' => [
            'name'          => __('Main Sidebar', 'maverick'),
            'id'            => 'sidebar-main',
            'description'   => __('Appears on blog pages and posts.', 'maverick'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ],
    ];

    /**
     * Allow others to modify or add sidebars
     *
     * @param array $sidebars Array of sidebars to register.
     * @return array Modified array of sidebars.
     */
    $sidebars = apply_filters('maverick_register_widget_areas', $sidebars);

    /**
     * Register each sidebar using register_sidebar()
     */
    foreach ($sidebars as $sidebar) {
        register_sidebar($sidebar);
    }
}

add_action('widgets_init', 'maverick_register_widget_areas');
