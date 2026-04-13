<?php

/**
 * Our Services Cards: grilla de 2 cards con icono y descripción wysiwyg.
 * Usado en: single-terrestre, single-multimodal, single-internacional.
 */

$data  = agc_get_our_services_cards_data();
$extra = trim($args['class'] ?? '');

if (empty($data['cards'])) {
    return;
}
?>

<section class="our-services-cards py-section <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">

        <?php if ($data['title']) : ?>
            <h2 class="our-services-cards__title">
                <?php echo esc_html($data['title']); ?>
            </h2>
        <?php endif; ?>

        <ul class="our-services-cards__grid">
            <?php foreach ($data['cards'] as $card) : ?>
                <li class="our-services-cards__card">
                    <?php if ($card['icon_src']) : ?>
                        <div class="our-services-cards__icon" aria-hidden="true">
                            <img
                                src="<?php echo esc_url($card['icon_src']); ?>"
                                alt="<?php echo esc_attr($card['icon_alt']); ?>"
                                loading="lazy"
                                width="100"
                                height="100">
                        </div>
                    <?php endif; ?>

                    <?php if ($card['description']) : ?>
                        <div class="our-services-cards__description">
                            <?php echo wp_kses_post($card['description']); ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>