<?php

/**
 * ACF group "servicios_ventajas_cards" (post template: single-internacional):
 *   - servicios_ventajas (group)
 *       - title  : text
 *       - card_1 : group  →  image (image) + description (wysiwyg)
 *       - card_2 : group  →  imagen (image) + description (wysiwyg)
 */

defined('ABSPATH') || exit;

function agc_get_servicios_ventajas_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('servicios_ventajas', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $title = trim($group['title'] ?? '');
    $cards = [];

    for ($i = 1; $i <= 2; $i++) {
        $card = $group["card_{$i}"] ?? null;

        if (! is_array($card)) {
            continue;
        }

        // card_1 usa "image", card_2 usa "imagen"
        $image = $card['image'] ?? $card['imagen'] ?? null;

        if (is_array($image)) {
            $img_src = $image['url'] ?? '';
            $img_alt = $image['alt'] ?? '';
        } elseif (is_int($image) && $image > 0) {
            $img_src = wp_get_attachment_image_url($image, 'large') ?: '';
            $img_alt = get_post_meta($image, '_wp_attachment_image_alt', true) ?: '';
        } else {
            $img_src = '';
            $img_alt = '';
        }

        $description = trim($card['description'] ?? '');

        if (empty($img_src) && $description === '') {
            continue;
        }

        $cards[] = [
            'img_src'     => $img_src,
            'img_alt'     => $img_alt,
            'description' => $description,
        ];
    }

    return compact('title', 'cards');
}
