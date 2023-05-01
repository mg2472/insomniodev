<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Default theme logo template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

$configs = [
    'lazy' => null
];

if (isset($args) && !empty($args)) {
    $configs = array_merge($configs, $args);
}

$logo = idtGetThemeLogo('logo1');
?>
<?php if (!empty($logo)): ?>
    <a href="<?php echo idtGetHomeUrl(); ?>" class="idt-logo-url">
        <img class="idt-logo"
             src="<?php echo $logo['url']; ?>"
             alt="<?php echo $logo['alt']; ?>"
             width="<?php echo $logo['width']; ?>"
             height="<?php echo $logo['width']; ?>">
    </a>
<?php endif; ?>