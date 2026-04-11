<?php

/**
 * Ventajas Grid: sección con fondo azul, título y grilla de hasta 8 cards (icon + texto).
 */

$data  = agc_get_ventajas_grid_data();
$extra = trim($args['class'] ?? '');

if (empty($data['cards'])) {
    return;
}
?>

<section class="ventajas-grid py-section bg-accent <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-7xl mx-auto px-4 xl:px-0">

        <?php if ($data['title']) : ?>
            <h2 class="ventajas-grid__title">
                <?php echo esc_html($data['title']); ?>
            </h2>
        <?php endif; ?>

        <ul class="ventajas-grid__list">
            <?php foreach ($data['cards'] as $card) : ?>
                <li class="ventajas-grid__item">
                    <?php if ($card['icon_src']) : ?>
                        <div class="ventajas-grid__icon" aria-hidden="true">
                            <img
                                src="<?php echo esc_url($card['icon_src']); ?>"
                                alt="<?php echo esc_attr($card['icon_alt']); ?>"
                                loading="lazy"
                                width="64"
                                height="64">
                        </div>
                    <?php endif; ?>

                    <?php if ($card['text']) : ?>
                        <p class="ventajas-grid__label">
                            <?php echo esc_html($card['text']); ?>
                        </p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</section>