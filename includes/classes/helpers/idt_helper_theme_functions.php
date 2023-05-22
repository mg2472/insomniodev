<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Add admin scripts and styles
 *
 * @return void
 */
function idtTFAddAdminResources(): void
{
    wp_enqueue_media();

    wp_register_style('idt_admin_styles' , IDT_THEME_DIR . '/admin/assets/styles/css/idt-admin-styles.css', false, '1.0.0');
    wp_enqueue_style('idt_admin_styles');

    wp_register_script('idt_admin_dashboard' , IDT_THEME_DIR . '/admin/assets/scripts/idt-dashboard.js', false, '0.9.0');
    wp_enqueue_script('idt_admin_dashboard');

    wp_localize_script(
        'idt_admin_dashboard' , 'idtAdminSettings',
        [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'adminUrl' => get_admin_url(),
        ]
    );
}

/**
 * Add admin dependencies
 *
 * @return void
 */
function idtTFAdminIncludes(): void
{
    include_once IDT_THEME_PATH . '/admin/includes/classes/idt_admin_fetch_handler.php';
    add_action('wp_ajax_adminRequestsRouter', 'IdtAdminFetchHandler::adminRequestsRouter');

    include_once IDT_THEME_PATH . '/admin/includes/classes/idt_admin_ajax_handler.php';
    add_action( 'wp_ajax_get_admin_template', 'idt_admin_ajax_handler::get_admin_template' );
    add_action( 'wp_ajax_save_settings', 'idt_admin_ajax_handler::save_settings' );
    add_action( 'wp_ajax_getAdminTemplate', 'idt_admin_ajax_handler::getAdminTemplate' );
    add_action( 'wp_ajax_saveThemeSettings', 'idt_admin_ajax_handler::saveThemeSettings' );
}

/**
 * Add admin pages
 *
 * @return void
 */
function idtTFAddAdminPage(): void
{
    include_once IDT_THEME_PATH . '/admin/includes/classes/idt_admin_pages.php';
    new idtAdminPages();
}

/**
 * Register the theme database tables
 *
 * @return void
 */
function idtTFCreateTables(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_db.php';
    $idtDB = new IdtDB();
    $result = $idtDB->createTables();
}

/**
 * Register custom post types and custom taxonomies
 *
 * @return void
 */
function idtTFRegisterPostsAndTaxs(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_taxonomies.php';
    $tax = new IdtTaxonomies();
    $tax->registerPostsAndTaxs();
}

/**
 * Register the theme shortcodes
 *
 * @return void
 */
function idtTFRegisterShortcodes(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_shortcodes.php';
    new IdtShortcodes();
}

/**
 * Add frontend theme styles and scripts
 *
 * @return void
 */
function idtTFAddThemeResources(): void
{
    if (!is_admin()) {
        global $template;
        $idtResources = new IdtResources();
        $idtResources->addThemeResources($template);
    }
}

/**
 * Filter scripts tags to add custom properties
 *
 * @param $tag
 *
 * @param $handle
 *
 * @param $src
 *
 * @return string
 */
function idtTFAddCustomTagsProperties($tag, $handle, $src): string
{
    global $template;
    $idtResources = new IdtResources();
    $tag = $idtResources->addCustomTagsProperties($tag, $handle, $src, $template);

    return $tag;
}

/**
 * Add custom mime types upload support
 *
 * @return array
 */
function idtTFMimeTypes(): array
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

/**
 * Init the theme SCSS compiler
 * @throws \ScssPhp\ScssPhp\Exception\SassException
 *
 * @return void
 */
function idtTFScssCompiler(): void
{
    $idtStyles = new IdtStyles();
    $idtStyles->addThemeBundleStyles();
    $idtStyles->addChildThemeBundleStyles();
}

/**
 * Register default menu positions
 *
 * @return void
 */
function idtTFRegisterMenus(): void
{
    register_nav_menus(
        [
            'main-menu' => __('Main menu', 'insomniodev'),
            'mobile-menu' => __('Mobile menu', 'insomniodev'),
            'social-menu' => __('Social menu', 'insomniodev')
        ]
    );
}

/**
 * Remove theme unused scripts and styles
 *
 * @return void
 */
function idtTFRemoveThemeScripts(): void
{
    $settings = idtGetSetting('performance');

    if (isset($settings['disableJquery']) && $settings['disableJquery']['value'] == 'disabled') {
        if (!is_admin()) {
            wp_deregister_script('jquery');
        }
    }

    if (isset($settings['disableStyleWpBlockLibrary']) && $settings['disableStyleWpBlockLibrary']['value'] == 'disabled') {
        wp_dequeue_style('wp-block-library');
    }

    if (isset($settings['disableStyleWpBlockLibraryTheme']) && $settings['disableStyleWpBlockLibraryTheme']['value'] == 'disabled') {
        wp_dequeue_style('wp-block-library-theme');
    }

    if (isset($settings['disableStyleClassicTheme']) && $settings['disableStyleClassicTheme']['value'] == 'disabled') {
        wp_dequeue_style('classic-theme-styles');
    }

    if (isset($settings['disableStyleDashicons']) && $settings['disableStyleDashicons']['value'] == 'disabled') {
        if (!is_user_logged_in()) {
            wp_dequeue_style('dashicons');
            wp_deregister_style('dashicons');
        }
    }
}

/**
 * Disable Widgets block editor
 *
 * @return bool
 */
function idtTFDisableWidgetsBlockEditor(): bool
{
    $settings = idtGetSetting('general');
    $active = true;

    if (isset($settings['disableWidgetsBlockEditor']) && $settings['disableWidgetsBlockEditor']['value'] == 'disabled') {
        $active = false;
    }

    return $active;
}

/**
 * Disable Gutenberg block editor
 *
 * @return bool
 */
function idtTFDisableGutenbergEditor(): bool
{
    $settings = idtGetSetting('general');
    $active = true;

    if (isset($settings['disableGutenbergEditor']) && $settings['disableGutenbergEditor']['value'] == 'disabled') {
        $active = false;
    }

    return $active;
}