<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends Main_controller {

    public $layout = 'default';
    public $ord_perpage = 15;
    public $ord_status = '';
    
    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BrandModel');
        $this->load->model('OrdersModel');
        $this->load->model('ProductsModel');
        $this->load->model('SettingsModel');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
        $this->data['brands'] = $this->ProductsModel->getAdminBrands();
        if (empty($this->data['brands'])) {
            redirect('/brand/add');
        }

        $this->data['min_delivery_price'] = $this->SettingsModel->get('min_delivery_price');
        $this->data['static_delivery_price'] = $this->SettingsModel->get('static_delivery_price');

    }

    public function index() {
        if (!isset($_COOKIE['ord_perpage'])) {
            setcookie('ord_perpage', $this->ord_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $this->ord_perpage = $_COOKIE['ord_perpage'];
        }
        
        if (!isset($_COOKIE['ord_status'])) {
            setcookie('ord_status', $this->ord_status, time() + (86400 * 30 * 1), "/");
        } else {
            $this->ord_status = $_COOKIE['ord_status'];
        }

        
        $this->data['ord_perpage'] = $this->ord_perpage;
        $this->data['ord_status'] = $this->ord_status;

        $this->data['page_number'] = 1;
        $result = $this->OrdersModel->getAllOrders($this->ord_perpage, $this->data['page_number'], $this->ord_status);
        
        $this->data['orders'] = $result['orders'];

        $data_count = $result["total"];
        $this->data['page_count'] = ceil($data_count / $this->data['ord_perpage']);
        $this->load->view('order/index', $this->data);
    }
    
    public function item($order_id) {
        $this->data['order_id'] = $order_id;
        $this->data['order'] = $this->OrdersModel->getOrderDetails($order_id);
        $this->data['order_points'] = $this->OrdersModel->getUserOrderPoints($this->data['order'][0]->user_id, $order_id);
        if(empty($this->data['order'])){
            redirect(site_url('order'));
        }
        $this->load->view('order/item', $this->data);
    }
    

}
