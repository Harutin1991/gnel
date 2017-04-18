<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

    public $user_id ='';

    function __construct() {
        parent::__construct();
    }

    public function error_404() {
        $this->lang->load('custom', $this->config->item('language'));
        
        $this->output->set_status_header('404');
        $this->load->view('pages/error_404');
    }



}