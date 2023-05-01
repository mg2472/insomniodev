<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Admin templates class
 * @version 0.0.1
 */
class IdtAdminTemplates
{
    /**
     * Get a theme admin template
     * @param string $templateName The admin template relative path
     * @return string Admin template
     */
    public function getAdminTemplate(string $templateName = ''): string
    {
        if (!isset($templateName) || $templateName == '') {
            $templateName = 'messages/tpl-not-found';
        }

        ob_start();
        get_template_part('admin/templates/' . $templateName);
        return ob_get_clean();
    }

    /**
     * Get a list of available theme templates
     * @param string $templatesType The templates type
     * @return array Templates list
     */
    public function getTemplatesList(string $templatesType = ''): array
    {
        return idtGetTplList($templatesType);
    }
}