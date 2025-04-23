<?php

/**
 * Sample extension for Multisite functionality
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Modify multisite settings
 *
 * @param array $multisite_settings The multisite settings array.
 * @return array Modified multisite settings array.
 */
function maverick_modify_multisite_settings(array $multisite_settings): array
{
    // Modify network settings
    $multisite_settings['network_settings']['network_menu_position'] = 101;
    $multisite_settings['network_settings']['network_menu_icon'] = 'dashicons-admin-network';

    // Add custom network settings
    $multisite_settings['network_settings']['custom_settings'] = [
        'enable_custom_feature' => true,
        'custom_feature_option' => 'default',
    ];

    // Modify site settings
    $multisite_settings['site_settings']['site_menu_position'] = 100;
    $multisite_settings['site_settings']['site_menu_icon'] = 'dashicons-admin-home';

    // Add custom site settings
    $multisite_settings['site_settings']['custom_settings'] = [
        'enable_site_feature' => true,
        'site_feature_option' => 'default',
    ];

    return $multisite_settings;
}
add_filter('maverick_register_multisite_settings', 'maverick_modify_multisite_settings');

/**
 * Add custom network settings section
 */
function maverick_add_network_settings_section(): void
{
    add_settings_section(
        'maverick_network_custom_section',
        __('Custom Network Settings', 'maverick'),
        'maverick_network_custom_section_callback',
        'maverick_network_settings'
    );

    add_settings_field(
        'maverick_network_custom_feature',
        __('Enable Custom Feature', 'maverick'),
        'maverick_network_custom_feature_callback',
        'maverick_network_settings',
        'maverick_network_custom_section'
    );
}
add_action('admin_init', 'maverick_add_network_settings_section');

/**
 * Network custom section callback
 */
function maverick_network_custom_section_callback(): void
{
    echo '<p>' . esc_html__('Configure custom network settings here.', 'maverick') . '</p>';
}

/**
 * Network custom feature callback
 */
function maverick_network_custom_feature_callback(): void
{
    $option = get_site_option('maverick_network_custom_feature', 'default');
?>
    <select name="maverick_network_custom_feature">
        <option value="default" <?php selected($option, 'default'); ?>><?php esc_html_e('Default', 'maverick'); ?></option>
        <option value="enabled" <?php selected($option, 'enabled'); ?>><?php esc_html_e('Enabled', 'maverick'); ?></option>
        <option value="disabled" <?php selected($option, 'disabled'); ?>><?php esc_html_e('Disabled', 'maverick'); ?></option>
    </select>
<?php
}

/**
 * Add custom site settings section
 */
function maverick_add_site_settings_section(): void
{
    add_settings_section(
        'maverick_site_custom_section',
        __('Custom Site Settings', 'maverick'),
        'maverick_site_custom_section_callback',
        'maverick_site_settings'
    );

    add_settings_field(
        'maverick_site_custom_feature',
        __('Enable Custom Feature', 'maverick'),
        'maverick_site_custom_feature_callback',
        'maverick_site_settings',
        'maverick_site_custom_section'
    );
}
add_action('admin_init', 'maverick_add_site_settings_section');

/**
 * Site custom section callback
 */
function maverick_site_custom_section_callback(): void
{
    echo '<p>' . esc_html__('Configure custom site settings here.', 'maverick') . '</p>';
}

/**
 * Site custom feature callback
 */
function maverick_site_custom_feature_callback(): void
{
    $option = get_option('maverick_site_custom_feature', 'default');
?>
    <select name="maverick_site_custom_feature">
        <option value="default" <?php selected($option, 'default'); ?>><?php esc_html_e('Default', 'maverick'); ?></option>
        <option value="enabled" <?php selected($option, 'enabled'); ?>><?php esc_html_e('Enabled', 'maverick'); ?></option>
        <option value="disabled" <?php selected($option, 'disabled'); ?>><?php esc_html_e('Disabled', 'maverick'); ?></option>
    </select>
<?php
}
