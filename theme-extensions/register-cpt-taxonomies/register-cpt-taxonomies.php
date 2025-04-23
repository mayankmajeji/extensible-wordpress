<?php

/**
 * Register Custom Post Types and Taxonomies with modifiable arguments
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Types and Taxonomies
 */
function maverick_register_cpt_taxonomies(): void
{
    // Default CPTs array
    $post_types = [
        'portfolio' => [
            'labels' => [
                'name'               => __('Portfolios', 'maverick'),
                'singular_name'      => __('Portfolio', 'maverick'),
                'menu_name'          => __('Portfolios', 'maverick'),
                'add_new'            => __('Add New', 'maverick'),
                'add_new_item'       => __('Add New Portfolio', 'maverick'),
                'edit_item'          => __('Edit Portfolio', 'maverick'),
                'new_item'           => __('New Portfolio', 'maverick'),
                'view_item'          => __('View Portfolio', 'maverick'),
                'search_items'       => __('Search Portfolios', 'maverick'),
                'not_found'          => __('No portfolios found', 'maverick'),
                'not_found_in_trash' => __('No portfolios found in Trash', 'maverick'),
            ],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-portfolio',
            'hierarchical'        => false,
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive'         => true,
            'rewrite'             => ['slug' => 'portfolio'],
            'show_in_rest'        => true,
        ],
    ];

    // Default Taxonomies array
    $taxonomies = [
        'portfolio_category' => [
            'post_type' => 'portfolio',
            'args' => [
                'labels' => [
                    'name'              => __('Portfolio Categories', 'maverick'),
                    'singular_name'     => __('Portfolio Category', 'maverick'),
                    'search_items'      => __('Search Portfolio Categories', 'maverick'),
                    'all_items'         => __('All Portfolio Categories', 'maverick'),
                    'parent_item'       => __('Parent Portfolio Category', 'maverick'),
                    'parent_item_colon' => __('Parent Portfolio Category:', 'maverick'),
                    'edit_item'         => __('Edit Portfolio Category', 'maverick'),
                    'update_item'       => __('Update Portfolio Category', 'maverick'),
                    'add_new_item'      => __('Add New Portfolio Category', 'maverick'),
                    'new_item_name'     => __('New Portfolio Category Name', 'maverick'),
                    'menu_name'         => __('Categories', 'maverick'),
                ],
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'portfolio-category'],
                'show_in_rest'      => true,
            ],
        ],
    ];

    // Allow other plugins/themes to modify the CPTs and Taxonomies
    $post_types = apply_filters('maverick_register_post_types', $post_types);
    $taxonomies = apply_filters('maverick_register_taxonomies', $taxonomies);

    // Register Custom Post Types
    foreach ($post_types as $post_type => $args) {
        register_post_type($post_type, $args);
    }

    // Register Taxonomies
    foreach ($taxonomies as $taxonomy => $data) {
        register_taxonomy($taxonomy, $data['post_type'], $data['args']);
    }
}
add_action('init', 'maverick_register_cpt_taxonomies');
