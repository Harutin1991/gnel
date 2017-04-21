<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* @property ShoppingModel $ShoppingModel
 */
class MY_Controller extends CI_Controller {

    protected $tamplate = 'default';

    function __construct() {
        parent::__construct();
        $this->_is_logged_in();
        $this->output->set_template($this->tamplate);

        $languages = $this->LanguagesModel->getLanguages('languages');
        $default_language = $this->SettingsModel->get('default_language');
        $this->config->set_item('language', $default_language);
        $this->load->model('CategoryModel');
        $this->load->model('MenuModel');
        $this->load->model('ShoppingModel');
        $firstSegment = getFirstSegment();
        if ($firstSegment != NULL) {
            if (array_key_exists($firstSegment, $languages))
                $this->config->set_item('language', $firstSegment);
        }

        if (!get_cookie('temp_id')) {
            $temp_id = generateRandomString(32);
            set_cookie('temp_id', $temp_id, '604840'); // a week
        }
        if ($this->_is_logged_in()) {
            $this->data['user_id'] = $this->session->userdata('user_id');
            $data_shopping['user_id'] = $this->data['user_id'];
            $data_shopping['temp_id'] = '';
        } else {
            $data_shopping['user_id'] = 0;
            $data_shopping['temp_id'] = get_cookie('temp_id') ? get_cookie('temp_id') : '';
        }
        $this->load->vars(array('languages' => $languages, 'default_language' => $default_language));
        $this->lang->load("custom");
        $this->data['last_products'] = $this->MultilangModel->getProducts();
        $this->data['categories'] = $this->getAllCategories();
        $this->data['parent_categories_array'] = getParentArray($this->data['categories'], 'id');
        $this->data["menu"] = $this->MenuModel->getAllMenus();
        $this->data["lang"] = $this->config->item('language');


        $this->data["shopping_cart"] = $this->ShoppingModel->getShoppingCart($data_shopping);
    }

    protected function set_lang($language) {
        $this->config->set_item('language', $language);
        $this->input->set_cookie('lang', $language, '604840');
    }

    public function getAllCategories() {

        $categories = $this->CategoryModel->getAll('categories');

        $categories = $this->getCategoriesProductsCount($categories);
        $categories = treealize($categories, 'id', 'parent_id', '0');
        Sort_Multidimension_Array($categories);
        $this->getParentCategoriesProductsCount($categories);
        //echo "<pre>"; print_r ($categories);exit;
        return $categories;
    }

    public function getCategoriesProductsCount($categories) {
        $product_counts = $this->CategoryModel->getCountOfProducts();
        if (is_array($categories) && count($categories) > 0) {
            foreach ($categories as $key => $category) {
                $product_count = isset($product_counts[$category->id]) ? $product_counts[$category->id] : 0;
                $categories[$key]->product_count = $product_count;
            }
        }

        return $categories;
    }

    public function getParentCategoriesProductsCount(&$categories) {
        $product_count = 0;
        foreach ($categories AS $k => $category) {

            if (isset($category->children)) {
                $res = $this->getParentCategoriesProductsCount($category->children);
                $product_count += $res;
                $category->product_count = $res;
            } else {
                $product_count += $category->product_count;
            }
        }
        //echo $product_count.'-';
        //echo "<br/><pre>";
        //$categories['product_count'] = $product_count;
        //$categories->product_count = $product_count;
        //var_dump($categories);
        //echo "</pre><br/>";
        return $product_count;
    }

    protected function _is_logged_in() {
        $this->load->library('encrypt');
        $config_verify_code = $this->config->item('encryption_key');
        $email = $this->session->userdata('email');
        $verify_code_ = $email . $config_verify_code;
        $verify_code = $this->session->userdata('verify_code');
        $verify_code = $this->encrypt->decode($verify_code);
        $this->data['logged'] = strcmp($verify_code, $verify_code_) === 0;
        //var_dump($verify_code, $verify_code_);exit;
//        if ($this->data['logged']) {
//            $this->session->set_userdata('return_url', uri_string());
//        }
        return $this->data['logged'];
    }

    protected function _do_upload($userfile, $folder) {
        $path = $this->config->item('images_path');
        //$config = array();
        $config['upload_path'] = $path . "{$folder}";
        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0755, true);
            // add index.html file to new created folder
            $dest = $config['upload_path']. "/index.html";
            $source = FCPATH . "system/index.html";
            if(is_file($source)) {
                copy($source, $dest);
            }
        }
        $config['upload_path'] = $path . "{$folder}";
        $config['allowed_types'] = 'gif|jpg|png'; // by extension, will check for whether it is an image
        $config['encrypt_name'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $files = $this->upload->do_upload($userfile);

        if ($files === false) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());

            return $data;
        }
    }

    protected function _delete_img($filename, $folder) {
        $path = $this->config->item('images_path');
        $file_path = $path . "{$folder}/{$filename}";
        if (is_file($file_path)) {
            unlink($file_path);
        }
    }

    protected function _delete_folder($foldername, $edit = true) {
        $path = $this->config->item('images_path');
        $folder = $path . "{$foldername}";

        if (file_exists($folder)) {
            $files = scandir($folder);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($folder . '/' . $file)) {
                    $this->_delete_folder($foldername . '/' . $file);
                } else {
                    @unlink($folder . "/" . $file);
                }
            }
            if ($edit) {
                rmdir($folder);
            }
        }
    }

    public function setLoginData($user_data) {
        $verify_code = $this->encrypt->encode($user_data['email'] . $this->config->item('encryption_key'));
        $this->session->set_userdata('verify_code', $verify_code);
        $this->session->set_userdata('user_id', $user_data['id']);
        $this->session->set_userdata('email', $user_data['email']);
        $this->session->set_userdata('first_name', $user_data['first_name']);
        $this->session->set_userdata('last_name', $user_data['last_name']);
        $this->session->set_userdata('total_points', $user_data['total_points']);
        $this->load->model('ShoppingModel');
        $temp_id = get_cookie('temp_id');
        if ($temp_id) {
            $this->ShoppingModel->updateShoppingCartDuringLogin($user_data['id'], $temp_id);
        }
    }

	public function send_mail($from, $to, $subject, $message, $from_name = 'Babybuy.am') {
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($from, $from_name);
		$this->email->to($to); 

		$this->email->subject($subject);
		$this->email->message($message);	

		$this->email->send();
		return true;
	}
}
