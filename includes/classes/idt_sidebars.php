<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme sidebars class
 * @version 0.0.1
 */
class IdtSidebars {

    /**
     * Class construct
     */
    public function __construct()
    {
        $this->registerSidebars();
    }

    /**
     * Registra los sidebars iniciales del tema
     * @return void
     */
    public function registerSidebars() : void
    {

        register_sidebar(
            [
                'name'          => __('Footer', 'insomniodev') . ' 1',
                'id'            => 'idt-sidebar-footer-1',
                'description'   => __('Add widgets here to appear in your footer', 'insomniodev'),
                'before_widget' => '<section class="idt-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="idt-widget__title">',
                'after_title'   => '</h2>'
            ]
        );

        register_sidebar(
            [
                'name'          => __('Footer', 'insomniodev') . ' 2',
                'id'            => 'idt-sidebar-footer-2',
                'description'   => __('Add widgets here to appear in your footer', 'insomniodev'),
                'before_widget' => '<section class="idt-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="idt-widget__title">',
                'after_title'   => '</h2>'
            ]
        );

        register_sidebar(
            [
                'name'          => __('Footer', 'insomniodev') . ' 3',
                'id'            => 'idt-sidebar-footer-3',
                'description'   => __('Add widgets here to appear in your footer', 'insomniodev'),
                'before_widget' => '<section class="idt-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="idt-widget__title">',
                'after_title'   => '</h2>'
            ]
        );

        register_sidebar(
            [
                'name'          => __('Footer', 'insomniodev') . ' 4',
                'id'            => 'idt-sidebar-footer-4',
                'description'   => __('Add widgets here to appear in your footer', 'insomniodev'),
                'before_widget' => '<section class="idt-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="idt-widget__title">',
                'after_title'   => '</h2>'
            ]
        );

        register_sidebar(
            [
                'name'          => __('Sidebar', 'insomniodev'),
                'id'            => 'idt-sidebar-1',
                'description'   => __('Add widgets here to appear in your sidebar', 'insomniodev'),
                'before_widget' => '<section class="idt-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="idt-widget__title">',
                'after_title'   => '</h2>'
            ]
        );
    }
}