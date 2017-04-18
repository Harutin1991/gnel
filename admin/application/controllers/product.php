<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends Main_controller {

    public $layout = 'default';
    public $pr_string = '';
    public $pr_perpage = 15;

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BrandModel');
        $this->load->model('ProductsModel');
        $this->load->model('CategoryModel');
        $this->load->model('OptionsModel');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
        $this->data['brands'] = $this->ProductsModel->getAdminBrands();
        if (empty($this->data['brands'])) {
            redirect('/brand/add');
        }
    }

    public function index($id = NULL) {
//        echo "<pre>"; print_r(isset($_COOKIE['pr_string']));

        if (!isset($_COOKIE['pr_string'])) {
            setcookie('pr_string', $this->pr_string, time() + (86400 * 30 * 7), "/");

        } else {
            $_COOKIE['pr_string'] = '';
            $this->pr_string = $_COOKIE['pr_string'];
        }

        if (!isset($_COOKIE['pr_perpage'])) {
            setcookie('pr_perpage', $this->pr_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $this->pr_perpage = $_COOKIE['pr_perpage'];
        }

        if($id != NULL) {
            $this->data['pr_string'] = $this->pr_string;
            $this->data['pr_perpage'] = $this->pr_perpage;
            $this->data['page_number'] = 1;
            $this->data['id'] = $id;
            $result = $this->ProductsModel->getBrandProducts($id, 'DESC', $this->pr_string, $this->pr_perpage, $this->data['page_number']);

            $this->data['products'] = $result['products'];
            $data_count = $result["total"];
            $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
            $this->load->view('product/index', $this->data);
        } else {
            $this->data['pr_string'] = $this->pr_string;
            $this->data['pr_perpage'] = $this->pr_perpage;
            $this->data['page_number'] = 1;
            $result = $this->ProductsModel->getAllProducts('DESC', $this->pr_string, $this->pr_perpage, $this->data['page_number']);

            $this->data['products'] = $result['products'];
            $data_count = $result["total"];
            $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
            $this->load->view('product/index', $this->data);
        }

    }

    public function add() {
        $categories = $this->CategoryModel->getAll('categories');
        $categories = json_decode(json_encode($categories), true);
        $categories_tree = treealize($categories, 'id', 'parent_id', '0');
        $this->data['categories'] = getChildCategories($categories_tree);
        if ($this->input->post('Product')) {
            $this->form_validation->set_rules($this->ProductsModel->rules_add());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Product', true);
                $data['user_id'] = $this->admin_id;

                //latin name and description
                $data['latin_name'] = converArmToLatin($data["name_am"]);
                $data['latin_description'] = converArmToLatin($data["description_am"]);
                $data = trim_array($data);
//                echo '<pre>'; print_r($data); exit();

                if (($id = $this->ProductsModel->insert('products', $data)) != false) {
                    $this->addLog('Added product with id: ' . $id);

                    $this->session->set_flashdata('message', 'add_success');
                    redirect('/product/addImages/' . $id, 'refresh');
                }
            }
        }

        $this->load->view('product/add', $this->data);
    }

    public function addImages($id = NULL) {
        if (!isset($id)) {
            show_404();
            redirect(site_url('product'));
        }
        $this->data['product'] = $this->ProductsModel->get('products', $id);
        if ($this->data['product'] == false) {
            show_404();
            redirect(site_url('product'));
        }
        if ($this->admin_id != $this->data['product']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id') &&
                $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('product'));
        }
        $this->data['product']['images'] = $this->ProductsModel->getWhere('product_images', $id);

        if ($this->input->post() != false) {

            if (!empty($_FILES['images']['name'][0])) {
                $_FILES = reArrayFiles($_FILES['images']);

                $path = $this->config->item('images_path');
                $config['upload_path'] = $path . 'product/' . $id;

                if (!is_dir($config['upload_path'])) {
                    @mkdir($config['upload_path'], 0755, true);
                    // add index.html file to new created folder
                    $dest = $config['upload_path']. "/index.html";
                    $source = FCPATH . "system/index.html";
                    if(is_file($source)) {
                        copy($source, $dest);
                    }
                }

                $config['allowed_types'] = 'gif|jpg|png'; // by extension, will check for whether it is an image
                $config['encrypt_name'] = true;
                $this->load->library('upload');
                $this->upload->initialize($config);

                $data = array();
                foreach ($_FILES as $key => $image) {
                    $this->upload->do_upload($key);
                    $uploadData = $this->upload->data();
                    $data[] = array(
                        'product_id' => $id,
                        'image' => $uploadData['file_name']
                    );
                }

                $this->ProductsModel->insertImages($data);
            }

            $this->session->set_flashdata('message', 'add_success');
        }

        $this->load->view('product/addimages', $this->data);
    }

    public function options($id = NULL) {
        if (!isset($id)) {
            show_404();
            redirect(site_url('product'));
        }
        $this->data['product'] = $this->ProductsModel->get('products', $id);
        if ($this->data['product'] == false) {
            show_404();
            redirect(site_url('product'));
        }
        if ($this->admin_id != $this->data['product']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id') &&
                $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('product'));
        }
        $category_ids = $this->ProductsModel->getCategoryIds($id);
        if (empty($category_ids)) {
            redirect(site_url('product/edit/' . $id));
        }
        $category_options = $this->ProductsModel->getOptionIds($category_ids);

        if ($this->input->post() != false) {

            $post = $this->input->post(NULL, TRUE);
            $conv_post = $this->convertPostForUpdate($post["pr_option"], $id);
            $result_remove = $this->ProductsModel->removeOptionOldValues($id);

            $result = $this->ProductsModel->updatePrductOtions($conv_post);
            $this->addLog('Updated options of product with id: ' . $id);
            $this->session->set_flashdata('message', 'edit_success');
            redirect(current_url(), 'refresh');
        }

        $product_options = $this->CategoryModel->getProductOptions($category_ids, $id);

        $this->data['lang_options'] = $this->prepareForDrawing($product_options); //$lang;
        $this->load->view('product/options', $this->data);
    }

    public function edit($id = NULL) {
        if (!isset($id)) {
            show_404();
            redirect(site_url('product'));
        }


        if ($this->input->post('Product')) {
            $this->form_validation->set_rules($this->ProductsModel->rules_edit());

            if ($this->form_validation->run()) {
                $data = $this->input->post('Product', true);

                //latin name and description
                $data['latin_name'] = converArmToLatin($data["name_am"]);
                $data['latin_description'] = converArmToLatin($data["description_am"]);

                //update product categories
                $categories = isset($data["category"]) ? $data["category"] : array();
                if ($this->ProductsModel->updateProductCategory($id, $categories) != false) {
                    $this->addLog("Updated  product(id=$id) to categories");
                }
                //update product
                $data = trim_array($data);
                if ($this->ProductsModel->update('products', $id, $data) != false) {
                    $this->addLog('Edited product with id: ' . $id);

                    $this->session->set_flashdata('message', 'edit_success');
                    $this->session->flashdata('message');

                    redirect(current_url(), 'refresh');
                }
            }
        }

        $this->data['product'] = $this->ProductsModel->getProductDetails($id);
        if ($this->data['product'] == false) {
            show_404();
            redirect(site_url('product'));
        }
        if ($this->admin_id != $this->data['product']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id')
                && $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('product'));
        }
        $this->data['selected_categories'] = $this->ProductsModel->getProductCategories($id);
        $categories = $this->CategoryModel->getAll('categories');
        $categories = json_decode(json_encode($categories), true);
        $categories_tree = treealize($categories, 'id', 'parent_id', '0');
        $this->data['categories'] = getChildCategories($categories_tree);


        $this->load->view('product/edit', $this->data);
    }

    public function comments($product_id) {
        if (preg_match('/^[0-9]*$/', $product_id)){
           $this->data['product_comments'] = array(1 => 'test');
           $this->data['product'] = $this->ProductsModel->getProductDetails($product_id);
           if (!empty($this->data['product'])) {
               $this->data['product_comments'] = $this->ProductsModel->getProductComments($product_id);
               $this->load->view('product/comments', $this->data);
           } else {
               redirect('product_comments');
           }
       } else{
           redirect('product_comments');
       }
    }
    
    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);

        $query = $this->db->get_where($table, array($field => $str));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->$field != $this->data['product'][$field]) {
                    return false;
                }
            }
        }

        return true;
    }

    public function convertPostForUpdate($post, $product_id) {
        $conv_post = array();

        foreach ($post AS $opt_key => $opt_val) {
            $opt_key_ = explode("_", $opt_key);
            foreach ($opt_val AS $value) {
                $row = array(
                    "product_id" => $product_id,
                    "category_id" => $opt_key_[0],
                    "option_id" => $opt_key_[1],
                    "lang_code" => $opt_key_[2],
                    "value" => $value
                );
                array_push($conv_post, $row);
            }
        }

        return $conv_post;
    }

    public function getUnselectedOptions($category_options, $conv_post) {
        foreach ($conv_post AS $opt) {
            if (($key = array_search($opt["option_id"], $category_options)) !== false) {
                unset($category_options[$key]);
            }
        }
        return $category_options;
    }

    public function prepareForDrawing($category_options) {
        $lang = array();
        foreach ($category_options as $option) {
            $option_values = json_decode($option->option_value);

            $lang[$option->lang_code][$option->option_id]["options"] = $option_values;

            $lang[$option->lang_code][$option->option_id]['cat_name'] = $option->cat_name;
            $lang[$option->lang_code][$option->option_id]['opt_name'] = $option->opt_name;
            $lang[$option->lang_code][$option->option_id]['category_id'] = $option->category_id;
            $lang[$option->lang_code][$option->option_id]['values'][] = $option->value;
        }

        return $lang;
    }
