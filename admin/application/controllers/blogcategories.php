<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogcategories extends Main_controller {

    public $layout = 'default';

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BlogcategoriesModel');
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        $this->load->library('form_validation');

        $this->data['languages'] = $this->LanguagesModel->getAllLanguages('languages');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
    }

    public function index() {
        $this->data['blogcategories'] = $this->BlogcategoriesModel->getAll('blognews_categories', 'ASC', 'order');
        $this->load->view('blogcategories/index', $this->data);
    }

    public function add() {
        if ($this->input->post('Blogcategories')) {
			$this->form_validation->set_rules($this->BlogcategoriesModel->rules());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Blogcategories', true);
                $data["user_id"] = $this->admin_id;
				
                $data = trim_array($data);
                if (($id = $this->BlogcategoriesModel->insert('blognews_categories', $data)) != false) {
                    $this->addLog('Added blogcategories with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("blogcategories/edit/$id", 'refresh');
            }
        }

        $this->load->view('blogcategories/add', $this->data);
    }

    public function edit($id = NULL) {
        if (!isset($id))
            show_404();
        $this->data['blogcategories'] = $this->BlogcategoriesModel->get('blognews_categories', $id, $this->session->userdata('admin_id'));
        if ($this->data['blogcategories'] == false)
            show_404();
        if ($this->admin_id != $this->data['blogcategories']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id') &&
                $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('brand'));
        }

        if ($this->input->post('Blogcategories')) {
            $this->form_validation->set_rules($this->BlogcategoriesModel->rules());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Blogcategories', true);
				

        
                $data = trim_array($data);
                if ($this->BlogcategoriesModel->update('blognews_categories', $id, $data) != false) {
                    $this->addLog('Edited blogcategories with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }
        $this->load->view('blogcategories/edit', $this->data);
    }


    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);

        $query = $this->db->get_where($table, array($field => $str));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->$field != $this->data['page'][$field])
                    return false;
            }
        }

        return true;
    }

    public function getBlognewsCount() {
        if ( $this->admin_id != $this->config->item('super_global_admin_id')) {
            $this->db->where('user_id', $this->admin_id);
        }
        $this->db->from('blognews');
        return $this->db->count_all_results();
    }

}
