<?php
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
    'inc/helpers/header-data.php',
    'inc/helpers/footer-data.php',
    // ─── Helpers de componentes (co-localizados en template-parts) ─────────
    'template-parts/components/hero/hero-data.php',
    'template-parts/components/box-tracking/box-tracking-data.php',
    'template-parts/components/noticias/noticias-data.php',
    'template-parts/components/banner-media/banner-media-data.php',
    'template-parts/components/tramites/tramites-data.php',
    'template-parts/components/box-intro/box-intro-data.php',
    'template-parts/components/accordeon/accordeon-data.php',
    'template-parts/components/ventajas-grid/ventajas-grid-data.php',
    'template-parts/components/gestion-en/gestion-en-data.php',
    'template-parts/components/our-services/our-services-data.php',
    'template-parts/components/our-services-cards/our-services-cards-data.php',
    'template-parts/components/quote/quote-data.php',
    'template-parts/components/our-services-banner/our-services-banner-data.php',
    'template-parts/components/servicios-ventajas/servicios-ventajas-data.php',
    'template-parts/components/documents/documents-data.php',
    'template-parts/components/messaging-widget/messaging-widget-data.php',
];

foreach ($agc_includes as $file) {
    $path = AGC_THEME_DIR . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
