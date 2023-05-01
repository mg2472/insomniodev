<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Default theme header
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<title><?php wp_title(''); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class();?> id="idt-page-body">
    <header id="idt-header">
        <?php get_template_part('template-parts/headers/header', 'sticky-bootstrap'); ?>
    </header>
