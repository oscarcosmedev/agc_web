<?php

/**
 * AGC Theme — functions.php
 * Carga los módulos de inc/ en orden de dependencia.
 */

defined('ABSPATH') || exit;

// ─── Rutas de conveniencia ────────────────────────────────────────────────────
define('AGC_THEME_DIR', get_template_directory());
define('AGC_THEME_URI', get_template_directory_uri());
define('AGC_VERSION',   wp_get_theme()->get('Version'));

// ─── Módulos ──────────────────────────────────────────────────────────────────
$agc_includes = [
    'inc/setup.php',                  // Theme supports, menus, content width
    'inc/enqueue.php',                // Assets (Vite manifest)
    'inc/wpml.php',                   // Helpers de idioma (WPML)
    'inc/acf.php',                    // ACF helpers + WP Settings API fallback
    'inc/cpt.php',                    // Custom Post Types helpers
    'inc/utils.php',                  // Utilidades generales
    'inc/helpers/svg-helpers.php',    // Helpers de SVG
    // ─── Helpers globales (componentes de layout) ─────────────────────────
    'inc/helpers/header-data.php',    // Datos del header global
    'inc/helpers/footer-data.php',    // Datos del footer global
    // ─── Helpers de componentes (co-localizados en template-parts) ─────────
    'template-parts/components/hero/hero-data.php',               // Datos del hero
    'template-parts/components/box-tracking/box-tracking-data.php', // Datos del tracking
    'template-parts/components/noticias/noticias-data.php',       // Datos de las noticias
    'template-parts/components/banner-media/banner-media-data.php', // Datos del banner media
    'template-parts/components/tramites/tramites-data.php',       // Datos de los trámites
    'template-parts/components/box-intro/box-intro-data.php',       // Datos del box intro
    'template-parts/components/accordeon/accordeon-data.php',       // Datos del accordeon
    'template-parts/components/ventajas-grid/ventajas-grid-data.php',       // Datos del ventajas grid
    'template-parts/components/gestion-en/gestion-en-data.php',       // Datos del gestion en
    'template-parts/components/our-services/our-services-data.php',       // Datos del our services
    'template-parts/components/our-services-cards/our-services-cards-data.php',       // Datos del our services cards
    'template-parts/components/quote/quote-data.php',       // Datos del quote
    'template-parts/components/our-services-banner/our-services-banner-data.php',       // Datos del our services banner
    'template-parts/components/servicios-ventajas/servicios-ventajas-data.php',       // Datos del servicios ventajas
];

foreach ($agc_includes as $file) {
    $path = AGC_THEME_DIR . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
