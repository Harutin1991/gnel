<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_comments extends Main_controller {

    public $layout = 'default';
    public $pr_string = '';
    public $pr_perpage = 15;
    public $pr_pending = 0;

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BrandModel');
        $this->load->model('CommentsModel');
        $this->load->model('ProductsModel');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
        $this->data['brands'] = $this->ProductsModel->getAdminBrands();
        if (empty($this->data['brands'])) {
            redirect('/brand/add');
        }
    }

    public function index() {
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

        if (!isset($_COOKIE['pr_pending'])) {
            setcookie('pr_pending', $this->pr_pending, time() + (86400 * 30 * 1), "/");
        } else {
            $this->pr_pending = $_COOKIE['pr_pending'];
        }
        
        $this->data['pr_string'] = $this->pr_string;
        $this->data['pr_perpage'] = $this->pr_perpage;
        $this->data['pr_pending'] = $this->pr_pending;
        $this->data['page_number'] = 1;
        $result = $this->CommentsModel->getAllCommentedProducts('DESC', $this->pr_string, $this->pr_perpage, $this->data['page_number'], $this->pr_pending);

        $this->data['products'] = $result['products'];
        $products_ids = getProductsArrayList($this->data['products']);
        $this->data['product_comments_counts'] = $this->CommentsModel->getProductsCommentsCount($products_ids);
//        echo "<pre>"; print_r($this->data['product_comments_counts']);exit;
        $data_count = $result["total"];
        $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
        $this->load->view('comment/product/index', $this->data);
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
                $this->admin_id != $this->config->item('super_global_admin_id')) {
            redirect(site_url('product'));
        }
        $this->data['selected_categories'] = $this->ProductsModel->getProductCategories($id);
        $categories = $this->CategoryModel->getAll('categories');
        $categories = json_decode(json_encode($categories), true);
        $categories_tree = treealize($categories, 'id', 'parent_id', '0');
        $this->data['categories'] = getChildCategories($categories_tree);


        $this->load->view('product/edit', $this->data);
    }

}
