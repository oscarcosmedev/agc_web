<?php

/**
 * ACF group "banner_media" (campo en página/template):
 *   - titulo   : text
 *   - link     : link
 *   - imagen   : image (return format: array)
 */

defined('ABSPATH') || exit;

function agc_get_banner_media_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('banner_media', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $imagen = $group['imagen'] ?? null;
    $link   = is_array($group['link'] ?? null) ? $group['link'] : null;

    return [
        'titulo'    => trim($group['titulo'] ?? ''),
        'link'      => $link,
        'has_link'  => $link !== null && ! empty($link['url']),
        'img_src'   => $imagen['url']  ?? '',
        'img_alt'   => $imagen['alt']  ?? '',
        'img_sizes' => $imagen['sizes'] ?? [],
    ];
}
