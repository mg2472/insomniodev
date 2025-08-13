<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme styles handler class
 * @version 0.0.1
 */
class IdtStyles extends IdtScssCompiler
{
    private string $themeScssPath = '';
    private string $themeCssPath = '';
    private bool $childThemeExist = false;
    private string $childThemeScssPath = '';
    private string $childThemeCssPath = '';
    private string $bootstrapScssPath = '';
    private array $performanceOptions = [];
    private $resourcesVersion = false;

    /**
     * Class construct
     */
    function __construct()
    {
        $settings = idtGetSetting('performance');
        $this->performanceOptions = $settings;
        $this->themeScssPath = IDT_THEME_PATH . '/assets/styles/scss/';
        $this->themeCssPath = IDT_THEME_PATH . '/assets/styles/css/';
        $this->bootstrapScssPath = IDT_THEME_PATH . '/assets/libs/bootstrap/scss/';
        $childThemePath = WP_CONTENT_DIR . '/themes/insomniodev-child';
        $this->resourcesVersion = get_option('idt_resources_version');
        if (file_exists($childThemePath) && is_dir($childThemePath)) {
            $this->childThemeExist = true;
            $this->childThemeScssPath = $childThemePath . '/assets/styles/scss/';
            $this->childThemeCssPath = $childThemePath . '/assets/styles/css/';
        }
    }

    /**
     * Compile and add bootstrap styles
     * @return void
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    public function addBootstrap(): void
    {
        $result = $this->compileScss([
            'path' => $this->bootstrapScssPath,
            'importFileName' => 'idt-bootstrap',
            'outputPath' => $this->themeCssPath,
            'cssFileName' => 'bootstrap',
            'compress' => true
        ]);
    }

    /**
     * Compile and add the main theme styles
     * @return void
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    public function addThemeBundleStyles(): void
    {
        if (
            isset($this->performanceOptions['enableThemeScssCompiler'])
            && $this->performanceOptions['enableThemeScssCompiler']['value'] == 'enabled'
        ) {
            $updateImportsFile = $this->updateImportsFile($this->themeScssPath, 'compiled');

            if ($updateImportsFile) {
                try {
                    $result = $this->compileScss([
                        'path' => $this->themeScssPath,
                        'importFileName' => 'compiled',
                        'outputPath' => $this->themeCssPath,
                        'cssFileName' => 'master',
                        'compress' => true
                    ]);

                    if (isset($result['errors']) && $result['errors'] != '') {
                        var_dump($result);
                        exit();
                    } else {
                        if ($this->resourcesVersion) {
                            $this->resourcesVersion++;
                        } else {
                            $this->resourcesVersion = 1;
                        }
                        update_option('idt_resources_version', $this->resourcesVersion);
                    }
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                    exit();
                }
            }
        }
    }

    /**
     * Compile and add the theme child styles
     * @return void
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    public function addChildThemeBundleStyles(): void
    {
        if (
            $this->childThemeExist
            && isset($this->performanceOptions['enableChildThemeScssCompiler'])
            && $this->performanceOptions['enableChildThemeScssCompiler']['value'] == 'enabled'
        ) {
            $updateImportsFile = $this->updateImportsFile($this->childThemeScssPath, 'compiled');

            if ($updateImportsFile) {
                try {

                    $result = $this->compileScss([
                        'path' => $this->childThemeScssPath,
                        'importFileName' => 'compiled',
                        'outputPath' => $this->childThemeCssPath,
                        'cssFileName' => 'child-master',
                        'compress' => true
                    ]);

                    if (isset($result['errors']) && $result['errors'] != '') {
                        var_dump($result);
                        exit();
                    } else {
                        if ($this->resourcesVersion) {
                            $this->resourcesVersion++;
                        } else {
                            $this->resourcesVersion = 1;
                        }
                        update_option('idt_resources_version', $this->resourcesVersion);
                    }

                } catch (Exception $e) {
                    var_dump($e->getMessage());
                    exit();
                }
            }
        }
    }

    /**
     * Automatically add scss files to a main file. If the file exist update it; if not will create a new one
     * @param $dirPath string The path to the folder when the scss imports fill will be created or updated
     * @param $importsFileName string The name of the file that will be created or updated
     * @return mixed true if the file was updated, false if not, can return an Exception message if error occurs
     */
    public function updateImportsFile(string $dirPath = '', string $importsFileName = ''): bool
    {
        global $wp_filesystem;
        $result = false;

        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        WP_Filesystem();

        if ($dirPath != '' && $importsFileName != '') {
            $scssFiles = scandir($dirPath);
            $imports = [];

            if (count($scssFiles) > 3) {
                foreach ($scssFiles as $scssFile) {
                    if ($scssFile != $importsFileName . '.scss' && $scssFile != '.' && $scssFile != '..') {
                        $scssFile = explode('.', $scssFile);
                        $imports[] = '@import ' . '"' . $scssFile[0] . '"';
                    }
                }

                try {
                    $result = $wp_filesystem->put_contents(
                        $dirPath . $importsFileName . '.scss',
                        implode(';', $imports) . ';',
                        FS_CHMOD_FILE // Permisos por defecto
                    );
                } catch (Exception $e) {
                    $result = $e->getMessage();
                }

            }
        }

        return $result;
    }

}