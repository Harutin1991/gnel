<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property PageModel $PageModel
 * @property MenuItemModel $MenuItemModel
 *
 */

class Menu extends Main_controller {
	
    public $layout = 'default';
    
    function __construct() {
		parent::__construct();
        
		if(!$this->_is_logged_in()){
            redirect(site_url('login'));
        }
        
        $this->load->model('MenuModel');
        $this->load->model('MenuItemModel');
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        $this->load->model('PageModel');
        $this->load->library('form_validation');
        
        $this->data['languages'] = $this->LanguagesModel->getAll('languages', 'ASC');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');
	}
	
    public function index() {
        $this->data['menus'] = $this->MenuModel->getAll('menus');
		$this->load->view('menu/index', $this->data);
	}
    
    public function add() {
        if($this->input->post('Menu'))
        {
            $this->form_validation->set_rules($this->MenuModel->rules_add());
            if($this->form_validation->run())
            {
                $data = $this->input->post('Menu', true);
                $data['parent_id'] = mt_rand(100000, 9999999);
                if($id = $this->MenuModel->insert('menus', $data))
                    $this->addLog('Added menu with id: ' . $id);
                
                $this->session->set_flashdata('message', 'add_success');
                redirect(current_url(), 'refresh');
            }
        }
        
		$this->load->view('menu/add', $this->data);
	}
    
    public function edit($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['menu'] = $this->MenuModel->get('menus', $id);
        if($this->data['menu'] == false) show_404();
        
        if($this->input->post('Menu')) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules($this->MenuModel->rules_edit());
            if($this->form_validation->run()) {
                $data = $this->input->post('Menu', true);
                
                if($this->MenuModel->update('menus', $id, $data))
                    $this->addLog('Edited menu with id: ' . $id);
                
                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }
        
		$this->load->view('menu/edit', $this->data);
	}
    
    public function addItem($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['parent'] = $this->MenuModel->get('menus', $id);
        if($this->data['parent'] == false) show_404();
        $this->data['pages'] = $this->PageModel->getAll('pages');
        $this->data['menuItems'] = $this->MenuItemModel->getAll('menu_items');
        
        if($this->input->post('MenuItem')) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules($this->MenuItemModel->rules_add());
            if($this->form_validation->run()) {
                $data = $this->input->post('MenuItem', true);
                $data['parent_id'] = $this->data['parent']['parent_id'];
                
                if($this->MenuItemModel->insert('menu_items', $data))
                    $this->addLog('Added item to menu with id: ' . $id);
                
                $this->session->set_flashdata('message', 'add_item_success');
                redirect(current_url(), 'refresh');
            }
        }
        
        $Arr = array();
        if($this->data['menuItems'] && count($this->data['menuItems'])>0){
            foreach ($this->data['menuItems'] as $menuItem) {
                array_push($Arr, (array)$menuItem);
            }
        }

        $result = treealize($Arr, 'id', 'parent_id', $this->data['parent']['parent_id']);
        Sort_Multidimension_Array($result);
        $this->data['menuItems'] = $result;
        $this->data['menu_id'] = $this->data['parent']['parent_id'];
        
        $this->load->view('menu/addItems', $this->data);
    }
    
    public function editItem($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['parent'] = $this->MenuModel->get('menus', $id);
        if($this->data['parent'] == false) show_404();
        $this->data['pages'] = $this->PageModel->getAll('pages');
        $this->data['menuItems'] = $this->MenuItemModel->getAll('menu_items');

        if($this->input->post('MenuItem')) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules($this->MenuItemModel->rules_edit());
            if($this->form_validation->run()) {
                $data = $this->input->post('MenuItem', true);
                
                if($this->MenuItemModel->update('menu_items', $data['menu_item_id'], $data))
                    $this->addLog('Edded item of menu with id: ' . $id);
                
                $this->session->set_flashdata('message', 'edit_item_success');
                redirect(current_url(), 'refresh');
            }
        }
        
        $Arr = array();
        foreach ($this->data['menuItems'] as $menuItem) {
            array_push($Arr, (array)$menuItem);
        }

        $result = treealize($Arr, 'id', 'parent_id', $this->data['parent']['parent_id']);
        Sort_Multidimension_Array($result);
        $this->data['menuItems'] = $result;
        $this->data['menu_id'] = $this->data['parent']['parent_id'];
        
        $this->load->view('menu/addItems', $this->data);
    }
    
    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);
		
        $query = $this->db->get_where($table, array($field => $str));
	
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if($row->$field != $this->data['menu'][$field])
                    return false;
            }
        }
        
        return true;
    }
    
}