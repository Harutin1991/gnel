<?php

function redirect_ssl() {
    $CI = & get_instance();
    $class = $CI->router->fetch_class();
    $include = array(/*'home', 'shopping', 'account'*/);  // add more controller name to include ssl.
    if($class !== 'ajax') {
        if (in_array($class, $include)) {
            // redirecting to ssl.
            $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
            if ($_SERVER['SERVER_PORT'] != 443)
                redirect(base_url($CI->uri->uri_string()));
        } else {
            // redirecting with no ssl.
            $CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
            if ($_SERVER['SERVER_PORT'] == 443)
                redirect(base_url($CI->uri->uri_string()));
        }
    }
}
