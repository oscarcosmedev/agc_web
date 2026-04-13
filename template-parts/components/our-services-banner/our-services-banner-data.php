<?php

/**
 * ACF group "our_services_banner" (post template: single-multimodal):
 *   - title               : text
 *   - our_services_banner : image (return format: array)
 */

defined('ABSPATH') || exit;

function agc_get_our_services_banner_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $title = trim(agc_field('our_services_title', $pid, ''));
    $image = agc_field('our_services_banner', $pid, null);

    if (is_array($image)) {
        $src    = $image['url'] ?? '';
        $alt    = $image['alt'] ?? '';
        $width  = $image['width'] ?? 0;
        $height = $image['height'] ?? 0;
    } elseif (is_int($image) && $image > 0) {
        $src    = wp_get_attachment_image_url($image, 'full') ?: '';
        $alt    = get_post_meta($image, '_wp_attachment_image_alt', true) ?: '';
        $width  = 0;
        $height = 0;
    } else {
        $src = $alt = '';
        $width = $height = 0;
    }

    return compact('title', 'src', 'alt', 'width', 'height');
}
