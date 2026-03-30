<?php

/**
 * inc/enqueue.php
 * Encola CSS y JS compilados por Vite.
 *
 * En desarrollo (WP_DEBUG true): espera que Vite dev server corra en :5173.
 * En producción: lee assets/dist/.vite/manifest.json para los hashes de archivo.
 */

defined('ABSPATH') || exit;

// ─── Helper: leer el manifest de Vite ─────────────────────────────────────────
function agc_vite_asset(string $entry): string
{
    static $manifest = null;

    if (null === $manifest) {
        $manifest_path = AGC_THEME_DIR . '/assets/dist/.vite/manifest.json';
        if (file_exists($manifest_path)) {
            // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
            $manifest = json_decode(file_get_contents($manifest_path), true) ?? [];
        } else {
            $manifest = [];
        }
    }

    return isset($manifest[$entry]['file'])
        ? AGC_THEME_URI . '/assets/dist/' . $manifest[$entry]['file']
        : '';
}

// ─── Enqueue principal ────────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {

    $is_dev = defined('WP_DEBUG') && WP_DEBUG;

    if ($is_dev) {
        // ── Modo desarrollo: Vite HMR en :5173 ──────────────────────────────
        // El CSS lo inyecta Vite automáticamente; solo encolamos el JS de entrada.
        wp_enqueue_script(
            'agc-vite-client',
            'http://localhost:5173/@vite/client',
            [],
            null,
            false
        );
        // En desarrollo, Vite sirve los CSS como módulos JavaScript que inyectan los estilos.
        // Por lo tanto, ¡debemos encolarlos como scripts!
        wp_enqueue_script(
            'agc-tailwind-css',
            'http://localhost:5173/assets/src/css/main.css',
            ['agc-vite-client'],
            null,
            true
        );
        wp_enqueue_script(
            'agc-custom-css',
            'http://localhost:5173/assets/src/scss/main.scss',
            ['agc-vite-client'],
            null,
            true
        );
        wp_enqueue_script(
            'agc-main-js',
            'http://localhost:5173/assets/src/js/main.js',
            ['agc-vite-client'],
            null,
            true
        );
    } else {
        // ── Modo producción: assets desde manifest.json ─────────────────────
        $tailwind_url = agc_vite_asset('assets/src/css/main.css');
        $custom_url   = agc_vite_asset('assets/src/scss/main.scss');
        $js_url       = agc_vite_asset('assets/src/js/main.js');

        if ($tailwind_url) {
            wp_enqueue_style('agc-tailwind-css', $tailwind_url, [], null);
        }
        if ($custom_url) {
            wp_enqueue_style('agc-custom-css', $custom_url, [], null);
        }

        if ($js_url) {
            wp_enqueue_script('agc-main-js', $js_url, [], null, true);
        }
    }

    // ── Variables PHP → JS ──────────────────────────────────────────────────
    wp_localize_script('agc-main-js', 'AGC', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('agc_nonce'),
        'lang'     => function_exists('agc_lang') ? agc_lang() : 'es',
        'themeUri' => AGC_THEME_URI,
        'isDebug'  => $is_dev,
    ]);
});

// ─── Atributos type="module" para scripts de Vite ─────────────────────────────
add_filter('script_loader_tag', function (string $tag, string $handle): string {
    $vite_handles = ['agc-vite-client', 'agc-tailwind-css', 'agc-custom-css', 'agc-main-js'];
    if (in_array($handle, $vite_handles, true)) {
        $tag = str_replace(' src=', ' type="module" crossorigin src=', $tag);
    }
    return $tag;
}, 10, 2);
