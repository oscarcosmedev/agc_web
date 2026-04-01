<?php

/**
 * Sección "Últimas Noticias". Construye slides de noticias y delega
 * el comportamiento del carousel al componente slider genérico.
 */

$data   = agc_get_noticias_data();
$titulo = $data['titulo'];
$posts  = $data['posts'];

if (empty($posts)) {
    return;
}

// ── Renderizar cada card como string (slide) ──────────────────────────────
ob_start();
$slides = [];

foreach ($posts as $post) {
    ob_start();
    $id = $post['id'];

    $permalink = $post['permalink'];
    $title = $post['title'];
    $alt = $post['thumbnail_alt'] ?: $post['title'];
    $date = $post['date'];

    $thumbnail_src = $post['thumbnail_src'];
    $hasImage = !empty($thumbnail_src);
    $imageClass = $hasImage ?: 'bg-slate-300';
?>
    <article class="noticia-card">
        <?php if ($hasImage) : ?>
            <a href="<?php echo esc_url($permalink); ?>" class="noticia-card__image-wrap" tabindex="-1" aria-hidden="true">
                <img
                    src="<?php echo esc_url($thumbnail_src); ?>"
                    alt="<?php echo esc_attr($alt); ?>"
                    class="noticia-card__image"
                    loading="lazy">
            </a>
        <?php else : ?>
            <a href="<?php echo esc_url($permalink); ?>" class="noticia-card__image-wrap <?php echo esc_attr($imageClass); ?>" tabindex="-1" aria-hidden="true"></a>
        <?php endif; ?>

        <div class="noticia-card__body md:min-h-28">
            <time class="noticia-card__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d', $id)); ?>">
                <?php echo esc_html($date); ?>
            </time>
            <h3 class="noticia-card__title">
                <a href="<?php echo esc_url($permalink); ?>">
                    <?php echo esc_html($title); ?>
                </a>
            </h3>
        </div>
    </article>
<?php
    $slides[] = ob_get_clean();
}

// ── Config Swiper ─────────────────────────────────────────────────────────
$swiper_config = [
    'slidesPerView'  => 1.2,
    'spaceBetween'   => 16,
    'grabCursor'     => true,
    'breakpoints'    => [
        640  => ['slidesPerView' => 2,   'spaceBetween' => 20],
        1024 => ['slidesPerView' => 3,   'spaceBetween' => 24],
        1280 => ['slidesPerView' => 4,   'spaceBetween' => 24],
    ],
    // navigation se inyecta en slider.php con IDs únicos
];
?>

<section class="noticias" aria-labelledby="noticias-heading">
    <div class="container mx-auto px-4">

        <h2 id="noticias-heading" class="noticias__titulo">
            <?php echo esc_html($titulo); ?>
        </h2>

        <?php
        get_template_part('template-parts/components/slider/slider', null, [
            'slides'     => $slides,
            'config'     => $swiper_config,
            'class'      => 'noticias__slider',
            'prev_label' => __('Noticia anterior', 'agc-theme'),
            'next_label' => __('Noticia siguiente', 'agc-theme'),
        ]);
        ?>

    </div>
</section>