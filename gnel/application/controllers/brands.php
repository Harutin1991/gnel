<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brands extends MY_Controller {

    protected $tamplate = 'babybuy/product';
    public $cat_display = 'list';
    public $cat_perpage = 15;
    public $br_category = 0;

    function __construct() {
        parent::__construct();
        
        $this->load->model('MultilangModel');
        $this->load->model('BrandModel');
        $this->load->model('BaseModel');
        
        // initialize cookies
        if(!isset($_COOKIE['cat_display'])) {
            setcookie('cat_display', $this->cat_display, time() + (86400 * 30*7), "/");
        } else {
            $this->cat_display = $_COOKIE['cat_display'];
        }
        
        $get = $this->input->get(NULL, true);
        
        if(isset($get['br_category'])) {
             $this->br_category = intval($get['br_category']) > 0 ? intval($get['br_category']) : $this->br_category;
        }
        
        if(isset($get['perpage'])) {
            $this->cat_perpage = intval($get['perpage']) > 0 ? intval($get['perpage']) : $this->cat_perpage;
            setcookie('cat_perpage', $this->cat_perpage, time() + (86400 * 30*1), "/"); 
        } else if(!get_cookie('cat_perpage')) {
            setcookie('cat_perpage', $this->cat_perpage, time() + (86400 * 30*1), "/"); 
        } else {
            $this->cat_perpage = intval($_COOKIE['cat_perpage']) > 0 ? intval($_COOKIE['cat_perpage']) : $this->cat_perpage;
        }
        
        $this->data['page_number'] = isset($get['page']) ? $get['page'] : 1;
    }

    public function index($id = NULL) {
        $brands = $this->BrandModel->getAllBrands();
        $this->data['arranged_brands'] = $this->arrangeBrandsByLetters($brands);
//        echo "<pre>";
//        print_r($this->data['brands'] ); exit;
        $this->load->view('brands/all', $this->data);
    }

    public function item($title = NULL){
        if (!isset($title)) {
            redirect(site_url(''));
        }

		if(preg_match('/^(.*)-b([^-b]*).html/', $title, $matches)) {
			$brand_id = $matches[2];
		} else if(is_numeric($title)){
			$brand_id = (int)$title;
		} else {
			redirect(site_url(''));
		}
        
        $this->data['c_brand'] = $this->BrandModel->get('brands', $brand_id);
		$this->data['meta_title']  = $this->data['c_brand']['name_'. $this->config->item('language')];
		$this->data['meta_keywords']    = $this->data['c_brand']['meta_keywords_'. $this->config->item('language')];
		$this->data['meta_description'] = $this->data['c_brand']['meta_description_'. $this->config->item('language')];
        $this->data['c_brand_name'] = $this->data['c_brand']['name_'. $this->config->item('language')];
//        echo "<pre>"; print_r($this->data['c_brand']);exit;
        if ($this->data['c_brand'] == false || $this->data['c_brand']['status'] == '0') {
            redirect(site_url(''));
        }
        $result = $this->BrandModel->getBrandProducts($brand_id, $this->br_category, $this->cat_perpage, $this->data['page_number']);

        $this->data['brand_categories'] = $this->BrandModel->getBrandCategories($brand_id);

        
        $this->data['brand_products'] =$result['products'];
        $this->data['page_count'] = ceil($result["total"] / $this->cat_perpage);
   
        if ($this->data['brand_products'] == false) {
            redirect(site_url(''));
        }
        
        $this->data['cat_display'] = $this->cat_display;
        $this->data['cat_perpage'] = $this->cat_perpage;
        $this->data['br_category'] = $this->br_category;

        
        //for fb
        $this->data['fb_url'] = brand_url($brand_id, $this->data['c_brand_name']);
        $this->data['fb_image'] = brandImg($this->data['c_brand']['image']);
        $this->data['fb_title'] = $this->data['c_brand_name'];
        $this->data['fb_description'] = $this->data['c_brand']['meta_description_'. $this->config->item('language')];
        
        
        $this->load->view('brands/item', $this->data);
    }
    
    public function arrangeBrandsByLetters($brands) {
        $brand_letters = array();
        foreach ($brands AS $brand) {
            $brand_letters[$brand->name[0]][] = $brand;     
        }
        
        return $brand_letters;
    }
    
}