<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

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

        $this->load->helper('main_helper');

        $this->load->model('MultilangModel');
        $this->load->model('ProductsModel');
        $this->load->model('BaseModel');
    }

    public function index($id = NULL) {
        redirect(site_url(''));
    }

    public function item($title = NULL) {
        if (!isset($title)) {
            redirect(site_url(''));
        }

        if (preg_match('/^(.*)-p([^-c]*).html/', $title, $matches)) {
            $id = $matches[2];
        } else if (is_numeric($title)) {
            $id = (int) $title;
        } else {
            redirect(site_url(''));
        }

        $this->data['product'] = $this->ProductsModel->getProductDetails($id);

//         echo "<pre>"; var_dump($this->data['product']);exit;

        if ($this->data['product'] == false || $this->data['product']['brand_status'] == '0'){
            redirect(site_url(''));
        }

        if ($this->input->post('submit_comment')) {
            $post = $this->input->post(NULL, true);
            $error = false;
            $this->load->model('BaseModel');
            $post = $this->input->post(NULL, true);
            if (!$this->_is_logged_in()) {
                $this->data['error'] = 'Please log in to comment';
                $error = true;
            }
            if (!$error) {
                $data['user_id'] = $this->session->userdata('user_id');
                $data['product_id'] = $id;
                $data['comment'] = trim($post['comment']);
                $data['comment_date'] = date('Y-m-d H:i:s', time());
                $data['ip'] = get_client_ip();
            }
            if ($data['comment'] == '') {
                $this->data['error'] = 'Please fill all fields.';
            } else {
                $comment_id = $this->BaseModel->insert('product_comments', $data);

                // send email to client about comment

                $repr_details = $this->ProductsModel->getProductRepresantativeDetails($id);
                $to = $repr_details->email;
                if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                    $from = 'comment@babybuy.am';
                    $subject = $this->lang->line('New comment');
                    $comment_email_data['comment'] = $data['comment'];
                    $comment_email_data['comment_date'] = $data['comment_date'];
                    $comment_email_data['product'] = $this->data['product'];
                    $message = $this->load->view('email/new_comment_to_admin', $comment_email_data, true);
                    $this->send_mail($from, $to, $subject, $message, $from_name = 'Babybuy.am');

                }

                $this->data['success'] = true;
                unset($_POST);
            }
        }

//        if(isset($_GET['dev'])) {
//           $from = 'comment@babybuy.am';
//                    $subject = $this->lang->line('New comment');
//                    $data['comment'] = 'comment descripton';
//                    $data['comment_date'] = date('Y-m-d H:i:s', time());
//                    $comment_email_data['comment'] = $data['comment'];
//                    $comment_email_data['comment_date'] = $data['comment_date'];
//                    $comment_email_data['product'] = $this->data['product'];
//                    $message = $this->load->view('email/new_comment_to_admin', $comment_email_data, true);
//                    var_dump($message);
//            echo "<pre>"; 
//            //var_dump($repr_details); 
//            exit;
//        }



        $this->data['meta_title'] = $this->data['product']['name_' . $this->config->item('language')] . ' ' . $this->data['product']['brand_name'];
        if ($this->config->item('language') == 'am') {
            $this->data['meta_title'] .= ' | ' . $this->data['product']['latin_name'];
        }
        $this->data['meta_keywords'] = $this->data['product']['meta_keywords_' . $this->config->item('language')];
        $this->data['meta_description'] = $this->data['product']['meta_description_' . $this->config->item('language')];
        $this->data['parent_categories_array'] = getParentArray($this->data['categories'], 'id', $this->data['product']['category_id']);
        $this->data['product_images'] = $this->ProductsModel->getProductImages($id);
        $this->data['product_options'] = $this->ProductsModel->getProductOptions($id);
        $this->data['product_rates'] = $this->ProductsModel->getProductAvgRate($id);
        $this->data['comment_page_number'] = 1;
        $this->data['comment_perpage'] = 5;
        $this->data['product_comments'] = $this->ProductsModel->getProductComments($id, $this->data['comment_page_number'], $this->data['comment_perpage']);
        if ($this->_is_logged_in()) {
            $this->data['user_product_rate'] = $this->ProductsModel->getUserRates($this->data['user_id'], $id);
        }

        //for fb
        $this->data['fb_url'] = product_url($id, $this->data['product']['name_' . $this->config->item('language')]);
        $this->data['fb_image'] = prodImg($id, $this->data['product']['image']);
        $this->data['fb_title'] = $this->data['product']['name_' . $this->config->item('language')] . ' ' . $this->data['product']['brand_name'];
        if($this->data['meta_description'] === ''){
            $fb_d = mb_substr($this->data['product']["description_" . $this->config->item('language')],0,100,'UTF-8');
            $fb_d = strip_tags( $fb_d );
            $fb_d = str_replace('"', "'", $fb_d);
            $this->data['fb_description'] = $fb_d . '...';
        } else {
            $this->data['fb_description'] = $this->data['meta_description'];
        }


//        $product_data = $this->ProductsModel->getProductData($id);
        $this->session->set_userdata('return_url', $this->uri_string());
        $this->load->view('product/item', $this->data);
    }

    public function search($keyword) {
        //header('Content-type: text/plain; charset=utf-8');
        $keyword = urldecode($keyword);
        $this->data['keyword'] = $keyword;

        $this->ProductsModel->updateSearchWordTable($keyword);

        $get = $this->input->get(NULL, true);
        $this->data['page_number'] = isset($get['page']) ? intval($get['page']) : 1;
        // initialize cookies
        if (!isset($_COOKIE['cat_display'])) {
            setcookie('cat_display', $this->cat_display, time() + (86400 * 30 * 7), "/");
        } else {
            $this->cat_display = $_COOKIE['cat_display'];
        }
        if (isset($get['perpage'])) {
            $this->cat_perpage = intval($get['perpage']) > 0 ? intval($get['perpage']) : $this->cat_perpage;
            setcookie('cat_perpage', $this->cat_perpage, time() + (86400 * 30 * 1), "/");
        } else if (!get_cookie('cat_perpage')) {
            setcookie('cat_perpage', $this->cat_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $this->cat_perpage = intval($_COOKIE['cat_perpage']) > 0 ? intval($_COOKIE['cat_perpage']) : $this->cat_perpage;
        }


        $result = $this->ProductsModel->findProducts('DESC', $keyword, $this->cat_perpage, $this->data['page_number']);
        //$this->data['found_brands'] = $this->ProductsModel->foundBrands($result['products']);
        $this->data['found_products'] = $result['products'];
//        var_dump($this->data['found_products']);exit;
        $this->data['page_count'] = ceil($result["total"] / $this->cat_perpage);

        $this->data['cat_display'] = $this->cat_display;
        $this->data['cat_perpage'] = $this->cat_perpage;
        $this->load->view('product/search', $this->data);
    }

    public function uri_string() {
        $CI = & get_instance();
        $uri = $CI->uri->uri_string();
        $lang = $CI->config->item('language') . '/';
        //var_dump($lang);exit;
        $uri = str_replace($lang, "", $uri);
        return $uri;
    }

}
