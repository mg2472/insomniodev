<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
/**
 * Template para las paginas del tema
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */

get_header();
$post = get_post();
$placeholder = IDT_THEME_DIR . '/assets/images/placeholder-4-4.png';
?>
<div class="idt-page" id="idt-tpl-page">
    <div id="idt-before">
        <div id="idt-before-1">
            <section class="idt-section idt-main-banner">
                <div class="idt-section-wrap">
					<?php get_template_part( 'sections/banners/page' );?>
                </div>
            </section>
        </div>
    </div>
    <div id="idt-main">
        <div class="container">
            <main class="idt-section idt-main-page-content">
                <?php the_content();?>
            </main>
        </div>
    </div>
</div>
<?php get_footer();?>
