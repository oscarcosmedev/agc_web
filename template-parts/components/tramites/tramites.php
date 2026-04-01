<?php

/**
 * Sección "Links para realizar trámites".
 * Fondo ilustrado + columna de título fija + slider de cards (CPT tramites).
 * Reutiliza el componente genérico slider.
 */

$data   = agc_get_tramites_data();
$extra  = trim($args['class'] ?? '');
$items  = $data['items'];

if (empty($items)) {
    return;
}

// ── Slides: una card por trámite ──────────────────────────────────────────
$slides = [];

foreach ($items as $item) {
    ob_start();

    $link   = $item['link'];
    $target = ($link['target'] ?? '') ?: '_self';
    $label  = ($link['title']  ?? '') ?: __('Click aquí', 'agc-theme');
?>
    <article class="tramite-card">
        <div class="tramite-card__icon" aria-hidden="true">
            <?php svg_icon('icon-clipboard'); ?>
        </div>

        <h3 class="tramite-card__titulo">
            <?php echo esc_html($item['titulo']); ?>
        </h3>

        <?php if ($item['description']) : ?>
            <div class="tramite-card__description">
                <?php echo wp_kses_post($item['description']); ?>
            </div>
        <?php endif; ?>

        <?php if ($item['has_link']) : ?>
            <a
                href="<?php echo esc_url($link['url']); ?>"
                class="tramite-card__btn"
                target="<?php echo esc_attr($target); ?>"
                <?php echo $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                <?php echo esc_html($label); ?>
            </a>
        <?php endif; ?>
    </article>
<?php
    $slides[] = ob_get_clean();
}

// ── Swiper config ─────────────────────────────────────────────────────────
$swiper_config = [
    'slidesPerView'  => 1.2,
    'spaceBetween'   => 20,
    'centeredSlides' => false,
    'grabCursor'     => true,
    'breakpoints'    => [
        640  => ['slidesPerView' => 2,   'spaceBetween' => 20],
        1024 => ['slidesPerView' => 2.4, 'spaceBetween' => 24],
        1280 => ['slidesPerView' => 2.6, 'spaceBetween' => 24],
    ],
];
?>

<section class="tramites py-section <?php echo esc_attr($extra); ?>">

    <div class="tramites__inner">

        <!-- Columna izquierda: título fijo -->
        <div class="tramites__header">
            <h2 class="tramites__titulo text-3xl font-bold text-secondary uppercase">
                <?php echo esc_html($data['titulo']); ?>
            </h2>
            <?php if ($data['subtitulo']) : ?>
                <p class="tramites__subtitulo text-lg text-text-muted">
                    <?php echo esc_html($data['subtitulo']); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Columna derecha: slider -->
        <div class="tramites__slider-col">
            <?php
            get_template_part('template-parts/components/slider/slider', null, [
                'slides'     => $slides,
                'config'     => $swiper_config,
                'class'      => 'tramites__slider',
                'prev_label' => __('Trámite anterior', 'agc-theme'),
                'next_label' => __('Trámite siguiente', 'agc-theme'),
            ]);
            ?>
        </div>

    </div>

</section>