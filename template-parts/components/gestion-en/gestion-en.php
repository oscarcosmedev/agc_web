<?php

/**
 * Gestión en: card con wysiwyg a la izquierda, imagen de fondo a la derecha.
 */

$data  = agc_get_gestion_en_data();
$extra = trim($args['class'] ?? '');

if (empty($data['title']) && empty($data['contenido'])) {
    return;
}
?>

<section
    class="gestion-en <?php echo esc_attr($extra); ?>"
    <?php if ($data['img_src']) : ?>
    style="background-image: url('<?php echo esc_url($data['img_src']); ?>')"
    <?php endif; ?>>

    <div class="gestion-en__inner w-full max-w-7xl mx-auto px-4 xl:px-0">

        <div class="gestion-en__card">
            <?php if ($data['title']) : ?>
                <h2 class="gestion-en__title">
                    <?php echo esc_html($data['title']); ?>
                </h2>
            <?php endif; ?>

            <?php if ($data['contenido']) : ?>
                <div class="gestion-en__content">
                    <?php echo wp_kses_post($data['contenido']); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

</section>