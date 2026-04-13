<?php

defined('ABSPATH') || exit;

$data  = agc_get_documents_data();
$items = $data['items'] ?? [];

if (empty($items)) {
    return;
}
?>

<section class="documents">
    <div class="max-w-6xl mx-auto py-20 px-4 xl:px-0">
        <h2 class="documents__title">
            <?php esc_html_e('Descarga de Documentos', 'agc-theme'); ?>
        </h2>

        <ul class="documents__grid">
            <?php foreach ($items as $item) : ?>
                <li class="documents__item">
                    <?php if (! empty($item['file_url'])) : ?>
                        <a
                            class="documents__link"
                            href="<?php echo esc_url($item['file_url']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            download
                        >
                    <?php endif; ?>

                    <?php if (! empty($item['icon_src'])) : ?>
                        <img
                            class="documents__icon"
                            src="<?php echo esc_url($item['icon_src']); ?>"
                            alt="<?php echo esc_attr($item['icon_alt']); ?>"
                            loading="lazy"
                        >
                    <?php endif; ?>

                    <?php if (! empty($item['title'])) : ?>
                        <span class="documents__name">
                            <?php echo esc_html($item['title']); ?>
                        </span>
                    <?php endif; ?>

                    <?php if (! empty($item['file_url'])) : ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
