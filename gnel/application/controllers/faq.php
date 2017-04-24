<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property MultilangModel $MultilangModel
 * @property FaqModel $FaqModel
 *
 */

class Faq extends MY_Controller {

    protected $tamplate = 'gnel/product';
//    public $menu_name = 'Menu1';

    function __construct(){
        parent::__construct();

        $this->load->model('PageModel');
        $this->load->model('MenuModel');
        $this->load->model('FaqModel');
    }

    public function index() {

        $this->data['faqs'] = $this->FaqModel->getAll('faq');
        echo '<pre>'; print_r($this->data['faqs']); die;
        $this->load->view('faq/index', $this->data);
    }


}
