<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blognews_comments extends Main_controller {

    public $layout = 'default';
    public $bg_string = '';
    public $bg_perpage = 15;
    public $bg_pending = 0;

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        //$this->load->model('BrandModel');
        $this->load->model('CommentsModel');
        $this->load->model('BlognewsModel');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
       /* $this->data['brands'] = $this->BlognewsModel->getAdminBrands();
        if (empty($this->data['brands'])) {
            redirect('/brand/add');
        }*/
    }

    public function index() {
        if (!isset($_COOKIE['bg_string'])) {
            setcookie('bg_string', $this->bg_string, time() + (86400 * 30 * 7), "/");
        } else {
            $_COOKIE['bg_string'] = '';
            $this->bg_string = $_COOKIE['bg_string'];
        }

        if (!isset($_COOKIE['bg_perpage'])) {
            setcookie('bg_perpage', $this->bg_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $this->bg_perpage = $_COOKIE['bg_perpage'];
        }

        if (!isset($_COOKIE['bg_pending'])) {
            setcookie('bg_pending', $this->bg_pending, time() + (86400 * 30 * 1), "/");
        } else {
            $this->bg_pending = $_COOKIE['bg_pending'];
        }

        $this->data['bg_string'] = $this->bg_string;
        $this->data['bg_perpage'] = $this->bg_perpage;
        $this->data['bg_pending'] = $this->bg_pending;
        $this->data['page_number'] = 1;
        $result = $this->CommentsModel->getAllCommentedBlognews('DESC', $this->bg_string, $this->bg_perpage, $this->data['page_number'], $this->bg_pending);
       // echo "<pre>"; print_r($result);exit;
        $this->data['blognews'] = $result['blognews'];
        $blognews_ids = getProductsArrayList($this->data['blognews']);
        $this->data['blognews_comments_counts'] = $this->CommentsModel->getBlognewsCommentsCount($blognews_ids);
 //       echo "<pre>"; print_r($this->data['blognews_comments_counts']);exit;
        $data_count = $result["total"];
        $this->data['page_count'] = ceil($data_count / $this->data['bg_perpage']);
        $this->load->view('comment/blognews/index', $this->data);
    }
    

}
