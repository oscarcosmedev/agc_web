<?php
$custom_class = $args['class'] ?? '';

?>

<div class="social-box flex gap-4 py-4 text-white text-xl <?php echo esc_attr($custom_class); ?>">
    <a href="" class="hover:text-white/80 transition-colors duration-300 cursor-pointer">
        <?php svg_icon('icon-linkedin'); ?>
    </a>
    <a href="" class="hover:text-white/80 transition-colors duration-300 cursor-pointer">
        <?php svg_icon('icon-facebook'); ?>
    </a>
    <a href="" class="hover:text-white/80 transition-colors duration-300 cursor-pointer">
        <?php svg_icon('icon-instagram'); ?>
    </a>
</div>