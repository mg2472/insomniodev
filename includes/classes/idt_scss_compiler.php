<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Include class dependencies
 * @version 0.0.1
 */

include_once IDT_THEME_PATH . '/assets/libs/php/scssphp-1.11.0/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;

/**
 * Main SCSS compiler class
 * @version 0.0.1
 */
class IdtScssCompiler
{
    /**
     * Compile a group of scss files
     * @param $args array compiler args
     * @return array compiled css info
     * @throws SassException
     * @version 0.0.1
     */
    public function compileScss(array $args = []): array
    {

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
                file_put_contents($params['outputPath'] . $params['cssFileName'] . '.css.map', $css->getSourceMap());
                $result['compileResult'] = file_put_contents($params['outputPath'] . $params['cssFileName'] . '.css', $css->getCss());
            } catch (Exception $e) {
                $result['errors'] = $e->getMessage();
            }
        } else {
            $result['errors'] = __('Compiler args missing, check that all the args was set.', 'insomniodev');
        }

        return $result;
    }
}