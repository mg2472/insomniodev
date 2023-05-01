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