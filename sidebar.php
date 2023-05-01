<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
?>
<div class="col-lg-4">
    <div id="sidebar">
        <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar' ); ?>
        <?php endif; ?>
    </div>
</div>
