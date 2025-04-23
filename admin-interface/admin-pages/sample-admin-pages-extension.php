<?php

/**
 * Sample extension for Admin Pages
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom admin page
 *
 * @param array $admin_pages The admin pages array.
 * @return array Modified admin pages array.
 */
function maverick_add_custom_admin_page(array $admin_pages): array
{
    $admin_pages['custom-settings'] = [
        'page_title' => __('Custom Settings', 'maverick'),
        'menu_title' => __('Custom Settings', 'maverick'),
        'capability' => 'manage_options',
        'menu_slug' => 'maverick-custom-settings',
        'callback' => 'maverick_custom_settings_page',
        'icon_url' => 'dashicons-admin-generic',
        'position' => 60,
        'submenu' => [
            'settings' => [
                'page_title' => __('Settings', 'maverick'),
                'menu_title' => __('Settings', 'maverick'),
                'capability' => 'manage_options',
                'menu_slug' => 'maverick-custom-settings',
                'callback' => 'maverick_custom_settings_page',
            ],
            'tools' => [
                'page_title' => __('Tools', 'maverick'),
                'menu_title' => __('Tools', 'maverick'),
                'capability' => 'manage_options',
                'menu_slug' => 'maverick-custom-tools',
                'callback' => 'maverick_custom_tools_page',
            ],
        ],
    ];

    return $admin_pages;
}
add_filter('maverick_register_admin_pages', 'maverick_add_custom_admin_page');

/**
 * Custom Settings page callback
 */
function maverick_custom_settings_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maverick_custom_settings');
            do_settings_sections('maverick_custom_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * Custom Tools page callback
 */
function maverick_custom_tools_page(): void
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div class="maverick-tools-container">
            <div class="maverick-tool-card">
                <h2><?php esc_html_e('Tool 1', 'maverick'); ?></h2>
                <p><?php esc_html_e('Description of Tool 1', 'maverick'); ?></p>
                <button class="button button-primary"><?php esc_html_e('Run Tool', 'maverick'); ?></button>
            </div>
            <div class="maverick-tool-card">
                <h2><?php esc_html_e('Tool 2', 'maverick'); ?></h2>
                <p><?php esc_html_e('Description of Tool 2', 'maverick'); ?></p>
                <button class="button button-primary"><?php esc_html_e('Run Tool', 'maverick'); ?></button>
            </div>
        </div>
    </div>
<?php
}
