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

/**
 * Return an attachment data
 * @param $attachID int|string The image ID
 * @return array Attachment file data if image exist, else empty array
 */
function idtGetFileData($attachID = 0): array
{
    $file = [
        'id' => 0,
        'url' => '',
        'alt' => '',
        'title' => '',
    ];

    if ($attachID > 0) {
        $fileUrl = wp_get_attachment_url($attachID);

        if ($fileUrl && $fileUrl !== '') {
            $file['id'] = $attachID;
            $file['url'] = $fileUrl;
            $file['alt'] = get_post_meta($attachID, '_wp_attachment_image_alt', true);
            $file['title'] = get_the_title($attachID);
        } else {
            $file = [];
        }
    } else {
        $file = [];
    }

    return $file;
}

/**
 *
 * Upload a base64 file to WordPress folder.
 * @param $base64File string The base64 file string
 * @param $fileTitle string The file title
 * @return array The uploaded file data
 *
 */
function idtUploadBase64File(string $base64File = '', string $fileTitle = ''): array
{
    $fileData = [
        'id' => 0,
        'url' => '',
        'alt' => '',
        'width' => null,
        'height' => null,
    ];
    $fileTypeData = idtGetBase64FileType($base64File);

    // Upload dir.
    $uploadDir  = wp_upload_dir();
    $uploadPath = str_replace( '/', DIRECTORY_SEPARATOR, $uploadDir['path'] ) . DIRECTORY_SEPARATOR;

    $file = str_replace( $fileTypeData['base64Type'], '', $base64File);
    $file = str_replace(' ', '-', $file);
    $decoded = base64_decode($file);
    $filename = str_replace('.' . $fileTypeData['extension'], '', strtolower($fileTitle));
    $filename = str_replace(' ', '-', $filename) . '.' . $fileTypeData['extension'];
    $fileType = $fileTypeData['type'];
    $hashedFilename = md5($filename . microtime()) . '_' . $filename;

    // Save the file in the uploads directory.
    $uploadFile = file_put_contents($uploadPath . $hashedFilename, $decoded);

    $attachment = [
        'post_mime_type' => $fileType,
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($hashedFilename)),
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $uploadDir['url'] . '/' . basename($hashedFilename)
    ];

    $attachID = wp_insert_attachment($attachment, $uploadDir['path'] . '/' . $hashedFilename);

    if ($attachID > 0) {
        $fileData = idtGetFileData($attachID);
    } else {
        $fileData = [];
    }

    return $fileData;
}

/**
 *
 * Get a base64 file type data
 * @param $base64File string The base64 file string
 * @return array File type data
 *
 */
function idtGetBase64FileType(string $base64File = ''): array
{
    $file = [
        'base64Type' => '',
        'type' => '',
        'extension' => '',
    ];

    if ($base64File != '') {
        preg_match('/data:(.*);base64,/i', $base64File, $match);

        if (!empty($match)) {
            $file['base64Type'] = $match[0];
            $file['type'] = $match[1];
            $file['extension'] = explode('/', $match[1])[1];
        }
    }

    return $file;
}