<?php

/**
 * single.php — Template para posts individuales.
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) : the_post();

    $thumb_id  = get_post_thumbnail_id();
    $thumb_src = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
    $thumb_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
    $cats      = get_the_category();
?>

    <main id="main" class="single-post">

        <!-- ── Hero con imagen destacada ───────────────────────────────────────── -->
        <div class="single-post__hero"
            <?php if ($thumb_src) : ?>
            style="background-image: url('<?php echo esc_url($thumb_src); ?>')"
            <?php endif; ?>>
            <div class="single-post__hero-overlay"></div>
            <div class="single-post__hero-inner w-full max-w-4xl mx-auto px-4 xl:px-0">

                <?php if ($cats) : ?>
                    <span class="single-post__cat">
                        <?php echo esc_html($cats[0]->name); ?>
                    </span>
                <?php endif; ?>

                <h1 class="single-post__title">
                    <?php the_title(); ?>
                </h1>

                <div class="single-post__meta">
                    <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                        <?php echo esc_html(get_the_date('j \d\e F Y')); ?>
                    </time>
                </div>

            </div>
        </div>

        <!-- ── Cuerpo del artículo ─────────────────────────────────────────────── -->
        <div class="single-post__body w-full max-w-4xl mx-auto px-4 xl:px-0 py-section">

            <?php get_template_part('template-parts/components/breadcrumb/breadcrumb'); ?>

            <!-- Volver -->
            <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/')); ?>"
                class="single-post__back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                <?php esc_html_e('Volver a noticias', 'agc-theme'); ?>
            </a>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post__article'); ?>>
                <div class="entry-content single-post__content">
                    <?php the_content(); ?>
                </div>

                <?php
                $tags = get_the_tags();
                if ($tags) : ?>
                    <footer class="single-post__footer">
                        <div class="single-post__tags">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                    class="single-post__tag">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <!-- Navegación entre posts -->
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ($prev || $next) : ?>
                <nav class="single-post__nav" aria-label="<?php esc_attr_e('Navegación entre posts', 'agc-theme'); ?>">
                    <?php if ($prev) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="single-post__nav-item single-post__nav-item--prev">
                            <span class="single-post__nav-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="15 18 9 12 15 6" />
                                </svg>
                                <?php esc_html_e('Anterior', 'agc-theme'); ?>
                            </span>
                            <span class="single-post__nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if ($next) : ?>
                        <a href="<?php echo esc_url(get_permalink($next)); ?>" class="single-post__nav-item single-post__nav-item--next">
                            <span class="single-post__nav-label">
                                <?php esc_html_e('Siguiente', 'agc-theme'); ?>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                            </span>
                            <span class="single-post__nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                        </a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>

        </div>

    </main>

<?php
endwhile;

get_footer();
