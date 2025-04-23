<?php

/**
 * Sample extension for REST API endpoints
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom REST API endpoint
 *
 * @param array $endpoints The endpoints array.
 * @return array Modified endpoints array.
 */
function maverick_add_custom_rest_endpoint(array $endpoints): array
{
    $endpoints['custom'] = [
        'namespace' => 'maverick/v1',
        'route' => '/custom',
        'methods' => ['GET', 'POST'],
        'callback' => 'maverick_rest_custom_endpoint',
        'permission_callback' => function () {
            return current_user_can('edit_posts');
        },
    ];

    return $endpoints;
}
add_filter('maverick_register_rest_endpoints', 'maverick_add_custom_rest_endpoint');

/**
 * Custom endpoint callback
 *
 * @param WP_REST_Request $request The request object.
 * @return WP_REST_Response|WP_Error The response object.
 */
function maverick_rest_custom_endpoint($request)
{
    if ($request->get_method() === 'GET') {
        $data = [
            'message' => __('This is a custom endpoint.', 'maverick'),
            'timestamp' => current_time('mysql'),
            'user' => [
                'id' => get_current_user_id(),
                'name' => wp_get_current_user()->display_name,
            ],
        ];

        return rest_ensure_response($data);
    }

    if ($request->get_method() === 'POST') {
        $params = $request->get_json_params();

        if (empty($params['action'])) {
            return new WP_Error('missing_action', __('Action parameter is required.', 'maverick'), ['status' => 400]);
        }

        // Process the action
        switch ($params['action']) {
            case 'update':
                // Handle update action
                return rest_ensure_response(['message' => __('Update action processed.', 'maverick')]);

            case 'delete':
                // Handle delete action
                return rest_ensure_response(['message' => __('Delete action processed.', 'maverick')]);

            default:
                return new WP_Error('invalid_action', __('Invalid action specified.', 'maverick'), ['status' => 400]);
        }
    }

    return new WP_Error('invalid_method', __('Invalid request method.', 'maverick'), ['status' => 400]);
}

/**
 * Modify posts endpoint response
 *
 * @param WP_REST_Response $response The response object.
 * @param WP_REST_Request $request The request object.
 * @return WP_REST_Response Modified response object.
 */
function maverick_modify_posts_endpoint_response($response, $request)
{
    $data = $response->get_data();

    // Add custom data to each post
    foreach ($data['posts'] as &$post) {
        $post['custom_field'] = get_post_meta($post['id'], 'custom_field', true);
        $post['featured_image'] = get_the_post_thumbnail_url($post['id'], 'full');
    }

    $response->set_data($data);
    return $response;
}
add_filter('rest_prepare_post', 'maverick_modify_posts_endpoint_response', 10, 2);
