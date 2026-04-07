<?php

/**
 * Helper de datos para el componente Box Tracking.
 *
 * Co-localizado junto a box-tracking.php porque es específico de este componente.
 * Centraliza labels, placeholders y configuración del formulario de tracking.
 */

defined('ABSPATH') || exit;

/**
 * Devuelve la configuración UI del componente Box Tracking.
 *
 * @return array{
 *   form_id: string,
 *   input_id: string,
 *   result_id: string,
 *   label: string,
 *   placeholder: string,
 *   button_label: string,
 *   error_empty: string,
 * }
 */
function agc_get_tracking_data(): array
{
    return [
        'form_id'      => 'tracking-form',
        'input_id'     => 'tracking-input',
        'result_id'    => 'tracking-result',
        'label'        => __('Rastree su envío', 'agc-theme'),
        'placeholder'  => __('Número de identificación', 'agc-theme'),
        'button_label' => __('Rastrear', 'agc-theme'),
        'error_empty'  => __('Por favor ingrese un número de tracking.', 'agc-theme'),
    ];
}
