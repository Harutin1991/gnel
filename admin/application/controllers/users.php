<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Main_controller {

    public $layout = 'default';
    public $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }
        $this->load->model('RolesModel');
        $this->load->model('UsersModel');
        $this->load->library('form_validation');
    }

    public function index() {        
        //$r=getArrayUrl() ;
        //print_r($r);exit;
        $this->data['users'] = $this->UsersModel->getUsers();
        $this->load->view('users/index', $this->data);
    }

    public function add() {
        if ($this->input->post('submit', true)) {
            $this->form_validation->set_rules('login', $this->lang->line('Login'), 'required|is_unique[admin_users.username]');
            $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
            $this->form_validation->set_rules('repeat_password', $this->lang->line('Repeat password'), 'required|matches[password]');
            $this->form_validation->set_rules('roles', $this->lang->line('Roles'), 'required');


            if ($this->form_validation->run()) {
                $login = $this->input->post('login', true);
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $role_id = $this->input->post('roles', true);
                $this->UsersModel->addUser($login, $email, $password, $role_id);
            }
        }
        $this->data['roles'] = $this->RolesModel->getRoles();
        $this->load->view('users/add', $this->data);
    }

    public function edit($post_id = false) {
        $exist_post_id = $this->UsersModel->existPostId($post_id);
        if ($exist_post_id) {
            $this->data['roles'] = $this->RolesModel->getRoles();
            $this->data['edit_user'] = $this->UsersModel->getEditUser($post_id);
            if ($this->input->post('submit', true)) {
                if($this->data['edit_user']['id'] <> 1){                
                $this->form_validation->set_rules('login', $this->lang->line('Login'), 'required');
                $this->form_validation->set_rules('roles', $this->lang->line('Roles'), 'required');
                //echo '<pre>';
                //var_dump($_POST);exit;                
                if ($this->input->post('hidden_change_password', true) == 1) {
                    //echo 'rr';exit;
                    $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
                    $this->form_validation->set_rules('repeat_password', $this->lang->line('Repeat password'), 'required|matches[password]');
                    if ($this->form_validation->run()) {
                        $login = $this->input->post('login', true);
                        $password = $this->input->post('password', true);
                        $email = $this->input->post('email', true);
                        $password = sha1($password);
                        $role_id = $this->input->post('roles', true);
                        $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                    }
                } else if ($this->form_validation->run()) {
                    $login = $this->input->post('login', true);
                    $email = $this->input->post('email', true);
                    $password = $this->data['edit_user']['password'];
                    $role_id = $this->input->post('roles', true);
                    $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                }
            }
            else{
             $this->form_validation->set_rules('login', $this->lang->line('Login'), 'required');                               
                if ($this->input->post('hidden_change_password', true) == 1) {                    
                    $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
                    $this->form_validation->set_rules('repeat_password', $this->lang->line('Repeat password'), 'required|matches[password]');
                    if ($this->form_validation->run()) {
                        $login = $this->input->post('login', true);
                        $email = $this->input->post('email', true);
                        $password = $this->input->post('password', true);
                        $password = sha1($password);
                        $role_id = 1 ;
                        $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                    }
                } else if ($this->form_validation->run()) {
                    $login = $this->input->post('login', true);
                    $email = $this->input->post('email', true);
                    $password = $this->data['edit_user']['password'];
                    $role_id = 1;
                    $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                }   
            }
            } 
            $this->data['edit_user'] = $this->UsersModel->getEditUser($post_id);
            $this->load->view('users/edit', $this->data);
        } else {
            show_404();
        }
    }
    public function personal($post_id = false) {
        
        $post_id = $this->session->userdata('admin_id');
        $login = $this->session->userdata('admin_username');
        $role_id = $this->session->userdata('rol_id');
        
        $exist_post_id = $this->UsersModel->existPostId($post_id);
        if ($exist_post_id) {
            $this->data['roles'] = $this->RolesModel->getRoles();
            $this->data['edit_user'] = $this->UsersModel->getEditUser($post_id);
            if ($this->input->post('submit', true)) {
                if($this->data['edit_user']['id'] <> 1){                
//                $this->form_validation->set_rules('login', $this->lang->line('Login'), 'required');
//                $this->form_validation->set_rules('roles', $this->lang->line('Roles'), 'required');
                                
                if ($this->input->post('hidden_change_password', true) == 1) {
                    //echo 'rr';exit;
                    $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
                    $this->form_validation->set_rules('repeat_password', $this->lang->line('Repeat password'), 'required|matches[password]');
                    if ($this->form_validation->run()) {
                        $password = $this->input->post('password', true);
                        $email = $this->input->post('email', true);
                        $password = sha1($password);
                        $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                    }
                } else {

                    $email = $this->input->post('email', true);
                    $password = $this->data['edit_user']['password'];
                    $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                }
            } else {                           
                if ($this->input->post('hidden_change_password', true) == 1) {                    
                    $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
                    $this->form_validation->set_rules('repeat_password', $this->lang->line('Repeat password'), 'required|matches[password]');
                    if ($this->form_validation->run()) {
                        $email = $this->input->post('email', true);
                        $password = $this->input->post('password', true);
                        $password = sha1($password);
                        $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                    }
                } else if ($this->form_validation->run()) {
                    $email = $this->input->post('email', true);
                    $password = $this->data['edit_user']['password'];
                    $role_id = 1;
                    $this->UsersModel->editUser($login, $email, $password, $role_id,$post_id);
                }   
            }
            } 
            $this->data['edit_user'] = $this->UsersModel->getEditUser($post_id);
            $this->load->view('users/personal', $this->data);
        } else {
            show_404();
        }
    }
}
