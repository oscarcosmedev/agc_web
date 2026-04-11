<?php

/**
 * Template Name: Servicio - Aduaneros
 * Template Post Type: services
 */

get_header();

$title = get_the_title();

get_template_part('template-parts/components/hero/hero');

?>

<section class="services-t-aduaneros">

    <div class="max-w-6xl mx-auto py-20 px-4 xl:px-0">
        <?php get_template_part('template-parts/components/breadcrumb/breadcrumb'); ?>
        <h1 class="text-secondary text-3xl font-bold uppercase">
            <?php echo $title; ?>
        </h1>
    </div>
</section>

<?php

get_template_part('template-parts/components/ventajas-grid/ventajas-grid');

get_template_part('template-parts/components/gestion-en/gestion-en');

get_footer();
