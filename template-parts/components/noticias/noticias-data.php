<?php

/**
 *
 * ACF group "noticias_section" (en página/template que use este componente):
 *   - titulo       : text   (default: "Últimas Noticias")
 *   - cantidad     : number (default: 8)
 *   - categoria    : taxonomy (post_category, opcional)
 *
 * Cada post tipo "post" expone:
 *   - Thumbnail (featured image)
 *   - Fecha (get_the_date)
 *   - Título
 *   - Permalink
 */

defined('ABSPATH') || exit;

function agc_get_noticias_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('noticias_section', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $titulo   = trim($group['titulo']   ?? '') ?: __('Últimas Noticias', 'agc-theme');
    $cantidad = (int) ($group['cantidad'] ?? 8);
    $cat_id   = (int) ($group['categoria'] ?? 0);

    $query_args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $cantidad,
        'no_found_rows'  => true,
    ];

    if ($cat_id) {
        $query_args['cat'] = $cat_id;
    }

    $query = new WP_Query($query_args);
    $posts = [];

    foreach ($query->posts as $post) {
        $thumbnail_id  = get_post_thumbnail_id($post->ID);
        $thumbnail_src = $thumbnail_id
            ? wp_get_attachment_image_url($thumbnail_id, 'large')
            : '';
        $thumbnail_alt = $thumbnail_id
            ? get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)
            : '';

        $posts[] = [
            'id'            => $post->ID,
            'title'         => get_the_title($post->ID),
            'permalink'     => get_permalink($post->ID),
            'date'          => get_the_date('j \d\e F Y', $post->ID),
            'thumbnail_src' => $thumbnail_src,
            'thumbnail_alt' => $thumbnail_alt ?: get_the_title($post->ID),
        ];
    }

    wp_reset_postdata();

    return [
        'titulo' => $titulo,
        'posts'  => $posts,
    ];
}
