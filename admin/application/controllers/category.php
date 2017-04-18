<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends Main_controller {

    public $layout = 'default';

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('CategoryModel');
        $this->load->model('OptionsModel');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
    }

    public function index() {
        $this->data['categories'] = $this->CategoryModel->getAll('categories');

        $option_counts = $this->CategoryModel->getCountOfOptions();
        $product_counts = $this->CategoryModel->getCountOfProducts();
        if (is_array($this->data['categories']) && count($this->data['categories']) > 0) {
            foreach ($this->data['categories'] as $key => $category) {

                $option_count = isset($option_counts[$category->id]) ? $option_counts[$category->id] : 0;
                $product_count = isset($product_counts[$category->id]) ? $product_counts[$category->id] : 0;

                $options_and_products_counts = sprintf($this->lang->line('options_and_products_counts'), $option_count, $product_count);
                $this->data['categories'][$key]->name .= " ( " . $options_and_products_counts . ')';
            }
        }

        $Arr = array();
        if (is_array($this->data['categories']) && count($this->data['categories']) > 0) {
            foreach ($this->data['categories'] as $item) {
                array_push($Arr, (array) $item);
            }
        }

        $result = treealize($Arr, 'id', 'parent_id', '0');
        Sort_Multidimension_Array($result);
        $this->data['categories'] = $result;

        $categories = json_decode(json_encode($this->data['categories']), true);
        $categories_tree = treealize($categories, 'id', 'parent_id', '0');
        $this->data['childCategories'] = getChildCategories($categories_tree);

        $this->load->view('category/index', $this->data);
    }

    public function add() {
        $this->data['options'] = $this->OptionsModel->getAll('options');

        if ($this->input->post('Category')) {
            $this->form_validation->set_rules($this->CategoryModel->rules_add());

            if ($this->form_validation->run()) {
                $data = $this->input->post();

                $options = array();
                if (isset($data['Category']['option'])) {
                    foreach ($data['Category']['option'] as $option) {
                        foreach ($this->data['languages'] as $language) {
                            foreach ($data['option_value_' . $option . '_' . $language->code] as $option_value)
                                $options[$option][$language->code][] = $option_value;
                        }
                    }
                }

                $data = $this->input->post('Category', true);
                $data['option'] = $options;

                if (isset($data['status'])) {
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }

                $image_data = $this->_do_upload('image', 'category');



                if (isset($image_data['upload_data'])) {
                    $data['image'] = $image_data['upload_data']['file_name'];
                }
                $data = trim_array($data);
                if (($id = $this->CategoryModel->insert('categories', $data)) != false) {
                    $this->addLog('Added category with id: ' . $id);

                    $this->session->set_flashdata('message', 'add_success');
                    redirect('/category/edit/' . $id, 'refresh');
                }
            }
        }

        $this->load->view('category/add', $this->data);
    }

    public function edit($id = NULL) {
        if (!isset($id))
            show_404();
        $this->data['category'] = $this->CategoryModel->get('categories', $id);
        if ($this->data['category'] == false)
            show_404();

        $this->data['options'] = $this->OptionsModel->getAll('options');
        $category_options = $this->CategoryModel->getOptions($id);

        $options = array();
        foreach ($category_options as $option) {
            $option_values = json_decode($option->option_value);
            if (is_array($option_values)) {
                foreach ($option_values as $option_value)
                    $options[$option->option_id][$option->lang_code][] = $option_value;
            }
        }
        $this->data['category_options'] = $options;

//        echo "<pre>";print_r($options);exit;
        if ($this->input->post('Category')) {
            $this->form_validation->set_rules($this->CategoryModel->rules_edit());

            if ($this->form_validation->run()) {
                $data = $this->input->post(NULL, true);
                $options = array();
                if (isset($data['Category']['option'])) {
                    foreach ($data['Category']['option'] as $option) {
                        foreach ($this->data['languages'] as $language) {
                            if (isset($data['option_value_' . $option . '_' . $language->code])) {
                                foreach ($data['option_value_' . $option . '_' . $language->code] as $option_value)
                                    $options[$option][$language->code][] = $option_value;
                            }
                        }
                    }
                }

                $data = $this->input->post('Category', true);
                $data['option'] = $options;

                if (isset($data['status']))
                    $data['status'] = 1;
                else
                    $data['status'] = 0;

                $old_image = $this->data['category']['image'];

                if (!empty($_FILES['image']['name'])) {
                    $image_data = $this->_do_upload('image', 'category');

                    if (isset($old_image))
                        $this->_delete_img($old_image, 'category');

                    if (isset($image_data['upload_data']))
                        $data['image'] = $image_data['upload_data']['file_name'];
                }

                $data['current_options'] = $this->data['category_options'];
                $data = trim_array($data);
                if ($this->CategoryModel->update('categories', $id, $data) != false) {
                    $this->addLog('Edited category with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }

        $this->load->view('category/edit', $this->data);
    }

    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);

        $query = $this->db->get_where($table, array($field => $str));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->$field != $this->data['category'][$field])
                    return false;
            }
        }

        return true;
    }

}
