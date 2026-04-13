<?php

/**
 * Servicios Ventajas: título + grilla de cards con imagen y descripción wysiwyg.
 * Usado en: single-internacional.
 */

$data  = agc_get_servicios_ventajas_data();
$extra = trim($args['class'] ?? '');

if (empty($data['cards'])) {
    return;
}
?>

<section class="servicios-ventajas <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">

        <?php if ($data['title']) : ?>
            <h2 class="servicios-ventajas__title">
                <?php echo esc_html($data['title']); ?>
            </h2>
        <?php endif; ?>

        <ul class="servicios-ventajas__grid">
            <?php foreach ($data['cards'] as $card) : ?>
                <li class="servicios-ventajas__card">

                    <?php if ($card['img_src']) : ?>
                        <div class="servicios-ventajas__image">
                            <img
                                src="<?php echo esc_url($card['img_src']); ?>"
                                alt="<?php echo esc_attr($card['img_alt']); ?>"
                                loading="lazy">
                        </div>
                    <?php endif; ?>

                    <?php if ($card['description']) : ?>
                        <div class="servicios-ventajas__description">
                            <?php echo wp_kses_post($card['description']); ?>
                        </div>
                    <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</section>