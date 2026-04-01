<?php

/**
 * Banner de dos columnas: panel de color + imagen superpuesta.
 * Título, botón e imagen provienen de ACF (ver banner-media-data.php).
 */

$data  = agc_get_banner_media_data();
$extra = trim($args['class'] ?? '');

if (empty($data['titulo']) && empty($data['img_src'])) {
    return;
}

$link   = $data['link'];
$target = ($link['target'] ?? '') ?: '_self';
$label  = ($link['title']  ?? '') ?: __('Ir al enlace', 'agc-theme');

$sizes = $data['img_sizes'];
$srcset = '';
if (! empty($sizes['large'])) {
    $srcset = esc_url($sizes['medium_large'] ?? $sizes['large']) . ' 768w, '
        . esc_url($sizes['large']) . ' 1024w';
}
?>

<section class="banner-media py-section <?php echo esc_attr($extra); ?>">
    <div class="banner-media__inner flex items-center">

        <div class="banner-media__panel flex justify-evenly">
            <div class="w-full max-w-2xs flex flex-col items-start gap-4">
                <?php if ($data['titulo']) : ?>
                    <h2 class="banner-media__titulo">
                        <?php echo esc_html($data['titulo']); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($data['has_link']) : ?>
                    <a
                        href="<?php echo esc_url($link['url']); ?>"
                        class="banner-media__btn"
                        target="<?php echo esc_attr($target); ?>"
                        <?php echo $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($data['img_src']) : ?>
            <div class="banner-media__image-wrap max-w-[650px]">
                <img
                    class="banner-media__image"
                    src="<?php echo esc_url($data['img_src']); ?>"
                    <?php if ($srcset) : ?>
                    srcset="<?php echo $srcset; ?>"
                    sizes="(max-width: 768px) 100vw, 60vw"
                    <?php endif; ?>
                    alt="<?php echo esc_attr($data['img_alt']); ?>"
                    loading="lazy">
            </div>
        <?php endif; ?>

    </div>
</section>