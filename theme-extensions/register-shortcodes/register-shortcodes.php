<?php

/**
 * Register Custom Shortcodes with filterable attributes
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Shortcodes
 */
function maverick_register_shortcodes(): void
{
    // Default shortcodes array
    $shortcodes = [
        'button' => [
            'callback' => 'maverick_button_shortcode',
            'default_attrs' => [
                'text' => __('Click Me', 'maverick'),
                'url' => '#',
                'style' => 'primary',
                'size' => 'medium',
                'target' => '_self',
            ],
        ],
        'alert' => [
            'callback' => 'maverick_alert_shortcode',
            'default_attrs' => [
                'type' => 'info',
                'message' => __('This is an alert message.', 'maverick'),
                'dismissible' => 'true',
            ],
        ],
    ];

    // Allow other plugins/themes to modify the shortcodes
    $shortcodes = apply_filters('maverick_register_shortcodes', $shortcodes);

    // Register each shortcode
    foreach ($shortcodes as $tag => $data) {
        add_shortcode($tag, function ($atts, $content = null) use ($data) {
            // Merge default attributes with user attributes
            $atts = shortcode_atts($data['default_attrs'], $atts, $tag);

            // Allow filtering of attributes
            $atts = apply_filters("maverick_shortcode_{$tag}_atts", $atts);

            // Call the callback function
            return call_user_func($data['callback'], $atts, $content);
        });
    }
}
add_action('init', 'maverick_register_shortcodes');

/**
 * Button shortcode callback
 *
 * @param array $atts Shortcode attributes.
 * @param string|null $content Shortcode content.
 * @return string Button HTML.
 */
function maverick_button_shortcode(array $atts, ?string $content = null): string
{
    $classes = [
        'maverick-button',
        'maverick-button-' . sanitize_html_class($atts['style']),
        'maverick-button-' . sanitize_html_class($atts['size']),
    ];

    $html = sprintf(
        '<a href="%s" class="%s" target="%s">%s</a>',
        esc_url($atts['url']),
        esc_attr(implode(' ', $classes)),
        esc_attr($atts['target']),
        esc_html($atts['text'])
    );

    return apply_filters('maverick_button_shortcode_output', $html, $atts);
}

/**
 * Alert shortcode callback
 *
 * @param array $atts Shortcode attributes.
 * @param string|null $content Shortcode content.
 * @return string Alert HTML.
 */
function maverick_alert_shortcode(array $atts, ?string $content = null): string
{
    $classes = [
        'maverick-alert',
        'maverick-alert-' . sanitize_html_class($atts['type']),
    ];

    if ($atts['dismissible'] === 'true') {
        $classes[] = 'maverick-alert-dismissible';
    }

    $html = sprintf(
        '<div class="%s" role="alert">%s%s</div>',
        esc_attr(implode(' ', $classes)),
        esc_html($atts['message']),
        $atts['dismissible'] === 'true' ? '<button type="button" class="maverick-alert-close">&times;</button>' : ''
    );

    return apply_filters('maverick_alert_shortcode_output', $html, $atts);
}
