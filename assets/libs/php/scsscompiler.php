<?php
//include libs, and create variables
require IDT_THEME_PATH . '/includes/vendor/autoload.php';
use ScssPhp\ScssPhp\Compiler;

global $wp_filesystem;

if (!function_exists('WP_Filesystem')) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
}

WP_Filesystem();

$compiler = new Compiler();
$dir = IDT_THEME_PATH . '/assets/styles/scss/';
$child_theme_path = WP_CONTENT_DIR . '/themes/insomniodev-child';
$child_dir = $child_theme_path . '/assets/styles/scss/';

$compiler->setImportPaths( $dir );

try {
    $compiler->setSourceMap( Compiler::SOURCE_MAP_FILE );
    $compiler->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
    $css = $compiler->compileString( '@import "compiled.scss";' );
    $wp_filesystem->put_contents(
        IDT_THEME_PATH . '/assets/styles/css/master.css',
        $css->getCss(),
        FS_CHMOD_FILE
    );
} catch ( Exception $e ) {
    var_dump( $e->getMessage() );
}

$compiler->setImportPaths( $child_dir );

try {
    $compiler->setSourceMap( Compiler::SOURCE_MAP_FILE );
    $compiler->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
    $css = $compiler->compileString( '@import "compiled.scss";' );
    $wp_filesystem->put_contents(
        $child_theme_path . '/assets/styles/css/child-master.css',
        $css->getCss(),
        FS_CHMOD_FILE
    );
} catch ( Exception $e ) {
    var_dump( $e->getMessage() );
}