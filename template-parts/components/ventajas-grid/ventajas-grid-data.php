<?php

/**
 * ACF group "ventajas_grid" (post template: single-aduaneros.php):
 *   - title  : text
 *   - card_1 … card_8 : group
 *       - icon : image (return format: array)
 *       - text : text
 */

defined('ABSPATH') || exit;

function agc_get_ventajas_grid_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('ventajas_grid', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $cards = [];

    for ($i = 1; $i <= 8; $i++) {
        $card = $group["card_{$i}"] ?? null;

        if (! is_array($card)) {
            continue;
        }

        $icon = $card['icon'] ?? null;

        // icon puede venir como array (return_format: array) o como ID (int)
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

        $text = trim($card['text'] ?? '');

        if (empty($icon_src) && $text === '') {
            continue;
        }

        $cards[] = [
            'icon_src' => $icon_src,
            'icon_alt' => $icon_alt,
            'text'     => $text,
        ];
    }

    return [
        'title' => trim($group['title'] ?? ''),
        'cards' => $cards,
    ];
}
