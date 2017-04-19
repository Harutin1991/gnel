<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends My_controller {

    protected $tamplate = 'gnel/account';
    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('UserModel');
        $this->load->model('SettingsModel');
        $this->data['min_delivery_price'] = $this->SettingsModel->get('min_delivery_price');
        $this->data['static_delivery_price'] = $this->SettingsModel->get('static_delivery_price');
    }

    public function index() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account/login'));
        }
        $this->load->view('account/index', $this->data);
    }

    public function login() {
        if ($this->_is_logged_in()) {
            redirect(site_url('account'));
        }
        if ($this->input->post('login')) {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $user_data = $this->UserModel->authenticateLogin($email, $password);
            //echo "<pre>";var_dump($user_data);exit;
            if ($user_data) {
                $this->setLoginData($user_data);
                if ($this->session->userdata('return_url')) {
                    redirect($this->session->userdata('return_url'));
                }
                redirect(site_url('account'));
            } else {
                $this->data['wrong_login'] = true;
            }
        }
        $this->load->view('account/login', $this->data);
    }

    public function points(){
        $this->load->model('ProductsModel');
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }
        $user_id = $this->session->userdata('user_id');
        $this->data['points'] = $this->ProductsModel->getUserPoints($user_id);
        $this->load->view('account/pointshistory', $this->data);
    }

    public function password() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }

        if ($this->input->post('update_password')) {
            $post = $this->input->post(NULL, true);
            $error = false;

            if ($post['password'] != $post['repeat_password']) {
                $error = true;
                $this->data['password_match'] = false;
            }
            if (!$error) {
                $user_password = array('password' => sha1($post['current_password']));
                if (!$this->UserModel->getUser($user_password)) {
                    $error = true;
                    $this->data['wrong_password'] = true;
                }
            }
            if (strlen($post['password']) < 6) {
                $error = true;
                $this->data['short_password'] = false;
            }
            if (!$error) {
                $post['password'] = sha1($post['password']);
                if ($this->UserModel->update('users', $this->data['user_id'], $post)) {
                    $this->data['update_success'] = true;
                } else {
                    $this->data['update_error'] = true;
                }
            }
        }

        $this->load->view('account/password', $this->data);
    }

    public function logout() {
        $this->session->unset_userdata('verify_code');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        if ($this->session->userdata('return_url')) {
            redirect($this->session->userdata('return_url'));
        }
        redirect(site_url('account/login'));
    }

    public function register() {
        if ($this->_is_logged_in()) {
            redirect(site_url('account'));
        }

        if ($this->input->post('register')) {
            $post = $this->input->post(NULL, true);
            $error = false;
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $this->data['wrong_email'] = true;
            }
            if ($post['password'] != $post['repeat_password']) {
                $error = true;
                $this->data['password_match'] = false;
            }
            if (strlen($post['password']) < 6) {
                $error = true;
                $this->data['short_password'] = false;
            }
            if (!$error) {
                $user_email = array('email' => $post['email']);

                if ($this->UserModel->getUser($user_email)) {
                    $error = true;
                    $this->data['email_exists'] = true;
                }
            }

            if (!$error) {
                $post['password'] = sha1($post['password']);
                if (($id = $this->UserModel->insert('users', $post)) != false) {
                    //$user_data = $this->UserModel->getUser($user_email);
                    //$this->setLoginData($user_data);
                    $this->data['code'] = $this->UserModel->addValidationCodeToEmail($post['email']);
                    $html = $this->load->view('email/useractivate', $this->data, true);

                    if ($this->send_mail('admin@gnel.am', $post["email"], 'Account Activation', $html)) {
                        $this->data['email_sent'] = true;
                    }
                    redirect(site_url('account/emailactivate'));
                } else {
                    $this->data['insertion_error'] = true;
                }
            }
        }

        $this->load->view('account/register', $this->data);
    }

    public function comments($table = NULL){
        if (!$this->_is_logged_in()) {
            redirect(site_url('account/login'));
        }
        $bn_string = '';
        $bn_perpage = 5;

        $user_id = $this->session->userdata('user_id');
        $table_name = $table == 'blognews' ? 'blognews_comments' : ($table == 'products' ? 'product_comments' : false);
        if (!isset($_COOKIE[$table_name.'_string'])) {
            setcookie($table_name.'_string', $bn_string, time() + (86400 * 30 * 7), "/");
        } else {
            $_COOKIE[$table_name.'_string'] = '';
            $bn_string = $_COOKIE[$table_name.'_string'];
        }

        if (!isset($_COOKIE[$table_name.'_perpage'])) {
            setcookie($table_name.'_perpage', $bn_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $bn_perpage = $_COOKIE[$table_name.'_perpage'];
        }
        $this->data['pr_string'] = $bn_string;
        $this->data['pr_perpage'] = $bn_perpage;
        $this->data['page_number'] = 1;
        if($table_name){
            $result = $this->UserModel->getUserComments($table_name, $user_id, $table, '',$this->data['page_number'], $bn_perpage);
            $this->data['comments'] = isset($result['comments']) ? $result['comments'] : array();
            $this->data['comment_type'] = $table;
            $data_count = isset($result["total"]) ? $result["total"] : 1;
            $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
            //echo "<pre>"; var_dump($result["total"]);exit;
            $this->load->view('account/comments-history', $this->data);
            //echo "<pre>"; var_dump($result);exit;
        }else{
            redirect(site_url('account'));
        }
    }
    public function activate($code = '') {
        $email = $this->UserModel->ActivateUser($code);
        $user_email = array('email' => $email);
        if ($user_email) {
            $user_data = $this->UserModel->getUser($user_email);
            $this->setLoginData($user_data);
        }
        //for seting appropriate data
        $this->_is_logged_in();
        
        $this->load->view('account/emailactivate', $this->data);
    }

    public function emailactivate() {
        $this->load->view('account/emailactivate', $this->data);
    }

    public function address() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }
        $this->data['countries'] = $this->UserModel->getCountries();
        $this->data['cities'] = $this->UserModel->getCities();
        if ($this->input->post('update_address')) {
            $post = $this->input->post(NULL, true);
            $post['same_shipping'] = isset($post['same_shipping']) ? 1 : 0;
            if ($this->UserModel->update('users', $this->data['user_id'], $post)) {
                $this->data['update_success'] = true;
            } else {
                $this->data['update_error'] = true;
            }
        }
        $this->data['user'] = $this->UserModel->get('users', $this->data['user_id']);
        $this->load->view('account/address', $this->data);
    }

    public function forgotpassword() {
        if ($this->_is_logged_in()) {
            redirect(site_url('account'));
        }

        if ($this->input->post('get_password')) {
            $post = $this->input->post(NULL, true);
            $error = false;
            $user_email = array('email' => $post['email']);
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL) ||
                    !$this->UserModel->getUser($user_email)) {
                $error = true;
                $this->data['wrong_email'] = true;
            }

            if (!$error) {
                $status = $this->UserModel->checkUserStatus($post['email']);
                if ($status === FALSE) {
                    $this->data['wrong_email'] = true;
                } else if ($status == '0') {
                    $this->data['code'] = $this->UserModel->getValidationCodeToEmail($post['email']);
                    $html = $this->load->view('email/useractivate', $this->data, true);

                    if ($this->send_mail('admin@gnel.am', $post["email"], 'Account Activation', $html)) {
                        $this->data['activation_email_sent'] = true;
                        $this->data['email_sent'] = true;
                    }
                } else {
                    $this->data['new_pass'] = $this->UserModel->generateNewPassword($post['email']);
                    if ($this->data['new_pass']) {
                        $html = $this->load->view('email/forgotpassword', $this->data, true);

                        if ($this->send_mail('admin@gnel.am', $post["email"], 'New Password', $html)) {
                            $this->data['password_email_sent'] = true;
                            $this->data['email_sent'] = true;
                        }
                    }
                }
            }
        }
        $this->load->view('account/forgotpassword', $this->data);
    }

    public function my() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }

        $this->data['user'] = $this->UserModel->get('users', $this->data['user_id']);
        if ($this->input->post('update_account')) {
            $post = $this->input->post(NULL, true);
            $old_image = $this->data['user']['image'];
            if (!empty($_FILES['image']['name'])) {
                $image_data = $this->_do_upload('image', 'users/' . $this->data['user_id']);

                if (isset($old_image))
                    $this->_delete_img($old_image, 'users/' . $this->data['user_id']);

                if (isset($image_data['upload_data']))
                    $post['image'] = $image_data['upload_data']['file_name'];
            }

            if ($this->UserModel->update('users', $this->data['user_id'], $post)) {
                $this->data['update_success'] = true;
            } else {
                $this->data['update_error'] = true;
            }
        }
        $this->data['user'] = $this->UserModel->get('users', $this->data['user_id']);
        $this->load->view('account/my', $this->data);
    }

    public function orderhistory() {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }
        $this->load->model('OrderModel');
        $od_perpage = 5;
        if (!isset($_COOKIE['od_perpage'])) {
            setcookie('od_perpage', $od_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $od_perpage = $_COOKIE['od_perpage'];
        }
        $this->data['od_perpage'] = $od_perpage;
        $this->data['page_number'] = 1;

        $result = $this->OrderModel->getUserOrders($this->data['page_number'], $od_perpage);
        $this->data['orders'] =  isset($result['orders']) ? $result['orders'] : array();
        $data_count = isset($result["total"]) ? $result["total"] : 1;
        $this->data['page_count'] = ceil($data_count / $this->data['od_perpage']);

        $this->load->view('account/orderhistory', $this->data);
    }

    public function orderinfo($order_id) {
        if (!$this->_is_logged_in()) {
            redirect(site_url('account'));
        }
        $this->load->model('OrderModel');
        $this->data['order_id'] = $order_id;
        $this->data['order'] = $this->OrderModel->getOrderDetails($order_id);
        $order_points = $this->OrderModel->getUserOrderPoints($this->session->userdata('user_id'), $order_id);
        $this->data['order_points'] = isset($order_points->points) ? $order_points->points : 0;
        if(empty($this->data['order'])) {
            redirect(site_url('account/orderhistory'));
        }
//        echo '<pre>'; print_r($this->data['order']); exit;
        $this->load->view('account/orderinfo', $this->data);
    }
    
    public function email() {
        exit;
        $this->data['new_pass'] = 111111;
        $this->data['code'] = 111111;
        $this->ci = & get_instance();
        $html = $this->ci->load->view('email/useractivate', $this->data, TRUE);
        //$html = $this->template->load('gnel/email', 'email/forgotpassword', $this->data, true);
        echo $html;
        exit;
    }

}
