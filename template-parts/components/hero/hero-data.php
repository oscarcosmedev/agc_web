<?php

/**
 *
 * ACF group "hero":
 *   - video       : url
 *   - background  : image (return format: array)
 *   - title       : text
 *   - description : wysiwyg
 *   - link        : link
 *
 * Prioridad de fondo: video > imagen > color sólido.
 */

defined('ABSPATH') || exit;

function agc_get_hero_data(int $post_id = 0): array
{
    $pid   = $post_id ?: (int) get_queried_object_id();
    $group = agc_field('hero', $pid, []);

    if (! is_array($group)) {
        $group = [];
    }

    $background = $group['background'] ?? null;
    $link       = is_array($group['link'] ?? null) ? $group['link'] : null;
    $video_url  = trim((string) ($group['video'] ?? ''));

    $video_embed_url = $video_url ? agc_hero_build_video_embed_url($video_url) : '';

    if ($video_embed_url) {
        $media_type = 'video';
    } elseif (! empty($background['url'])) {
        $media_type = 'image';
    } else {
        $media_type = 'none';
    }

    return [
        'bg_url'          => $background['url'] ?? '',
        'bg_alt'          => $background['alt'] ?? '',
        'title'           => trim($group['title']       ?? ''),
        'description'     => trim($group['description'] ?? ''),
        'link'            => $link,
        'has_link'        => $link !== null && ! empty($link['url']),
        'media_type'      => $media_type,
        'video_embed_url' => $video_embed_url,
    ];
}

function agc_hero_build_video_embed_url(string $url): string
{
    // YouTube: youtu.be/ID, youtube.com/watch?v=ID, /embed/ID, /shorts/ID
    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $url, $m)) {
        return add_query_arg([
            'autoplay'       => 1,
            'mute'           => 1,
            'loop'           => 1,
            'playlist'       => $m[1],
            'controls'       => 0,
            'rel'            => 0,
            'modestbranding' => 1,
        ], 'https://www.youtube.com/embed/' . $m[1]);
    }

    // Vimeo: vimeo.com/ID, player.vimeo.com/video/ID
    if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $m)) {
        return add_query_arg([
            'autoplay'   => 1,
            'muted'      => 1,
            'loop'       => 1,
            'background' => 1,
        ], 'https://player.vimeo.com/video/' . $m[1]);
    }

    // Archivo directo (mp4, webm, ogg) — se renderiza como <video>
    if (preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i', $url)) {
        return $url;
    }

    return '';
}

function agc_hero_is_direct_video(string $embed_url): bool
{
    return (bool) preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i', $embed_url);
}
