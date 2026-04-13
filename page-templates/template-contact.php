<?php

/**
 * Template Name: Contact
 * Template Post Type: page
 */

get_header();

get_template_part('template-parts/components/hero/hero');

// Datos de contacto desde opciones globales
$email   = agc_option('contact_email', 'info@actionglobalcargo.com');
$phone   = agc_option('contact_phone', '+54911 37301311');
?>

<section class="contact py-section">
    <div class="w-full max-w-6xl mx-auto px-4 xl:px-0">

        <h2 class="contact__heading">
            <?php esc_html_e('Can we help you?', 'agc-theme'); ?>
        </h2>

        <div class="contact__card">

            <!-- ── Formulario (izquierda) ───────────────────────────── -->
            <div class="contact__form-col">
                <?php echo do_shortcode('[contact-form-7 id="e27f981" title="Contacto"]'); ?>
            </div>

            <!-- ── Info de contacto (derecha) ──────────────────────── -->
            <aside class="contact__info-col">
                <div class="contact__info-bar" aria-hidden="true"></div>

                <ul class="contact__info-list">

                    <li class="contact__info-item">
                        <?php svg_icon('flag-arg', ['class' => 'contact__info-icon', 'aria-hidden' => 'true']); ?>
                        <address class="contact__info-address">
                            Av. Cramer 1675, Belgrano<br>
                            Ciudad Autónoma de Buenos Aires<br>
                            Argentina - C1426APA
                        </address>
                    </li>

                    <li class="contact__info-item">
                        <?php svg_icon('flag-uru', ['class' => 'contact__info-icon', 'aria-hidden' => 'true']); ?>
                        <address class="contact__info-address">
                            Juan D. Jackson 1018, Montevideo<br>
                            Departamento de Montevideo<br>
                            Uruguay - CP 11200
                        </address>
                    </li>

                    <li class="contact__info-item contact__info-item--soon">
                        <span class="contact__info-soon-label">
                            <?php esc_html_e('Coming soon to:', 'agc-theme'); ?>
                        </span>
                        <span class="contact__info-soon-flags">
                            <span>EEUU <span aria-label="Estados Unidos">🇺🇸</span></span>
                            <span>Brasil <span aria-label="Brasil">🇧🇷</span></span>
                        </span>
                    </li>

                    <?php if ($email) : ?>
                        <li class="contact__info-item">
                            <?php svg_icon('icon-mail', ['class' => 'contact__info-icon', 'aria-hidden' => 'true']); ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact__info-link">
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                        <li class="contact__info-item">
                            <?php svg_icon('icon-wsp', ['class' => 'contact__info-icon', 'aria-hidden' => 'true']); ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="contact__info-link">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </aside>

        </div><!-- /.contact__card -->

    </div>
</section>

<?php get_footer();
