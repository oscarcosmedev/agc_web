<?php
/**
 * AGC Theme — index.php
 * Fallback genérico de WordPress. Idealmente nunca se usa directamente
 * ya que cada tipo de contenido tiene su propio template.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No se encontró contenido.', 'agc-theme' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
