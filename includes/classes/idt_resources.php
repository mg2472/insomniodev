<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme resources handler class
 * @version 0.0.1
 */
class IdtResources
{
    /**
     * Add the theme resources
     * @param string $template Current template
     * @version 1.0.0
     */
    public function addThemeResources($template = ''): void
    {
        $settings = new IdtSettings();
        $args = [
            'templateType' => '',
            'templateName' => '',
            'status' => 'enabled',
        ];

        if (is_front_page()) {
            $args['templateType'] = 'wordpressTPL';
            $args['templateName'] = 'front-page.php';
        } else if (is_home()) {
            $args['templateType'] = 'wordpressTPL';
            $args['templateName'] = 'home.php';
        } else if (is_singular() && !is_singular(['post', 'page'])) {
            $post = get_post();
            $args['templateType'] = 'postType';
            $args['templateName'] = $post->post_type;
        } else if (is_single()) {
            $args['templateType'] = 'wordpressTPL';
            $args['templateName'] = 'single.php';
        } else if (is_tax()) {
            $term = get_queried_object();
            $args['templateType'] = 'taxonomy';
            $args['templateName'] = $term->name;
        } else if (is_category()) {
            $args['templateType'] = 'taxonomy';
            $args['templateName'] = 'category';
        } else if ($template != '') {
            $templateName = explode('/', $template);
            $templateName = end($templateName);
            $args['templateName'] = $templateName;
        }

        if ($args['templateName'] != '') {
            $resources = $settings->getTemplatesSettings($args);

            if (!empty($resources)) {
                $this->addThemeScripts($resources[0]);
                $this->addThemeStyles($resources[0]);
            } else {
                $this->addDefaultThemeStyles();
                $this->addDefaultThemeScripts();
            }
        } else {
            $this->addDefaultThemeStyles();
            $this->addDefaultThemeScripts();
        }
    }

    /**
     * Add the theme scripts
     * @param array $settings Current template settings
     * @version 1.0.0
     * @return void
     */
    public function addThemeScripts(array $settings = []): void
    {
        wp_register_script('idtThemeHeaderHook', IDT_THEME_DIR . '/assets/scripts/theme/idt-theme-header-hook.js', false, '1.0.0', false);
        wp_enqueue_script('idtThemeHeaderHook');

        wp_register_script('idtThemeResources', IDT_THEME_DIR . '/assets/scripts/theme/idt-theme-resources.esm.js', false, '1.0.0', true);
        wp_enqueue_script('idtThemeResources');

        if (!empty($settings)) {
            $headerScripts = (isset($settings['scriptsHeader']) && $settings['scriptsHeader'] != '') ? json_decode($settings['scriptsHeader']) : [];
            $footerScripts = (isset($settings['scriptsFooter']) && $settings['scriptsFooter'] != '') ? json_decode($settings['scriptsFooter']) : [];

            //Template header scripts
            if (!empty($headerScripts)) {
                $x = 0;

                foreach ($headerScripts as $item) {
                    $x++;
                    wp_register_script('idtHeaderScript-' . $x, $item, [], '1.0.0', false);
                    wp_enqueue_script('idtHeaderScript-' . $x);
                }
            }

            //Template footer scripts
            if (!empty($footerScripts)) {
                $x = 0;

                foreach ($footerScripts as $item) {
                    $x++;
                    wp_register_script('idtFooterScript-' . $x, $item, [], '1.0.0', true);
                    wp_enqueue_script('idtFooterScript-' . $x);
                }
            }

            if (empty($headerScripts) && empty($footerScripts)) {
                $this->addDefaultThemeScripts();
            }
        }
    }

