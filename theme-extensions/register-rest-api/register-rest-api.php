<?php

/**
 * Register REST API endpoints with extensibility
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register REST API endpoints
 */
function maverick_register_rest_api(): void
{
    // Default REST API endpoints array
    $endpoints = [
        'settings' => [
            'namespace' => 'maverick/v1',
            'route' => '/settings',
            'methods' => ['GET', 'POST'],
            'callback' => 'maverick_rest_settings_endpoint',
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
        ],
        'posts' => [
            'namespace' => 'maverick/v1',
            'route' => '/posts',
            'methods' => ['GET'],
            'callback' => 'maverick_rest_posts_endpoint',
            'permission_callback' => '__return_true',
        ],
    ];

    // Allow other plugins/themes to modify the endpoints
    $endpoints = apply_filters('maverick_register_rest_endpoints', $endpoints);

    // Register each endpoint
    foreach ($endpoints as $endpoint_id => $endpoint_data) {
        register_rest_route(
            $endpoint_data['namespace'],
            $endpoint_data['route'],
            [
                'methods' => $endpoint_data['methods'],
                'callback' => $endpoint_data['callback'],
                'permission_callback' => $endpoint_data['permission_callback'],
            ]
        );
    }
}
add_action('rest_api_init', 'maverick_register_rest_api');

/**
 * Settings endpoint callback
 *
 * @param WP_REST_Request $request The request object.
 * @return WP_REST_Response|WP_Error The response object.
 */
function maverick_rest_settings_endpoint($request)
{
    if ($request->get_method() === 'GET') {
        $settings = get_option('maverick_settings', []);
        return rest_ensure_response($settings);
    }

    if ($request->get_method() === 'POST') {
        $settings = $request->get_json_params();
        update_option('maverick_settings', $settings);
        return rest_ensure_response(['message' => __('Settings updated successfully.', 'maverick')]);
    }

    return new WP_Error('invalid_method', __('Invalid request method.', 'maverick'), ['status' => 400]);
}

/**
 * Posts endpoint callback
 *
 * @param WP_REST_Request $request The request object.
 * @return WP_REST_Response|WP_Error The response object.
 */
function maverick_rest_posts_endpoint($request)
{
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $request->get_param('per_page') ?? 10,
        'paged' => $request->get_param('page') ?? 1,
    ];

    $query = new WP_Query($args);
    $posts = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $posts[] = [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'content' => get_the_content(),
                'excerpt' => get_the_excerpt(),
                'date' => get_the_date('c'),
                'modified' => get_the_modified_date('c'),
                'author' => [
                    'id' => get_the_author_meta('ID'),
                    'name' => get_the_author(),
                ],
            ];
        }
    }

    wp_reset_postdata();

    return rest_ensure_response([
        'posts' => $posts,
        'total' => $query->found_posts,
        'total_pages' => $query->max_num_pages,
    ]);
}
