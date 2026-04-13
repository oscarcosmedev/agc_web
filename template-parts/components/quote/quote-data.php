<?php

/**
 * ACF group "our_services_quote" (post templates: single-aereo, single-multimodal):
 *   - icon  : image (return format: array)
 *   - quote : wysiwyg
 */

defined('ABSPATH') || exit;

function agc_get_quote_data(int $post_id = 0): array
{
    $pid  = $post_id ?: (int) get_queried_object_id();
    $icon = agc_field('icon', $pid, null);

    if (is_array($icon)) {
        $icon_src = $icon['url'] ?? '';
        $icon_alt = $icon['alt'] ?? '';
    } elseif (is_int($icon) && $icon > 0) {
        $icon_src = wp_get_attachment_image_url($icon, 'medium') ?: '';
        $icon_alt = get_post_meta($icon, '_wp_attachment_image_alt', true) ?: '';
    } else {
        $icon_src = '';
        $icon_alt = '';
    }

    return [
        'icon_src' => $icon_src,
        'icon_alt' => $icon_alt,
        'quote'    => trim(agc_field('quote', $pid, '')),
    ];
}
