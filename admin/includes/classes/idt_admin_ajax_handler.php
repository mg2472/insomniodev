<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
/*
 * Clase encargada del manejo de las peticiones ajax del administrador del tema
 * @version 0.0.1
*/
class idt_admin_ajax_handler {

	/*
	* Busca un template administrativo del tema
	* @return void
	*/
	public function get_admin_template() {
		$tpl = $_POST[ 'data' ];
		if ( !isset( $tpl ) || $tpl == '' ) {
			$tpl = 'sections/messages/tpl-not-found';
		}
		ob_start();
		get_template_part( 'admin/templates/' . $tpl );
		$response = ob_get_clean();
		echo json_encode( $response );
		wp_die();
	}

	/*
	* Guarda la configuraciones del tema
	* @return void
	*/
	public function save_settings() {
		$settings = $_POST[ 'data' ];

		$response = [
			'status' => 0,
			'message' => __( 'It was not possible to save the changes', 'insomniodev' )
		];

		if ( isset( $settings[ 'section' ] ) && $settings[ 'section' ] != '' ) {

			switch ( $settings[ 'section' ] ) {
				case 'logos':
					update_option( 'idt_logo', [ 'id' => (int)$settings[ 'settings' ][ 'default' ][0], 'url' => $settings[ 'settings' ][ 'default' ][1] ] );
					break;
				case 'blog':
					$blog = [
						'banner' => [
							'id' => 0,
							'url' => '',
						],
						'posts' => [
							'default_image' => [
								'id' => 0,
								'url' => '',
							]
						],
					];
					if ( isset( $settings[ 'settings' ][ 'banner' ][ 'bannerId' ] ) && $settings[ 'settings' ][ 'banner' ][ 'bannerId' ] != '' ) {
						$blog[ 'banner' ][ 'id' ] = $settings[ 'settings' ][ 'banner' ][ 'bannerId' ];
						$blog[ 'banner' ][ 'url' ] = $settings[ 'settings' ][ 'banner' ][ 'bannerUrl' ];
					}
					if ( isset( $settings[ 'settings' ][ 'posts' ][ 'postsImageId' ] ) && $settings[ 'settings' ][ 'posts' ][ 'postsImageId' ] != '' ) {
						$blog[ 'posts' ][ 'default_image' ][ 'id' ] = $settings[ 'settings' ][ 'posts' ][ 'postsImageId' ];
						$blog[ 'posts' ][ 'default_image' ][ 'url' ] = $settings[ 'settings' ][ 'posts' ][ 'postsImageUrl' ];
					}
					update_option( 'idt_blog', $blog );
					break;
                case 'menu' :
                    $active_dropdown = '';

                    if ( isset( $settings[ 'settings' ][ 'active_dropdown' ] ) && $settings[ 'settings' ][ 'active_dropdown' ] != '' ) {
                        $active_dropdown = $settings[ 'settings' ][ 'active_dropdown' ];
                    }

                    update_option( 'idt_menu', $active_dropdown );
                    break;
				case 'social':
					$social = [];

					if ( isset( $settings[ 'settings' ][ 'default' ][0] ) && $settings[ 'settings' ][ 'default' ][0] != '' ) {
						$social[ 'facebook' ] = $settings[ 'settings' ][ 'default' ][0];
					} else {
						$social[ 'facebook' ] = '';
					}

					if ( isset( $settings[ 'settings' ][ 'default' ][1] ) && $settings[ 'settings' ][ 'default' ][1] != '' ) {
						$social[ 'instagram' ] = $settings[ 'settings' ][ 'default' ][1];
					} else {
						$social[ 'instagram' ] = '';
					}

					if ( isset( $settings[ 'settings' ][ 'default' ][2] ) && $settings[ 'settings' ][ 'default' ][2] != '' ) {
						$social[ 'twitter' ] = $settings[ 'settings' ][ 'default' ][2];
					} else {
						$social[ 'twitter' ] = '';
					}

					if ( isset( $settings[ 'settings' ][ 'default' ][3] ) && $settings[ 'settings' ][ 'default' ][3] != '' ) {
						$social[ 'youtube' ] = $settings[ 'settings' ][ 'default' ][3];
					} else {
						$social[ 'youtube' ] = '';
					}

					if ( isset( $settings[ 'settings' ][ 'default' ][4] ) && $settings[ 'settings' ][ 'default' ][4] != '' ) {
						$social[ 'whatsapp' ] = $settings[ 'settings' ][ 'default' ][4];
					} else {
						$social[ 'whatsapp' ] = '';
					}

					if ( isset( $settings[ 'settings' ][ 'default' ][5] ) && $settings[ 'settings' ][ 'default' ][5] != '' ) {
						$social[ 'linkedin' ] = $settings[ 'settings' ][ 'default' ][5];
					} else {
						$social[ 'linkedin' ] = '';
					}

					update_option( 'idt_social', $social );
					break;
				case 'taxonomies':
					$taxonomies = [];

					if ( isset( $settings[ 'settings' ][ 'active' ][0] ) && $settings[ 'settings' ][ 'active' ][0] == 'true' ) {
						$taxonomies[ 'active' ][ 'portfolio' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'portfolio' ] = false;
					}

					if ( isset( $settings[ 'settings' ][ 'active' ][1] ) && $settings[ 'settings' ][ 'active' ][1] == 'true' ) {
						$taxonomies[ 'active' ][ 'testimony' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'testimony' ] = false;
					}

					if ( isset( $settings[ 'settings' ][ 'active' ][2] ) && $settings[ 'settings' ][ 'active' ][2] == 'true' ) {
						$taxonomies[ 'active' ][ 'team' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'team' ] = false;
					}

					if ( isset( $settings[ 'settings' ][ 'active' ][3] ) && $settings[ 'settings' ][ 'active' ][3] == 'true' ) {
						$taxonomies[ 'active' ][ 'gallery' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'gallery' ] = false;
					}

					if ( isset( $settings[ 'settings' ][ 'active' ][4] ) && $settings[ 'settings' ][ 'active' ][4] == 'true' ) {
						$taxonomies[ 'active' ][ 'client' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'client' ] = false;
					}

					if ( isset( $settings[ 'settings' ][ 'active' ][5] ) && $settings[ 'settings' ][ 'active' ][5] == 'true' ) {
						$taxonomies[ 'active' ][ 'value' ] = true;
					} else {
						$taxonomies[ 'active' ][ 'value' ] = false;
					}

					update_option( 'idt_taxonomies', $taxonomies );
					break;
				case 'error404':
					$error404 = [];
					if ( isset( $settings[ 'settings' ][ 'banner' ][0] ) && $settings[ 'settings' ][ 'banner' ][0] != '' ) {
						$error404[ 'banner' ] = [
							'id' => $settings[ 'settings' ][ 'banner' ][0],
							'url' => $settings[ 'settings' ][ 'banner' ][1],
						];
					}
					update_option( 'idt_404', $error404 );
					break;
				case 'search':
					$search = [];
					if ( isset( $settings[ 'settings' ][ 'banner' ][0] ) && $settings[ 'settings' ][ 'banner' ][0] != '' ) {
						$search[ 'banner' ] = [
							'id' => $settings[ 'settings' ][ 'banner' ][0],
							'url' => $settings[ 'settings' ][ 'banner' ][1],
						];
					}
					update_option( 'idt_search', $search );
					break;
				case 'copyright':
					$copyright = '';

					if ( isset( $settings[ 'settings' ][ 'default' ] ) && $settings[ 'settings' ][ 'default' ] != '' ) {
						$copyright = $settings[ 'settings' ][ 'default' ];
					}

					update_option( 'idt_copyright', $copyright );
					break;
			}

			$response[ 'status' ] = 1;
			$response[ 'message' ] = __( 'Changes saved successfully', 'insomniodev' );

		}

		echo json_encode( $response );
		wp_die();
	}

