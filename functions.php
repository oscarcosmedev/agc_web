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
];

foreach ($agc_includes as $file) {
    $path = AGC_THEME_DIR . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
