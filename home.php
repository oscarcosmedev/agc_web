<?php

defined('ABSPATH') || exit;

get_header();

// ── Query: últimas noticias (posts default) ───────────────────────────────────
$noticias_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'no_found_rows'  => true,
]);

if ($noticias_query->have_posts()) : ?>

    <section class="home-noticias py-section" aria-labelledby="home-noticias-heading">
        <div class="w-full max-w-7xl mx-auto px-4 xl:px-0">

            <h2 id="home-noticias-heading" class="home-noticias__titulo">
                <?php esc_html_e('Últimas Noticias', 'agc-theme'); ?>
            </h2>

            <ul class="home-noticias__grid">
                <?php while ($noticias_query->have_posts()) : $noticias_query->the_post(); ?>
                    <?php
                    $thumb_id  = get_post_thumbnail_id();
                    $thumb_src = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
                    $thumb_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
                    ?>
                    <li>
                        <article class="noticia-card">
                            <?php if ($thumb_src) : ?>
                                <a href="<?php the_permalink(); ?>" class="noticia-card__image-wrap" tabindex="-1" aria-hidden="true">
                                    <img
                                        src="<?php echo esc_url($thumb_src); ?>"
                                        alt="<?php echo esc_attr($thumb_alt ?: get_the_title()); ?>"
                                        class="noticia-card__image"
                                        loading="lazy">
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="noticia-card__image-wrap bg-slate-200" tabindex="-1" aria-hidden="true"></a>
                            <?php endif; ?>

                            <div class="noticia-card__body">
                                <time class="noticia-card__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                                    <?php echo esc_html(get_the_date('j \d\e F Y')); ?>
                                </time>
                                <h3 class="noticia-card__title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </div>
                        </article>
                    </li>
                <?php endwhile; ?>
            </ul>

        </div>
    </section>

<?php
endif;
wp_reset_postdata();

get_footer();
