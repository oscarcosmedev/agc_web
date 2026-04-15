<?php

/**
 * Template Name: Services
 */

get_header();

get_template_part('template-parts/components/hero/hero');

// ── Encabezado de sección ─────────────────────────────────────────────────────
$description = get_the_content();
?>

<div class="services-header w-full max-w-7xl mx-auto px-4 xl:px-0 pt-section">
    <h2 class="text-secondary text-3xl font-bold uppercase mb-8">
        <?php the_title(); ?>
    </h2>
    <?php if ($description) : ?>
        <p class="text-gray-600 text-xl"><?php echo esc_html($description); ?></p>
    <?php endif; ?>
    <hr class="mt-20 border-gray-200">
</div>

<?php
get_template_part('template-parts/components/services-grid/services-grid');

get_footer();
