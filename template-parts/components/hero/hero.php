<?php

/**
 * Prioridad de fondo: video > imagen > color sólido (--color-primary).
 */

$hero        = agc_get_hero_data();
$extra_class = trim($args['class'] ?? '');
$media_type  = $hero['media_type'];
$is_direct   = $media_type === 'video' && agc_hero_is_direct_video($hero['video_embed_url']);
?>

<section
    class="hero <?php echo esc_attr($extra_class); ?>"
    <?php if ($media_type === 'image') : ?>
    style="background-image: url(<?php echo esc_url($hero['bg_url']); ?>)"
    <?php endif; ?>
    aria-label="<?php esc_attr_e('Sección principal', 'agc-theme'); ?>">

    <?php if ($media_type === 'video') : ?>
        <div class="hero__video" aria-hidden="true">
            <?php if ($is_direct) : ?>
                <video
                    class="hero__video-el"
                    src="<?php echo esc_url($hero['video_embed_url']); ?>"
                    autoplay muted loop playsinline></video>
            <?php else : ?>
                <iframe
                    class="hero__video-el"
                    src="<?php echo esc_url($hero['video_embed_url']); ?>"
                    allow="autoplay; fullscreen"
                    allowfullscreen
                    loading="lazy"
                    title="<?php esc_attr_e('Video de fondo', 'agc-theme'); ?>"></iframe>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($media_type !== 'none') : ?>
        <div class="hero__overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="container hero__content flex flex-col flex-start gap-2 max-w-5xl mx-auto px-4 md:px-0 py-16 text-white">

        <?php if ($hero['title']) : ?>
            <h1 class="hero__title text-5xl md:text-7xl font-bold leading-tight">
                <?php echo esc_html($hero['title']); ?>
            </h1>
        <?php endif; ?>

        <?php if ($hero['description']) : ?>
            <div class="hero__description text-lg md:text-2xl leading-relaxed">
                <?php echo wp_kses_post($hero['description']); ?>
            </div>
        <?php endif; ?>

        <?php if ($hero['has_link']) :
            $link   = $hero['link'];
            $target = $link['target'] ?: '_self';
            $label  = $link['title']  ?: __('Ver más', 'agc-theme');
        ?>
            <a
                href="<?php echo esc_url($link['url']); ?>"
                class="btn btn--primary hero__cta"
                target="<?php echo esc_attr($target); ?>"
                <?php echo $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                <?php echo esc_html($label); ?>
            </a>
        <?php endif; ?>

    </div>

</section>