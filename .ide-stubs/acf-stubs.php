<?php
/**
 * ACF Stubs (Declaraciones Falsas para el IDE).
 * 
 * NOTA: Este archivo es solo para ayudar a tu IDE (Intelephense, VS Code, PHPStorm)
 * a reconocer las funciones de ACF (Advanced Custom Fields) y dejen de marcarse 
 * como un error ("Undefined function").
 * 
 * NUNCA debes incluir o cargar (require/include) este archivo en tu functions.php.
 * El IDE lo lee automáticamente solo por estar en la carpeta de tu proyecto.
 */

if ( ! function_exists( 'get_field' ) ) {
    /**
     * Retorna el valor de un campo específico.
     *
     * @param string $selector   El nombre o la clave del campo.
     * @param mixed  $post_id    El post ID donde se guardó el valor.
     * @param bool   $format_value Indica si se debe formatear el valor o no.
     * @return mixed
     */
    function get_field( $selector, $post_id = false, $format_value = true ) {
        return null;
    }
}

if ( ! function_exists( 'the_field' ) ) {
    /**
     * Muestra el valor de un campo específico.
     *
     * @param string $selector
     * @param mixed  $post_id
     * @param bool   $format_value
     */
    function the_field( $selector, $post_id = false, $format_value = true ) {}
}

if ( ! function_exists( 'have_rows' ) ) {
    /**
     * Comprueba si existe un campo de repetidor o similar con datos.
     *
     * @param string $selector
     * @param mixed  $post_id
     * @return bool
     */
    function have_rows( $selector, $post_id = false ) {
        return false;
    }
}

if ( ! function_exists( 'the_row' ) ) {
    /**
     * Prepara los datos de la fila actual de un loop en un repetidor.
     *
     * @return void
     */
    function the_row() {}
}

if ( ! function_exists( 'get_sub_field' ) ) {
    /**
     * Retorna el valor de un sub-campo.
     *
     * @param string $selector
     * @param bool   $format_value
     * @return mixed
     */
    function get_sub_field( $selector, $format_value = true ) {
        return null;
    }
}

if ( ! function_exists( 'get_row_layout' ) ) {
    /**
     * Retorna el nombre del layout actual en un contenido flexible.
     *
     * @return string
     */
    function get_row_layout() {
        return '';
    }
}
