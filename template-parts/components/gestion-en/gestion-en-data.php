<?php

/**
 * ACF group "gestion" (post template: single-aduaneros.php):
 *   - title    : text
 *   - contenido: wysiwyg
 *   - image    : image (return format: array)
 */

defined('ABSPATH') || exit;

function agc_get_gestion_en_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('gestion', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $image = $group['image'] ?? null;

    if (is_array($image)) {
        $img_src   = $image['url']   ?? '';
        $img_alt   = $image['alt']   ?? '';
        $img_sizes = $image['sizes'] ?? [];
    } elseif (is_int($image) && $image > 0) {
        $img_src   = wp_get_attachment_image_url($image, 'large') ?: '';
        $img_alt   = get_post_meta($image, '_wp_attachment_image_alt', true) ?: '';
        $img_sizes = [];
    } else {
        $img_src   = '';
        $img_alt   = '';
        $img_sizes = [];
    }

    return [
        'title'     => trim($group['title']    ?? ''),
        'contenido' => $group['contenido']      ?? '',
        'img_src'   => $img_src,
        'img_alt'   => $img_alt,
        'img_sizes' => $img_sizes,
    ];
}
