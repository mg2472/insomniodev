<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Iframe video template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Insomnio Dev
 * @subpackage Insomnio Dev
 * @since 1.0
 * @version 1.0
 */

$settings = [
    'url' => null,
    'loading' => null,
    'cssClass' => null,
    'id' => null
];

if (!empty($args)) {
    $settings = array_merge($settings, $args);
}

$id = uniqid('idt-sc-video-v1-iframe');
$cssClass = 'idt-sc-video-v1-iframe';

if (isset($settings['id']) && $settings['id'] != '') {
    $id .= ' ' . $settings['id'];
}

if (isset($settings['cssClass']) && $settings['cssClass'] != '') {
    $cssClass .= ' ' . $settings['cssClass'];
}
?>
<?php if ($settings['url'] != ''): ?>
    <div class="<?php echo esc_attr($cssClass); ?>" id="<?php echo esc_attr($id); ?>">
        <iframe src="<?php echo esc_url($settings['url']); ?>"
                loading="<?php echo esc_attr($settings['loading']); ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
    </div>
<?php endif; ?>