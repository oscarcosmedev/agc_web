<?php

/**
 * Helper de datos para el footer global del sitio.
 */

defined('ABSPATH') || exit;

/**
 * Devuelve los datos necesarios para renderizar el site-footer.
 *
 * @return array
 */
function agc_get_footer_data(): array
{
    $site_name      = esc_html(get_bloginfo('name'));
    $logo_white_id  = attachment_url_to_postid(get_theme_mod('agc_logo_white', ''));

    $logo_html = $logo_white_id
        ? wp_get_attachment_image($logo_white_id, 'full', false, [
            'class'   => 'footer-logo__img',
            'alt'     => $site_name,
            'loading' => 'lazy',
        ])
        : '';

    // Fallback: logo estándar de WP
    if (! $logo_html) {
        $fallback_id = get_theme_mod('custom_logo');
        if ($fallback_id) {
            $logo_html = wp_get_attachment_image($fallback_id, 'full', false, [
                'class'   => 'footer-logo__img',
                'alt'     => $site_name,
                'loading' => 'lazy',
            ]);
        }
    }

    return [
        'site_url'        => esc_url(home_url('/')),
        'site_name'       => $site_name,
        'logo_html'       => $logo_html,
        'has_footer_menu' => has_nav_menu('footer'),
        'contact_url'     => esc_url(get_theme_mod('agc_footer_contact_url', home_url('/contacto'))),
        'email'           => sanitize_email(get_theme_mod('agc_footer_email', 'info@actionglobalcargo.com')),
        'phone'           => esc_html(get_theme_mod('agc_footer_phone', '+54911 37301311')),
        'year'            => gmdate('Y'),
    ];
}
