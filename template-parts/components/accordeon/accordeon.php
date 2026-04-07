<?php

/**
 * Componente accordion: lista de tabs colapsables con título y descripción.
 * Datos desde ACF (ver accordeon-data.php). JS en modules/accordeon.js.
 */

$data  = agc_get_accordeon_data();
$extra = trim($args['class'] ?? '');

if (empty($data['tabs'])) {
    return;
}
?>

<section class="accordeon py-section border-t border-gray-300 <?php echo esc_attr($extra); ?>">
    <div class="w-full max-w-3xl mx-auto px-4 xl:px-0">
        <dl class="accordeon__list" data-accordeon>
            <?php foreach ($data['tabs'] as $index => $tab) : ?>
                <div
                    class="accordeon__item border-b border-gray-300"
                    data-accordeon-item>
                    <dt>
                        <button
                            class="accordeon__trigger flex w-full items-center justify-between py-4 text-left"
                            aria-expanded="false"
                            aria-controls="accordeon-panel-<?php echo $index; ?>"
                            data-accordeon-trigger>
                            <span class="accordeon__title text-secondary font-bold">
                                <?php echo esc_html($tab['title']); ?>
                            </span>
                            <span class="accordeon__icon shrink-0 ml-4" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" />
                                    <line class="accordeon__icon-h" x1="7" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <line class="accordeon__icon-v" x1="12" y1="7" x2="12" y2="17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd
                        class="accordeon__panel overflow-hidden"
                        id="accordeon-panel-<?php echo $index; ?>"
                        data-accordeon-panel>
                        <div class="accordeon__panel-inner pb-4 leading-relaxed text-gray-700">
                            <?php echo wp_kses_post($tab['description']); ?>
                        </div>
                    </dd>
                </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>