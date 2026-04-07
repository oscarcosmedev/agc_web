<?php

/**
 * Grid de servicios: consulta el CPT 'services' y renderiza las cards.
 * Cada card enlaza al single del servicio.
 */

$extra    = trim($args['class'] ?? '');
$services = agc_get_posts('services');

if (empty($services)) {
    return;
}
?>

<section class="services-grid py-section <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-7xl mx-auto px-4 xl:px-0">
        <ul class="services-grid__list">
            <?php foreach ($services as $service) : ?>
                <?php
                $thumb_id  = get_post_thumbnail_id($service->ID);
                $thumb_src = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
                $thumb_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
                $permalink = get_permalink($service->ID);
                ?>
                <li class="services-grid__item">
                    <a
                        href="<?php echo esc_url($permalink); ?>"
                        class="services-grid__card"
                        aria-label="<?php echo esc_attr($service->post_title); ?>"
                    >
                        <div class="services-grid__image-wrap">
                            <?php if ($thumb_src) : ?>
                                <img
                                    class="services-grid__image"
                                    src="<?php echo esc_url($thumb_src); ?>"
                                    alt="<?php echo esc_attr($thumb_alt ?: $service->post_title); ?>"
                                    loading="lazy"
                                >
                            <?php else : ?>
                                <div class="services-grid__image-placeholder"></div>
                            <?php endif; ?>
                        </div>
                        <div class="services-grid__body">
                            <h3 class="services-grid__title">
                                <?php echo esc_html($service->post_title); ?>
                            </h3>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
