<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property MultilangModel $MultilangModel
 * @property BlogModel $BlogModel
 * @property BaseModel $BaseModel
 *
 */

class Blog extends MY_Controller {

    protected $tamplate = 'gnel/blog';
    public $blg_display = 'list';
    public $blg_perpage = 7;
    public $br_category = 0;

    function __construct() {
        parent::__construct();
        
        $this->load->model('MultilangModel');
        $this->load->model('BlogModel');
        $this->load->helper('main_helper');
        $get = $this->input->get(NULL, true);

        $this->data['page_number'] = isset($get['page']) ? $get['page'] : 1;
        $this->data['first_item_id'] = 0;

    }

    public function index() {

        $this->data["blognews"] = $this->BlogModel->getAll('blognews');;

        $this->load->view('blog/latest', $this->data);
    }


   public function item($id = NULL){

        if (!isset($id)) {
            redirect(site_url(''));
        }

       $this->data['blog'] = $this->BlogModel->get('blognews', $id);
//        var_dump($this->data['blog']); die;

       $this->load->view('blog/blog-details', $this->data);
    }
    
    public function arrangeBrandsByLetters($brands) {
        $brand_letters = array();
        foreach ($brands AS $brand) {
            $brand_letters[$brand->name[0]][] = $brand;     
        }
        
        return $brand_letters;
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