    /**
     * Return a theme admin template
     * @version 0.0.1
    */
    public static function getAdminTemplate()
    {
        $data = file_get_contents("php://input");

        $response = [
            'message' => '',
            'errors' => [],
            'status' => 0
        ];

        if (isset($data)) {
            $data = json_decode($data)->data;

            $templateName = (isset($data->templateName) && $data->templateName != '') ? $data->templateName : '';

            if (file_exists(IDT_THEME_PATH . '/admin/templates/components/' . $templateName . '.php')) {
                ob_start();
                include_once IDT_THEME_PATH . '/admin/templates/components/' . $templateName . '.php';
                $response['message'] = ob_get_clean();
            } else {
                $response['errors'][] = __('Template not found.', 'insomniodev');
            }
            $response['status'] = 200;
        } else {
            $response['errors'][] = __('Empty data.', 'insomniodev');
            $response['status'] = 200;
        }

        echo json_encode($response);
        wp_die();
    }

    /**
     * Save the main theme settings
     * @version 0.0.1
     */
    public function saveThemeSettings()
    {
        $data = file_get_contents("php://input");

        $response = [
            'message' => '',
            'errors' => [],
            'status' => 0
        ];

        if (isset($data)) {
            $settings = json_decode($data)->data;
            $args = [
                'optionsGroup' => '',
                'values' => []
            ];
            $updateResult = false;
            if (
                isset($settings->optionsGroup)
                && $settings->optionsGroup != ''
                && isset($settings->values)
                && !empty($settings->values)
            ) {
                $optionGroup = $settings->optionsGroup;

                switch ($optionGroup) {
                    case 'social':
                        $args['optionsGroup'] = 'idt_options_social';

                        foreach ($settings->values as $input) {
                            switch ($input->name) {
                                case 'social_linkedin_url':
                                    $args['values']['linkedinUrl'] = $input->value;
                                    break;
                                case 'social_facebook_url':
                                    $args['values']['facebookUrl'] = $input->value;
                                    break;
                                case 'social_instagram_url':
                                    $args['values']['instagramUrl'] = $input->value;
                                    break;
                                case 'social_twitter_url':
                                    $args['values']['twitterUrl'] = $input->value;
                                    break;
                                case 'social_youtube_url':
                                    $args['values']['youtubeUrl'] = $input->value;
                                    break;
                                case 'social_pinterest_url':
                                    $args['values']['pinterestUrl'] = $input->value;
                                    break;
                                case 'social_spotify_url':
                                    $args['values']['spotifyUrl'] = $input->value;
                                    break;
                                case 'social_twitch_url':
                                    $args['values']['twitchUrl'] = $input->value;
                                    break;
                                case 'social_reddit_url':
                                    $args['values']['redditUrl'] = $input->value;
                                    break;
                                case 'social_telegram_url':
                                    $args['values']['telegramUrl'] = $input->value;
                                    break;
                                case 'social_whatsapp1_url':
                                    $args['values']['whatsapp1Url'] = $input->value;
                                    break;
                                case 'social_whatsapp2_url':
                                    $args['values']['whatsapp2Url'] = $input->value;
                                    break;
                                case 'social_whatsapp3_url':
                                    $args['values']['whatsapp3Url'] = $input->value;
                                    break;
                                case 'social_whatsapp4_url':
                                    $args['values']['whatsapp4Url'] = $input->value;
                                    break;
                            }
                        }
                        break;
                    case 'performanceScssCompiler':
                        $args['optionsGroup'] = 'idt_options_performance_scss_compiler';

                        foreach ($settings->values as $input) {
                            switch ($input->name) {
                                case 'performance_enable_theme_scss_compiler':
                                    if ($input->value == 'checked') {
                                        $args['values']['enableThemeScssCompiler'] = 'enabled';
                                    } else {
                                        $args['values']['enableThemeScssCompiler'] = 'disabled';
                                    }
                                    break;
                                case 'performance_enable_theme_child_scss_compiler':
                                    if ($input->value == 'checked') {
                                        $args['values']['enableThemeChildScssCompiler'] = 'enabled';
                                    } else {
                                        $args['values']['enableThemeChildScssCompiler'] = 'disabled';
                                    }
                                    break;
                            }
                        }
                        break;
                    case 'performanceResources':
                        $args['optionsGroup'] = 'idt_options_performance_resources';

                        foreach ($settings->values as $input) {
                            switch ($input->name) {
                                case 'performance_resource_enable_bootstrap':
                                    if ($input->value == 'checked') {
                                        $args['values']['enableBootstrap'] = 'enabled';
                                    } else {
                                        $args['values']['enableBootstrap'] = 'disabled';
                                    }
                                    break;
                                case 'performance_resource_bootstrap_version':
                                    $args['values']['bootstrapVersion'] = $input->value;
                                    break;
                                case 'performance_resource_bootstrap_import_styles':
                                    $args['values']['bootstrapImportStyles'] = $input->value;
                                    break;
                            }
                        }
                        break;
                }

                try {
                    update_option($args['optionsGroup'], $args['values']);
                    $response['message'] = __( 'Changes saved successfully', 'insomniodev' );
                    $response['status'] = 200;
                } catch (Exception $e) {
                    $response['errors'][] = __( 'It was not possible to save the changes', 'insomniodev' );
                    $response['status'] = 500;
                }
            }
        } else {
            $response['errors'][] = __( 'It was not possible to save the changes', 'insomniodev' );
            $response['errors'][] = __('Empty data.', 'insomniodev');
            $response['status'] = 200;
        }

        echo json_encode( $response );
        wp_die();
    }

}
