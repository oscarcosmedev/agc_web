<?php
/**
 * inc/utils.php
 * Funciones utilitarias generales del tema.
 */

defined( 'ABSPATH' ) || exit;

// ─── SVG inline ───────────────────────────────────────────────────────────────
/**
 * Renderiza un SVG inline desde /assets/svg/.
 * Ejemplo: agc_svg('arrow-right') → <svg>...</svg>
 *
 * @param  string $name      Nombre del archivo sin extensión.
 * @param  string $css_class Clase CSS adicional para el SVG.
 * @return string
 */
function agc_svg( string $name, string $css_class = '' ): string {
    $path = AGC_THEME_DIR . '/assets/svg/' . sanitize_file_name( $name ) . '.svg';

    if ( ! file_exists( $path ) ) {
        return '';
    }

    // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
    $svg = file_get_contents( $path );

    if ( $css_class ) {
        $svg = str_replace( '<svg', '<svg class="' . esc_attr( $css_class ) . '"', $svg );
    }

    return $svg;
}

// ─── Debug helper ─────────────────────────────────────────────────────────────
/**
 * Dump formateado — solo disponible en WP_DEBUG mode.
 *
 * @param  mixed $var    Variable a inspeccionar.
 * @param  bool  $die    Terminar ejecución tras el dump.
 * @return void
 */
function agc_dump( $var, bool $die = false ): void {
    if ( ! ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
        return;
    }
    echo '<pre style="background:#1e1e2e;color:#cdd6f4;padding:1em;overflow:auto;font-size:13px;">';
    // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_export
    echo esc_html( var_export( $var, true ) );
    echo '</pre>';
    if ( $die ) {
        wp_die();
    }
}

// ─── Excerpt personalizado ────────────────────────────────────────────────────
/**
 * Genera un excerpt de longitud controlada sin cortar palabras.
 *
 * @param  int         $length  Cantidad de palabras.
 * @param  int|WP_Post $post_id Post ID o objeto. Por defecto el post actual.
 * @return string
 */
function agc_excerpt( int $length = 30, $post_id = 0 ): string {
    $post = get_post( $post_id );
    if ( ! $post ) {
        return '';
    }
    $content = wp_strip_all_tags( $post->post_excerpt ?: $post->post_content );
    return wp_trim_words( $content, $length, '&hellip;' );
}

// ─── Clases de body condicionales ────────────────────────────────────────────
/**
 * Agrega clases útiles al body: idioma activo y tipo de template.
 */
add_filter( 'body_class', function ( array $classes ) : array {
    // Clase de idioma (ej: lang-es, lang-en)
    $classes[] = 'lang-' . agc_lang();

    return $classes;
} );
