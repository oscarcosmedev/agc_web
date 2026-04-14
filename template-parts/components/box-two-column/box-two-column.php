<?php
$custom_class = $args['class'] ?? '';
?>

<div class="box-two-column py-section <?php echo $custom_class; ?>">
    <div class="w-full max-w-7xl mx-auto px-4 xl:px-0">
        <div class="flex flex-col lg:flex-row justify-center items-center">
            <div class="box-two-column__left relative -z-10 w-full h-full max-w-xl min-h-[350px] rounded-xl bg-gray-300 overflow-hidden">
                <picture class="absolute inset-0 w-full h-full block">
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/dist/assets/find-us.webp" type="image/webp">
                    <img class="w-full h-full object-cover" src="<?php echo get_template_directory_uri(); ?>/assets/dist/find-us.webp" alt="Descripción">
                </picture>
            </div>
            <div class="box-two-column__right w-full max-w-xl bg-white lg:-ml-20 px-10 py-5 rounded-xl shadow-lg">
                <div class="box-two-column__content">
                    <h3 class="box-two-column__title text-secondary text-2xl font-bold mb-4">
                        <?php _e('Find us:', 'agc-theme'); ?>
                    </h3>
                    <div class="box-two-column__text flex flex-col sm:flex-row sm:justify-between gap-8">
                        <div class="flex flex-col">
                            <?php svg_icon('flag-arg'); ?>
                            <h4 class="my-4 text-accent text-xl font-bold">Argentina</h4>
                            <p class="text-sm">Av. Cramer 1675, Belgrano <br>
                                Ciudad Autónoma de Buenos Aires <br>
                                Argentina - C1426APA</p>
                        </div>
                        <div class="flex flex-col">
                            <?php svg_icon('flag-uru'); ?>
                            <h4 class="my-4 text-accent text-xl font-bold">Uruguay</h4>
                            <p class="text-sm">Juan D. Jackson 1018, Montevideo <br>
                                Departamento de Montevideo <br>
                                Uruguay - CP 11200</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>