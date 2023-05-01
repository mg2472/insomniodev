<?php

if (!defined( 'ABSPATH')) exit; //Exit if accessed directly.

/**
 * Add theme vars
 */
add_action('after_setup_theme' , 'idtDefineVars', 1);
function idtDefineVars()
{
    define('IDT_THEME_DIR', get_template_directory_uri());
    define('IDT_THEME_PATH', get_template_directory());
}

/**
 * Add theme text domain
 */
add_action('after_setup_theme', 'idtAddTextDomain');
function idtAddTextDomain()
{
    load_theme_textdomain('insomniodev', IDT_THEME_PATH . '/i18n/languages');
}

/**
 * Add admin scripts
 */
add_action('admin_enqueue_scripts', 'idtAddAdminScripts');
function idtAddAdminScripts()
{
    wp_enqueue_media();

    wp_register_script('idt_admin_scripts' , IDT_THEME_DIR . '/admin/assets/scripts/idt-admin-scripts.js', ['jquery']);
    wp_enqueue_script('idt_admin_scripts');

    wp_register_script('idt_admin_dashboard' , IDT_THEME_DIR . '/admin/assets/scripts/idt-dashboard.js', false, '0.9.0');
    wp_enqueue_script('idt_admin_dashboard');

    wp_localize_script(
        'idt_admin_scripts' , 'ajaxObject',
        [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'langMediaUploadTitle' => __('Select a image to upload', 'insomniodev'),
            'langMediaUploadButton' => __('Use this image', 'insomniodev'),
        ]
    );

    wp_localize_script(
        'idt_admin_dashboard' , 'idtAdminSettings',
        [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'adminUrl' => get_admin_url(),
        ]
    );
}

/**
 * Add admin styles
 */
add_action('admin_enqueue_scripts', 'idtAddAdminStyles' );
function idtAddAdminStyles()
{
    wp_register_style('idt_admin_styles' , IDT_THEME_DIR . '/admin/assets/styles/css/idt-admin-styles.css', false, '1.0.0');
    wp_enqueue_style('idt_admin_styles');
}

/**
 * Add admin dependencies
 */
add_action('admin_init', 'idtAdminIncludes', 1);
function idtAdminIncludes()
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
 */
add_action('admin_menu', 'idtAddAdminPage');
function idtAddAdminPage()
{
    include_once IDT_THEME_PATH . '/admin/includes/classes/idt_admin_pages.php';
    new idtAdminPages();
}

/**
 * Add theme dependencies
 */
add_action('init' , 'idtIncludes', 1);
function idtIncludes()
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_settings.php';
    include_once IDT_THEME_PATH . '/includes/classes/idt_resources.php';
    include_once IDT_THEME_PATH . '/includes/classes/idt_scss_compiler.php';
    include_once IDT_THEME_PATH . '/includes/classes/idt_styles.php';
}

/**
 * Add theme helpers
 */
add_action('init' , 'idtAddHelpers', 2);
function idtAddHelpers()
{
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_general.php';
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_multimedia.php';
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_pipes.php';
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_settings.php';
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_templates.php';

}

/**
 * Register the theme database tables
 */
add_action('after_switch_theme', 'idtCreateTables');
function idtCreateTables()
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_db.php';
    $idtDB = new IdtDB();
    $result = $idtDB->createTables();
}

/**
 * Register custom post types and custom taxonomies
 */
add_action('init', 'idtRegisterPostsAndTaxs');
function idtRegisterPostsAndTaxs()
{
    include_once IDT_THEME_PATH . '/includes/taxonomies.php';
    $tax = new IdtTaxonomies();
    $tax->registerPostsAndTaxs();
}

/**
 * Register default menu positions
 */
add_action('init' , 'idtRegisterMenus');
function idtRegisterMenus()
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
 * Register the theme shortcodes
 */
add_filter('init', 'idtRegisterShortcodes');
function idtRegisterShortcodes()
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_shortcodes.php';
    new IdtShortcodes();
}

