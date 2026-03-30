<?php

/**
 * inc/helpers/header-data.php
 * Helper de datos para el header global del sitio.
 *
 * Devuelve un array tipado con los datos que site-header.php necesita,
 * sin lógica de presentación. Global porque el header se usa en todos los templates.
 */

defined('ABSPATH') || exit;

/**
 * Devuelve los datos necesarios para renderizar el site-header.
 *
 * @return array{
 *   has_logo: bool,
 *   logo_white_html: string,
 *   logo_color_html: string,
 *   site_url: string,
 *   site_name: string,
 *   has_primary_menu: bool,
 *   languages: array,
 *   current_lang: string,
 * }
 */
function agc_get_header_data(): array
{
    $site_name = esc_attr(get_bloginfo('name'));

    $logo_white_id = attachment_url_to_postid(get_theme_mod('agc_logo_white', ''));
    $logo_color_id = attachment_url_to_postid(get_theme_mod('agc_logo_color', ''));

    $logo_white_html = $logo_white_id
        ? wp_get_attachment_image($logo_white_id, 'full', false, [
            'class'   => 'site-logo__img site-logo__img--white',
            'alt'     => $site_name,
            'loading' => 'eager',
        ])
        : '';

    $logo_color_html = $logo_color_id
        ? wp_get_attachment_image($logo_color_id, 'full', false, [
            'class'   => 'site-logo__img site-logo__img--color',
            'alt'     => $site_name,
            'loading' => 'eager',
        ])
        : '';

    // Fallback: si solo hay un logo, usarlo en ambas variantes
    if (! $logo_white_id && ! $logo_color_id) {
        $fallback_id = get_theme_mod('custom_logo');
        if ($fallback_id) {
            $logo_color_html = wp_get_attachment_image($fallback_id, 'full', false, [
                'class'   => 'site-logo__img site-logo__img--color',
                'alt'     => $site_name,
                'loading' => 'eager',
            ]);
        }
    }

    return [
        'has_logo'         => (bool) ($logo_white_id || $logo_color_id || get_theme_mod('custom_logo')),
        'logo_white_html'  => $logo_white_html,
        'logo_color_html'  => $logo_color_html,
        'site_url'         => esc_url(home_url('/')),
        'site_name'        => esc_html(get_bloginfo('name')),
        'has_primary_menu' => has_nav_menu('primary'),
        'languages'        => agc_lang_switcher(),
        'current_lang'     => strtoupper(agc_lang()),
    ];
}
