<?php
/**
 * archive.php — Archivos de categorías, tags, authors, fechas y CPTs.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
            <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card__thumbnail" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            </a>
                        <?php endif; ?>
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
            <p><?php esc_html_e( 'No se encontraron resultados.', 'agc-theme' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
