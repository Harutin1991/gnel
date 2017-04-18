<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partners extends MY_Controller {

    protected $tamplate = 'babybuy/product';
    public $cat_display = 'list';
    public $cat_perpage = 15;

    function __construct() {
        parent::__construct();
        /*
          if (!$this->_is_logged_in()) {
          redirect(site_url('login'));
          }
         */


        $this->load->model('MultilangModel');
        $this->load->model('PartnerModel');
        $this->load->model('BaseModel');
    }

    public function index($id = NULL) {
        $this->data['partners'] = $this->PartnerModel->getAllPartners();
        //$this->data['arranged_brands'] = $this->arrangeBrandsByLetters($brands);
//        echo "<pre>";
//        print_r($this->data['brands'] ); exit;
        $this->load->view('partners/all', $this->data);
    }

//    public function arrangeBrandsByLetters($brands) {
//        $brand_letters = array();
//        foreach ($brands AS $brand) {
//            $brand_letters[$brand->name[0]][] = $brand;     
//        }
//        
//        return $brand_letters;
//    }
}