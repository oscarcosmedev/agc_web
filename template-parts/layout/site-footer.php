<?php

/**
 * Footer global del sitio.
 * Datos: agc_get_footer_data() en inc/helpers/footer-data.php.
 */

$footer = agc_get_footer_data();
?>

<footer id="colophon" class="site-footer" aria-label="<?php esc_attr_e('Pie de página', 'agc-theme'); ?>">

    <div class="site-footer__inner max-w-7xl mx-auto px-6 xl:px-0 pt-14 pb-10">

        <!-- Logo -->
        <div class="footer-logo mb-12">
            <a href="<?php echo $footer['site_url']; ?>" class="footer-logo__link" rel="home" aria-label="<?php echo $footer['site_name']; ?> — Inicio">
                <?php if ($footer['logo_html']) : ?>
                    <?php echo $footer['logo_html']; ?>
                <?php else : ?>
                    <span class="footer-logo__text"><?php echo $footer['site_name']; ?></span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Grid principal: direcciones | nav | contacto -->
        <div class="footer-grid">

            <!-- ── Columna 1: Direcciones ── -->
            <div class="footer-addresses">

                <!-- Argentina -->
                <div class="footer-address">
                    <span class="footer-address__flag" aria-label="Argentina">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2" width="30" height="20" role="img" aria-hidden="true" focusable="false">
                            <rect width="3" height="2" fill="#fff" />
                            <rect width="3" height=".667" fill="#74ACDF" />
                            <rect width="3" height=".667" y="1.333" fill="#74ACDF" />
                        </svg>
                    </span>
                    <address class="footer-address__text">
                        Av. Cramer 1675, Belgrano<br>
                        Ciudad Autónoma de Buenos Aires<br>
                        Argentina - C1426APA
                    </address>
                </div>

                <!-- Uruguay -->
                <div class="footer-address">
                    <span class="footer-address__flag" aria-label="Uruguay">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2" width="30" height="20" role="img" aria-hidden="true" focusable="false">
                            <rect width="3" height="2" fill="#fff" />
                            <rect width="3" height=".222" y=".222" fill="#002B7F" />
                            <rect width="3" height=".222" y=".667" fill="#002B7F" />
                            <rect width="3" height=".222" y="1.111" fill="#002B7F" />
                            <rect width="3" height=".222" y="1.556" fill="#002B7F" />
                        </svg>
                    </span>
                    <address class="footer-address__text">
                        Juan D. Jackson 1018,<br>
                        Montevideo &nbsp;Departamento<br>
                        de Montevideo &nbsp;Uruguay - CP 11200
                    </address>
                </div>

            </div><!-- /.footer-addresses -->

            <!-- ── Columna 2: Navegación ── -->
            <nav class="footer-nav" aria-label="<?php esc_attr_e('Menú footer', 'agc-theme'); ?>">
                <?php if ($footer['has_footer_menu']) :
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'footer-nav__list',
                        'depth'          => 1,
                    ]);
                endif; ?>
            </nav>

            <!-- ── Columna 3: Contacto ── -->
            <div class="footer-contact">

                <!-- Botón Contacto -->
                <a href="<?php echo $footer['contact_url']; ?>" class="footer-contact__btn">
                    <?php esc_html_e('Contacto', 'agc-theme'); ?>
                </a>


                <!-- Redes sociales -->
                <div class="footer-social">
                    <?php get_template_part('template-parts/components/box-social/box-social', null, ['class' => 'footer-social__box']); ?>
                </div>

                <!-- Email y teléfono -->
                <div class="footer-contact__info">

                    <a href="mailto:<?php echo antispambot($footer['email']); ?>" class="footer-contact__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <span><?php echo antispambot($footer['email']); ?></span>
                    </a>

                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $footer['phone'])); ?>" class="footer-contact__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        <span><?php echo $footer['phone']; ?></span>
                    </a>

                </div><!-- /.footer-contact__info -->

            </div><!-- /.footer-contact -->

        </div><!-- /.footer-grid -->

    </div><!-- /.site-footer__inner -->

    <!-- Barra inferior -->
    <div class="footer-bottom">
        <div class="max-w-7xl mx-auto px-6 xl:px-0">
            <div class="footer-bottom__inner">
                <p class="footer-bottom__copy">
                    &copy; <?php echo esc_html($footer['year']); ?> <?php echo $footer['site_name']; ?> | <?php esc_html_e('Todos los derechos reservados.', 'agc-theme'); ?>
                </p>
                <p class="footer-bottom__credit">
                    <?php esc_html_e('Diseña y Desarrolla', 'agc-theme'); ?> <strong>LANZARA</strong>
                </p>
            </div>
        </div>
    </div>

</footer>