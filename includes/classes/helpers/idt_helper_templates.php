<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Return a template settings class instance
 * @param $settingsFileName string Settings file name
 * @param $settingsClassName string Settings class name
 * @param $args mixed The template post ID, page ID, term object, etc
 * @param $inChildTheme bool Check if the file and class instance to return is on the child theme settings folder. Default false
 * @return object|null Class instance if the settings class exist, else null
 */
function idtGetTplSettings(string $settingsFileName, string $settingsClassName, $args, bool $inChildTheme = false)
{
    $settings = null;
    $themePath = IDT_THEME_PATH;

    if ($inChildTheme && defined('IDT_CHILD_THEME_PATH')) {
        $themePath = IDT_CHILD_THEME_PATH;
    }

    if ($settingsFileName != '' && $settingsClassName != '' && isset($args)) {
        $classFile = $themePath . '/includes/tpl-settings/' . $settingsFileName . '.php';

        if (file_exists($classFile)) {
            include_once $classFile;
            $settingsInstance = new $settingsClassName;

            $settings = $settingsInstance->getSettings($args);
        }
    }

    return $settings;
}

/**
 * Return a theme templates list
 * @param string $type The template type
 * @param bool $inChildTheme Check if the template is on the child theme folders. Default false
 * @return array Templates list
 */
function idtGetTplList(string $type = 'wordpressTPL'): array
{
    $tplList = [];

    if ($type == 'wordpressTPL') {
        $tplList = [
            'index' => [
                'path' => get_index_template(),
                'name' => 'index.php'
            ],
            'home' => [
                'path' => get_home_template(),
                'name' => 'home.php'
            ],
            'frontpage' => [
                'path' => get_front_page_template(),
                'name' => 'front-page.php'
            ],
            'page' => [
                'path' => get_page_template(),
                'name' => 'page.php'
            ],
            'single' => [
                'path' => get_single_template(),
                'name' => 'single.php'
            ],
            'search' => [
                'path' => get_search_template(),
                'name' => 'search.php'
            ],
            'privacyPolicy' => [
                'path' => get_privacy_policy_template(),
                'name' => 'privacy-policy.php'
            ],
            '404' => [
                'path' => get_404_template(),
                'name' => '404.php'
            ],
            'archive' => [
                'path' => get_archive_template(),
                'name' => 'archive.php'
            ],
            'author' => [
                'path' => get_author_template(),
                'name' => 'author.php'
            ],
            'category' => [
                'path' => get_category_template(),
                'name' => 'category.php'
            ],
            'tag' => [
                'path' => get_tag_template(),
                'name' => 'tag.php'
            ],
            'date' => [
                'path' => get_date_template(),
                'name' => 'date.php'
            ],
            'embed' => [
                'path' => get_embed_template(),
                'name' => 'embed.php'
            ],
            'singular' => [
                'path' => get_singular_template(),
                'name' => 'singular.php'
            ],
            'attachment' => [
                'path' => get_attachment_template(),
                'name' => 'attachment.php'
            ]
        ];
    } else if ($type == 'customTPL') {
        $customTemplates = wp_get_theme()->get_page_templates();

        foreach ($customTemplates as $key => $value) {
            $tplName = basename($key);
            $listIndex = explode('.php', basename($key));

            $tplList[$listIndex[0]] = [
                'path' => $key,
                'name' => $tplName
            ];
        }
    } else if ($type == 'postType') {
        $postTypes = get_post_types();

        foreach ($postTypes as $key => $value) {
            $tplList[$key] = [
                'path' => $key,
                'name' => $value
            ];
        }
    } else if ($type == 'taxonomy') {
        $taxonomies = get_taxonomies();

        foreach ($taxonomies as $key => $value) {
            $tplList[$key] = [
                'path' => '',
                'name' => $value
            ];
        }
    }

    return $tplList;
}
