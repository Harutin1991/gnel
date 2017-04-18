<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles extends Main_controller {

    public $layout = 'default';
    public $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }
        $this->load->model('RolesModel');
        $this->load->library('form_validation');
    }

    public function index() {
        //$r=getArrayUrl() ;
        //print_r($r);exit;
        $this->data['roles'] = $this->RolesModel->getRoles();
        $this->load->view('roles/index', $this->data);
    }

    public function add() {
        if ($this->input->post('submit', true)) {
            $this->form_validation->set_rules('role', $this->lang->line('Name'), 'required|is_unique[admin_roles.rol_name]');
            $this->form_validation->set_rules('permission', $this->lang->line('Permission'), 'required');
            if ($this->form_validation->run()) {
                $role_permission = $this->input->post('permission', true);
                $role_name = $this->input->post('role', true);                
                $this->RolesModel->addRole($role_name, $role_permission);
            }
        }        
        $this->data['controller_files'] = scandir('./application/controllers/');        
        //$this->data['permission'] = getArrayUrl();
        $this->load->view('roles/add', $this->data);
    }

    public function edit($post_id = false) {
        $exist_post_id = $this->RolesModel->existPostId($post_id);
        if ($exist_post_id) {
            if ($this->input->post('submit', true)) {
                $this->form_validation->set_rules('role', $this->lang->line('Name'), 'required');
                $this->form_validation->set_rules('permission', $this->lang->line('Permission'), 'required');
                if ($this->form_validation->run()) {
                    $role_permission = $this->input->post('permission', true);
                    $role_name = $this->input->post('role', true);
                    $this->RolesModel->editRole($post_id, $role_name, $role_permission);
                }
            }
            $this->data['controller_files'] = scandir('./application/controllers/');            
            $this->data['edit_role'] = $this->RolesModel->getEditRole($post_id);
            $this->load->view('roles/edit', $this->data);
        } else {
            show_404();
        }
    }

}
