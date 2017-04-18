<?php
if (!function_exists('createMultilangUrl')) {

    function createMultilangUrl($lang) {
        $ci =& get_instance();
        
        $languages = $ci->LanguagesModel->getLanguages('languages');
        $default_language = $ci->SettingsModel->get('default_language');
        
        if (array_key_exists($lang, $languages)) {
            $url_details = parse_url($_SERVER['REQUEST_URI']);
            $path = (isset($url_details['path']) && $url_details['path'] != '/') ? $url_details['path'] : false;
            $query = isset($url_details['query']) ? $url_details['query'] : false;

            if ($path) {
                $path_array = explode('/', $path);
                if (array_key_exists($path_array[1], $languages)) {
                    $path_array[1] = $lang;
                }
                else {
                    array_unshift($path_array, $lang);
                }
                $path_array = array_filter($path_array);
                $path = '/' . implode('/', $path_array);
                if ($query) {
                    $path .= '?' . $query;
                }
                return $path;
            }
            else {
                if ($query) {
                    return '/' . $lang . '?' . $query;
                }
                else {
                    return '/' . $lang;
                }
            }
        }
        else {
            return $_SERVER['REQUEST_URI'];
        }
    }
}

if (!function_exists('addCurrentLang')) {
    function addCurrentLang($uri) {
        $ci =& get_instance();
        $default_language = $ci->SettingsModel->get('default_language');
        $languages = $ci->LanguagesModel->getLanguages('languages');
        $current_language = $ci->config->item('language');
        if($default_language != $current_language)
            $uri = $current_language . '/' . $uri;
        
        return $uri;
    }
}

if (!function_exists('getFirstSegment')) {
    function getFirstSegment() {
        $ci =& get_instance();
        
        $languages = $ci->LanguagesModel->getLanguages('languages');
        $default_language = $ci->SettingsModel->get('default_language');
        
        $first_segment = NULL;

        $url_details = parse_url($_SERVER['REQUEST_URI']);
        $path = (isset($url_details['path']) && $url_details['path'] != '/') ? $url_details['path'] : false;
        $query = isset($url_details['query']) ? $url_details['query'] : false;

        if ($path) {
            $path_array = explode('/', $path);
            $first_segment = $path_array[1];
        }
        
        return $first_segment;
    }
}