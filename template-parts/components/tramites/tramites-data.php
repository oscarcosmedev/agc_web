<?php

/**
 * CPT: 'tramites'
 * ACF en cada post (group "tramite"):
 *   - description  : wysiwyg
 *   - link         : link
 *
 * ACF a nivel de página/template (group "tramites_section"):
 *   - titulo       : text   (default: "Links para realizar trámites")
 *   - subtitulo    : text
 */

defined('ABSPATH') || exit;

function agc_get_tramites_data(int $page_id = 0): array
{
    $pid   = $page_id ?: (int) get_queried_object_id();
    $group = agc_field('tramites_section', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $titulo   = trim($group['titulo']   ?? '') ?: __('Links para realizar trámites', 'agc-theme');
    $subtitulo = trim($group['subtitulo'] ?? '') ?: __('Links necesarios para tramites.', 'agc-theme');

    $query = new WP_Query([
        'post_type'      => 'tramites',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    ]);

    $items = [];

    foreach ($query->posts as $post) {
        $acf   = agc_field('tramite', $post->ID, []);
        $link  = is_array($acf['link'] ?? null) ? $acf['link'] : null;

        $items[] = [
            'id'          => $post->ID,
            'titulo'      => get_the_title($post->ID),
            'description' => $acf['description'] ?? '',
            'link'        => $link,
            'has_link'    => $link !== null && ! empty($link['url']),
        ];
    }

    wp_reset_postdata();

    return [
        'titulo'    => $titulo,
        'subtitulo' => $subtitulo,
        'items'     => $items,
    ];
}
