<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property MultilangModel $MultilangModel
 * @property PageModel $PageModel
 *
 */

class Page extends MY_Controller {

    protected $tamplate = 'gnel/product';
//    public $menu_name = 'Menu1';
    
    function __construct(){
		parent::__construct();
        
        $this->load->model('PageModel');
        $this->load->model('MenuModel');
		$this->load->model('ProductsModel');
		$this->data['last_products'] = $this->MultilangModel->getProducts();
    }
	public function index($title = 'default') {

        $this->data['title'] = $title;
		$this->load->view('page/index', $this->data);
	}
	
	public function item($url = 'Information') {

        $this->data['url'] = $url;
        $this->data['pages'] = $this->PageModel->getPageData($url);



        if(empty($this->data['pages'])) {
            redirect(site_url('page/Information'));
        }

        $parent_id = $this->data['pages']->parent_id;
        if($parent_id != 0) {
            $this->data['page_parrent'] = $this->PageModel->getParrentPage($parent_id);
            $this->data['page_childes'] = $this->PageModel->getPageChilds($parent_id);

            $this->load->view('page/item', $this->data);
        } else {
            $page_id = $this->data['pages']->page_id;
            $this->data['page_childes'] = $this->PageModel->getPageChilds($page_id);
            $this->load->view('page/index', $this->data);

        }

	}

	public function faq() {
		$this->load->view('site/about');
	}

	public function contacts() {
		$this->load->view('site/contacts');
	}
}
