<?php

/**
 * Our Services Primary: título + filas de servicios (icono + nombre).
 * Usado en: single-maritimo, single-terrestre, single-aereo.
 */

$data  = agc_get_our_services_data();
$extra = trim($args['class'] ?? '');

if (empty($data['rows'])) {
    return;
}
?>

<section class="our-services <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">

        <?php if ($data['title']) : ?>
            <h2 class="our-services__title">
                <?php echo esc_html($data['title']); ?>
            </h2>
        <?php endif; ?>

        <?php foreach ($data['rows'] as $row) : ?>
            <div class="our-services__row">

                <?php if ($row['title']) : ?>
                    <h3 class="our-services__row-title">
                        <?php echo esc_html($row['title']); ?>
                    </h3>
                <?php endif; ?>

                <ul class="our-services__list">
                    <?php foreach ($row['services'] as $service) : ?>
                        <li class="our-services__item">
                            <?php if ($service['icon_src']) : ?>
                                <div class="our-services__icon" aria-hidden="true">
                                    <img
                                        src="<?php echo esc_url($service['icon_src']); ?>"
                                        alt="<?php echo esc_attr($service['icon_alt']); ?>"
                                        loading="lazy"
                                        width="80"
                                        height="80">
                                </div>
                            <?php endif; ?>

                            <?php if ($service['name']) : ?>
                                <p class="our-services__name">
                                    <?php echo esc_html($service['name']); ?>
                                </p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        <?php endforeach; ?>

    </div>
</section>