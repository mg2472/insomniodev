<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Return a truncated string
 * @param $string string The text to be truncated
 * @param $length int The characters limit to return
 * @param $symbol string The final symbol to show after truncate the string
 * @return string String truncated
 */
function idtTruncateString(string $string = '', int $length = 50, string $symbol = '...') : string
{
    $excerpt = $string;
    $excerpt = preg_replace(" ([.*?])",'', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $length);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = $excerpt . $symbol;
    $excerpt = trim($excerpt);
    return $excerpt;
}