<?php

if (!defined( 'ABSPATH')) exit; //Exit if accessed directly.

/**
 * Add theme vars
 */
add_action('after_setup_theme' , 'idtDefineVars', 1);
function idtDefineVars(): void
{
    define('IDT_THEME_DIR', get_template_directory_uri());
    define('IDT_THEME_PATH', get_template_directory());
}

/**
 * Add theme text domain
 */
add_action('after_setup_theme', 'idtAddTextDomain');
function idtAddTextDomain(): void
{
    load_theme_textdomain('insomniodev', IDT_THEME_PATH . '/i18n/languages');
}

/**
 * Add admin resources
 */
add_action('admin_enqueue_scripts', 'idtAddAdminResources');
function idtAddAdminResources(): void
{
    idtTFAddAdminResources();
}

/**
 * Add admin dependencies
 */
add_action('admin_init', 'idtAdminIncludes', 1);
function idtAdminIncludes(): void
{
    idtTFAdminIncludes();
}

/**
 * Add admin pages
 */
add_action('admin_menu', 'idtAddAdminPage');
function idtAddAdminPage(): void
{
    idtTFAddAdminPage();
}

/**
 * Add theme dependencies
 */
add_action('init' , 'idtIncludes', 1);
function idtIncludes(): void
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
function idtAddHelpers(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/helpers/idt_helper_theme_functions.php';
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
function idtCreateTables(): void
{
    idtTFCreateTables();
}

/**
 * Register custom post types and custom taxonomies
 */
add_action('init', 'idtRegisterPostsAndTaxs');
function idtRegisterPostsAndTaxs(): void
{
    idtTFRegisterPostsAndTaxs();
}

/**
 * Register default menu positions
 */
add_action('init' , 'idtRegisterMenus');
function idtRegisterMenus(): void
{
    idtTFRegisterMenus();
}

/**
 * Register the theme shortcodes
 */
add_filter('init', 'idtRegisterShortcodes');
function idtRegisterShortcodes(): void
{
    idtTFRegisterShortcodes();
}

/**
 * Add theme requests handler
 */
add_action('after_setup_theme', 'idtFetchHandler', 2);
function idtFetchHandler(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_fetch_handler.php';
    add_action('wp_ajax_idtRequestsRouter', 'IdtFetchHandler::idtRequestsRouter');
    add_action('wp_ajax_nopriv_idtRequestsRouter', 'IdtFetchHandler::idtRequestsRouter');
}

/**
 * Init the theme SCSS compiler
 * @throws \ScssPhp\ScssPhp\Exception\SassException
 */
add_action('init', 'idtScssCompiler', 3);
function idtScssCompiler(): void
{
    idtTFScssCompiler();
}

/**
 * Register default theme sidebars
 */
add_action('widgets_init', 'idtRegisterSidebars');
function idtRegisterSidebars(): void
{
    include_once IDT_THEME_PATH . '/includes/classes/idt_sidebars.php';
    new IdtSidebars();
}

/**
 * Register default theme widgets
 */
add_action('widgets_init', 'idtRegisterWidgets');
function idtRegisterWidgets(): void
{
    include_once IDT_THEME_PATH . '/includes/widgets/idt_widget_cpt_categories.php';
    include_once IDT_THEME_PATH . '/includes/widgets/idt_widget_most_popular_posts.php';
    include_once IDT_THEME_PATH . '/includes/widgets/idt_widget_social_menu.php';

    register_widget('IdtWidgetCptCategories');
    register_widget('IdtWidgetMostPopularPosts');
    register_widget('IdtWidgetSocialMenu');
}

/**
 * Add frontend theme styles and scripts
 */
add_action('wp_enqueue_scripts', 'idtAddThemeResources');
function idtAddThemeResources(): void
{
    idtTFAddThemeResources();
}

/**
 * Remove unused WordPress resources like Scripts and Styles to improve performance
 */
add_action('init', 'idtRemoveThemeResourcesInit', 4);
function idtRemoveThemeResourcesInit(): void
{
    idtTFRemoveThemeResourcesInit();
}

/**
 * Remove unused WordPress resources like Scripts and Styles to improve performance
 */
add_action('wp_enqueue_scripts', 'idtRemoveThemeResources', 11);
function idtRemoveThemeResources(): void
{
    idtTFRemoveThemeResourcesScripts();
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
function idtAddCustomTagsProperties($tag, $handle, $src): string
{
    return idtTFAddCustomTagsProperties($tag, $handle, $src);
}

/**
 * Disable Gutenberg block editor
 */
add_filter('use_block_editor_for_post', 'idtDisableGutenbergEditor', 10);
function idtDisableGutenbergEditor(): bool
{
    return idtTFDisableGutenbergEditor();
}

/**
 * Disable Widgets block editor
 */
add_filter('use_widgets_block_editor', 'idtDisableWidgetsBlockEditor');
function idtDisableWidgetsBlockEditor(): bool
{
    return idtTFDisableWidgetsBlockEditor();
}

/**
 * Add custom mime types upload support
 */
add_filter('upload_mimes', 'idtMimeTypes');
function idtMimeTypes($mimes): array
{
    return idtTFMimeTypes($mimes);
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

/**
* Update a single post views count
*/
add_action('wp', 'idtUpdatePostViews');
function idtUpdatePostViews()
{
    if (is_single()) {
        $postID = get_the_ID();
        $viewsCount = get_post_meta($postID, 'post_views', true);
        $newCount = (isset($viewsCount) && (int)$viewsCount > 0) ? ((int)$viewsCount + 1) : 1;
        update_post_meta($postID, 'post_views', $newCount);
    }
}
