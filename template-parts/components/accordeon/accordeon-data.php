<?php

/**
 * ACF group "accordeon" (campo en página/template):
 *   - tab_1 (group)
 *       - title       : text
 *       - description : wysiwyg / textarea
 *   - tab_2 (group)  (misma estructura)
 *   - tab_3 (group)  (misma estructura)
 */

defined('ABSPATH') || exit;

function agc_get_accordeon_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('accordeon', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $tabs = [];
    for ($i = 1; $i <= 3; $i++) {
        $tab = $group["tab_{$i}"] ?? [];
        if (! empty($tab['title'])) {
            $tabs[] = [
                'title'       => trim($tab['title']),
                'description' => $tab['description'] ?? '',
            ];
        }
    }

    return ['tabs' => $tabs];
}
