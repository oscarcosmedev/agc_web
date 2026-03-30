<?php
/**
 * home.php
 * Template del archivo de blog (listado de posts).
 * WordPress lo usa cuando está configurado: Ajustes → Lectura → Página de entradas.
 * NOTA: front-page.php maneja la landing; este archivo es exclusivo del blog.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main blog-archive">
    <div class="container">

        <header class="page-header">
            <h1 class="page-title">
                <?php
                $blog_page_id = get_option( 'page_for_posts' );
                echo $blog_page_id
                    ? esc_html( get_the_title( $blog_page_id ) )
                    : esc_html__( 'Blog', 'agc-theme' );
                ?>
            </h1>
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
                            <div class="post-card__meta">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </div>
                            <div class="post-card__excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn--primary">
                                <?php esc_html_e( 'Leer más', 'agc-theme' ); ?>
                            </a>
                        </div>

                    </article>

                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination( [
                'prev_text' => '&larr; ' . __( 'Anterior', 'agc-theme' ),
                'next_text' => __( 'Siguiente', 'agc-theme' ) . ' &rarr;',
            ] ); ?>

        <?php else : ?>
            <p class="no-results"><?php esc_html_e( 'No hay entradas publicadas aún.', 'agc-theme' ); ?></p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
