<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Handler the admin dashboard fetch requests
 * @version 0.0.1
 */
class IdtAdminFetchHandler
{
    /**
     * Controller for the incoming admin fetch requests
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     * @version 0.0.1
     */
    public static function adminRequestsRouter()
    {
        $data = file_get_contents('php://input');

        $response = [
            'message' => '',
            'errors' => []
        ];
        $code = 0;

        if (isset($data)) {
            $data = json_decode($data);
            $group = $data->group;
            $method = $data->method;
            $args = [];

            if (is_object($data->data)) {
                $args = (array)$data->data;
            }

            switch ($group) {
                case 'templates':
                    require_once IDT_THEME_PATH . '/admin/includes/classes/idt_admin_templates.php';
                    $templates = new IdtAdminTemplates();

                    switch ($method) {
                        case 'getTemplate':
                            $template = $templates->getAdminTemplate($args['templateName']);

                            if ($template != '') {
                                $response['message'] = $template;
                            } else {
                                $response['errors'][] = __('Not found', 'insomniodev');
                            }

                            $response['status'] = 200;
                            break;
                        case 'getTemplatesList':
                            $response['message'] = $templates->getTemplatesList($args['tplType']);
                            $code = 200;
                            break;
                        default:
                            $response['errors'][] = __('No method match for the query.', 'insomniodev');
                            $response['status'] = 404;
                            break;
                    }
                    break;
                case 'settings':
                    $settings = new IdtSettings();

                    switch ($method) {
                        case 'updateSocialSettings':
                            if ($settings->updateSocialSettings($args)) {
                                $response['message'] = __('Changes saved successfully', 'insomniodev');
                            } else {
                                $response['message'] = __('Not changes to save', 'insomniodev');
                            }
                            $code = 200;
                            break;
                        case 'getSocialSettings':
                            $response['message'] = $settings->getSocialSettings($args);
                            $code = 200;
                            break;
                        case 'updateGeneralSettings':
                        case 'updateLogosSettings':
                            if ($settings->updateGeneralSettings($args)) {
                                $response['message'] = __('Changes saved successfully', 'insomniodev');
                            } else {
                                $response['message'] = __('Not changes to save', 'insomniodev');
                            }
                            $code = 200;
                            break;
                        case 'getGeneralSettings':
                            $response['message'] = $settings->getGeneralSettings($args);
                            $code = 200;
                            break;
                        case 'getLogosSettings':
                            $response['message'] = $settings->getLogosSettings($args);
                            $code = 200;
                            break;
                        case 'getTemplatesSettings':
                            $response['message'] = $settings->getTemplatesSettings($args);
                            $code = 200;
                            break;
                        case 'createTemplateSetting':
//                            $data = $settings->createTemplateSettings($args);
//                            $response['message'] = $data;
                            if ($settings->createTemplateSettings($args)) {
                                $response['message'] = __('Changes saved successfully', 'insomniodev');
                            } else {
                                $response['message'] = __('Not changes to save', 'insomniodev');
                            }
                            $code = 200;
                            break;
                        case 'updateTemplateSetting':
//                            $data = $settings->updateTemplateSettings($args);
//                            $response['message'] = $data;
                            if ($settings->updateTemplateSettings($args)) {
                                $response['message'] = __('Changes saved successfully', 'insomniodev');
                            } else {
                                $response['message'] = __('Not changes to save', 'insomniodev');
                            }
                            $code = 200;
                            break;
                        default:
                            $response['errors'][] = __('No method match for the query.', 'insomniodev');
                            $code = 404;
                            break;
                    }

                    wp_send_json($response, $code);
                    break;
                default:
                    $response['errors'][] = __('No group match for the query.', 'b2chat-tools');
                    $response['status'] = 404;
                    break;
            }

        } else {
            $response['errors'][] = __('Empty data.', 'b2chat-tools');
            $response['status'] = 200;
        }

        echo json_encode($response);
        wp_die();
    }
}