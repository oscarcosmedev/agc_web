<?php
/**
 * search.php — Resultados de búsqueda.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query */
                printf( esc_html__( 'Resultados para: &ldquo;%s&rdquo;', 'agc-theme' ), get_search_query() );
                ?>
            </h1>
        </header>

        <?php get_search_form(); ?>

        <?php if ( have_posts() ) : ?>
            <div class="posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        <div class="post-card__body">
                            <h2 class="post-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-card__excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No se encontraron resultados para tu búsqueda. Intentá con otras palabras.', 'agc-theme' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
