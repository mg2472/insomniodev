<?php
//include libs, and create variables
include_once IDT_THEME_PATH . '/assets/libs/php/scssphp-1.11.0/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

$compiler = new Compiler();

$dir = IDT_THEME_PATH . '/assets/styles/scss/';
$child_theme_path = WP_CONTENT_DIR . '/themes/insomniodev-child';
$child_dir = $child_theme_path . '/assets/styles/scss/';

$compiler->setImportPaths( $dir );

try {
    $compiler->setSourceMap( Compiler::SOURCE_MAP_FILE );
    $compiler->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
    $css = $compiler->compileString( '@import "compiled.scss";' );
    file_put_contents( IDT_THEME_PATH . '/assets/styles/css/master.css', $css->getCss() );
} catch ( Exception $e ) {
    var_dump( $e->getMessage() );
}

$compiler->setImportPaths( $child_dir );

try {
    $compiler->setSourceMap( Compiler::SOURCE_MAP_FILE );
    $compiler->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
    $css = $compiler->compileString( '@import "compiled.scss";' );
    file_put_contents( $child_theme_path . '/assets/styles/css/child-master.css', $css->getCss() );
} catch ( Exception $e ) {
    var_dump( $e->getMessage() );
}

//$scssList = scandir( $dir );
//
//if( count( $scssList ) > 3 ) {
//
//	foreach ($scssList as $scssFile)
//	{
//		//save .scss files name in array for compile it
//		if($scssFile != "compiled.scss" && $scssFile != "." && $scssFile!="..")
//		{
//			$scssFile = explode(".",$scssFile);
//			$import[] = '@import ' . '"' . $scssFile[0] . '"';
//		}
//	}
//
//    $count = count( $import );
//    if ( $count  == 1 ) {
//        $import = $import[0] . ';';
//    } else {
//        $import = implode( ';', $import );
//        $import = $import . ';';
//    }
//
//	$result = file_put_contents( IDT_THEME_PATH . '/assets/styles/scss/compiled.scss', $import );
//	$scss = new Compiler();
//	$scss->setImportPaths($dir);
//	$scss->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::EXPANDED );
//
//	$cssOut = $scss->compileString('@import "compiled.scss";');
//	file_put_contents(IDT_THEME_PATH . '/assets/styles/css/master.css', $cssOut);
//}
//
//if ( file_exists( $child_theme_path ) && is_dir( $child_theme_path ) ) {
//
//	$childScssList = scandir( $child_dir );
//
//	if( count( $childScssList ) > 3 ){
//
//		foreach ( $childScssList as $childScssFile ) {
//			//save .scss files name in array for compile it
//			if( $childScssFile != "compiled.scss" && $childScssFile != "." && $childScssFile != ".." )
//			{
//				$childScssFile = explode( ".", $childScssFile );
//				$child_import[] = '@import ' . '"' . $childScssFile[0] . '"';
//			}
//		}
//
//		$count = count( $child_import );
//		if ( $count  == 1 ) {
//			$child_import = $child_import[0] . ';';
//		} else {
//			$child_import = implode( ';', $child_import );
//			$child_import = $child_import . ';';
//		}
//
//		$result = file_put_contents( $child_dir . 'compiled.scss', $child_import );
//		$scss = new Compiler();
//		$scss->setImportPaths($child_dir);
//        $scss->setOutputStyle( ScssPhp\ScssPhp\OutputStyle::EXPANDED );
//
//		$cssOut = $scss->compileString('@import "compiled.scss";');
//		file_put_contents($child_theme_path . '/assets/styles/css/child-master.css', $cssOut);
//	}
//}
