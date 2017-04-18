<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

    protected $tamplate = 'babybuy/product';
    public $menu_name = 'Menu1';
    
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
        $this->data['page'] = $this->PageModel->getPageData($url);
        if(empty($this->data['page'])) {
            redirect(site_url('page/Information'));
        }
		$this->load->view('page/index', $this->data);
	}

	public function about() {
		$this->load->view('site/about');
	}

	public function contacts() {
		$this->load->view('site/contacts');
	}
}