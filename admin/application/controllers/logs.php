<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends Main_controller {
	
    public $layout = 'default';
    
    function __construct(){
		parent::__construct();
        
		if(!$this->_is_logged_in()){
            redirect(site_url('login'));
        }
        
        $this->load->model('LogsModel');
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        $this->load->library('pagination');
       
        $this->data['languages'] = $this->LanguagesModel->getAll('languages');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');
	}
	
    public function index($from = 0) {
        $config['base_url'] = '/logs/index/';
        $config['total_rows'] = $this->LogsModel->countAll('logs');
        $config['num_links'] = 3;
        $config['per_page'] = 50;
    //  $config['use_page_numbers'] = TRUE;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = $this->lang->line('First') . ' ...';
        $config['prev_link'] = '«';
        $config['next_link'] = '»';
        $config['last_link'] = '... ' . $this->lang->line('Last');

        $this->pagination->initialize($config); 

        $this->data['links'] = $this->pagination->create_links();

        $this->data['logs'] = $this->LogsModel->getAll('logs', $from, $config['per_page']);
		$this->load->view('logs/index', $this->data);
	}

}