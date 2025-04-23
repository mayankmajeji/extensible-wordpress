<?php

/**
 * Sample extension for Custom Post Types and Taxonomies
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom post type
 *
 * @param array $post_types The post types array.
 * @return array Modified post types array.
 */
function maverick_add_custom_post_type(array $post_types): array
{
    $post_types['testimonial'] = [
        'labels' => [
            'name'               => __('Testimonials', 'maverick'),
            'singular_name'      => __('Testimonial', 'maverick'),
            'menu_name'          => __('Testimonials', 'maverick'),
            'add_new'            => __('Add New', 'maverick'),
            'add_new_item'       => __('Add New Testimonial', 'maverick'),
            'edit_item'          => __('Edit Testimonial', 'maverick'),
            'new_item'           => __('New Testimonial', 'maverick'),
            'view_item'          => __('View Testimonial', 'maverick'),
            'search_items'       => __('Search Testimonials', 'maverick'),
            'not_found'          => __('No testimonials found', 'maverick'),
            'not_found_in_trash' => __('No testimonials found in Trash', 'maverick'),
        ],
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-format-quote',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'testimonial'],
        'show_in_rest'        => true,
    ];

    return $post_types;
}
add_filter('maverick_register_post_types', 'maverick_add_custom_post_type');

/**
 * Add custom taxonomy
 *
 * @param array $taxonomies The taxonomies array.
 * @return array Modified taxonomies array.
 */
function maverick_add_custom_taxonomy(array $taxonomies): array
{
    $taxonomies['testimonial_category'] = [
        'post_type' => 'testimonial',
        'args' => [
            'labels' => [
                'name'              => __('Testimonial Categories', 'maverick'),
                'singular_name'     => __('Testimonial Category', 'maverick'),
                'search_items'      => __('Search Testimonial Categories', 'maverick'),
                'all_items'         => __('All Testimonial Categories', 'maverick'),
                'parent_item'       => __('Parent Testimonial Category', 'maverick'),
                'parent_item_colon' => __('Parent Testimonial Category:', 'maverick'),
                'edit_item'         => __('Edit Testimonial Category', 'maverick'),
                'update_item'       => __('Update Testimonial Category', 'maverick'),
                'add_new_item'      => __('Add New Testimonial Category', 'maverick'),
                'new_item_name'     => __('New Testimonial Category Name', 'maverick'),
                'menu_name'         => __('Categories', 'maverick'),
            ],
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'testimonial-category'],
            'show_in_rest'      => true,
        ],
    ];

    return $taxonomies;
}
add_filter('maverick_register_taxonomies', 'maverick_add_custom_taxonomy');
