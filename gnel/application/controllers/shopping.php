<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shopping extends My_controller {

    protected $tamplate = 'gnel/main';
    public $data = array();

    public function __construct() {
        parent::__construct();

        $this->load->library('encrypt');
        $this->load->model('UserModel');
        $this->load->model('OrderModel');
        $this->data['delivery_price'] = 0;
        $this->data['min_delivery_price'] = $this->SettingsModel->get('min_delivery_price');
        $this->data['static_delivery_price'] = $this->SettingsModel->get('static_delivery_price');
        if ($this->_is_logged_in()) {
            $this->data['user_id'] = $this->session->userdata('user_id');
            $result = $this->UserModel->getDeliveryPrice($this->data['user_id']);
            $this->data['delivery_price'] = $result['delivery_price'];
            $this->data['delivery_city_id'] = $result['delivery_city_id'];
        }

        $this->data['city_price'] = $this->ShoppingModel->cityDeliveryPrice();
    }

    public function index() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account/login'));
        }
        $this->load->view('account/index', $this->data);
    }

    public function cart() {
        $this->load->view('shopping/cart', $this->data);
    }

    public function checkout() {
        if (empty($this->data['shopping_cart'])) {
            redirect(site_url('shopping/cart'));
        }

        $this->data['countries'] = $this->UserModel->getCountries();
        $this->data['cities'] = $this->UserModel->getCities();
        if ($this->input->post('submit_order')) {
            $post = $this->input->post(NULL, true);
            $error = false;
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $this->data['order_error'] = $this->lang->line("You have submitted wrong email");
            }
            if (!$error && isset($post['checkbox_points']) && !preg_match('/^\d+$/', $post['checkbox_points'])) {
                $post['checkbox_points'] = 0;
            }
            $order_points = isset($post['checkbox_points']) ? $post['checkbox_points'] : 0;

            if (isset($post['register-account'])) {
                if (!$error && $post['password'] != $post['repeat_password']) {
                    $error = true;
                    $this->data['order_error'] = $this->lang->line("Passwords are not match");
                }
                if (!$error && strlen($post['password']) < 6) {
                    $error = true;
                    $this->data['order_error'] = $this->lang->line('Password must contain at least 6 characters');
                }
                if (!$error) {
                    $user_email = array('email' => $post['email']);

                    if ($this->UserModel->getUser($user_email)) {
                        $error = true;
                        $this->data['order_error'] = $this->lang->line("This email already exists");
                    }
                }
                if (!$error) {
                    $post['password'] = sha1($post['password']);
                    if (($id = $this->UserModel->insert('users', $post)) != false) {
                        $user_data = $this->UserModel->getUser($user_email);
                        $this->setLoginData($user_data);
                        $this->data['user_id'] = $this->session->userdata('user_id');
                    } else {
                        $this->data['order_error'] = $this->lang->line('Unknown error during registration');
                        $this->data['insertion_error'] = true;
                    }
                }
            }

            if (!$this->_is_logged_in()) {
                $user_email = array('email' => $post['email']);

                if ($this->UserModel->getUser($user_email)) {
                    $error = true;
                    $this->data['order_error'] = $this->lang->line("This email already exists");
                }
            }

            if (!$error && isset($post['save_my_data'])) {
                $post['same_shipping'] = isset($post['same_shipping']) ? 1 : 0;
                if ($this->UserModel->update('users', $this->data['user_id'], $post)) {
                    
                } else {
                    $error = true;
                    $this->data['order_error'] = $this->lang->line('Unknown error during data update');
                }
            }

            if (!$error) {

                if ($this->_is_logged_in()) {
                    $post['user_id'] = $this->data['user_id'];
                    $post['temp_id'] = '';
                } else {
                    $post['temp_id'] = get_cookie('temp_id') ? get_cookie('temp_id') : '';
                    $post['user_id'] = 0;
                }

                $post['user_ip'] = $_SERVER['REMOTE_ADDR'];

                $order_id = $this->OrderModel->insert('orders', $post);
                $this->data['order_id'] = $order_id;
            }
            if (!$error && $order_id) {
              
                $result = $this->OrderModel->addOrderProduct($order_id, $this->data["shopping_cart"]);

                if ($result) {
                    $this->data['delivery_city_id'] = $post['ship_city_id'];
                    $this->data['delivery_price'] = $this->data['city_price'][$post['ship_city_id']]['price'];
                    $this->data['order_points'] = $order_points;

                    $html_user = $this->load->view('email/order_user', $this->data, true);
                    
                    $user_subject = $this->lang->line('Order from gnel.am');
                    if ($this->send_mail('order@gnel.am', $post["email"], $user_subject, $html_user)) {
                        $order_cart = $this->get_order_ammount($this->data);
                        $this->data['current_order'] = $this->OrderModel->getOrderDetails($this->data['order_id'], false);
                        $html_admin = $this->load->view('email/order_admin', $this->data, true);
                        $admin_subject = 'baby_order_'.$order_cart['total'].'_'.$order_cart['quantity'];
                        $this->send_mail('order@gnel.am', 'babybuy_email@mail.ru', $admin_subject, $html_admin, $admin_subject);
                        $this->data['email_sent'] = true;
                    }
                    if($order_points != 0){
                        $this->load->model('ProductsModel');
                        //$product_id = $order_id;
                        $points = array('amount' => -$order_points, 'id' => 3);
                        $product_id = 0;

                        $total_points = $this->ProductsModel->insertUserPoints($post['user_id'], $product_id, $order_id, (object)$points);

                        $this->session->set_userdata('total_points', $total_points);
                    }
                    //echo '<pre>';var_dump($order_id);exit;
                    $this->ShoppingModel->clearShoppingCart($post['user_id'], $post['temp_id']);
                    $this->data['order_success'] = true;
                    redirect(site_url('shopping/thankyou'));
                } else {
                    $this->data['order_error'] = $this->lang->line('Unknown error during adding order');
                }
            }
        }

        if ($this->_is_logged_in()) {
            $this->data['user'] = $this->UserModel->get('users', $this->data['user_id']);
        }

        $this->data['city_price'] = $this->ShoppingModel->cityDeliveryPrice();
        $this->load->view('shopping/checkout', $this->data);
    }

    public function thankyou() {
        $this->load->view('shopping/thankyou', $this->data);
    }

    public function save_user_data(){


    }

    public function email() {
        exit;
        $this->ci = & get_instance();
        $this->data['order_id'] = '5';
        $this->data['current_order'] = $this->OrderModel->getOrderDetails($this->data['order_id'], false);
        $html = $this->ci->load->view('email/order_admin', $this->data, TRUE);
        //$html = $this->template->load('gnel/email', 'email/forgotpassword', $this->data, true);

        echo $html;
        exit;
    }

    public function sendordermail() {
        $this->ci = & get_instance();
        $html = $this->ci->load->view('email/order_user', $this->data, TRUE);
        $this->send_mail('order@gnel.am', 'adpox@mail.ru', $this->lang->line('Order from gnel.am'), $html);
        echo "mail already sent";
        exit;
    }

    public function get_order_ammount($data) {
        $cart['total'] = 0;
        if (!empty($data['shopping_cart'])) {
            foreach ($data['shopping_cart'] AS $product) {

                $subtotal = intval($product->total_amount);

                $cart['total'] += $subtotal;
                $cart['quantity'] += intval($product->quantity);
            }
        }
        
        return $cart;
    }

}
