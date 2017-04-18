<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomPostType extends Main_controller {

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }
        $this->load->model('CustomPostTypeModel');
    }

    public $layout = "default";
    public $data = array();

    public function index() {
        $this->data['customposttype'] = $this->CustomPostTypeModel->customStartingWithChoiceOfTables();
        $this->load->view('custom_post_type/index', $this->data);
    }

    public function add() {
        if (isset($_POST['create_post_type'])) {
            $field_param = $this->input->post('hidden_element', true);
            $table_name = $this->input->post('tabl_name', true);
            $this->CustomPostTypeModel->createTable($table_name, $field_param);
        }
        $this->load->view('custom_post_type/add', $this->data);
    }

    public function edit($edit_custom_post_type = false) {
        $this->data['customposttype'] = $edit_custom_post_type;
        $customFields = $this->CustomPostTypeModel->customField('custom_' . $edit_custom_post_type);
        foreach ($customFields as $index => $element) {            
            if ($index < 2) {
                continue;
            }
            $pos = strripos($element, '_');
            $field_name = substr($element, 0, $pos);
            $field_type = substr($element, $pos + 1);
            $customField[$field_name]= $field_type;
        }
        $translationCustomFields = $this->CustomPostTypeModel->customFieldTranslation('custom_' . $edit_custom_post_type);
        foreach ($translationCustomFields as $index => $element) {            
            if ($index < 3) {
                continue;
            }
            $pos = strripos($element, '_');
            $field_name = substr($element, 0, $pos);
            $field_type = substr($element, $pos + 1);
            $customField_t[$field_name]= $field_type ;
        }
        $this->data['custom_field'] = $customField;
        $this->data['custom_field_t'] = $customField_t;
        //echo '<pre>';
        //var_dump($customField);

        if (isset($_POST['edit_custom_post_type'])) {
            //var_dump('uu');exit;
            $field_param = $this->input->post('hidden_element', true);
            $new_table_name = $this->input->post('tabl_name', true);
            $this->CustomPostTypeModel->editTable($edit_custom_post_type,$new_table_name, $field_param);
        }
        $this->load->view('custom_post_type/edit', $this->data);
    }

}
