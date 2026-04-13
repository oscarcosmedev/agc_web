<?php

/**
 * Template Name: Servicio - Maritimo
 * Template Post Type: services
 */

get_header();

get_template_part('template-parts/components/hero/hero');

$title = get_the_title();

?>

<section class="services-t-maritimo">
    <div class="max-w-6xl mx-auto py-20 px-4 xl:px-0">
        <?php get_template_part('template-parts/components/breadcrumb/breadcrumb'); ?>
        <h1 class="text-secondary text-3xl font-bold uppercase">
            <?php echo $title; ?>
        </h1>
    </div>
</section>

<?php

get_template_part('template-parts/components/box-intro/box-intro', null, [
    'class' => 'pt-0',
]);

get_template_part('template-parts/components/our-services/our-services');

get_footer();