/*
    public function armtolatin() {

        $query = $this->ProductsModel->db->query('select products.id AS product_id, products_t.name AS name_am, products_t.description AS description_am '
                . ' from products '
                . 'left join products_t on products.id = products_t.product_id '
                . 'where products_t.lang_code = "am"');

        if ($query->num_rows() > 0) {
            $res = $query->result();
        }
        foreach ($res AS $row) {
            var_dump($row);
            echo "<hr/>";
            $id = $row->product_id;
            $data['latin_name'] = converArmToLatin($row->name_am);
            $data['latin_description'] = converArmToLatin($row->description_am);
            $this->ProductsModel->db->where('id', $id);
            $this->ProductsModel->db->update('products', $data);
        }


        echo 222222;
        exit;
    }

    public function trimproductName() {
        $query = $this->ProductsModel->db->query('select * from products_t');
        if ($query->num_rows() > 0) {
            $res = $query->result();
        }
        foreach ($res AS $row) {
            $id = $row->product_id;
            $lang_code = $row->lang_code;
            $data['name'] = trim($row->name);
            $data['description'] = trim($row->description);
            $data['meta_keywords'] = trim($row->meta_keywords);
            $data['meta_description'] = trim($row->meta_description);
            $this->ProductsModel->db->where('product_id', $id);
            $this->ProductsModel->db->where('lang_code', $lang_code);
            $this->ProductsModel->db->update('products_t', $data);
        }


        echo 222222;
        exit;
    }
*/
}
