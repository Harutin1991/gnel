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
        $this->data['blog_ccategories'] = $this->BlogModel->getBlogCategories();
        $this->data['archives'] = $this->BlogModel->getBlogArchive();
        $this->data['first_item_id'] = 0;

    }

    public function index($id = NULL) {
        //redirect(site_url(''));
        $page_num = $this->input->get('page', true);
        $this->data["blognews"] = array();
        $this->data['special_news'] = array();
        $this->data['old_id'] = null;
        if(preg_match('/^[1-9][0-9]{0,3}$/', $page_num) ) {
            $this->data["blognews"] = $this->BlogModel->getLastBlognews(array(), $page_num);
        }elseif(!$this->input->get('page')){
            $this->data["blognews"] = $this->BlogModel->getLastBlognews();
        }
//        echo "<pre>";print_r($this->data["blognews"]);exit;

        $special_news = $this->BlogModel->getSpecialBlognews();
       if(!empty($special_news) && isset($special_news[0]) ){
           $this->data['special_news'] = $special_news[0];
           $this->data['first_item_id'] = $this->data['special_news']->id;
       }

        $page_count = $this->BlogModel->getCountNews();
        $this->data['popular'] = $this->BlogModel->getPopularNews();
        $this->data['page_count'] = ceil($page_count[0]->count_news / $this->blg_perpage);
        $this->load->view('blog/latest', $this->data);
    }

	public function category($id = null){
		if($id){
            $page_num = $this->input->get('page', true);
            $this->data['old_id'] = $id;
            $where['blognews.blognews_category_id'] = $id;
            $this->data["blognews"] = array();
            if(preg_match('/^[1-9][0-9]{0,3}$/', $page_num)) {
                $this->data["blognews"] = $this->BlogModel->getLastBlognews($where, $page_num);
            }
            $page_count = $this->BlogModel->getCountNews($where);
           // $this->data['blog_ccategories'] = $this->BlogModel->getBlogCategories();
           // $this->data['archives'] = $this->BlogModel->getBlogArchive();
            $this->data['page_count'] = ceil($page_count[0]->count_news / $this->blg_perpage);
            $this->data['popular'] = $this->BlogModel->getPopularNews();
            $this->load->view('blog/latest', $this->data);

		}else{
            redirect('blog');
		}
	}

	public function archive($date = null){
		if($date){
			$Stamp = strtotime( $date );
			$Month = date( 'm', $Stamp );
			$Day   = date( 'd', $Stamp );
			$Year  = date( 'Y', $Stamp );
			if(checkdate( $Month, $Day, $Year )){
				$where ="MONTH(blognews.date_created)='$Month'";
                $this->data['old_id'] = $Month;
				//$result = $this->BlogModel->getLastBlognews($where);
                $page_num = $this->input->get('page', true);
                $page_count = $this->BlogModel->getCountNews($where);
                $this->data['popular'] = $this->BlogModel->getPopularNews();
                $this->data["blognews"] = array();
                if(preg_match('/^[1-9][0-9]{0,3}$/', $page_num)) {
                    $this->data["blognews"] = $this->BlogModel->getLastBlognews($where, $page_num);
                }
				//$this->data['blog_ccategories'] = $this->BlogModel->getBlogCategories();
				//$this->data['archives'] = $this->BlogModel->getBlogArchive();
                $this->data['page_count'] = ceil($page_count[0]->count_news / $this->blg_perpage);
				//$this->load->view('blog/latest', $this->data);
			}
            $this->load->view('blog/latest', $this->data);
		}else{
            redirect('blog');
		}
		
		//return $result;
	}
   public function item($title = NULL){
       //echo 'Hello'; exit;
        if (!isset($title)) {
            redirect(site_url(''));
        }

		if(preg_match('/^(.*)-b([^-b]*).html/', $title, $matches)) {
			$news_id = $matches[2];
		} else if(is_numeric($title)){
            $news_id = (int)$title;
		} else {
			redirect(site_url(''));
		}
       $is_page_viewed = false;
       if(!isset($_COOKIE['news_ids'])) {
           $cookie_value = array($news_id);
           setcookie('news_ids', serialize($cookie_value), time() + (3600), "/");
           $is_page_viewed = true;
       }else{
           $news_ids = unserialize($_COOKIE['news_ids']);
           if(is_array($news_ids) && !in_array($news_id, $news_ids)){
               $is_page_viewed = true;
               array_push($news_ids, $news_id);
               setcookie('news_ids', serialize($news_ids), time() + (3600), "/");
           }


       }
        //var_dump($is_page_viewed, $news_ids);exit;
       if($is_page_viewed) {
           $this->BlogModel->addBlogewsWiewed($news_id);
       }


       $lang_code = $this->config->item('language');
       //echo $lang_code;exit;
       $news = $this->BlogModel->getBlogNews($news_id, $lang_code);
       if(isset($news[0]) && !empty($news[0])) {
           $this->data['news'] = $news[0];
           $id = $this->data['news']->id;
           $this->data['old_id'] = $this->data['news']->catgory_id;
           $filter = array('blognews.blognews_category_id' => $this->data['news']->catgory_id,
                            'blognews.id !=' => $this->data['news']->id
               );
           $limit = 4;
           $this->data['news_this_categoreis'] = $this->BlogModel->getLastBlognews($filter, 1, $limit);
           /* $this->data['c_brand'] = $this->BrandModel->get('brands', $news_id);
            $this->data['meta_title']  = $this->data['c_brand']['name_'. $this->config->item('language')];
            $this->data['meta_keywords']    = $this->data['c_brand']['meta_keywords_'. $this->config->item('language')];
            $this->data['meta_description'] = $this->data['c_brand']['meta_description_'. $this->config->item('language')];
            $this->data['c_brand_name'] = $this->data['c_brand']['name_'. $this->config->item('language')];
    //        echo "<pre>"; print_r($this->data['c_brand']);exit;
            if ($this->data['c_brand'] == false || $this->data['c_brand']['status'] == '0') {
                redirect(site_url(''));
            }
            */
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

                   $data['blognews_id'] = $id;
                   $data['comment'] = trim($post['comment']);
                   $data['comment_date'] = date('Y-m-d H:i:s', time());
                   $data['ip'] = get_client_ip();
               }
               if ($data['comment'] == '') {
                   $this->data['error'] = 'Please fill all fields.';
               } else {

                   $comment_id = $this->BaseModel->insert('blognews_comments', $data);


                   // send email to admin about comment

                   $to = "gnel.am@gmail.com";
                   if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                       $from = 'blogcomment@gnel.am';
                       $subject = $this->lang->line('New comment');
                       $comment_email_data['comment'] = $data['comment'];
                       $comment_email_data['comment_date'] = $data['comment_date'];
                       $comment_email_data['blognews'] = $this->data['news'];
                       $message = "New comment to blognews <a href='". blognews_url($this->data['news']->id, $this->data['news']->title)."'>".$this->data['news']->title."</a>" ;
                       $this->send_mail($from, $to, $subject, $message, $from_name = 'Babybuy.am');

                   }

                   $this->data['success'] = true;
                   unset($_POST);
               }
           }

           $this->data['fb_url'] = blognews_url($this->data['news']->id, $this->data['news']->title);
           $this->data['fb_image'] = base_url().'images/blognews/'.$this->data['news']->image;
           $this->data['fb_title'] = $this->data['news']->title;
           $description = substr($this->data['news']->content,0,100);
           $this->data['fb_description'] = trim(strip_tags($description));
           $this->data['comment_page_number'] = 1;
           $this->data['comment_perpage'] = 2;
           $this->data['blognews_comments'] = $this->BlogModel->getBlognewsComments($id, $this->data['comment_page_number'], $this->data['comment_perpage']);
           $this->data['popular'] = $this->BlogModel->getPopularNews();

           $this->session->set_userdata('return_url', $this->uri_string());
           $this->load->view('blog/blog-details', $this->data);
       }else{
           redirect('blog');
       }
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