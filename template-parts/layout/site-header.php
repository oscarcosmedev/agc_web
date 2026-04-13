<?php

/**
 * Header global del sitio. Dos variantes:
 *   - Base:        fondo transparente, logo blanco (sobre hero).
 *   - is-scrolled: fondo sólido + sombra, logo con color (JS agrega la clase).
 *
 * Datos: agc_get_header_data() en inc/helpers/header-data.php.
 */

$header = agc_get_header_data();
?>

<header
    class="site-header fixed top-0 left-0 right-0 z-50 py-4"
    data-header aria-label="<?php esc_attr_e('Encabezado del sitio', 'agc-theme'); ?>">

    <div class="site-header__inner w-full max-w-7xl mx-auto px-4 xl:px-0 flex justify-between items-center">
        <!-- Logo -->
        <div class="site-logo">
            <a href="<?php echo $header['site_url']; ?>" class="site-logo__link" rel="home" aria-label="<?php echo $header['site_name']; ?> — Inicio">
                <?php if ($header['has_logo']) : ?>
                    <?php echo $header['logo_white_html']; ?>
                    <?php echo $header['logo_color_html']; ?>
                <?php else : ?>
                    <span class="site-logo__text"><?php echo $header['site_name']; ?></span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Nav principal + idioma -->
        <div class="site-header__nav-wrap flex justify-between items-center gap-4 md:gap-8">

            <?php if ($header['has_primary_menu']) : ?>
                <nav id="site-navigation" class="main-navigation hidden md:block" aria-label="<?php esc_attr_e('Menú principal', 'agc-theme'); ?>">
                    <?php
                    $_active_link = function ($atts, $item) {
                        if (in_array('current-menu-item', $item->classes, true)) {
                            $atts['class'] = trim(($atts['class'] ?? '') . ' is-active');
                        }
                        return $atts;
                    };
                    add_filter('nav_menu_link_attributes', $_active_link, 10, 2);

                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'main-navigation__list flex justify-center items-center gap-4',
                    ]);

                    remove_filter('nav_menu_link_attributes', $_active_link, 10);
                    ?>
                </nav>
            <?php endif; ?>

            <!-- Selector de idioma (dropdown) -->
            <?php if (! empty($header['languages'])) : ?>
                <div class="lang-switcher" data-lang-switcher>
                    <button
                        class="lang-switcher__toggle"
                        aria-expanded="false"
                        aria-haspopup="listbox"
                        aria-controls="lang-switcher-list"
                        data-lang-toggle>
                        <!-- Globe icon -->
                        <svg class="lang-switcher__globe" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="2" y1="12" x2="22" y2="12" />
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                        <span class="lang-switcher__current" aria-hidden="true"><?php echo esc_html($header['current_lang']); ?></span>
                        <span class="sr-only"><?php esc_html_e('Cambiar idioma. Idioma actual:', 'agc-theme'); ?> <?php echo esc_html($header['current_lang']); ?></span>
                    </button>

                    <ul
                        id="lang-switcher-list"
                        class="lang-switcher__dropdown"
                        role="listbox"
                        aria-label="<?php esc_attr_e('Seleccionar idioma', 'agc-theme'); ?>"
                        hidden>
                        <?php foreach ($header['languages'] as $lang) : ?>
                            <li role="option" aria-selected="<?php echo $lang['active'] ? 'true' : 'false'; ?>">
                                <a
                                    href="<?php echo esc_url($lang['url']); ?>"
                                    hreflang="<?php echo esc_attr($lang['code']); ?>"
                                    class="lang-switcher__item<?php echo $lang['active'] ? ' is-active' : ''; ?>">
                                    <?php echo esc_html(strtoupper($lang['code'])); ?>
                                    <span class="lang-switcher__name"><?php echo esc_html($lang['name']); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Botón hamburguesa (mobile) -->
            <button
                class="nav-toggle"
                aria-controls="site-navigation"
                aria-expanded="false"
                aria-label="<?php esc_attr_e('Abrir menú', 'agc-theme'); ?>"
                data-menu-toggle>
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
            </button>

            <div class="nav-mobile" data-nav-mobile aria-hidden="true">

                <!-- Cabecera del panel mobile -->
                <div class="nav-mobile__header">
                    <a href="<?php echo $header['site_url']; ?>" class="nav-mobile__logo" rel="home" aria-label="<?php echo $header['site_name']; ?> — Inicio">
                        <?php if ($header['has_logo']) : ?>
                            <?php echo $header['logo_white_html']; ?>
                        <?php else : ?>
                            <span class="nav-mobile__logo-text"><?php echo $header['site_name']; ?></span>
                        <?php endif; ?>
                    </a>

                    <button
                        class="nav-mobile__close"
                        aria-label="<?php esc_attr_e('Cerrar menú', 'agc-theme'); ?>"
                        data-menu-close>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <?php if ($header['has_mobile_menu']) : ?>
                    <nav id="site-navigation-mobile" class="main-navigation-mobile" aria-label="<?php esc_attr_e('Menú mobile', 'agc-theme'); ?>">
                        <?php
                        $_active_link = function ($atts, $item) {
                            if (in_array('current-menu-item', $item->classes, true)) {
                                $atts['class'] = trim(($atts['class'] ?? '') . ' is-active');
                            }
                            return $atts;
                        };
                        add_filter('nav_menu_link_attributes', $_active_link, 10, 2);

                        wp_nav_menu([
                            'theme_location' => 'mobile',
                            'menu_id'        => 'mobile-menu',
                            'container'      => false,
                            'menu_class'     => 'main-navigation-mobile__list',
                        ]);

                        remove_filter('nav_menu_link_attributes', $_active_link, 10);
                        ?>
                    </nav>
                <?php endif; ?>
            </div>

        </div>

    </div>
</header>