<?php
/**
 * page.php — Template para páginas estáticas de WordPress.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
                <div class="entry-content">
                    <?php
                    the_content();
                    wp_link_pages();
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
