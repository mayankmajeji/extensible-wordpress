<?php

/**
 * Sample extension for Plugin Setup
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Modify plugin initialization
 *
 * @param array $init_params The initialization parameters.
 * @return array Modified initialization parameters.
 */
function maverick_modify_plugin_init(array $init_params): array
{
    // Add custom initialization parameters
    $init_params['custom_param'] = 'custom_value';

    // Modify existing parameters
    $init_params['version'] = '1.0.1';

    return $init_params;
}
add_filter('maverick_plugin_init', 'maverick_modify_plugin_init');

/**
 * Modify plugin activation tasks
 *
 * @param array $activation_tasks The activation tasks.
 * @return array Modified activation tasks.
 */
function maverick_modify_plugin_activation(array $activation_tasks): array
{
    // Add custom activation task
    $activation_tasks['custom_activation'] = true;

    // Modify existing tasks
    $activation_tasks['create_tables'] = false;

    return $activation_tasks;
}
add_filter('maverick_plugin_activation', 'maverick_modify_plugin_activation');

/**
 * Modify plugin deactivation tasks
 *
 * @param array $deactivation_tasks The deactivation tasks.
 * @return array Modified deactivation tasks.
 */
function maverick_modify_plugin_deactivation(array $deactivation_tasks): array
{
    // Add custom deactivation task
    $deactivation_tasks['custom_deactivation'] = true;

    // Modify existing tasks
    $deactivation_tasks['clear_transients'] = false;

    return $deactivation_tasks;
}
add_filter('maverick_plugin_deactivation', 'maverick_modify_plugin_deactivation');

/**
 * Modify plugin uninstall tasks
 *
 * @param array $uninstall_tasks The uninstall tasks.
 * @return array Modified uninstall tasks.
 */
function maverick_modify_plugin_uninstall(array $uninstall_tasks): array
{
    // Add custom uninstall task
    $uninstall_tasks['custom_uninstall'] = true;

    // Modify existing tasks
    $uninstall_tasks['delete_options'] = false;

    return $uninstall_tasks;
}
add_filter('maverick_plugin_uninstall', 'maverick_modify_plugin_uninstall');

/**
 * Modify database tables
 *
 * @param array $tables The database tables.
 * @return array Modified database tables.
 */
function maverick_modify_plugin_tables(array $tables): array
{
    // Add new table
    $tables['maverick_custom_data'] = [
        'columns' => [
            'id' => 'bigint(20) NOT NULL AUTO_INCREMENT',
            'user_id' => 'bigint(20) NOT NULL',
            'data' => 'text NOT NULL',
            'status' => 'varchar(50) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
        ],
        'primary_key' => 'id',
        'indexes' => [
            'user_id' => 'user_id',
            'status' => 'status',
        ],
    ];

    // Modify existing table
    if (isset($tables['maverick_data'])) {
        // Add new column
        $tables['maverick_data']['columns']['status'] = 'varchar(50) NOT NULL DEFAULT "active"';

        // Add new index
        $tables['maverick_data']['indexes']['status'] = 'status';
    }

    return $tables;
}
add_filter('maverick_plugin_tables', 'maverick_modify_plugin_tables');

/**
 * Custom activation task
 */
function maverick_custom_activation(): void
{
    // Add custom activation logic here
    update_option('maverick_custom_option', 'custom_value');
}
add_action('maverick_plugin_activated', 'maverick_custom_activation');

/**
 * Custom deactivation task
 */
function maverick_custom_deactivation(): void
{
    // Add custom deactivation logic here
    delete_option('maverick_custom_option');
}
add_action('maverick_plugin_deactivated', 'maverick_custom_deactivation');

/**
 * Custom uninstall task
 */
function maverick_custom_uninstall(): void
{
    // Add custom uninstall logic here
    delete_option('maverick_custom_option');
}
add_action('maverick_plugin_uninstalled', 'maverick_custom_uninstall');
