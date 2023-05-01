<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main theme database class
 * @version 0.0.1
 */

class IdtDB
{

    /**
     * Create the theme main database tables whe the theme is activated
     * @return bool Return true if all the tables was created successfully, else false
     */
    public function createTables(): bool
    {
        global $wpdb;
        $dbInstalledVersion = get_option('idt_db_version');
        $dbVersion = '1.0.0';
        $flag = true;

        if ($dbInstalledVersion != $dbVersion) {

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            $charsetCollate = $wpdb->get_charset_collate();
            $tablesNames = [
                'social' => $wpdb->prefix . 'idt_social',
                'settings' => $wpdb->prefix . 'idt_settings',
                'templates' => $wpdb->prefix . 'idt_templates',
            ];
            $queryResults = [];

            $sqlQuery = "CREATE TABLE IF NOT EXISTS `" . $tablesNames['social'] . "` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `code` VARCHAR(50) NOT NULL UNIQUE,
                `name` VARCHAR(50) NOT NULL,
                `url` LONGTEXT NOT NULL,
                `lang` VARCHAR(5) NOT NULL,
                `is_custom` BOOLEAN DEFAULT false,
                PRIMARY KEY (`id`)
            ) $charsetCollate;";

            $queryResults['social'] = $wpdb->query($sqlQuery);

            $sqlQuery = "CREATE TABLE IF NOT EXISTS `" . $tablesNames['settings'] . "` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `code` VARCHAR(50) NOT NULL UNIQUE,
                `name` VARCHAR(50) NOT NULL,
                `value` LONGTEXT NOT NULL,
                `group` VARCHAR(50) NOT NULL,
                `lang` VARCHAR(5) NOT NULL,
                PRIMARY KEY (`id`)
            ) $charsetCollate;";

            $queryResults['settings'] = $wpdb->query($sqlQuery);

            $sqlQuery = "CREATE TABLE IF NOT EXISTS `" . $tablesNames['templates'] . "` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `code` VARCHAR(50) NOT NULL UNIQUE,
                `tpl_name` VARCHAR(255) NOT NULL,
                `tpl_type` VARCHAR(255) NOT NULL,
                `critical_css` LONGTEXT NOT NULL,
                `critical_css_files` LONGTEXT NOT NULL,
                `critical_css_scss_files` LONGTEXT NOT NULL,
                `css` LONGTEXT NOT NULL,
                `css_files` LONGTEXT NOT NULL,
                `css_scss_files` LONGTEXT NOT NULL,
                `scripts_header` LONGTEXT NOT NULL,
                `scripts_header_files` LONGTEXT NOT NULL,
                `scripts_footer` LONGTEXT NOT NULL,
                `scripts_footer_files` LONGTEXT NOT NULL,
                `is_child_theme` BOOLEAN NOT NULL,
                `status` VARCHAR(10) NOT NULL,
                PRIMARY KEY (`id`)
            ) $charsetCollate;";

            $queryResults['templates'] = $wpdb->query($sqlQuery);

            foreach ($queryResults as $queryResult) {
                $flag = $queryResult;
            }

            if ($flag) {
                update_option('idt_db_version', $dbVersion);
            }
        } else {
            $flag = false;
        }

        return $flag;
    }
}