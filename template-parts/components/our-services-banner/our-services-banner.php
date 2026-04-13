<?php

/**
 * Our Services Banner: imagen ilustrativa de ancho completo.
 * Usado en: single-multimodal.
 */

$data  = agc_get_our_services_banner_data();
$extra = trim($args['class'] ?? '');

if (empty($data['src'])) {
    return;
}
?>

<section class="our-services-banner <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">

        <?php if ($data['title']) : ?>
            <h2 class="our-services-banner__title">
                <?php echo esc_html($data['title']); ?>
            </h2>
        <?php endif; ?>

        <img
            class="our-services-banner__img"
            src="<?php echo esc_url($data['src']); ?>"
            alt="<?php echo esc_attr($data['alt']); ?>"
            <?php if ($data['width'] && $data['height']) : ?>
            width="<?php echo (int) $data['width']; ?>"
            height="<?php echo (int) $data['height']; ?>"
            <?php endif; ?>
            loading="lazy">
    </div>
</section>