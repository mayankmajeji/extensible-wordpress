<?php

/**
 * Register Admin Pages with extensibility
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Admin Pages
 */
function maverick_register_admin_pages(): void
{
    // Default admin pages array
    $admin_pages = [
        'theme-settings' => [
            'page_title' => __('Theme Settings', 'maverick'),
            'menu_title' => __('Theme Settings', 'maverick'),
            'capability' => 'manage_options',
            'menu_slug' => 'maverick-settings',
            'callback' => 'maverick_theme_settings_page',
            'icon_url' => 'dashicons-admin-customizer',
            'position' => 59,
            'submenu' => [
                'general' => [
                    'page_title' => __('General Settings', 'maverick'),
                    'menu_title' => __('General', 'maverick'),
                    'capability' => 'manage_options',
                    'menu_slug' => 'maverick-settings',
                    'callback' => 'maverick_general_settings_page',
                ],
                'advanced' => [
                    'page_title' => __('Advanced Settings', 'maverick'),
                    'menu_title' => __('Advanced', 'maverick'),
                    'capability' => 'manage_options',
                    'menu_slug' => 'maverick-advanced-settings',
                    'callback' => 'maverick_advanced_settings_page',
                ],
            ],
        ],
    ];

    // Allow other plugins/themes to modify the admin pages
    $admin_pages = apply_filters('maverick_register_admin_pages', $admin_pages);

    // Register each admin page
    foreach ($admin_pages as $page_id => $page_data) {
        // Register main menu page
        add_menu_page(
            $page_data['page_title'],
            $page_data['menu_title'],
            $page_data['capability'],
            $page_data['menu_slug'],
            $page_data['callback'],
            $page_data['icon_url'] ?? '',
            $page_data['position'] ?? null
        );

        // Register submenu pages if they exist
        if (!empty($page_data['submenu'])) {
            foreach ($page_data['submenu'] as $submenu_id => $submenu_data) {
                add_submenu_page(
                    $page_data['menu_slug'],
                    $submenu_data['page_title'],
                    $submenu_data['menu_title'],
                    $submenu_data['capability'],
                    $submenu_data['menu_slug'],
                    $submenu_data['callback']
                );
            }
        }
    }
}
add_action('admin_menu', 'maverick_register_admin_pages');

/**
 * Theme Settings page callback
 */
function maverick_theme_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_theme_settings');
            do_settings_sections('maverick_theme_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * General Settings page callback
 */
function maverick_general_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_general_settings');
            do_settings_sections('maverick_general_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * Advanced Settings page callback
 */
function maverick_advanced_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_advanced_settings');
            do_settings_sections('maverick_advanced_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}
