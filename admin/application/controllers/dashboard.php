<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property BaseModel $BaseModel
 * @property CommentsModel $CommentsModel
 *
 */
class Dashboard extends Main_controller {
	function __construct(){
		parent::__construct();	
		if(!$this->_is_logged_in()){ redirect(site_url('login')); }		
		
		$this->load->model('BaseModel');
		$this->load->model('CommentsModel');
	}
	public $layout = 'default'; 
	public function index()
	{
        $this->data["product_count"] = $this->BaseModel->getCount('products');
        $this->data["brand_count"] = $this->BaseModel->getCount('brands');
        $this->data["users"] = $this->BaseModel->getCount('users');
        $this->data["orders"] = $this->BaseModel->getCount('orders');
        $allComments = $this->CommentsModel->getUserProductsCommentsCount();
		$blognews_comments = $this->CommentsModel->getUserBlognewsCommentsCount();
		$this->data['blognews_comments'] = $blognews_comments;
        $this->data["product_comments"] = $allComments;
		$this->load->view('pages/dashboard', $this->data);
	}
}
