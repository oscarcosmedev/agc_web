<?php

/**
 * Template Name: Servicio - Multimodal
 * Template Post Type: services
 */

get_header();

$title = get_the_title();

get_template_part('template-parts/components/hero/hero');
?>

<section class="services-t-multimodal">
    <div class="max-w-6xl mx-auto pt-20 px-4 xl:px-0">
        <?php get_template_part('template-parts/components/breadcrumb/breadcrumb'); ?>
        <h1 class="text-secondary text-3xl font-bold uppercase">
            <?php echo $title; ?>
        </h1>
    </div>
</section>

<?php

get_template_part('template-parts/components/box-intro/box-intro');

get_template_part('template-parts/components/our-services-banner/our-services-banner');

get_template_part('template-parts/components/our-services-cards/our-services-cards', null, [
    'class' => 'service-multimodal-cards'
]);

get_footer();
