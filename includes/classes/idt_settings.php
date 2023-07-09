<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme settings class
 * @version 0.0.1
 */
class IdtSettings
{

    /**
     * Return the theme social settings
     * @param array $filters The filters for the query
     * @return array Return a settings list
     */
    public function getSocialSettings(array $filters = []): array
    {
        global $wpdb;
        $settings = [
            'socialNetworks' => [],
            'customNetworks' => []
        ];
        $order = 'DESC';
        $orderBy = 'social.id';
        $start = 0;
        $limit = 100;

        $query = "SELECT social.id AS id, ";
        $query .= "social.name AS name, ";
        $query .= "social.url AS url, ";
        $query .= "social.lang AS lang, ";
        $query .= "social.is_custom AS isCustom ";

        $query .= "FROM " . $wpdb->prefix . "idt_social AS social ";

        $where = "";

        if (isset($filters) && !empty($filters)) {

            //Pagination limit filter
            if (isset($filters['limit']) && (int)$filters['limit'] > 0) {
                $limit = (int)$filters['limit'];
            }

            //Pagination page filter
            if (isset($filters['page']) && (int)$filters['page'] > 0) {
                $page = (int)$filters['page'] - 1;
                $start = ($page * $limit);
            }

            //ID filter
            if (isset($filters['id']) && (int)$filters['id'] > 0) {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "social.id = " . (int)$filters['id'];
            }

            //Setting name filter
            if (isset($filters['name']) && $filters['name'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "social.name = '" . (string)$filters['name'] . "'";
            }

            //Setting value filter
            if (isset($filters['value']) && $filters['value'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "social.value = '" . (string)$filters['value'] . "'";
            }

            //Setting language filter
            if (isset($filters['lang']) && $filters['lang'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "social.lang = '" . (string)$filters['lang'] . "'";
            }
        }

        if ($where != '') {
            $query .= " WHERE " . $where;
        }

        $query .= " ORDER BY " . $orderBy . " " . $order . " LIMIT " . (int)$start . "," . (int)$limit;

        $query .= ";";

        $queryResults = $wpdb->get_results($query, ARRAY_A);

        if ($queryResults) {
            foreach ($queryResults as $item) {
                if (isset($item['isCustom']) && $item['isCustom']) {
                    $settings['customNetworks'][$item['name']] = [
                        'url' => $item['url'],
                        'lang' => $item['lang']
                    ];
                } else {
                    $settings['socialNetworks'][$item['name']] = [
                        'url' => $item['url'],
                        'lang' => $item['lang']
                    ];
                }
            }
        }

        return $settings;
    }

    /**
     * Create or update the theme social settings
     * @param array $values The social settings values
     * @return bool True if the social settings was created or updated successfully, else False
     */
    public function updateSocialSettings(array $values = []): bool
    {
        $queryResults = [];
        $flag = false;

        if(isset($values) && !empty($values)) {
            global $wpdb;
            $dbName = $wpdb->prefix . 'idt_social';

            foreach ($values as $key => $value) {
                if($key != 'customValues') {
                    $value = (array)$value;
                    $query = "INSERT INTO " . $dbName . " ";
                    $query .= "(`id`, `code`, `name`, `url`, `lang`, `is_custom`) ";
                    $query .= "VALUES (";
                    $query .= "'', ";
                    $query .= "'" . (string)str_replace(' ', '_', strtolower($key . '_' . $value['lang'])) . "', ";
                    $query .= "'" . (string)$key . "', ";
                    $query .= "'" . (string)$value['url'] . "', ";
                    $query .= "'" . (string)$value['lang'] . "', ";
                    $query .= "false";
                    $query .= ") ";
                    $query .= "ON DUPLICATE KEY UPDATE ";
                    $query .= "url = '" . (string)$value['url'] . "';";

                    $queryResults[] = $wpdb->query($query);
                }
            }
        }

        if (!empty($queryResults)) {
            foreach ($queryResults as $queryResult) {
                if($queryResult) {
                    $flag = true;
                }
            }
        }

        return $flag;
    }

    /**
     * Return the theme general settings
     * @param array $filters The filters for the query
     * @return array Return a settings list
     */
    public function getGeneralSettings(array $filters = []): array
    {
        global $wpdb;
        $settings = [];
        $order = 'DESC';
        $orderBy = 'settings.id';
        $start = 0;
        $limit = 100;

        $query = "SELECT settings.id AS id, ";
        $query .= "settings.code AS code, ";
        $query .= "settings.name AS name, ";
        $query .= "settings.value AS value, ";
        $query .= "settings.group AS settingsGroup, ";
        $query .= "settings.lang AS lang ";

        $query .= "FROM " . $wpdb->prefix . "idt_settings AS settings ";

        $where = "";

        if (isset($filters) && !empty($filters)) {

            //Pagination limit filter
            if (isset($filters['limit']) && (int)$filters['limit'] > 0) {
                $limit = (int)$filters['limit'];
            }

            //Pagination page filter
            if (isset($filters['page']) && (int)$filters['page'] > 0) {
                $page = (int)$filters['page'] - 1;
                $start = ($page * $limit);
            }

            //ID filter
            if (isset($filters['id']) && (int)$filters['id'] > 0) {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "settings.id = " . (int)$filters['id'];
            }

            //Setting name filter
            if (isset($filters['name']) && $filters['name'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "settings.name = '" . (string)$filters['name'] . "'";
            }

            //Setting value filter
            if (isset($filters['value']) && $filters['value'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "settings.value = '" . (string)$filters['value'] . "'";
            }

            //Setting group filter
            if (isset($filters['group']) && $filters['group'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "settings.group = '" . (string)$filters['group'] . "'";
            }

            //Setting language filter
            if (isset($filters['lang']) && $filters['lang'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "settings.lang = '" . (string)$filters['lang'] . "'";
            }
        }

        if ($where != '') {
            $query .= " WHERE " . $where;
        }

        $query .= " ORDER BY " . $orderBy . " " . $order . " LIMIT " . (int)$start . "," . (int)$limit;

        $query .= ";";

        $queryResults = $wpdb->get_results($query, ARRAY_A);

        if ($queryResults) {
            foreach ($queryResults as $item) {
                $settings[$item['name']] = [
                    'code' => $item['code'],
                    'value' => $item['value'],
                    'group' => $item['settingsGroup'],
                    'lang' => $item['lang']
                ];
            }
        }

        return $settings;
    }

    /**
     * Create or update the theme general settings
     * @param array $values The general settings values
     * @return bool True if the general settings was created or updated successfully, else False
     */
    public function updateGeneralSettings(array $values = []): bool
    {
        $queryResults = [];
        $flag = false;

        if(isset($values) && !empty($values)) {
            global $wpdb;
            $dbName = $wpdb->prefix . 'idt_settings';

            foreach ($values as $key => $value) {
                $value = (array)$value;
                $query = "INSERT INTO " . $dbName . " ";
                $query .= "(`id`, `code`, `name`, `value`, `group`, `lang`) ";
                $query .= "VALUES (";
                $query .= "'', ";
                $query .= "'" . (string)str_replace(' ', '_', strtolower($key . '_' . $value['lang'])) . "', ";
                $query .= "'" . (string)$key . "', ";
                $query .= "'" . (string)$value['value'] . "', ";
                $query .= "'" . (string)$value['group'] . "', ";
                $query .= "'" . (string)$value['lang'] . "'";
                $query .= ") ";
                $query .= "ON DUPLICATE KEY UPDATE ";
                $query .= "value = '" . (string)$value['value'] . "';";

                $queryResults[] = $wpdb->query($query);
            }
        }

        if (!empty($queryResults)) {
            foreach ($queryResults as $queryResult) {
                if($queryResult) {
                    $flag = true;
                }
            }
        }

        return $flag;
    }

    /**
     * Return the theme logos settings
     *
     * @param array $filters The filters for the query
     *
     * @return array Return a settings list
     */
    function getLogosSettings(array $filters = []): array
    {
        $filters['group'] = 'logo';

        $logos = $this->getGeneralSettings($filters);
        $settings = [];

        foreach ($logos as $key => $logo) {
            $image = [
                'id' => 0,
                'url' => '',
                'alt' => '',
                'width' => null,
                'height' => null,
            ];

            if ((int)$logo['value'] > 0) {
                $imageParams = wp_get_attachment_image_src($logo['value'], 'full');
                $imageUrl = $imageParams[0];
                $imageWidth = $imageParams[1];
                $imageHeight = $imageParams[2];
                $imageAlt = get_post_meta($logo['value'], '_wp_attachment_image_alt', true);
                $image['id'] = (int)$logo['value'];
                $image['url'] = $imageUrl;
                $image['alt'] = $imageAlt;
                $image['width'] = $imageWidth;
                $image['height'] = $imageHeight;
            } else {
                $image = null;
            }

            $settings[$key] = $image;
        }

        return $settings;
    }

    /**
     * Return the theme templates settings
     * @param array $filters The filters for the query
     * @return array Return a settings list
     */
    public function getTemplatesSettings(array $filters = []): array
    {
        global $wpdb;
        $settings = [];
        $order = 'DESC';
        $orderBy = 'templates.id';
        $start = 0;
        $limit = 100;

        $query = "SELECT templates.id AS id, ";
        $query .= "templates.code AS code, ";
        $query .= "templates.tpl_name AS templateName, ";
        $query .= "templates.tpl_type AS templateType, ";
        $query .= "templates.critical_css AS criticalCss, ";
        $query .= "templates.critical_css_files AS criticalCssFiles, ";
        $query .= "templates.critical_css_scss_files AS criticalCssScssFiles, ";
        $query .= "templates.css AS css, ";
        $query .= "templates.css_files AS cssFiles, ";
        $query .= "templates.css_scss_files AS cssScssFiles, ";
        $query .= "templates.scripts_header AS scriptsHeader, ";
        $query .= "templates.scripts_header_files AS scriptsHeaderFiles, ";
        $query .= "templates.scripts_footer AS scriptsFooter, ";
        $query .= "templates.scripts_footer_files AS scriptsFooterFiles, ";
        $query .= "templates.is_child_theme AS isChildTheme, ";
        $query .= "templates.status AS status ";

        $query .= "FROM " . $wpdb->prefix . "idt_templates AS templates ";

        $where = "";

        if (isset($filters) && !empty($filters)) {

            //Pagination limit filter
            if (isset($filters['limit']) && (int)$filters['limit'] > 0) {
                $limit = (int)$filters['limit'];
            }

            //Pagination page filter
            if (isset($filters['page']) && (int)$filters['page'] > 0) {
                $page = (int)$filters['page'] - 1;
                $start = ($page * $limit);
            }

            //ID filter
            if (isset($filters['id']) && (int)$filters['id'] > 0) {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "templates.id = " . (int)$filters['id'];
            }

            //Setting template name filter
            if (isset($filters['templateName']) && $filters['templateName'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "templates.tpl_name = '" . (string)$filters['templateName'] . "'";
            }

            //Setting template type filter
            if (isset($filters['templateType']) && $filters['templateType'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "templates.tpl_type = '" . (string)$filters['templateType'] . "'";
            }

            //Setting is child theme template filter
            if (isset($filters['isChildTheme']) && $filters['isChildTheme']) {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "templates.is_child_theme = 1";
            }

            //Setting status filter
            if (isset($filters['status']) && $filters['status'] != '') {
                if ($where != '') {
                    $where .= " AND ";
                }
                $where .= "templates.status = '" . (string)$filters['status'] . "'";
            }
        }

        if ($where != '') {
            $query .= " WHERE " . $where;
        }

        $query .= " ORDER BY " . $orderBy . " " . $order . " LIMIT " . (int)$start . "," . (int)$limit;

        $query .= ";";

        $queryResults = $wpdb->get_results($query, ARRAY_A);

        if ($queryResults) {
            $settings = $queryResults;
        }

        return $settings;
    }

    /**
     * Add a theme template settings
     * @param array $values The template settings values
     * @return bool True if the template settings was created successfully, else False
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    public function createTemplateSettings(array $values = [])
    {
        $queryResults = [];
        $flag = false;

        if(isset($values) && !empty($values)) {
            global $wpdb;
            include_once IDT_THEME_PATH . '/includes/classes/idt_scss_compiler.php';
            $scssCompiler = new IdtScssCompiler();
            $dbName = $wpdb->prefix . 'idt_templates';
            $values = (array)$values;

            $resources = $this->getTemplateSettingsResources($values);

            $query = "INSERT INTO " . $dbName . " ";
            $query .= "(`id`, `code`, `tpl_name`, `tpl_type`, `critical_css`, `critical_css_files`, `critical_css_scss_files`, `css`, `css_files`, `css_scss_files`, `scripts_header`, `scripts_header_files`, `scripts_footer`, `scripts_footer_files`, `is_child_theme`, `status`) ";
            $query .= "VALUES (";
            $query .= "'', ";
            $query .= "'" . (string)str_replace('.php', '', strtolower($values['templateName'])) . "', ";
            $query .= "'" . (string)$values['templateName'] . "', ";
            $query .= "'" . (string)$values['templateType'] . "', ";
            $query .= "'" . json_encode($resources['criticalCss']) . "', ";
            $query .= "'" . json_encode((array)$values['criticalCss']) . "', ";
            $query .= "'" . json_encode((array)$values['criticalCssScssFiles']) . "', ";
            $query .= "'" . json_encode($resources['css']) . "', ";
            $query .= "'" . json_encode((array)$values['css']) . "', ";
            $query .= "'" . json_encode((array)$values['cssScssFiles']) . "', ";
            $query .= "'" . json_encode($resources['headerScripts']) . "', ";
            $query .= "'" . json_encode((array)$values['headerScripts']) . "', ";
            $query .= "'" . json_encode($resources['footerScripts']) . "', ";
            $query .= "'" . json_encode((array)$values['footerScripts']) . "', ";
            $query .= 0 . ", ";
            $query .= "'" . (string)$values['status'] . "' ";
            $query .= ") ";

            $queryResults[] = $wpdb->query($query);
        }

        if (!empty($queryResults)) {
            foreach ($queryResults as $queryResult) {
                if($queryResult) {
                    $flag = true;
                }
            }
        }

        return $flag;

//        return $queryResults;
    }

    /**
     * Create or update the theme general settings
     * @param array $values The general settings values
     * @return bool True if the general settings was created or updated successfully, else False
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    public function updateTemplateSettings(array $values = [])
    {
        $queryResults = [];
        $flag = false;

        if(isset($values) && !empty($values) && isset($values['id'])) {
            global $wpdb;
            include_once IDT_THEME_PATH . '/includes/classes/idt_scss_compiler.php';
            $scssCompiler = new IdtScssCompiler();
            $dbName = $wpdb->prefix . 'idt_templates';
            $values = (array)$values;

            $resources = $this->getTemplateSettingsResources($values);

            $query = "UPDATE " . $dbName . " ";
            $query .= "SET ";
            $query .= "code = '" . (string)str_replace('.php', '', strtolower($values['templateName'])) . "', ";
            $query .= "tpl_name = '" . (string)$values['templateName'] . "', ";
            $query .= "tpl_type = '" . (string)$values['templateType'] . "', ";
            $query .= "critical_css = '" . json_encode($resources['criticalCss']) . "', ";
            $query .= "critical_css_files = '" . json_encode((array)$values['criticalCss']) . "', ";
            $query .= "critical_css_scss_files = '" . json_encode((array)$values['criticalCssScssFiles']) . "', ";
            $query .= "css = '" . json_encode($resources['css']) . "', ";
            $query .= "css_files = '" . json_encode((array)$values['css']) . "', ";
            $query .= "css_scss_files = '" . json_encode((array)$values['cssScssFiles']) . "', ";
            $query .= "scripts_header = '" . json_encode($resources['headerScripts']) . "', ";
            $query .= "scripts_header_files = '" . json_encode((array)$values['headerScripts']) . "', ";
            $query .= "scripts_footer = '" . json_encode($resources['footerScripts']) . "', ";
            $query .= "scripts_footer_files = '" . json_encode((array)$values['footerScripts']) . "', ";
            $query .= "status = '" . (string)$values['status'] . "' ";

            $query .= "WHERE id = " . (int)$values['id'] . ";";

            $queryResults[] = $wpdb->query($query);
        }

        if (!empty($queryResults)) {
            foreach ($queryResults as $queryResult) {
                if($queryResult) {
                    $flag = true;
                }
            }
        }

        return $flag;

//        return $queryResults;
    }

    /**
     * Create and generate a template resources
     * @param array $values The template settings values
     * @return array The template resources data
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    private function getTemplateSettingsResources(array $values = []): array
    {
        include_once IDT_THEME_PATH . '/includes/classes/idt_scss_compiler.php';
        $scssCompiler = new IdtScssCompiler();
        $wpUploadsDir = wp_upload_dir();
        $resources = [
            'criticalCss' => [],
            'criticalCssScssPaths' => [],
            'criticalCssScssFiles' => [],
            'css' => [],
            'cssScssPaths' => [],
            'cssScssFiles' => [],
            'headerScripts' => [],
            'footerScripts' => []
        ];
        $dirs = [
            'path' => [
                'bootstrap' => IDT_THEME_PATH . '/assets/libs/bootstrap/versions/version-5.2',
                'fontawesome' => IDT_THEME_PATH . '/assets/libs/fontawesome/versions/version-6.3',
                'animate' => IDT_THEME_PATH . '/assets/libs/animate',
                'glide' => IDT_THEME_PATH . '/assets/libs/glide',
                'lite-youtube-embed' => IDT_THEME_PATH . '/assets/libs/lite-youtube-embed',
                'theme' => IDT_THEME_PATH,
                'childTheme' => file_exists(WP_CONTENT_DIR . '/themes/insomniodev-child') ? IDT_CHILD_THEME_PATH : '',
                'childThemeCssPath' => file_exists(WP_CONTENT_DIR . '/themes/insomniodev-child') ? IDT_CHILD_THEME_PATH . '/assets/styles/css/' : '',
                'wpUploads' => $wpUploadsDir['basedir'] . '/insomniodev'
            ],
            'dir' => [
                'bootstrap' => IDT_THEME_DIR . '/assets/libs/bootstrap/versions/version-5.2',
                'fontawesome' => IDT_THEME_DIR . '/assets/libs/fontawesome/versions/version-6.3',
                'animate' => IDT_THEME_DIR . '/assets/libs/animate',
                'glide' => IDT_THEME_DIR . '/assets/libs/glide',
                'lite-youtube-embed' => IDT_THEME_DIR . '/assets/libs/lite-youtube-embed',
                'theme' => IDT_THEME_DIR,
                'childTheme' => file_exists(WP_CONTENT_DIR . '/themes/insomniodev-child') ? IDT_CHILD_THEME_DIR : '',
                'childThemeCssPath' => file_exists(WP_CONTENT_DIR . '/themes/insomniodev-child') ? IDT_CHILD_THEME_DIR . '/assets/styles/css/' : '',
                'wpUploads' => $wpUploadsDir['baseurl'] . '/insomniodev'
            ]
        ];

        if (!file_exists($dirs['path']['wpUploads'] . '/css/')){
            wp_mkdir_p($dirs['path']['wpUploads'] . '/css/');
        }

        /**
         * Critical CSS
         */
        if (isset($values['criticalCss'])) {
            if (isset($values['criticalCss']->bootstrap) && !empty($values['criticalCss']->bootstrap)) {
                foreach ($values['criticalCss']->bootstrap as $file) {
                    $resources['criticalCss'][] = $dirs['dir']['bootstrap'] . '/css/' . $file;
                }
            }

            if (isset($values['criticalCss']->fontawesome) && !empty($values['criticalCss']->fontawesome)) {
                foreach ($values['criticalCss']->fontawesome as $file) {
                    $resources['criticalCss'][] = $dirs['dir']['fontawesome'] . '/css/' . $file;
                }
            }

            if (isset($values['criticalCss']->additional) && !empty($values['criticalCss']->additional)) {
                foreach ($values['criticalCss']->additional as $file) {
                    if ($file == 'animate.min.css') {
                        $resources['criticalCss'][] = $dirs['dir']['animate'] . '/css/' . $file;
                    } else if ($file == 'glide.core.min.css' || $file == 'glide.core.css') {
                        $resources['criticalCss'][] = $dirs['dir']['glide'] . '/css/' . $file;
                    } else if ($file == 'lite-yt-embed.css') {
                        $resources['criticalCss'][] = $dirs['dir']['lite-youtube-embed'] . '/' . $file;
                    }
                }
            }

            if (isset($values['criticalCss']->theme) && !empty($values['criticalCss']->theme)) {
                foreach ($values['criticalCss']->theme as $file) {
                    $resources['criticalCss'][] = $dirs['dir']['theme'] . '/assets/css/' . $file;
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['criticalCss']->childTheme) && !empty($values['criticalCss']->childTheme)) {
                foreach ($values['criticalCss']->childTheme as $file) {
                    $resources['criticalCss'][] = $dirs['dir']['childTheme'] . '/assets/css/' . $file;
                }
            }
        }

        /**
         * Critical CSS Scss files to compile
         */
        if (isset($values['criticalCssScssFiles'])) {
            if (isset($values['criticalCssScssFiles']->bootstrap) && !empty($values['criticalCssScssFiles']->bootstrap)) {
                $resources['criticalCssScssPaths'][] = $dirs['path']['bootstrap'] . '/scss';

                $scssSettings = [
                    'path' => $dirs['path']['bootstrap'] . '/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'critical-bootstrap-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                $scssSettings['compileString'] .= '@import "_functions.scss";';
                $scssSettings['compileString'] .= '@import "_variables.scss";';
                $scssSettings['compileString'] .= '@import "_maps.scss";';
                $scssSettings['compileString'] .= '@import "_maps.scss";';
                $scssSettings['compileString'] .= '@import "_mixins.scss";';
                $scssSettings['compileString'] .= '@import "_utilities.scss";';

                foreach ($values['criticalCssScssFiles']->bootstrap as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['criticalCss'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if (isset($values['criticalCssScssFiles']->fontawesome) && !empty($values['criticalCssScssFiles']->fontawesome)) {
                $resources['criticalCssScssPaths'][] = $dirs['path']['fontawesome'] . '/scss';

                $scssSettings = [
                    'path' => $dirs['path']['fontawesome'] . '/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'critical-fontawesome-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                $scssSettings['compileString'] .= '@import "_functions.scss";';
                $scssSettings['compileString'] .= '@import "_variables.scss";';
                $scssSettings['compileString'] .= '@import "_mixins.scss";';

                foreach ($values['criticalCssScssFiles']->fontawesome as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['criticalCss'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if (isset($values['criticalCssScssFiles']->theme) && !empty($values['criticalCssScssFiles']->theme)) {
                $resources['criticalCssScssPaths'][] = $dirs['path']['theme'] . '/assets/styles/scss';

                $scssSettings = [
                    'path' => $dirs['path']['theme'] . '/assets/styles/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'critical-theme-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                foreach ($values['criticalCssScssFiles']->theme as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['criticalCss'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['criticalCssScssFiles']->childTheme) && !empty($values['criticalCssScssFiles']->childTheme)) {
                $resources['criticalCssScssPaths'][] = $dirs['path']['childTheme'] . '/assets/styles/scss';

                $scssSettings = [
                    'path' => $dirs['path']['childTheme'] . '/assets/styles/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'critical-child-theme-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                foreach ($values['criticalCssScssFiles']->childTheme as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                $resources['criticalChildTheme'] = $compileResult;

                if ($compileResult['compileResult']) {
                    $resources['criticalCss'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }
        }

        /**
         * CSS
         */
        if (isset($values['css'])) {
            if (isset($values['css']->bootstrap) && !empty($values['css']->bootstrap)) {
                foreach ($values['css']->bootstrap as $file) {
                    $resources['css'][] = $dirs['dir']['bootstrap'] . '/css/' . $file;
                }
            }

            if (isset($values['css']->fontawesome) && !empty($values['css']->fontawesome)) {
                foreach ($values['css']->fontawesome as $file) {
                    $resources['css'][] = $dirs['dir']['fontawesome'] . '/css/' . $file;
                }
            }

            if (isset($values['css']->additional) && !empty($values['css']->additional)) {
                foreach ($values['css']->additional as $file) {
                    if ($file == 'animate.min.css') {
                        $resources['css'][] = $dirs['dir']['animate'] . '/css/' . $file;
                    } else if ($file == 'glide.core.min.css' || $file == 'glide.core.css') {
                        $resources['css'][] = $dirs['dir']['glide'] . '/css/' . $file;
                    } else if ($file == 'lite-yt-embed.css') {
                        $resources['css'][] = $dirs['dir']['lite-youtube-embed'] . '/' . $file;
                    }
                }
            }

            if (isset($values['css']->theme) && !empty($values['css']->theme)) {
                foreach ($values['css']->theme as $file) {
                    $resources['css'][] = $dirs['dir']['theme'] . '/assets/css/' . $file;
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['css']->childTheme) && !empty($values['css']->childTheme)) {
                foreach ($values['css']->childTheme as $file) {
                    $resources['css'][] = $dirs['dir']['childTheme'] . '/assets/css/' . $file;
                }
            }
        }

        /**
         * CSS Scss files to compile
         */
        if (isset($values['cssScssFiles'])) {
            if (isset($values['cssScssFiles']->bootstrap) && !empty($values['cssScssFiles']->bootstrap)) {
                $resources['cssScssPaths'][] = $dirs['path']['bootstrap'] . '/scss';

                $scssSettings = [
                    'path' => $dirs['path']['bootstrap'] . '/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'styles-bootstrap-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                $scssSettings['compileString'] .= '@import "_functions.scss";';
                $scssSettings['compileString'] .= '@import "_variables.scss";';
                $scssSettings['compileString'] .= '@import "_maps.scss";';
                $scssSettings['compileString'] .= '@import "_maps.scss";';
                $scssSettings['compileString'] .= '@import "_mixins.scss";';
                $scssSettings['compileString'] .= '@import "_utilities.scss";';

                foreach ($values['cssScssFiles']->bootstrap as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['css'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if (isset($values['cssScssFiles']->fontawesome) && !empty($values['cssScssFiles']->fontawesome)) {
                $resources['cssScssPaths'][] = $dirs['path']['fontawesome'] . '/scss';

                $scssSettings = [
                    'path' => $dirs['path']['fontawesome'] . '/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'styles-fontawesome-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                $scssSettings['compileString'] .= '@import "_functions.scss";';
                $scssSettings['compileString'] .= '@import "_variables.scss";';
                $scssSettings['compileString'] .= '@import "_mixins.scss";';

                foreach ($values['criticalCssScssFiles']->fontawesome as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['css'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if (isset($values['cssScssFiles']->theme) && !empty($values['cssScssFiles']->theme)) {
                $resources['cssScssPaths'][] = $dirs['path']['theme'] . '/assets/styles/scss';

                $scssSettings = [
                    'path' => $dirs['path']['theme'] . '/assets/styles/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'styles-theme-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                foreach ($values['cssScssFiles']->theme as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['css'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['cssScssFiles']->childTheme) && !empty($values['cssScssFiles']->childTheme)) {
                $resources['cssScssPaths'][] = $dirs['path']['childTheme'] . '/assets/styles/scss';

                $scssSettings = [
                    'path' => $dirs['path']['childTheme'] . '/assets/styles/scss',
                    'importFileName' => 'compiled',
                    'outputPath' => $dirs['path']['childThemeCssPath'] != '' ? $dirs['path']['childThemeCssPath'] : $dirs['path']['wpUploads'] . '/css/',
                    'outputDir' => $dirs['dir']['childThemeCssPath'] != '' ? $dirs['dir']['childThemeCssPath'] : $dirs['dir']['wpUploads'] . '/css/',
                    'cssFileName' => 'styles-child-theme-' . str_replace('.php', '', $values['templateName']),
                    'compress' => true,
                    'compileString' => ''
                ];

                foreach ($values['cssScssFiles']->childTheme as $file) {
                    $scssSettings['compileString'] .= '@import "' . $file . '";';
                }

                $compileResult = $scssCompiler->compileScss($scssSettings);

                if ($compileResult['compileResult']) {
                    $resources['css'][] = $scssSettings['outputDir'] . $compileResult['cssFileName'];
                }
            }
        }

        /**
         * Header scripts
         */
        if (isset($values['headerScripts'])) {
            if (isset($values['headerScripts']->bootstrap) && !empty($values['headerScripts']->bootstrap)) {
                foreach ($values['headerScripts']->bootstrap as $file) {
                    $resources['headerScripts'][] = $dirs['dir']['bootstrap'] . '/js/' . $file;
                }
            }

            if (isset($values['headerScripts']->fontawesome) && !empty($values['headerScripts']->fontawesome)) {
                foreach ($values['headerScripts']->fontawesome as $file) {
                    $resources['headerScripts'][] = $dirs['dir']['fontawesome'] . '/js/' . $file;
                }
            }

            if (isset($values['headerScripts']->additional) && !empty($values['headerScripts']->additional)) {
                foreach ($values['headerScripts']->additional as $file) {
                    if ($file == 'glide.esm.js' || $file == 'glide.min.js' || $file == 'glide.modular.esm.js') {
                        $resources['headerScripts'][] = $dirs['dir']['glide'] . '/' . $file;
                    } else if ($file == 'lite-yt-embed.js') {
                        $resources['headerScripts'][] = $dirs['dir']['lite-youtube-embed'] . '/' . $file;
                    } else if ($file == 'slick.min.js') {
                        $resources['headerScripts'][] = $dirs['dir']['slick'] . '/' . $file;
                    }
                }
            }

            if (isset($values['headerScripts']->theme) && !empty($values['headerScripts']->theme)) {
                foreach ($values['headerScripts']->theme as $file) {
                    $resources['headerScripts'][] = $dirs['dir']['theme'] . '/assets/scripts/' . $file;
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['headerScripts']->childTheme) && !empty($values['headerScripts']->childTheme)) {
                foreach ($values['headerScripts']->childTheme as $file) {
                    $resources['headerScripts'][] = $dirs['dir']['childTheme'] . '/assets/scripts/' . $file;
                }
            }
        }

        //Footer scripts
        if (isset($values['footerScripts'])) {
            if (isset($values['footerScripts']->bootstrap) && !empty($values['footerScripts']->bootstrap)) {
                foreach ($values['footerScripts']->bootstrap as $file) {
                    $resources['footerScripts'][] = $dirs['dir']['bootstrap'] . '/js/' . $file;
                }
            }

            if (isset($values['footerScripts']->fontawesome) && !empty($values['headerScripts']->fontawesome)) {
                foreach ($values['footerScripts']->fontawesome as $file) {
                    $resources['footerScripts'][] = $dirs['dir']['footerScripts'] . '/js/' . $file;
                }
            }

            if (isset($values['footerScripts']->additional) && !empty($values['footerScripts']->additional)) {
                foreach ($values['footerScripts']->additional as $file) {
                    if ($file == 'glide.esm.js' || $file == 'glide.min.js' || $file == 'glide.modular.esm.js') {
                        $resources['footerScripts'][] = $dirs['dir']['glide'] . '/' . $file;
                    } else if ($file == 'lite-yt-embed.js') {
                        $resources['footerScripts'][] = $dirs['dir']['lite-youtube-embed'] . '/' . $file;
                    } else if ($file == 'slick.min.js') {
                        $resources['footerScripts'][] = $dirs['dir']['slick'] . '/' . $file;
                    }
                }
            }

            if (isset($values['footerScripts']->theme) && !empty($values['footerScripts']->theme)) {
                foreach ($values['footerScripts']->theme as $file) {
                    $resources['footerScripts'][] = $dirs['dir']['theme'] . '/assets/scripts/' . $file;
                }
            }

            if ($dirs['path']['childTheme'] != '' && isset($values['footerScripts']->childTheme) && !empty($values['footerScripts']->childTheme)) {
                foreach ($values['footerScripts']->childTheme as $file) {
                    $resources['footerScripts'][] = $dirs['dir']['childTheme'] . '/assets/scripts/' . $file;
                }
            }
        }

        return $resources;
    }

    /**
     * Return the theme options
     * @param string $optionsGroupName Options group name
     * @return array Theme options by group. If empty will return all the options
     */
    public function getThemeOptions(string $optionsGroupName = '') : array
    {
        $options = [];

        switch ($optionsGroupName) {
            case 'logos':
                $section_options = get_option( 'idt_logo' );
                if ( $section_options ) {
                    $options[ 'default' ] = $section_options;
                    $options[ 'default' ][ 'alt' ] = get_post_meta( $options[ 'default' ][ 'id' ], '_wp_attachment_image_alt', true );
                    $options[ 'default' ][ 'title' ] = get_the_title( $options[ 'default' ][ 'id' ] );
                } else {
                    $options[ 'default' ][ 'id' ] = 0;
                    $options[ 'default' ][ 'alt' ] = '';
                    $options[ 'default' ][ 'title' ] = '';
                }
                break;
            case 'menu':
                $section_options = get_option( 'idt_menu' );
                if ( $section_options ) {
                    $options[ 'active_dropdown' ] = $section_options;
                } else {
                    $options[ 'active_dropdown' ] = '';
                }
                break;
            case 'blog':
                $section_options = get_option( 'idt_blog' );
                if ( $section_options ) {

                    $banner = $section_options[ 'banner' ];
                    $options[ 'banner' ] = $banner;
                    $options[ 'banner' ][ 'alt' ] = get_post_meta( $banner[ 'id' ], '_wp_attachment_image_alt', true );
                    $options[ 'banner' ][ 'title' ] = get_the_title( $banner[ 'id' ] );

                    $posts = $section_options[ 'posts' ];
                    $options[ 'posts' ] = $posts;
                    $options[ 'posts' ][ 'default_image' ][ 'alt' ] = get_post_meta( $posts[ 'default_image' ][ 'id' ], '_wp_attachment_image_alt', true );
                    $options[ 'posts' ][ 'default_image' ][ 'title' ] = get_the_title( $posts[ 'default_image' ][ 'id' ] );

                } else {

                    $options[ 'banner' ][ 'id' ] = 0;
                    $options[ 'banner' ][ 'alt' ] = '';
                    $options[ 'banner' ][ 'title' ] = '';

                    $options[ 'posts' ][ 'default_image' ][ 'id' ] = 0;
                    $options[ 'posts' ][ 'default_image' ][ 'alt' ] = '';
                    $options[ 'posts' ][ 'default_image' ][ 'title' ] = '';

                }
                break;
            case 'social':
                $optionsGroup = get_option('idtOptionsSocial');

                if (isset($optionsGroup) && !empty($optionsGroup)) {
                    $options = $optionsGroup;
                }
                break;
            case 'performance':
                $optionsGroup = get_option('idtOptionsPerformance');

                if (isset($optionsGroup) && !empty($optionsGroup)) {
                    $options = $optionsGroup;
                }
                break;
            case 'performanceScssCompiler':
                $optionsGroup = get_option('idtOptionsPerformanceScssCompiler');

                if (isset($optionsGroup) && !empty($optionsGroup)) {
                    $options = $optionsGroup;
                }
                break;
            case 'performanceResources':
                $optionsGroup = get_option('idtOptionsPerformanceResources');

                if (isset($optionsGroup) && !empty($optionsGroup)) {
                    $options = $optionsGroup;
                }
                break;
            case '404':
                $section_options = get_option( 'idt_404' );
                if ( $section_options ) {
                    $banner = $section_options[ 'banner' ];
                    $options[ 'banner' ] = $banner;
                    $options[ 'banner' ][ 'alt' ] = get_post_meta( $banner[ 'id' ], '_wp_attachment_image_alt', true );
                    $options[ 'banner' ][ 'title' ] = get_the_title( $banner[ 'id' ] );
                } else {
                    $options[ 'banner' ][ 'id' ] = 0;
                    $options[ 'banner' ][ 'alt' ] = '';
                    $options[ 'banner' ][ 'title' ] = '';
                }
                break;
            case 'search':
                $section_options = get_option( 'idt_search' );
                if ( $section_options ) {
                    $banner = $section_options[ 'banner' ];
                    $options[ 'banner' ] = $banner;
                    $options[ 'banner' ][ 'alt' ] = get_post_meta( $banner[ 'id' ], '_wp_attachment_image_alt', true );
                    $options[ 'banner' ][ 'title' ] = get_the_title( $banner[ 'id' ] );
                } else {
                    $options[ 'banner' ][ 'id' ] = 0;
                    $options[ 'banner' ][ 'alt' ] = '';
                    $options[ 'banner' ][ 'title' ] = '';
                }
                break;
            case 'copyright':
                $section_options = get_option( 'idt_copyright' );
                if ( $section_options ) {
                    $options[ 'default' ] = $section_options;
                } else {
                    $options[ 'default' ] = '';
                }
                break;
            default :
                $options = [];
                break;
        }

        return $options;
    }
}