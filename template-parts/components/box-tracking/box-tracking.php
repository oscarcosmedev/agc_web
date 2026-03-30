<?php

/**
 * Componente Box Tracking — formulario para rastrear envíos.
 *
 * Datos: agc_get_tracking_data() cargada desde functions.php
 * (template-parts/components/box-tracking/box-tracking-data.php).
 * Accesibilidad: label visible, aria-live region para el resultado.
 * JS hook: data-tracking-form, data-tracking-input, data-tracking-result.
 */

$tracking = agc_get_tracking_data();

// Clase custom opcional — pasada desde get_template_part() como tercer argumento:
// get_template_part('template-parts/components/box-tracking/box-tracking', null, ['class' => 'mi-clase'])
$extra_class = trim($args['class'] ?? '');

$section_class = 'box-tracking' . ($extra_class ? ' ' . $extra_class : '');
?>

<section class="<?php echo esc_attr($section_class); ?>" aria-label="<?php esc_attr_e('Rastreo de envíos', 'agc-theme'); ?>">
    <div class="box-tracking__card">

        <form
            id="<?php echo esc_attr($tracking['form_id']); ?>"
            class="box-tracking__form"
            data-tracking-form
            novalidate>

            <label for="<?php echo esc_attr($tracking['input_id']); ?>" class="box-tracking__label">
                <?php echo esc_html($tracking['label']); ?>
            </label>

            <div class="box-tracking__field-wrap">
                <!-- Location pin icon -->
                <svg class="box-tracking__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>

                <input
                    type="text"
                    id="<?php echo esc_attr($tracking['input_id']); ?>"
                    name="tracking_number"
                    class="box-tracking__input"
                    placeholder="<?php echo esc_attr($tracking['placeholder']); ?>"
                    autocomplete="off"
                    aria-describedby="<?php echo esc_attr($tracking['result_id']); ?>"
                    data-tracking-input />

                <button type="submit" class="btn btn--primary box-tracking__btn">
                    <?php echo esc_html($tracking['button_label']); ?>
                </button>
            </div><!-- /.box-tracking__field-wrap -->

        </form>

        <!-- Región aria-live: el JS escribe aquí el resultado o errores -->
        <div
            id="<?php echo esc_attr($tracking['result_id']); ?>"
            class="box-tracking__result"
            role="status"
            aria-live="polite"
            data-tracking-result></div>

    </div><!-- /.box-tracking__card -->
</section><!-- /.box-tracking -->