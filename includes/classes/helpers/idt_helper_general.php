<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Return the theme home URL
 * @return string Theme home URL
 */
function idtGetHomeUrl(): string
{
    $url = '';

    if (function_exists('pll_home_url')) {
        $url = pll_home_url();
    } else {
        $url = get_home_url();
    }

    return $url;
}

/**
 * Return estimate post reading time
 * @return string Estimate reading time
 */
function idtGetPostReadingTime($postID = null): string
{
    $totalReadingTime = '';

    if ($postID) {
        $content = get_post_field('post_content', $postID);
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200);

        if ($readingTime == 1) {
            $timer = __('minute', 'insomniodev');
        } else {
            $timer = __('minutes', 'insomniodev');
        }
        $totalReadingTime = $readingTime . ' ' . $timer;
    }

    return $totalReadingTime;
}