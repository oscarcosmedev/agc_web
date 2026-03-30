<?php
/**
 * single.php — Template para posts individuales.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="entry-meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php the_tags( '<div class="entry-tags">', ', ', '</div>' ); ?>
                </footer>
            </article>

            <?php
            the_post_navigation( [
                'prev_text' => '&larr; %title',
                'next_text' => '%title &rarr;',
            ] );

            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