    /**
     * Add the theme styles
     * @param array $settings Current template settings
     * @version 1.0.0
     * @return void
     */
    public function addThemeStyles(array $settings = []): void
    {
        $idtThemeResources = [
            'css' => [
                'files' => []
            ]
        ];

        if (!empty($settings)) {
            $criticalCss = (isset($settings['criticalCss']) && $settings['criticalCss'] != '') ? json_decode($settings['criticalCss']) : [];
            $css = (isset($settings['css']) && $settings['css'] != '') ? json_decode($settings['css']) : [];

            //Template critical CSS
            if (!empty($criticalCss)) {
                $x = 0;

                foreach ($criticalCss as $item) {
                    $x++;
                    wp_register_style('idtCriticalCss-' . $x, $item, [], '1.0.0', false);
                    wp_enqueue_style('idtCriticalCss-' . $x);
                }
            }

            //Template CSS
            if (!empty($css)) {
                $idtThemeResources['css']['files'] = $css;
            }

            if (empty($criticalCss) && empty($css)) {
                $this->addDefaultThemeStyles();
            }
        }

        wp_localize_script(
            'idtThemeResources' , 'idtResourcesJS',
            [
                'css' => $idtThemeResources['css']['files']
            ]
        );
    }

    /**
     * Add the default theme styles
     * @version 1.0.0
     * @return void
     */
    public function addDefaultThemeStyles(): void
    {
        wp_register_style('idtGlideCore', IDT_THEME_DIR . '/assets/libs/glide/css/glide.core.min.css', false);
        wp_enqueue_style('idtGlideCore');

        wp_register_style('idtGlideTheme', IDT_THEME_DIR . '/assets/libs/glide/css/glide.theme.min.css', false);
        wp_enqueue_style('idtGlideTheme');

        wp_register_style('idtLiteYoutubeEmbed', IDT_THEME_DIR . '/assets/libs/lite-youtube-embed/lite-yt-embed.css', false);
        wp_enqueue_style('idtLiteYoutubeEmbed');

        wp_register_style('idtBootstrapStyles', IDT_THEME_DIR . '/assets/libs/bootstrap/versions/version-5.2/css/bootstrap.min.css', false);
        wp_enqueue_style('idtBootstrapStyles');

        wp_register_style('idtThemeStyles', IDT_THEME_DIR . '/assets/styles/css/master.css', ['idtBootstrapStyles'], '1.0.0');
        wp_enqueue_style('idtThemeStyles');

        if (defined('IDT_CHILD_THEME_DIR')) {
            $childThemeDir = IDT_CHILD_THEME_DIR;

            wp_register_style( 'idtChildThemeStyles', $childThemeDir . '/assets/styles/css/child-master.css', ['idtThemeStyles'], '1.0.0');
            wp_enqueue_style( 'idtChildThemeStyles' );
        }
    }

    /**
     * Add the default theme scripts
     * @version 1.0.0
     * @return void
     */
    public function addDefaultThemeScripts(): void
    {
        wp_register_script('idtThemeHeaderHook', IDT_THEME_DIR . '/assets/scripts/theme/idt-theme-header-hook.js', false, '1.0.0', false);
        wp_enqueue_script('idtThemeHeaderHook');

        wp_register_script('idtBootstrapJS' , IDT_THEME_DIR . '/assets/libs/bootstrap/versions/version-5.2/js/bootstrap.bundle.min.js', [], '1.0.0', true);
        wp_enqueue_script('idtBootstrapJS');

        wp_register_script('idtLiteYoutubeEmbed' , IDT_THEME_DIR . '/assets/libs/lite-youtube-embed/lite-yt-embed.js', '', null, true);
        wp_enqueue_script('idtLiteYoutubeEmbed');

        wp_register_script('idtDefaultHeaderScripts', IDT_THEME_DIR . '/assets/scripts/header-scripts.js', [], null, false);
        wp_enqueue_script('idtDefaultHeaderScripts');

        wp_register_script('idtDefaultFooterScripts', IDT_THEME_DIR . '/assets/scripts/footer-scripts.js', ['idtBootstrapJS', 'idtLiteYoutubeEmbed'], null, true);
        wp_enqueue_script('idtDefaultFooterScripts');

        if (defined('IDT_CHILD_THEME_PATH')) {
            $childThemeDir = IDT_CHILD_THEME_DIR;

            wp_register_script('idtDefaultChildThemeHeaderScripts', $childThemeDir . '/assets/scripts/header-scripts.js', ['idtDefaultHeaderScripts'], null, false);
            wp_enqueue_script('idtDefaultChildThemeHeaderScripts');

            wp_register_script('idtDefaultChildThemeFooterScripts', $childThemeDir . '/assets/scripts/footer-scripts.js', ['idtDefaultFooterScripts'], null, true);
            wp_enqueue_script('idtDefaultChildThemeFooterScripts');
        }
    }

