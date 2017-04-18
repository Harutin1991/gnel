<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends Main_controller {

    public $layout = 'default';

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BrandModel');
        $this->load->model('ProductsModel');
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
        $this->data['brands'] = $this->BrandModel->getAll('brands');
        $this->load->view('brand/index', $this->data);
    }

    public function add() {
        if ($this->input->post('Brand')) {
            $this->form_validation->set_rules($this->BrandModel->rules());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Brand', true);
                $data["user_id"] = $this->admin_id;

                $image_data = $this->_do_upload('image', 'brand');
                if (isset($image_data['upload_data']))
                    $data['image'] = $image_data['upload_data']['file_name'];
                $data = trim_array($data);
                if (($id = $this->BrandModel->insert('brands', $data)) != false) {
                    $this->addLog('Added page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("brand/edit/$id", 'refresh');
            }
        }

        $this->load->view('brand/add', $this->data);
    }

    public function edit($id = NULL) {
        if (!isset($id))
            show_404();
        $this->data['brand'] = $this->BrandModel->get('brands', $id, $this->session->userdata('admin_id'));
        if ($this->data['brand'] == false)
            show_404();
        if ($this->admin_id != $this->data['brand']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id') &&
                $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('brand'));
        }

        if ($this->input->post('Brand')) {
            $this->form_validation->set_rules($this->BrandModel->rules());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Brand', true);
                $old_image = $this->data['brand']['image'];

                if (!empty($_FILES['image']['name'])) {
                    $image_data = $this->_do_upload('image', 'brand');

                    if (isset($old_image))
                        $this->_delete_img($old_image, 'brand');

                    if (isset($image_data['upload_data']))
                        $data['image'] = $image_data['upload_data']['file_name'];
                }
                $data = trim_array($data);
                $data_sale['percent_off'] = $data['percent_off'];
                $data_sale['amount_off'] = $data['amount_off'];
                $this->ProductsModel->updateSaleProduct($id,$data_sale);

//                echo '<pre>'; print_r($data); exit;

                if ($this->BrandModel->update('brands', $id, $data) != false) {
                    $this->addLog('Edited page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }
        $this->load->view('brand/edit', $this->data);
    }

    private function uploadImage($input_name, $path) {
        if (isset($_FILES[$input_name])) {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $fileext = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
            $config['file_name'] = uniqid() . '.' . strtolower($fileext);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($input_name)) {
                $upload_data = $this->upload->data();
                return $config['upload_path'] . $upload_data['file_name'];
            }
        }

        return false;
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

    public function getBrandCount() {
        if ( $this->admin_id != $this->config->item('super_global_admin_id')) {
            $this->db->where('user_id', $this->admin_id);
        }
        $this->db->from('brands');
        return $this->db->count_all_results();
    }

}
