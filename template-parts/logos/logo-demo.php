<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Theme Demo logo template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

$logo = IDT_THEME_DIR . '/assets/images/logo-insomniodev.webp';
?>
<a href="<?php echo idtGetHomeUrl(); ?>" class="idt-logo-url">
    <img class="idt-logo"
         src="<?php echo $logo; ?>"
         alt="Insomnio Dev Logo"
         width=""
         height="">
</a>