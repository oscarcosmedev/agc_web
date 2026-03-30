<?php
/**
 * inc/wpml.php
 * Helpers de idioma para WPML.
 * Todas las funciones son seguras si WPML no está activo (devuelven defaults).
 */

defined( 'ABSPATH' ) || exit;

// ─── Idioma actual ────────────────────────────────────────────────────────────
/**
 * Devuelve el código del idioma activo (ej: 'es', 'en').
 *
 * @return string
 */
function agc_lang(): string {
    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
        return ICL_LANGUAGE_CODE;
    }
    return get_bloginfo( 'language' ) ? substr( get_bloginfo( 'language' ), 0, 2 ) : 'es';
}

// ─── Es idioma primario? ──────────────────────────────────────────────────────
/**
 * @param  string $lang Código de idioma a verificar (ej: 'es').
 * @return bool
 */
function agc_is_lang( string $lang ): bool {
    return agc_lang() === $lang;
}

// ─── URL traducida ────────────────────────────────────────────────────────────
/**
 * Devuelve la URL del post/página en el idioma activo.
 *
 * @param  int    $post_id ID del post original.
 * @param  string $lang    Código de idioma destino. Por defecto el idioma activo.
 * @return string
 */
function agc_translate_url( int $post_id, string $lang = '' ): string {
    if ( ! $lang ) {
        $lang = agc_lang();
    }
    if ( function_exists( 'wpml_object_id_filter' ) ) {
        $translated_id = apply_filters( 'wpml_object_id', $post_id, get_post_type( $post_id ), true, $lang );
        return get_permalink( $translated_id ) ?: get_permalink( $post_id );
    }
    return get_permalink( $post_id ) ?: home_url( '/' );
}

// ─── Listado de idiomas disponibles ──────────────────────────────────────────
/**
 * Devuelve un array de idiomas activos, útil para language switchers.
 *
 * @return array<int, array{code: string, url: string, name: string, active: bool}>
 */
function agc_lang_switcher(): array {
    if ( ! function_exists( 'icl_get_languages' ) ) {
        return [];
    }

    $langs  = icl_get_languages( 'skip_missing=0&orderby=code' );
    $result = [];

    foreach ( $langs as $code => $lang ) {
        $result[] = [
            'code'   => $code,
            'url'    => $lang['url'],
            'name'   => $lang['native_name'],
            'active' => (bool) $lang['active'],
        ];
    }

    return $result;
}

// ─── Wrapper de traducción ────────────────────────────────────────────────────
/**
 * Wrapper de __() para strings del tema.
 * Útil para tener un punto central si en el futuro se cambia el text domain.
 *
 * @param  string $string Texto a traducir.
 * @return string
 */
function agc_t( string $string ): string {
    return __( $string, 'agc-theme' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}
