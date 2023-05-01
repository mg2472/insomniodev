<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Mobile menu with Bootstrap layout template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

$copyright = idtGetThemeCopyright();
?>
<nav class="idt-mobile-menu-container">
    <div class="container">
            <?php wp_nav_menu([
                'theme_location' => 'mobile-menu',
                'menu_class' => '',
                'container_class' => 'menu'
            ]); ?>
        <section class="idt-secondary-menu idt-secondary__mobile">
            <?php get_template_part('sections/menus/desktop/desktop-menu', 'default', ['themeLocation' => 'secondary-menu']); ?>
        </section>
    </div>
    <div class="idt-mobile-menu__footer">
        <div class="copyright">
            <div class="copyright__content text-center">
                <p><?php echo $copyright['value']; ?></p>
            </div>
        </div>
        <?php get_template_part('template-parts/menus/social/social-menu', 'default'); ?>
    </div>
</nav>
