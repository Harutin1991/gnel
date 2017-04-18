<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends Main_controller {
	
    public $layout = 'default';
    
    function __construct(){
		parent::__construct();
        
		if(!$this->_is_logged_in()){
            redirect(site_url('login'));
        }
        
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        
        $this->data['languages'] = $this->LanguagesModel->getAllLanguages('languages');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');
	}
	
    public function index() {
        $this->data['languages'] = $this->LanguagesModel->getAll('languages', 'ASC');
		$this->load->view('languages/index', $this->data);
	}
    
    public function add() {
        if($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules($this->LanguagesModel->rules_add());
            if($this->form_validation->run()) {
                $data = $this->input->post('Languages', true);
                
                if($id = $this->LanguagesModel->insert('languages', $data)) 
                    $this->addLog('Added language with id: ' . $id);
                
                $this->session->set_flashdata('message', 'add_success');
                redirect(current_url(), 'refresh');
            }
        }
        
		$this->load->view('languages/add', $this->data);
	}
    
    public function edit($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['lang'] = $this->LanguagesModel->get('languages', $id);
        if($this->data['lang'] == false) show_404();
        
        if($this->input->post('Languages'))
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules($this->LanguagesModel->rules_edit());
            if($this->form_validation->run())
            {
                $data = $this->input->post('Languages', true);
                if($this->LanguagesModel->update('languages', $id, $data))
                    $this->addLog('Edited language with id: ' . $id);
                
                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }
        
		$this->load->view('languages/edit', $this->data);
	}
    
    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);
		
        $query = $this->db->get_where($table, array($field => $str));
	
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                if($row->$field != $this->data['lang'][$field])
                    return false;
            }
        }
        
        return true;
    }
}