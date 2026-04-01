<?php

/**
 * front-page.php
 * Template para la página de inicio del sitio (landing).
 * WordPress lo usa cuando está configurado: Ajustes → Lectura → Página de inicio estática.
 */

defined('ABSPATH') || exit;

get_header();

get_template_part(
    'template-parts/components/hero/hero',
    null,
    ['class' => 'hero--home']
);

get_template_part('template-parts/components/box-tracking/box-tracking');

get_template_part('template-parts/components/box-two-column/box-two-column');

get_template_part('template-parts/components/noticias/noticias');

get_template_part('template-parts/components/banner-media/banner-media', null, ['class' => 'banner-media--home']);

get_template_part('template-parts/components/tramites/tramites');

get_footer();
