<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * 404 template demo V1
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

get_header('demo');
?>
<div class="idt-tpl-404-demo-v1" id="idt-tpl-404-demo-v1">
    <div id="idt-main">
        <main class="idt-section">
            <?php get_template_part('template-parts/banners/banner', 'demo-v1'); ?>
            <h1 class="idt-section-title"><?php _e('404', 'insomniodev'); ?></h1>
            <p><?php _e('Oops ... The page was not found', 'insomniodev'); ?></p>
        </main>
    </div>
</div>
<?php get_footer('demo'); ?>