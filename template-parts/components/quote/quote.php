<?php

/**
 * Quote: card centrada con fondo amarillo claro, icono opcional y texto wysiwyg.
 * Usado en: single-aereo, single-multimodal.
 */

$data  = agc_get_quote_data();
$extra = trim($args['class'] ?? '');

if (empty($data['icon_src']) && empty($data['quote'])) {
    return;
}
?>

<section class="quote <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">
        <div class="quote__card">

            <?php if ($data['icon_src']) : ?>
                <div class="quote__icon" aria-hidden="true">
                    <img
                        src="<?php echo esc_url($data['icon_src']); ?>"
                        alt="<?php echo esc_attr($data['icon_alt']); ?>"
                        loading="lazy"
                        width="80"
                        height="80">
                </div>
            <?php endif; ?>

            <?php if ($data['quote']) : ?>
                <div class="quote__text">
                    <?php echo wp_kses_post($data['quote']); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>