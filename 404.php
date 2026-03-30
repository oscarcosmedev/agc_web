<?php
/**
 * 404.php — Página de error no encontrado.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main error-404">
    <div class="container">
        <div class="error-404__content">
            <h1 class="error-404__title">404</h1>
            <p class="error-404__message">
                <?php esc_html_e( 'La página que buscás no existe o fue movida.', 'agc-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                <?php esc_html_e( 'Volver al inicio', 'agc-theme' ); ?>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