/**
 * Add theme requests handler
 */
add_action('after_setup_theme', 'idtFetchHandler', 2);
function idtFetchHandler()
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_fetch_handler.php';
    add_action('wp_ajax_idtRequestsRouter', 'IdtFetchHandler::idtRequestsRouter');
    add_action('wp_ajax_nopriv_idtRequestsRouter', 'IdtFetchHandler::idtRequestsRouter');
}

/**
 * Init the theme SCSS compiler
 */
add_action('init', 'idtScssCompiler', 3);
/**
 * @throws \ScssPhp\ScssPhp\Exception\SassException
 */
function idtScssCompiler()
{
    $idtStyles = new IdtStyles();
    $idtStyles->addThemeBundleStyles();
    $idtStyles->addChildThemeBundleStyles();
}

/**
 * Register default theme sidebars
 */
add_action('widgets_init', 'idtRegisterSidebars');
function idtRegisterSidebars()
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_sidebars.php';
    new IdtSidebars();
}

/**
 * Add frontend theme styles and scripts
 * @return void
 */
add_action('wp_enqueue_scripts', 'idtAddThemeResources');
function idtAddThemeResources(): void
{
    if (!is_admin()) {
        global $template;
        $idtResources = new IdtResources();
        $idtResources->addThemeResources($template);
    }
}

/**
 * Remove jQuery and WordPress styles
 */
add_action('wp_enqueue_scripts', 'idtRemoveThemeScripts', 11);
function idtRemoveThemeScripts()
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
}

/**
 * Remove jQuery Migrate
 */
add_action('wp_default_scripts', 'idtRemoveJqueryMigrate', 12);
function idtRemoveJqueryMigrate($scripts) {
//    $settings = idtGetSetting('general');
//
//    if (isset($settings['disableJquery']) && $settings['disableJquery']['value'] == 'disabled') {
//        if (!is_admin()) {
//            $script = $scripts->registered['jquery'];
//            if ($script->deps) {
//                // Check whether the script has any dependencies
//                $script->deps = array_diff($script->deps, ['jquery-migrate']);
//            }
//        }
//    }
}

/**
 * Filter scripts tags to add custom properties
 */
add_filter('script_loader_tag', 'idtAddCustomTagsProperties' , 10, 3);
function idtAddCustomTagsProperties($tag, $handle, $src)
{
    global $template;
    $idtResources = new IdtResources();
    $tag = $idtResources->addCustomTagsProperties($tag, $handle, $src, $template);

    return $tag;
}

/**
 * Disable Gutenberg block editor
 */
add_filter('use_block_editor_for_post', 'idtDisableGutenbergEditor', 10);
function idtDisableGutenbergEditor()
{
    $settings = idtGetSetting('general');
    $active = true;

    if (isset($settings['disableGutenbergEditor']) && $settings['disableGutenbergEditor']['value'] == 'disabled') {
        $active = false;
    }

    return $active;
}

/**
 * Disable Widgets block editor
 */
add_filter('use_widgets_block_editor', 'idtDisableWidgetsBlockEditor');
function idtDisableWidgetsBlockEditor()
{
    $settings = idtGetSetting('general');
    $active = true;

    if (isset($settings['disableWidgetsBlockEditor']) && $settings['disableWidgetsBlockEditor']['value'] == 'disabled') {
        $active = false;
    }

    return $active;
}

/**
 * Add custom mime types upload support
 */
add_filter('upload_mimes', 'idtMimeTypes');
function idtMimeTypes($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

/**
 * Update Woocommerce mini cart fragments
 */
add_filter('woocommerce_add_to_cart_fragments', 'idtWcRefreshMiniCartCount');
function idtWcRefreshMiniCartCount($fragments)
{
    ob_start();
    ?>
        <span class="idt-wc-mini-cart__count cart-items-count count">
            <?php echo WC()->cart->get_cart_contents_count(); ?>
        </span>
    <?php

    $fragments['.cart-items-count'] = ob_get_clean();

    return $fragments;
}
