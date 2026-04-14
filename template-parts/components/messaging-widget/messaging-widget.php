<?php

/**
 * Component: Messaging Widget
 * 
 * Fixed messaging widget that displays in the bottom-right corner of the viewport.
 * Expands upward to reveal WhatsApp and WeChat contact buttons.
 */

// Get messaging data from Settings page
$messaging_data = agc_get_messaging_widget_data();
$whatsapp = $messaging_data['whatsapp'] ?? '';
$wechat   = $messaging_data['wechat'] ?? '';

// Si no hay opciones de chat disponibles, no mostrar nada
if ($whatsapp === '' && $wechat === '') {
    return;
}

// Construir URL de WhatsApp
$whatsapp_url = '';
if ($whatsapp !== '') {
    // Limpiar el número (remover espacios, guiones, etc.)
    $clean_number = preg_replace('/[^0-9]/', '', $whatsapp);
    $whatsapp_url = 'https://wa.me/' . $clean_number;
}
?>

<div class="messaging-widget" data-messaging-widget>
    <div class="messaging-widget__container">

        <?php if ($whatsapp_url !== ''): ?>
            <!-- WhatsApp Button -->
            <a
                href="<?php echo esc_url($whatsapp_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="messaging-widget__button messaging-widget__button--whatsapp"
                aria-label="<?php esc_attr_e('Contact us on WhatsApp', 'agc-theme'); ?>"
                data-messaging-option>
                <span class="messaging-widget__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                    </svg>
                </span>
            </a>
        <?php endif; ?>

        <?php if ($wechat !== ''): ?>
            <!-- WeChat Button -->
            <a
                href="<?php echo esc_url($wechat); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="messaging-widget__button messaging-widget__button--wechat"
                aria-label="<?php esc_attr_e('Contact us on WeChat', 'agc-theme'); ?>"
                data-messaging-option>
                <span class="messaging-widget__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                    </svg>
                </span>
            </a>
        <?php endif; ?>

        <!-- Main Toggle Button -->
        <button
            type="button"
            class="messaging-widget__button messaging-widget__button--main"
            aria-label="<?php esc_attr_e('Toggle messaging options', 'agc-theme'); ?>"
            aria-expanded="false"
            data-messaging-toggle>
            <span class="messaging-widget__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="none" viewBox="0 0 29 29">
                    <path fill="currentColor" stroke="currentColor" d="M14.5.5C6.78.5.5 6.78.5 14.5s6.28 14 14 14h14v-14c0-7.72-6.28-14-14-14Zm12.833 26.833H14.5c-7.076 0-12.833-5.757-12.833-12.833S7.424 1.667 14.5 1.667 27.333 7.424 27.333 14.5zM15.667 14.5a1.167 1.167 0 1 1-2.335 0 1.167 1.167 0 0 1 2.335 0Zm5.833 0a1.167 1.167 0 1 1-2.334 0 1.167 1.167 0 0 1 2.334 0Zm-11.667 0a1.167 1.167 0 1 1-2.334 0 1.167 1.167 0 0 1 2.334 0Z" />
                </svg>
            </span>
        </button>

    </div>
</div>