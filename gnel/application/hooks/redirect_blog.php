<?php

function redirect_blog() {
    $CI = & get_instance();
    $class = $CI->router->fetch_class();
    $include = array('blog', 'ajax', 'account');  // add more controller name to include ssl.

    if (!in_array($class, $include)) {
            redirect(site_url('blog'));
    }
}
