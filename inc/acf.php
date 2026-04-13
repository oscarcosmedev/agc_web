<?php

/**
 * Helpers para ACF Free.
 *
 * ACF Free no incluye options page; usamos el Settings API nativo de WP
 * para opciones globales del sitio (colores, redes sociales, datos de contacto, etc.).
 */

defined('ABSPATH') || exit;

// ─── Helper: get_field seguro ─────────────────────────────────────────────────
/**
 * Wrapper seguro de get_field(). Devuelve $default si ACF no está activo
 * o el campo no existe/está vacío.
 *
 * @param  string     $key     Nombre del campo ACF.
 * @param  int|string $post_id ID del post o 'option'. Por defecto el post actual.
 * @param  mixed      $default Valor por defecto si el campo está vacío.
 * @return mixed
 */
function agc_field(string $key, $post_id = false, $default = '')
{
    if (! function_exists('get_field')) {
        return $default;
    }
    $value = get_field($key, $post_id);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

// ─── ACF JSON: guardar/cargar campos localmente ───────────────────────────────
/**
 * Guarda los grupos de campos exportados en /acf-json/ del tema.
 * Permite versionar los campos en git.
 */
add_filter('acf/settings/save_json', function () {
    return AGC_THEME_DIR . '/acf-json';
});

add_filter('acf/settings/load_json', function (array $paths): array {
    $paths[] = AGC_THEME_DIR . '/acf-json';
    return $paths;
});

// ─── Opciones globales del sitio (WP Settings API — fallback ACF Free) ────────
/**
 * Registra una página de ajustes en WP Admin para opciones globales.
 * Usá get_option('agc_options') para recuperar los valores.
 */
add_action('admin_menu', function () {
    add_menu_page(
        __('Opciones AGC', 'agc-theme'),      // Page title
        __('Opciones AGC', 'agc-theme'),      // Menu title
        'manage_options',                        // Capability
        'agc-options',                           // Menu slug
        'agc_options_page_render',               // Callback
        'dashicons-admin-settings',              // Icon
        59                                       // Position (antes de WooCommerce)
    );
});

function agc_options_page_render(): void
{
    if (! current_user_can('manage_options')) {
        return;
    }
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('agc_options_group');
            do_settings_sections('agc-options');
            submit_button(__('Guardar cambios', 'agc-theme'));
            ?>
        </form>
    </div>
<?php
}

add_action('admin_init', function () {
    register_setting('agc_options_group', 'agc_options', [
        'sanitize_callback' => 'agc_sanitize_options',
        'default'           => [],
    ]);

    // ── Sección: Redes Sociales ──────────────────────────────────────────────
    add_settings_section(
        'agc_social_section',
        __('Redes Sociales', 'agc-theme'),
        null,
        'agc-options'
    );

    $social_fields = [
        'social_instagram' => __('Instagram URL', 'agc-theme'),
        'social_linkedin'  => __('LinkedIn URL', 'agc-theme'),
        'social_facebook'  => __('Facebook URL', 'agc-theme'),
    ];

    foreach ($social_fields as $field_key => $field_label) {
        add_settings_field(
            $field_key,
            $field_label,
            function () use ($field_key) {
                $options = get_option('agc_options', []);
                $value   = isset($options[$field_key]) ? $options[$field_key] : '';
                printf(
                    '<input type="url" name="agc_options[%s]" value="%s" class="regular-text">',
                    esc_attr($field_key),
                    esc_url($value)
                );
            },
            'agc-options',
            'agc_social_section'
        );
    }

    // ── Sección: Contacto ────────────────────────────────────────────────────
    add_settings_section(
        'agc_contact_section',
        __('Contacto', 'agc-theme'),
        null,
        'agc-options'
    );

    $contact_fields = [
        'contact_email' => __('Email de contacto', 'agc-theme'),
        'contact_phone' => __('Teléfono', 'agc-theme'),
        'contact_address' => __('Dirección', 'agc-theme'),
    ];

    foreach ($contact_fields as $field_key => $field_label) {
        add_settings_field(
            $field_key,
            $field_label,
            function () use ($field_key) {
                $options = get_option('agc_options', []);
                $value   = isset($options[$field_key]) ? $options[$field_key] : '';
                printf(
                    '<input type="text" name="agc_options[%s]" value="%s" class="regular-text">',
                    esc_attr($field_key),
                    esc_attr($value)
                );
            },
            'agc-options',
            'agc_contact_section'
        );
    }
});

/**
 * Sanitiza las opciones globales antes de guardar.
 */
function agc_sanitize_options(array $input): array
{
    $sanitized = [];
    $url_fields  = ['social_instagram', 'social_linkedin', 'social_facebook'];
    $text_fields = ['contact_email', 'contact_phone', 'contact_address'];

    foreach ($url_fields as $key) {
        $sanitized[$key] = ! empty($input[$key]) ? esc_url_raw($input[$key]) : '';
    }
    foreach ($text_fields as $key) {
        $sanitized[$key] = ! empty($input[$key]) ? sanitize_text_field($input[$key]) : '';
    }
    return $sanitized;
}

/**
 * Helper para leer opciones globales del sitio.
 *
 * @param  string $key     Clave de la opción.
 * @param  mixed  $default Valor por defecto.
 * @return mixed
 */
function agc_option(string $key, $default = '')
{
    $options = get_option('agc_options', []);
    return ! empty($options[$key]) ? $options[$key] : $default;
}
