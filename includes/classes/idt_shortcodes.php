<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme shortcodes class
 * @version 0.0.1
 */
class IdtShortcodes
{

    /**
     * Class construct
     */
    public function __construct()
    {
        add_shortcode('idt_latest_posts', [$this, 'latestPosts']);
        add_shortcode('idt_wc_mini_cart', [$this, 'idtWcMiniCart']);
    }

    /**
     * This shortcode show the recently posts added
     * @param array $atts Shortcode params
     * @version 0.0.1
     */
    public function latestPosts(array $atts = [])
    {
        global $idt_helper;

        $params = [
            'count' => 3,
            'thumbnails' => 'true',
            'template' => 'sections/posts/post/post-style-3'
        ];

        if (!empty($atts)) {
            if (isset($atts['count']) && $atts[ 'count' ] > 0) {
                $params['count'] = $atts['count'];
            }
            if (isset($atts['template']) && $atts['template'] != '') {
                $params['template'] = $atts['template'];
            }
        }

        $loop = new WP_Query([
            'post_type' => 'post',
            'order' => 'DESC',
            'posts_per_page'  => (int)$params['count'],
            'post_status' => 'publish',
        ]);

        if (!$loop->have_posts()) {
            return;
        }

        ob_start();

        while($loop->have_posts()): $loop->the_post();
            get_template_part($params['template']);
        endwhile; wp_reset_query();

        return ob_get_clean();
    }

    /**
     * This shortcode add the woocommerce mini cart
     * @version 0.0.1
     */
    public function idtWcMiniCart()
    {
        ob_start();
        get_template_part('template-parts/shortcodes/woocommerce/wc', 'mini-cart');
        return ob_get_clean();
    }

}
