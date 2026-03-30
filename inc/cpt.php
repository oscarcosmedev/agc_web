<?php
/**
 * inc/cpt.php
 * Helpers de Custom Post Types para trabajar con CPT UI.
 *
 * Los CPTs se registran desde el plugin CPT UI; aquí solo
 * incluimos helpers de consulta y utilidades de integración.
 */

defined( 'ABSPATH' ) || exit;

// ─── Helper: query de CPT ─────────────────────────────────────────────────────
/**
 * Consulta posts de un CPT con defaults sensatos y WPML aware.
 *
 * @param  string $post_type Slug del CPT registrado en CPT UI.
 * @param  array  $args      Args adicionales para WP_Query.
 * @return WP_Post[]
 */
function agc_get_posts( string $post_type, array $args = [] ): array {
    $defaults = [
        'post_type'      => $post_type,
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
        'no_found_rows'  => true,   // Optimización: deshabilita COUNT si no necesitás paginación
    ];

    $query = new WP_Query( array_merge( $defaults, $args ) );

    wp_reset_postdata();

    return $query->posts;
}

// ─── Helper: URL del archivo de un CPT ────────────────────────────────────────
/**
 * Devuelve la URL del archivo de un CPT.
 *
 * @param  string $post_type Slug del CPT.
 * @return string
 */
function agc_cpt_archive_url( string $post_type ): string {
    $url = get_post_type_archive_link( $post_type );
    return $url ?: home_url( '/' );
}

// ─── Flush rewrite rules al activar/desactivar theme ──────────────────────────
// Necesario para que los CPTs registrados por CPT UI generen sus permalinks.
add_action( 'after_switch_theme', function () {
    flush_rewrite_rules();
} );
