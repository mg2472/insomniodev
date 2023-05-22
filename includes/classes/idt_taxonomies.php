<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Main theme custom post types and custom taxonomies class
 */

class IdtTaxonomies
{
    /**
     * Custom taxonomies arrays
     * @var array
     */
    private $taxonomies = [];

    /**
     * Class construct
     */
    public function __construct()
    {}

    /**
     * Register theme custom taxonomies and post types
     * @return void
     */
    public function registerPostsAndTaxs() : void
    {
        // *** Begin: Portafolio Taxonomy *** //
//        register_post_type(
//            'portfolio',
//            [
//                'description' => __('Portfolios', 'insomniodev'),
//                'labels' => [
//                    'name' => __('Portfolios', 'insomniodev'),
//                    'singular_name' => __('Portfolio', 'insomniodev'),
//                    'add_new' => __('Add new portfolio', 'insomniodev'),
//                    'add_new_item' => __('Add new portfolio', 'insomniodev'),
//                    'edit_item' => __('Edit portfolio', 'insomniodev'),
//                    'search_items' => __('Search portfolio', 'insomniodev'),
//                ],
//                'public' => true,
//                'has_archive' => true,
//                'show_in_menu' => true,
//                'show_ui' => true,
//                'supports' => [
//                    'title',
//                    'editor',
//                    'thumbnail',
//                    'category',
//                    'tag'
//                ],
//                'menu_icon' => 'dashicons-portfolio',
//                'taxonomies' => ['portfolio_category'],
//                'rewrite' => ['slug' => __('portfolio', 'insomniodev')]
//            ]
//        );
//
//        register_taxonomy(
//            'portfolio_category',
//            [
//                'portfolio'
//            ],
//            [
//                'labels' => [
//                    'name' => __('Portfolio categories', 'insomniodev'),
//                    'singular_name' => __('Portfolio category', 'insomniodev'),
//                    'add_new' => __('Add new portfolio category', 'insomniodev'),
//                    'add_new_item' => __('Add new portfolio category', 'insomniodev'),
//                    'edit_item' => __('Edit portfolio category', 'insomniodev'),
//                    'search_items' => __('Search portfolio category', 'insomniodev'),
//                ],
//                'show_in_menu' => true,
//                'show-ui' => true,
//                'show_admin_column' => true,
//                'query_var' => true,
//                'rewrite' => ['slug' => __('portfolio-category', 'insomniodev')],
//                'hierarchical' => true,
//            ]
//        );
        // *** End: Taxonomia Portafolio *** //
    }

}
