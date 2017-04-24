<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property MultilangModel $MultilangModel
 * @property ContactModel $ContactModel
 *
 */

class Contact extends MY_Controller {

    protected $tamplate = 'gnel/product';
//    public $menu_name = 'Menu1';

    function __construct(){
        parent::__construct();

        $this->load->model('PageModel');
        $this->load->model('MenuModel');
        $this->load->model('ContactModel');

    }
    public function index() {

        $this->data['pages'] = $this->PageModel->getPageData();

        $this->load->view('page/index', $this->data);
    }


}
