<?php

/**
 *
 * Slider genérico basado en Swiper. No sabe nada del dominio.
 *
 * $args esperados:
 *   slides      (array)   Arreglo de strings HTML — cada item es un <div class="swiper-slide">…</div>
 *   config      (array)   Opciones de Swiper (se serializan a JSON)
 *   class       (string)  Clase extra para el wrapper externo
 *   prev_label  (string)  Texto accesible del botón anterior (opcional)
 *   next_label  (string)  Texto accesible del botón siguiente (opcional)
 */

$slides     = $args['slides']     ?? [];
$config     = $args['config']     ?? [];
$extra      = trim($args['class'] ?? '');
$prev_label = $args['prev_label'] ?? __('Anterior', 'agc-theme');
$next_label = $args['next_label'] ?? __('Siguiente', 'agc-theme');

if (empty($slides)) {
    return;
}

// IDs únicos para que varios sliders en la misma página no compartan controles.
$uid      = 'swiper-' . wp_unique_id();
$prev_id  = $uid . '-prev';
$next_id  = $uid . '-next';

// Inyectar los IDs de navegación en la config.
$config['navigation'] = array_merge($config['navigation'] ?? [], [
    'prevEl' => '#' . $prev_id,
    'nextEl' => '#' . $next_id,
]);

$config_json = wp_json_encode($config, JSON_HEX_TAG | JSON_HEX_APOS);
?>

<div class="slider-wrapper <?php echo esc_attr($extra); ?>">

    <div
        id="<?php echo esc_attr($uid); ?>"
        class="swiper slider"
        data-swiper
        data-swiper-config="<?php echo esc_attr($config_json); ?>">

        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) : ?>
                <div class="swiper-slide">
                    <?php echo $slide; // HTML pre-renderizado por el componente padre 
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Navegación -->
    <button
        id="<?php echo esc_attr($prev_id); ?>"
        class="slider__nav slider__nav--prev"
        aria-label="<?php echo esc_attr($prev_label); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <polyline points="15 18 9 12 15 6" />
        </svg>
    </button>

    <button
        id="<?php echo esc_attr($next_id); ?>"
        class="slider__nav slider__nav--next"
        aria-label="<?php echo esc_attr($next_label); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <polyline points="9 18 15 12 9 6" />
        </svg>
    </button>

</div>