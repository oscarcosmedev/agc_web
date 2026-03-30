<?php

/**
 * SVG Helper Functions
 * 
 * Funciones para sanitizar y renderizar iconos SVG inline
 */

if (!function_exists('sanitize_svg')) {
    /**
     * Sanitizador reutilizable para SVGs
     *
     * @param string $svg Contenido SVG a sanitizar
     * @return string SVG sanitizado
     */
    function sanitize_svg(string $svg): string
    {
        // Quitar cabeceras inseguras
        $svg = preg_replace('/<\?xml.*?\?>/is', '', $svg);
        $svg = preg_replace('/<!DOCTYPE.*?>/is', '', $svg);

        // Lista controlada de etiquetas y atributos permitidos
        $allowed_tags = [
            'svg' => [
                'xmlns' => true,
                'width' => true,
                'height' => true,
                'viewBox' => true,
                'viewbox' => true,
                'role' => true,
                'aria-hidden' => true,
                'focusable' => true,
                'preserveAspectRatio' => true,
                'class' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'stroke-linejoin' => true,
            ],
            'g' => ['fill' => true, 'stroke' => true, 'transform' => true, 'opacity' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'fill-rule' => true, 'clip-rule' => true],
            'path' => ['d' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'transform' => true, 'opacity' => true, 'class' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'fill-rule' => true, 'clip-rule' => true],
            'rect' => ['x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
            'circle' => ['cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
            'ellipse' => ['cx' => true, 'cy' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
            'line' => ['x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true],
            'polyline' => ['points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true],
            'polygon' => ['points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
            'title' => [],
            'defs' => [],
            'use' => ['href' => true, 'xlink:href' => true],
            'style' => [],
        ];

        // Limpiar con wp_kses
        $clean = wp_kses($svg, $allowed_tags);

        // Forzar atributos de accesibilidad si no existen
        if ($clean && false === strpos($clean, 'aria-hidden')) {
            // Si el SVG se va a insertar inline y no tiene aria-hidden, añadir role="img"
            if (strpos($clean, '<svg') !== false && strpos($clean, 'role=') === false) {
                $clean = preg_replace('/<svg(\s|>)/', '<svg role="img" aria-hidden="true"$1', $clean, 1);
            }
        }

        return $clean;
    }
}

/**
 * Obtiene el contenido de un SVG desde assets/src/icons
 *
 * @param string $iconName Nombre del archivo sin extensión (ej: 'icon-arrow-right')
 * @param array $attrs Atributos adicionales (ej: ['class' => 'w-4 h-4'])
 * @return string HTML del SVG o string vacío si no existe
 */
function get_svg_icon($iconName, $attrs = array())
{
    $iconPath = get_template_directory() . '/assets/src/icons/' . $iconName . '.svg';

    if (!file_exists($iconPath)) {
        error_log('SVG icon not found: ' . $iconPath);
        return '';
    }

    $svg = file_get_contents($iconPath);

    if ($svg === false) {
        error_log('Failed to read SVG icon: ' . $iconPath);
        return '';
    }

    // Sanitizar el SVG
    if (function_exists('sanitize_svg')) {
        $svg = sanitize_svg($svg);
    }

    // Agregar atributos al SVG
    if (!empty($attrs)) {
        $attrString = '';
        foreach ($attrs as $key => $value) {
            // Manejar atributos booleanos como aria-hidden
            if (is_bool($value)) {
                $attrString .= sprintf(' %s="%s"', esc_attr($key), $value ? 'true' : 'false');
            } else {
                $attrString .= sprintf(' %s="%s"', esc_attr($key), esc_attr($value));
            }
        }
        // Insertar atributos después de la etiqueta <svg
        $svg = preg_replace('/<svg/', '<svg' . $attrString, $svg, 1);
    }

    return $svg;
}

/**
 * Imprime un icono SVG
 *
 * @param string $iconName Nombre del archivo sin extensión
 * @param array $attrs Atributos adicionales
 */
function svg_icon($iconName, $attrs = array())
{
    $svg = get_svg_icon($iconName, $attrs);

    if ($svg !== '') {
        // El SVG ya está sanitizado en get_svg_icon
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $svg;
    }
}
