<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Include class dependencies
 * @version 1.0.0
 */

require IDT_THEME_PATH . '/includes/vendor/autoload.php';
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;

/**
 * Main SCSS compiler class
 * @version 1.0.0
 */
class IdtScssCompiler
{
    /**
     * Compile a group of scss files
     * @param $args array compiler args
     * @return array compiled css info
     * @throws SassException
     * @version 1.0.0
     */
    public function compileScss(array $args = []): array
    {
        global $wp_filesystem;

        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        WP_Filesystem();

        $params = [
            'path' => null,
            'importFileName' => 'compiled',
            'outputPath' => null,
            'cssFileName' => null,
            'compileString' => '',
            'compress' => false
        ];

        $result = [
            'ccsFileName' => '',
            'cssFileDir' => '',
            'compileResult' => false,
            'errors' => null
        ];

        if (!empty($args)) {
            $params = array_merge($params, $args);
        }

        if (
            isset($params['path'])
            && $params['path'] != ''
            && isset($params['outputPath'])
            && $params['outputPath'] != ''
            && isset($params['cssFileName'])
            && $params['cssFileName'] != ''
        ) {
            $compiler = new Compiler();

            $compiler->setImportPaths($params['path']);

            try {
                if ($params['compress']) {
                    $compiler->setOutputStyle(ScssPhp\ScssPhp\OutputStyle::COMPRESSED);
                } else {
                    $compiler->setOutputStyle(ScssPhp\ScssPhp\OutputStyle::EXPANDED);
                }
                $compiler->setSourceMap(Compiler::SOURCE_MAP_FILE);
                if ($params['compileString'] != '') {
                    $css = $compiler->compileString($params['compileString']);
                } else {
                    $css = $compiler->compileString('@import "' . $params['importFileName'] . '.scss";');
                }
                $result['cssFileName'] = $params['cssFileName'] . '.css';
                $wp_filesystem->put_contents(
                    $params['outputPath'] . $params['cssFileName'] . '.css.map',
                    $css->getSourceMap(),
                    FS_CHMOD_FILE
                );

                $result['compileResult'] = $wp_filesystem->put_contents(
                    $params['outputPath'] . $params['cssFileName'] . '.css',
                    $css->getCss(),
                    FS_CHMOD_FILE
                );
            } catch (Exception $e) {
                $result['errors'] = $e->getMessage();
            }
        } else {
            $result['errors'] = __('Compiler args missing, check that all the args was set.', 'insomniodev');
        }

        return $result;
    }
}