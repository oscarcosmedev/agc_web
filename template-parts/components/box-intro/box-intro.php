<?php

/**
 * Box de dos columnas: imagen izquierda + card de texto superpuesta.
 * Título, descripción e imagen provienen de ACF (ver box-intro-data.php).
 */

$data  = agc_get_box_intro_data();
$extra = trim($args['class'] ?? '');

if (empty($data['title']) && empty($data['img_src'])) {
    return;
}

$sizes  = $data['img_sizes'];
$srcset = '';
if (! empty($sizes['large'])) {
    $srcset = esc_url($sizes['medium_large'] ?? $sizes['large']) . ' 768w, '
        . esc_url($sizes['large']) . ' 1024w';
}
?>

<section class="box-intro py-section <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-7xl mx-auto px-4 xl:px-0">
        <div class="flex flex-col lg:flex-row justify-center items-center">

            <div class="box-intro__image w-full max-w-xl min-h-[350px] h-[350px] rounded-xl bg-gray-200 overflow-hidden shrink-0">
                <?php if ($data['img_src']) : ?>
                    <img
                        class="w-full h-full object-cover"
                        src="<?php echo esc_url($data['img_src']); ?>"
                        <?php if ($srcset) : ?>
                        srcset="<?php echo $srcset; ?>"
                        sizes="(max-width: 768px) 100vw, 50vw"
                        <?php endif; ?>
                        alt="<?php echo esc_attr($data['img_alt']); ?>"
                        loading="lazy">
                <?php endif; ?>
            </div>

            <div class="box-intro__card w-full max-w-xl bg-white lg:-ml-20 px-10 py-8 rounded-xl shadow-lg">
                <?php if ($data['title']) : ?>
                    <h2 class="box-intro__title text-secondary text-xl font-bold uppercase mb-4">
                        <?php echo esc_html($data['title']); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($data['description']) : ?>
                    <div class="box-intro__description text-sm leading-relaxed text-gray-700">
                        <?php echo wp_kses_post($data['description']); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>