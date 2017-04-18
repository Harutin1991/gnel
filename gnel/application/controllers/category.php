<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Category extends MY_Controller {

    protected $tamplate = 'babybuy/product';
    public $cat_display = 'list';
    public $cat_brand = 0;
    public $cat_perpage = 15;

    function __construct() {
        parent::__construct();
		/*
        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }
		*/
		
        $this->load->model('ProductsModel');
		$this->load->model('CategoryModel');
		$this->load->model('MultilangModel');
        // initialize cookies
        if(!isset($_COOKIE['cat_display'])) {
            setcookie('cat_display', $this->cat_display, time() + (86400 * 30*7), "/");
        } else {
            $this->cat_display = $_COOKIE['cat_display'];
        }
        
        $get = $this->input->get(NULL, true);
        if(isset($get['brand'])) {
            $this->cat_brand = intval($get['brand']);
            setcookie('cat_brand', $this->cat_brand, time() + (86400 * 30*1), "/"); 
        } else if(!isset($_COOKIE['cat_brand'])) {
            setcookie('cat_brand', $this->cat_brand, time() + (86400 * 30*1), "/"); 
        } else {
            $this->cat_brand = intval($_COOKIE['cat_brand']);
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
	
        redirect(site_url(''));

	}

	public function item($title = NULL) {
        if (!isset($title)) {
            redirect(site_url(''));
        }

		if(preg_match('/^(.*)-c([^-c]*).html/', $title, $matches)) {
			$category_id = $matches[2];
		} else if(is_numeric($title)){
			$category_id = (int)$title;
		} else {
			redirect(site_url(''));
		}

        $this->data['category'] = $this->CategoryModel->get('categories', $category_id);
		$this->data['meta_title']  = $this->data['category']['name_'. $this->config->item('language')];
		$this->data['meta_keywords']    = $this->data['category']['meta_keywords_'. $this->config->item('language')];
		$this->data['meta_description'] =$this->data['category']['meta_description_'. $this->config->item('language')];
        if ($this->data['category'] == false) {
            redirect(site_url(''));
        }
        $this->data['category_brands'] = $this->CategoryModel->getCategoryBrands($category_id);
        $result = $this->CategoryModel->getCategoryProducts($category_id, $this->cat_brand, $this->cat_perpage, $this->data['page_number']);
//        echo "<pre>";var_dump($result['total']); exit;
        $int_res = isset($result["total"]) ? intval($result["total"]) : 0;
        if($int_res == 0){
            $this->cat_brand = 0;
            setcookie('cat_brand', $this->cat_brand, time() + (86400 * 30*1), "/"); 
            $result = $this->CategoryModel->getCategoryProducts($category_id, $this->cat_brand, $this->cat_perpage, $this->data['page_number']);
        }

        $this->data['category_products'] =$result['products'];
        $this->data['page_count'] = ceil($result["total"] / $this->cat_perpage);
   
        if ($this->data['category_products'] == false) {
            redirect(site_url(''));
        }
                 

		$this->data['parent_categories_array'] = getParentArray($this->data['categories'], 'id', $category_id); 
        $this->data['category_brands'] = $this->CategoryModel->getCategoryBrands($category_id);
		
        $this->data['cat_display'] = $this->cat_display;
        $this->data['cat_brand'] = $this->cat_brand;
        $this->data['cat_perpage'] = $this->cat_perpage;

        $this->load->view('category/item', $this->data);
    }

    
}
