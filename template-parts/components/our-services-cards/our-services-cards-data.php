<?php

/**
 * ACF group "our_services_cards" (post templates: single-terrestre, single-multimodal, single-internacional):
 *   - our_services (group)
 *       - card_1 … card_2 : group
 *           - icon        : image (return format: array)
 *           - description : wysiwyg
 */

defined('ABSPATH') || exit;

function agc_get_our_services_cards_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    
    // Al haber cambiado los IDs en producción, la Base de Datos está desconectada del nombre.
    // Usar directamente la nueva KEY soluciona este comportamiento.
    $group = agc_field('field_69dd304a3a23e', $pid, []);

    if (! is_array($group) || empty($group)) {
        $group = agc_field('our_services', $pid, []);
    }

    if (! is_array($group)) {
        $group = [];
    }

    $cards = [];

    for ($i = 1; $i <= 2; $i++) {
        $card = $group["card_{$i}"] ?? null;

        if (! is_array($card)) {
            continue;
        }

        $icon = $card['icon'] ?? null;

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

        $description = trim($card['description'] ?? '');

        if (empty($icon_src) && $description === '') {
            continue;
        }

        $cards[] = [
            'icon_src'    => $icon_src,
            'icon_alt'    => $icon_alt,
            'description' => $description,
        ];
    }

    return ['cards' => $cards];
}
