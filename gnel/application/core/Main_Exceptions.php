<?php

class Main_Exceptions extends CI_Exceptions {

    function __construct() {
        parent::__construct();
    }

    function show_404($page = '', $log_error = true) {
        include APPPATH . 'config/routes.php';
        
        // By default we log this, but allow a dev to skip it
        if ($log_error) {
            log_message('error', '404 Page Not Found --> ' . $page);
        }
        
        $heading = "404 Page Not Found";
        $message = array('Sorry, the page you requested was not found. ');
        log_message('error', '404 Page Not Found --> '.$page);
        
        if (!empty($route['404_override'])) {
            $CI = & get_instance();
            $CI->load->view('pages/error_404');
            echo $CI->output->get_output();
            exit;
        }
        else {
            echo $this->show_error($heading, $message, 'error_404', 404);
            exit;
        }
    }

}