    /**
     * Filter scripts tags to add custom properties
     * @param $tag
     * @param $handle
     * @param $src
     * @return string
     * @version 1.0.0
     */
    public function addCustomTagsProperties($tag, $handle, $src, $template): string
    {
        if (!is_admin()) {
            $settings = new IdtSettings();
            $args = [
                'templateType' => '',
                'templateName' => '',
                'status' => 'enabled',
            ];

            if (is_front_page()) {
                $args['templateType'] = 'wordpressTPL';
                $args['templateName'] = 'front-page.php';
            } else if (is_home()) {
                $args['templateType'] = 'wordpressTPL';
                $args['templateName'] = 'home.php';
            } else if (is_singular() && !is_singular(['post', 'page'])) {
                $post = get_post();
                $args['templateType'] = 'postType';
                $args['templateName'] = $post->post_type;
            } else if (is_single()) {
                $args['templateType'] = 'wordpressTPL';
                $args['templateName'] = 'single.php';
            } else if (is_tax()) {
                $term = get_queried_object();
                $args['templateType'] = 'taxonomy';
                $args['templateName'] = $term->name;
            } else if (is_category()) {
                $args['templateType'] = 'taxonomy';
                $args['templateName'] = 'category';
            } else if ($template != '') {
                $templateName = explode('/', $template);
                $templateName = end($templateName);
                $args['templateName'] = $templateName;
            }

            if ($args['templateName'] != '') {
                $resources = $settings->getTemplatesSettings($args);

                if (!empty($resources)) {
                    $headerScripts = (isset($resources[0]['scriptsHeader']) && $resources[0]['scriptsHeader'] != '') ? json_decode($resources[0]['scriptsHeader']) : [];
                    $footerScripts = (isset($resources[0]['scriptsFooter']) && $resources[0]['scriptsFooter'] != '') ? json_decode($resources[0]['scriptsFooter']) : [];

                    //Template header scripts
                    if (!empty($headerScripts)) {
                        $x = 0;

                        foreach ($headerScripts as $item) {
                            $x++;
                            if ('idtHeaderScript-' . $x === $handle) {
                                $tag = '<script type="module" id="' . $handle . '" src="' . esc_url($src) . '"></script>';
                            }
                        }
                    }

                    //Template footer scripts
                    if (!empty($footerScripts)) {
                        $x = 0;

                        foreach ($footerScripts as $item) {
                            $x++;
                            if ('idtFooterScript-' . $x === $handle) {
                                $tag = '<script type="module" id="' . $handle . '" src="' . esc_url($src) . '"></script>';
                            }
                        }
                    }
                }
            }
        }

        if (
            'idt_front_scripts' === $handle
            || 'idt_admin_dashboard' === $handle
            || 'idtThemeResources' === $handle
            || 'idtDefaultHeaderScripts' === $handle
            || 'idtDefaultFooterScripts' === $handle
            || 'idtDefaultChildThemeHeaderScripts' === $handle
            || 'idtDefaultChildThemeFooterScripts' === $handle
        ) {
            $tag = '<script type="module" id="' . $handle . '" src="' . esc_url($src) . '"></script>';
        }

        return $tag;
    }

