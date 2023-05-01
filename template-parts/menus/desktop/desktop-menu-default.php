<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Desktop menu template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

$configs = [
    'themeLocation' => null
];

if (isset($args) && !empty($args)) {
    $configs = array_merge($configs, $args);
}

?>
<?php if (isset($configs['themeLocation']) && $configs['themeLocation'] != ''): ?>
<nav class="idt-menu-desktop">
    <?php
        wp_nav_menu([
            'theme_location' => $configs['themeLocation']
        ]);
    ?>
</nav>
<?php endif; ?>
