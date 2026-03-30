<?php

/**
 * inc/setup.php
 * Theme supports, tamaño de contenido, menus y texdomain.
 */

defined('ABSPATH') || exit;

// ─── Theme Setup ──────────────────────────────────────────────────────────────
add_action('after_setup_theme', function () {

    // Traducciones del tema
    load_theme_textdomain('agc-theme', AGC_THEME_DIR . '/languages');

    // Título dinámico manejado por WP (no hardcodear en header.php)
    add_theme_support('title-tag');

    // Soporte de thumbnails
    add_theme_support('post-thumbnails');

    // Tamaños de imagen personalizados
    add_image_size('agc-card',    600, 400, true);
    add_image_size('agc-hero',   1920, 800, true);
    add_image_size('agc-square',  600, 600, true);

    // HTML5 semántico
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Logo custom
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Soporte de Selective Refresh para widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Block editor: deshabilitar estilos del core en el frontend (usamos los nuestros)
    add_theme_support('disable-custom-colors');
    remove_theme_support('core-block-patterns');

    // Menús de navegación
    register_nav_menus([
        'primary' => __('Menú Principal', 'agc-theme'),
        'footer'  => __('Menú Footer', 'agc-theme'),
    ]);
});

// ─── Content Width ────────────────────────────────────────────────────────────
if (! isset($content_width)) {
    $content_width = 1280;
}

// ─── Quitar estilos del core de WP que no necesitamos ─────────────────────────
add_action('wp_enqueue_scripts', function () {
    // Quitar style del block editor en frontend si no se usan bloques
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-block-styles');
}, 100);


/**
 * Deshabilitar el editor de bloques (Gutenberg) de WordPress.
 * Referencia: hook use_block_editor_for_post
 */

add_filter('use_block_editor_for_post', '__return_false', 10);


// Registro de dos logos personalizados (color y blanco)
function agc_customize_register($wp_customize)
{
    // Logo principal (color)
    $wp_customize->add_setting('agc_logo_color');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'agc_logo_color',
        [
            'label'    => __('Logo a color', 'agc-theme'),
            'section'  => 'title_tagline',
            'settings' => 'agc_logo_color',
        ]
    ));

    // Logo alternativo (blanco)
    $wp_customize->add_setting('agc_logo_white');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'agc_logo_white',
        [
            'label'    => __('Logo blanco', 'agc'),
            'section'  => 'title_tagline',
            'settings' => 'agc_logo_white',
        ]
    ));
}
add_action('customize_register', 'agc_customize_register');

/**
 * Permitir la subida de archivos SVG solo a administradores.
 * Validación ANTES del upload + sanitización.
 */
function agc_allow_svg_upload($mimes)
{
    if (current_user_can('manage_options')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'agc_allow_svg_upload');

function agc_validate_svg_upload($file)
{
    if (!isset($file['type'])) {
        return $file;
    }

    $filetype = wp_check_filetype($file['name']);

    // Detectar SVG por extensión
    if ($filetype['ext'] === 'svg' || $file['type'] === 'image/svg+xml') {
        if (!current_user_can('manage_options')) {
            $file['error'] = __('Solo los administradores pueden subir SVGs por seguridad.', 'agc');
        }
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'agc_validate_svg_upload');

/**
 * Sanitizar SVG después del upload
 */
function agc_sanitize_svg_on_upload($file)
{
    if (!isset($file['file']) || !isset($file['type'])) {
        return $file;
    }

    if ($file['type'] === 'image/svg+xml') {
        $svg_content = file_get_contents($file['file']);

        if ($svg_content && function_exists('sanitize_svg')) {
            $sanitized = sanitize_svg($svg_content);
            file_put_contents($file['file'], $sanitized);
        }
    }

    return $file;
}
add_filter('wp_handle_upload', 'agc_sanitize_svg_on_upload');
