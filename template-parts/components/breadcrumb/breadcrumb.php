<?php

/**
 * Breadcrumb (Breadcrumb NavXT plugin)
 */

?>

<div class="breadcrumb mb-10 text-sm text-slate-600" aria-label="Breadcrumb">
    <?php if (function_exists('bcn_display')) : ?>
        <?php bcn_display(); ?>
    <?php endif; ?>
</div>