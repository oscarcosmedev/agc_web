<?php

/**
 * ACF group "our_services_primary" (post templates: single-maritimo, single-terrestre, single-aereo):
 *   - title  : text
 *   - row_1 … row_3 : group
 *       - title    : text
 *       - service_1 … service_4 : group
 *           - icon : image (return format: array)
 *           - name : text
 */

defined('ABSPATH') || exit;

function agc_get_our_services_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('our_services_primary', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $rows = [];

    for ($r = 1; $r <= 3; $r++) {
        $row = $group["row_{$r}"] ?? null;

        if (! is_array($row)) {
            continue;
        }

        $services = [];

        for ($s = 1; $s <= 5; $s++) {
            $service = $row["service_{$s}"] ?? null;

            if (! is_array($service)) {
                continue;
            }

            $icon = $service['icon'] ?? null;

            if (is_array($icon)) {
                $icon_src = $icon['url'] ?? '';
                $icon_alt = $icon['alt'] ?? '';
            } elseif (is_int($icon) && $icon > 0) {
                $icon_src = wp_get_attachment_image_url($icon, 'thumbnail') ?: '';
                $icon_alt = get_post_meta($icon, '_wp_attachment_image_alt', true) ?: '';
            } else {
                $icon_src = '';
                $icon_alt = '';
            }

            $name = trim($service['name'] ?? '');

            if (empty($icon_src) && $name === '') {
                continue;
            }

            $services[] = [
                'icon_src' => $icon_src,
                'icon_alt' => $icon_alt,
                'name'     => $name,
            ];
        }

        if (empty($services)) {
            continue;
        }

        $rows[] = [
            'title'    => trim($row['title'] ?? ''),
            'services' => $services,
        ];
    }

    return [
        'title' => trim($group['title'] ?? ''),
        'rows'  => $rows,
    ];
}
