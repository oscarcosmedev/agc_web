<?php

/**
 * ACF group "documents" (post_type: documentos):
 *   - documents (group)
 *       - title : text
 *       - icon  : image
 *       - file  : file
 */

defined('ABSPATH') || exit;

function agc_get_documents_data(): array
{
    $query = new WP_Query([
        'post_type'      => 'documentos',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $items = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $pid   = (int) get_the_ID();
            $group = agc_field('documents', $pid, []);

            if (! is_array($group)) {
                continue;
            }

            $title = trim($group['title'] ?? '');

            // Icon
            $icon = $group['icon'] ?? null;
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

            // File
            $file = $group['file'] ?? null;
            if (is_array($file)) {
                $file_url = $file['url'] ?? '';
            } elseif (is_int($file) && $file > 0) {
                $file_url = wp_get_attachment_url($file) ?: '';
            } else {
                $file_url = '';
            }

            if ($title === '' && $file_url === '') {
                continue;
            }

            $items[] = [
                'title'    => $title,
                'icon_src' => $icon_src,
                'icon_alt' => $icon_alt,
                'file_url' => $file_url,
            ];
        }
        wp_reset_postdata();
    }

    return compact('items');
}
