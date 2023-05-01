<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * This class contains validations for multiple use cases
 * @version 0.0.1
 * @since 1.0.0
 */
class IdtValidations
{
    /**
     * Validate if a URL exist
     * @version 0.0.1
     * @since 1.0.0
     * @param $url string The url to check
     * @return bool True if URL exist, else False
     */
    public function checkUrlExist(string $url = '') : bool
    {
        $flag = false;

        if (is_string($url) && $url != '') {
            $finalUrl = '';

            if (
                (strpos($url, 'http://') !== false)
                || (strpos($url, 'https://') !== false)
            ) {
                $finalUrl = $url;
            } else {
                $finalUrl = 'http://' . $url;
            }

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);

            if ($response !== false) {

                $responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if ($responseStatus == 200) {
                    $flag = true;
                }
            }

            curl_close($curl);
        }

        return $flag;
    }

    /**
     * Validate if a string is in an excluded list
     * @version 0.0.1
     * @since 1.0.0
     * @param $string string The url to check
     * @param $listPath string The relative path of the JSON file with the exclusion list
     * @return bool True if URL exist, else False
     */
    public function stringIsInExclusionList(string $string = '', string $listPath = '') : bool
    {
        $flag = false;
        $exclusionList = '';

        if (file_exists(IDT_THEME_PATH . $listPath)) {
            $exclusionList = file_get_contents(IDT_THEME_PATH . $listPath);
        } elseif (file_exists(IDT_THEME_CHILD_PATH . $listPath)) {
            $exclusionList = file_get_contents(IDT_THEME_CHILD_PATH . $listPath);
        }

        if ($exclusionList !='') {
            $exclusionValues = json_decode($exclusionList, true);

            if (isset($exclusionValues['values']) && !empty($exclusionValues['values'])) {
                foreach ($exclusionValues['values'] as $exclusionValue) {
                    $value = strtolower(trim($string));
                    $exclude = strtolower(trim($exclusionValue));

                    if (
                        $value === $exclude
                         || strpos($value, $exclude)
                     ) {
                        $flag = true;
                         break;
                     }
                }
            }
        }


        return $flag;
    }
}