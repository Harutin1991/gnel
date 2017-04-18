<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Option extends Main_controller {
	
    public $layout = 'default';
    
    function __construct() {
		parent::__construct();
        
		if(!$this->_is_logged_in()){
            redirect(site_url('login'));
        }
        
        $this->load->model('OptionsModel');
        $this->load->model('CategoryModel');
        
        $categories = $this->CategoryModel->getAll('categories');
        $categories = json_decode(json_encode($categories), true);
        $categories_tree = treealize($categories, 'id', 'parent_id', '0');
        $this->data['categories'] = getChildCategories($categories_tree);
	}
	
    public function index() {
        $this->data['options'] = $this->OptionsModel->getAll('options');
		$this->load->view('option/index', $this->data);
	}
    
    public function add() {
        if($this->input->post('Option')) {
            $this->form_validation->set_rules($this->OptionsModel->rules_add());

            if($this->form_validation->run()) {
                $data = $this->input->post('Option', true);
                if(($id = $this->OptionsModel->insert('options', $data)) != false) {
                    $this->addLog('Added option with id: ' . $id);
                
                    $this->session->set_flashdata('message', 'add_success');
                    redirect('/option/edit/'.$id, 'refresh');
                }
            }
        }
        
		$this->load->view('option/add', $this->data);
	}
    
    public function edit($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['option'] = $this->OptionsModel->get('options', $id);
        if($this->data['option'] == false) show_404();
        
        if($this->input->post('Option')) {
            $this->form_validation->set_rules($this->OptionsModel->rules_edit());
            
            if($this->form_validation->run()) {
                $data = $this->input->post('Option', true);
                
                if($this->OptionsModel->update('options', $id, $data) != false) {
                    $this->addLog('Edited option with id: ' . $id);
                
                    $this->session->set_flashdata('message', 'edit_success');
                    redirect(current_url(), 'refresh');
                }
            }
        }
        
		$this->load->view('option/edit', $this->data);
	}

    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);
		
        $query = $this->db->get_where($table, array($field => $str));
	
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if($row->$field != $this->data['option'][$field])
                    return false;
            }
        }
        
        return true;
    }
    
}