<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery extends MY_Controller {

    protected $tamplate = 'gnel/product';
    public $cat_display = 'list';
    public $cat_perpage = 15;

    function __construct() {
        parent::__construct();
        $this->load->model('BaseModel');
    }

    public function index($id = NULL) {
        $this->data['delivery_prices'] = $this->BaseModel->getDeliveryPrices();
//        echo "<pre>";        print_r($this->data['delivery_prices']);exit;
        $this->load->view('delivery/index', $this->data);
    }


}