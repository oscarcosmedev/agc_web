<?php

/**
 * Obtiene los datos del Messaging Widget desde ACF
 *
 * Lee el grupo 'messaging_widget' de la página Settings (slug: 'settings').
 *
 * @return array { whatsapp: string, wechat: string }
 */
function agc_get_messaging_widget_data(): array
{
    $empty = ['whatsapp' => '', 'wechat' => ''];

    if (! function_exists('get_field')) {
        return $empty;
    }

    $settings_page = get_page_by_path('settings');

    if (! $settings_page) {
        return $empty;
    }

    $data = get_field('messaging_widget', $settings_page->ID);

    if (! is_array($data)) {
        return $empty;
    }

    return [
        'whatsapp' => (string) ($data['whatsapp'] ?? ''),
        'wechat'   => (string) ($data['wechat']   ?? ''),
    ];
}
