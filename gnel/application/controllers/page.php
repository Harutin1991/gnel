<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property MultilangModel $MultilangModel
 * @property PageModel $PageModel
 *
 */
class Page extends MY_Controller {
    protected $tamplate = 'gnel/product';

    function __construct(){
        parent::__construct();

        $this->load->model('PageModel');
    }

    public function index($title = 'default') {
        $this->data['title'] = $title;
        $this->load->view('page/index', $this->data);
    }

    public function item($url = 'Information') {
        $this->data['url'] = $url;
        $this->data['pages'] = $this->PageModel->getPageData($url);
//       echo '<pre>'; print_r($this->data['pages']); die;

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