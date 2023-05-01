<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
/**
 * Template por defecto que muestra las entradas de los tags del sitio web
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<?php get_template_part( 'templates/blog'. 'default' );?>
<?php get_footer(); ?>
