<?php

/**
 * ACF group "box_intro" (campo en página/template):
 *   - image       : image (return format: array)
 *   - title       : text
 *   - description : wysiwyg / textarea
 */

defined('ABSPATH') || exit;

function agc_get_box_intro_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('box_intro', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $image = $group['image'] ?? null;

    return [
        'title'       => trim($group['title'] ?? ''),
        'description' => $group['description'] ?? '',
        'img_src'     => $image['url']   ?? '',
        'img_alt'     => $image['alt']   ?? '',
        'img_sizes'   => $image['sizes'] ?? [],
    ];
}
