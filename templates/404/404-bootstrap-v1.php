<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * 404 template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

get_header('demo');
?>
<div class="idt-tpl-404-demo-v1" id="idt-tpl-404-demo-v1">
    <div id="idt-main">
        <div class="container">
            <main class="idt-section idt-main-content">
                <div class="idt-section-wrap">
                    <?php get_template_part('template-parts/banners/banner', 'demo-v1'); ?>
                    <h1 class="idt-section-title"><?php _e('404', 'insomniodev'); ?></h1>
                    <p><?php _e('Oops ... The page was not found', 'insomniodev'); ?></p>
                </div>
            </main>
        </div>
    </div>
</div>
<?php get_footer('demo'); ?>
