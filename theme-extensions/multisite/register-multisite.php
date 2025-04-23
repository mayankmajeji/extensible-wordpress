<?php

/**
 * Register Multisite functionality with extensibility
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Multisite functionality
 */
function maverick_register_multisite(): void
{
    // Default multisite settings array
    $multisite_settings = [
        'network_settings' => [
            'enable_network_settings' => true,
            'network_menu_position' => 100,
            'network_menu_icon' => 'dashicons-networking',
        ],
        'site_settings' => [
            'enable_site_settings' => true,
            'site_menu_position' => 99,
            'site_menu_icon' => 'dashicons-admin-site',
        ],
        'user_settings' => [
            'enable_user_settings' => true,
            'user_menu_position' => 98,
            'user_menu_icon' => 'dashicons-admin-users',
        ],
    ];

    // Allow other plugins/themes to modify the multisite settings
    $multisite_settings = apply_filters('maverick_register_multisite_settings', $multisite_settings);

    // Register network admin menu if enabled
    if ($multisite_settings['network_settings']['enable_network_settings']) {
        add_action('network_admin_menu', function () use ($multisite_settings) {
            add_menu_page(
                __('Network Settings', 'maverick'),
                __('Network Settings', 'maverick'),
                'manage_network',
                'maverick-network-settings',
                'maverick_network_settings_page',
                $multisite_settings['network_settings']['network_menu_icon'],
                $multisite_settings['network_settings']['network_menu_position']
            );
        });
    }

    // Register site admin menu if enabled
    if ($multisite_settings['site_settings']['enable_site_settings']) {
        add_action('admin_menu', function () use ($multisite_settings) {
            add_menu_page(
                __('Site Settings', 'maverick'),
                __('Site Settings', 'maverick'),
                'manage_options',
                'maverick-site-settings',
                'maverick_site_settings_page',
                $multisite_settings['site_settings']['site_menu_icon'],
                $multisite_settings['site_settings']['site_menu_position']
            );
        });
    }

    // Register user settings if enabled
    if ($multisite_settings['user_settings']['enable_user_settings']) {
        add_action('admin_menu', function () use ($multisite_settings) {
            add_menu_page(
                __('User Settings', 'maverick'),
                __('User Settings', 'maverick'),
                'manage_options',
                'maverick-user-settings',
                'maverick_user_settings_page',
                $multisite_settings['user_settings']['user_menu_icon'],
                $multisite_settings['user_settings']['user_menu_position']
            );
        });
    }
}
add_action('init', 'maverick_register_multisite');

/**
 * Network Settings page callback
 */
function maverick_network_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_network_settings');
            do_settings_sections('maverick_network_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * Site Settings page callback
 */
function maverick_site_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_site_settings');
            do_settings_sections('maverick_site_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * User Settings page callback
 */
function maverick_user_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_user_settings');
            do_settings_sections('maverick_user_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}
