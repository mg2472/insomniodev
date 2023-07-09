<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Return a theme logo
 * @param $logoName string The logo name to return. If the logo name is not set, the function will search for all the theme logos
 * @return array The theme logos
 */
function idtGetThemeLogo(string $logoName = ''): array
{
    $logo = idtGetThemeLogos();

    if (!empty($logo) && $logoName != '') {
        $logo = $logo[$logoName];
    }

    return $logo;
}

/**
 * Return a post featured image data
 * @param $postID int|string The post ID
 * @param $size string Image size, default "full"
 * @return array Image data
 * @version 1.0.1
 */
function idtGetPostThumbnail($postID = 0, string $size = 'full'): array
{
    $image = [];

    if ($postID > 0) {
        $imageID = get_post_thumbnail_id($postID);

        if ($imageID > 0) {
            $image = idtGetImageData($imageID, $size);
        }
    }

    return $image;
}

/**
 * Return a image data
 * @param $imageID int|string The image ID
 * @param $size string Image size, default "full"
 * @return array Image data if image exist, else empty array
 */
function idtGetImageData($imageID = 0, string $size = 'full'): array
{
    $image = [
        'id' => 0,
        'url' => '',
        'alt' => '',
        'width' => null,
        'height' => null,
    ];

    if ($imageID > 0) {
        $imageParams = wp_get_attachment_image_src($imageID, $size);

        if (!empty($imageParams)) {
            $imageUrl = $imageParams[0];
            $imageWidth = $imageParams[1];
            $imageHeight = $imageParams[2];
            $imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
            $image['id'] = $imageID;
            $image['url'] = $imageUrl;
            $image['alt'] = $imageAlt;
            $image['width'] = $imageWidth;
            $image['height'] = $imageHeight;
        } else {
            $image = [];
        }
    } else {
        $image = [];
    }

    return $image;
}