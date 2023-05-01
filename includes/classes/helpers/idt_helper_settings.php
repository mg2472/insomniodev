<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

$idtThemeSettings = [
    'socialNetworks' => [],
    'performance' => [],
    'logos' => [],
    'general' => [],
    'copyright' => []
];

/**
 * Return the theme setting
 *
 * @param string $settingName The settings to return
 *
 * @return mixed The selected settings values
 */
function idtGetSetting(string $settingName = ''): array
{
    $idtSettings = new IdtSettings();
    $settings = [];

    switch ($settingName) {
        case 'socialNetworks':
            if (empty($idtThemeSettings['socialNetworks'])) {
                $settings = $idtSettings->getSocialSettings();
                $idtThemeSettings['socialNetworks'] = $settings;
            } else {
                $settings = $idtThemeSettings['socialNetworks'];
            }
            break;
        case 'performance':
            if (empty($idtThemeSettings['performance'])) {
                $settings = $idtSettings->getGeneralSettings(['group' => 'performance']);
                $idtThemeSettings['performance'] = $settings;
            } else {
                $settings = $idtThemeSettings['performance'];
            }
            break;
        case 'logos':
            if (empty($idtThemeSettings['logos'])) {
                $settings = $idtSettings->getGeneralSettings(['group' => 'logo']);
                $idtThemeSettings['logos'] = $settings;
            } else {
                $settings = $idtThemeSettings['logos'];
            }
            break;
        case 'copyright':
            if (empty($idtThemeSettings['copyright'])) {
                $settings = $idtSettings->getGeneralSettings(['group' => 'general', 'name' => 'copyright']);
                $idtThemeSettings['copyright'][] = $settings;
            } else {
                $settings = $idtThemeSettings['copyright'];
            }
            break;
        case 'general':
        default:
            if (empty($idtThemeSettings['general'])) {
                $settings = $idtSettings->getGeneralSettings(['group' => 'general']);
                $idtThemeSettings['general'] = $settings;
            } else {
                $settings = $idtThemeSettings['general'];
            }
            break;
    }

    return $settings;
}

/**
 * Return the theme logo list
 *
 * @return array The theme logos
 */
function idtGetThemeLogos(): array
{
    $logos = [];
    $logosData = idtGetSetting('logos');

    if (!empty($logosData)) {
        foreach ($logosData as $key => $logoData) {
            $logos[$key] = idtGetImageData((int)$logoData['value']);
        }
    }

    return $logos;
}

/**
 * Return the theme copyright
 *
 * @return array The theme copyright
 */
function idtGetThemeCopyright(): array
{
    $settings = idtGetSetting('copyright');
    $copyright = [
        'code' => 'copyright_all',
        'value' => '',
        'group' => 'general',
        'lang' => 'all'
    ];

    if (!empty($settings['copyright'])) {
        $copyright = $settings['copyright'];
    }


    return $copyright;
}

/**
 * Return the theme social networks
 *
 * @return array The theme social networks
 */
function idtGetThemeSocialNetworks(): array
{
    $settings = idtGetSetting('socialNetworks');
    $socialNetworks = [];

    if (!empty($settings['socialNetworks'])) {
        $socialNetworks = $settings['socialNetworks'];
    }

    return $socialNetworks;
}