<?php

/**
 * Sample extension for Custom Shortcodes
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom shortcode
 *
 * @param array $shortcodes The shortcodes array.
 * @return array Modified shortcodes array.
 */
function maverick_add_custom_shortcode(array $shortcodes): array
{
    $shortcodes['card'] = [
        'callback' => 'maverick_card_shortcode',
        'default_attrs' => [
            'title' => __('Card Title', 'maverick'),
            'content' => __('Card content goes here.', 'maverick'),
            'image' => '',
            'link' => '#',
            'style' => 'default',
        ],
    ];

    return $shortcodes;
}
add_filter('maverick_register_shortcodes', 'maverick_add_custom_shortcode');

/**
 * Card shortcode callback
 *
 * @param array $atts Shortcode attributes.
 * @param string|null $content Shortcode content.
 * @return string Card HTML.
 */
function maverick_card_shortcode(array $atts, ?string $content = null): string
{
    $classes = [
        'maverick-card',
        'maverick-card-' . sanitize_html_class($atts['style']),
    ];

    $image_html = '';
    if (!empty($atts['image'])) {
        $image_html = sprintf(
            '<img src="%s" alt="%s" class="maverick-card-image">',
            esc_url($atts['image']),
            esc_attr($atts['title'])
        );
    }

    $html = sprintf(
        '<div class="%s">
            %s
            <div class="maverick-card-content">
                <h3 class="maverick-card-title">%s</h3>
                <div class="maverick-card-body">%s</div>
                <a href="%s" class="maverick-card-link">%s</a>
            </div>
        </div>',
        esc_attr(implode(' ', $classes)),
        $image_html,
        esc_html($atts['title']),
        wp_kses_post($atts['content']),
        esc_url($atts['link']),
        esc_html__('Read More', 'maverick')
    );

    return apply_filters('maverick_card_shortcode_output', $html, $atts);
}

/**
 * Modify button shortcode attributes
 *
 * @param array $atts Button shortcode attributes.
 * @return array Modified attributes.
 */
function maverick_modify_button_shortcode_atts(array $atts): array
{
    // Add custom class to all buttons
    $atts['class'] = 'custom-button-class';

    // Change default style for specific cases
    if (strpos($atts['url'], 'download') !== false) {
        $atts['style'] = 'download';
    }

    return $atts;
}
add_filter('maverick_shortcode_button_atts', 'maverick_modify_button_shortcode_atts');