    /**
     * Get a list of the Bootstrap styles files
     * @param string $version The Bootstrap version. Default 5.2
     * @param string $filesExtension The Bootstrap files extension to return. Default css
     * @return array Bootstrap styles files list
     * @version 1.0.0
     */
    public function getBootstrapStyleFiles(string $version = '5.2', string $filesExtension = 'css'): array
    {
        $dir = IDT_THEME_PATH . '/assets/libs/bootstrap/versions/version-' . $version;
        $filesDir = $dir . '/' . $filesExtension . '/';
        $files = [];
        $filesList = [];

        if (file_exists($filesDir) && is_dir($filesDir)) {
            $files = array_diff(scandir($filesDir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == $filesExtension) {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of the Fontawesome styles files
     * @param string $version The Fontawesome version. Default 6.3
     * @param string $filesExtension The Fontawesome files extension to return. Default css
     * @return array Fontawesome styles files list
     * @version 1.0.0
     */
    public function getFontawesomeStyleFiles(string $version = '6.3', string $filesExtension = 'css'): array
    {
        $dir = IDT_THEME_PATH . '/assets/libs/fontawesome/versions/version-' . $version;
        $filesDir = $dir . '/' . $filesExtension . '/';
        $files = [];
        $filesList = [];

        if (file_exists($filesDir) && is_dir($filesDir)) {
            $files = array_diff(scandir($filesDir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == $filesExtension) {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of additional theme styles files
     * @return array Additional styles files list
     * @version 1.0.0
     */
    public function getAdditionalStyleFiles(): array
    {
        return [
            'animate.min.css',
            'glide.core.min.css',
            'glide.core.css',
            'lite-yt-embed.css'
        ];
    }

    /**
     * Get a list of the Theme styles files
     * @param bool $child Check for files in child theme if existed. Default false
     * @return array Theme styles files list
     * @version 0.0.1
     */
    public function getThemeStyleFiles(bool $child = false): array
    {
        $theme = IDT_THEME_PATH;

        if ($child) {
            $theme = WP_CONTENT_DIR . '/themes/insomniodev-child';
        }

        $dir = $theme . '/assets/styles/scss';
        $files = [];
        $filesList = [];

        if (file_exists($dir) && is_dir($dir)) {
            $files = array_diff(scandir($dir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == 'scss') {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of the Bootstrap scripts files
     * @param string $version The Bootstrap version. Default 5.2
     * @return array Theme scripts files list
     * @version 1.0.0
     */
    public function getBootstrapScriptsFiles(string $version = '5.2'): array
    {
        $theme = IDT_THEME_PATH;

        $dir = IDT_THEME_PATH . '/assets/libs/bootstrap/versions/version-' . $version . '/js';
        $files = [];
        $filesList = [];

        if (file_exists($dir) && is_dir($dir)) {
            $files = array_diff(scandir($dir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == 'js') {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of the Fontawesome scripts files
     * @param string $version The Fontawesome version. Default 6.3
     * @return array Theme scripts files list
     * @version 1.0.0
     */
    public function getFontawesomeScriptsFiles(string $version = '6.3'): array
    {
        $theme = IDT_THEME_PATH;

        $dir = IDT_THEME_PATH . '/assets/libs/fontawesome/versions/version-' . $version . '/js';
        $files = [];
        $filesList = [];

        if (file_exists($dir) && is_dir($dir)) {
            $files = array_diff(scandir($dir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == 'js') {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of the Theme scripts files
     * @param bool $child Check for files in child theme if existed. Default false
     * @return array Theme scripts files list
     * @version 1.0.0
     */
    public function getThemeScriptsFiles(bool $child = false): array
    {
        $theme = IDT_THEME_PATH;

        if ($child) {
            $theme = WP_CONTENT_DIR . '/themes/insomniodev-child';
        }

        $dir = $theme . '/assets/scripts';
        $files = [];
        $filesList = [];

        if (file_exists($dir) && is_dir($dir)) {
            $files = array_diff(scandir($dir), ['..', '.']);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $dirFile = explode('.', $file);

                    if(!empty($dirFile) && $dirFile[array_key_last($dirFile)] == 'js') {
                        $filesList[] = $file;
                    }
                }
            }
        }

        return $filesList;
    }

    /**
     * Get a list of additional scripts files
     * @return array Additional scripts files list
     * @version 1.0.0
     */
    public function getAdditionalScriptsFiles(): array
    {
        return [
            'glide.esm.js',
            'glide.min.js',
            'glide.modular.esm.js',
            'lite-yt-embed.js',
            'slick.min.js'
        ];
    }
}