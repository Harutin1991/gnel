<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends MY_controller {

    public $cat_display = 'list';
    public $cat_brand = 0;
    public $cat_perpage = 15;

    function __construct() {
        parent::__construct();

        // initialize cookies
        if (!isset($_COOKIE['cat_display'])) {
            setcookie('cat_display', $this->cat_display, time() + (86400 * 30 * 7), "/");
        } else {
            $this->cat_display = $_COOKIE['cat_display'];
        }
        if (!isset($_COOKIE['cat_brand'])) {
            setcookie('cat_brand', $this->cat_brand, time() + (86400 * 30 * 1), "/");
        } else {
            $this->cat_brand = $_COOKIE['cat_brand'];
        }

        if (!isset($_COOKIE['cat_perpage'])) {
            setcookie('cat_perpage', '15', time() + (86400 * 30 * 1), "/");
        } else {
            $this->cat_perpage = $_COOKIE['cat_perpage'];
        }
    }

    public $data = array();

    public function index() {
//        ob_clean();
        $action = $this->input->post('action');
        switch ($action) {
            case 'brand_filter':
                $this->load->model('BrandModel');
                $brand_id = intval($this->input->post('brand_id'));
                $cat_perpage = $this->input->post('cat_perpage');
                $br_category = $this->input->post('br_category');
                $cat_pagenum = $this->input->post('cat_pagenum');
                $this->data['c_brand_name'] = $this->input->post('c_brand_name');

                $result = $this->BrandModel->getBrandProducts($brand_id, $br_category, $cat_perpage, $cat_pagenum);
                $brand_products = $result['products'];
                $data_count = $result["total"];
                $page_count = ceil($data_count / $cat_perpage);
                $this->data['cat_display'] = $this->cat_display;
                $this->data['cat_perpage'] = $this->cat_perpage;
                $this->data['brand_products'] = $brand_products;
                $this->data['page_count'] = $page_count;
                $this->data['page_number'] = $cat_pagenum;

                $html = $this->load->view('brands/product-list.php', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'category_filter':
                $this->load->model('CategoryModel');
                $category_id = intval($this->input->post('category_id'));
                $cat_brand = intval($this->input->post('cat_brand'));
                $cat_perpage = $this->input->post('cat_perpage');
                $cat_pagenum = $this->input->post('cat_pagenum');

                $result = $this->CategoryModel->getCategoryProducts($category_id, $cat_brand, $cat_perpage, $cat_pagenum);
                $category_products = $result['products'];
                $data_count = $result["total"];
                $page_count = ceil($data_count / $cat_perpage);
                $this->data['cat_display'] = $this->cat_display;
                $this->data['cat_brand'] = $this->cat_brand;
                $this->data['cat_perpage'] = $this->cat_perpage;
                $this->data['category_products'] = $category_products;
                $this->data['page_count'] = $page_count;
                $this->data['page_number'] = $cat_pagenum;

                $html = $this->load->view('category/product-list.php', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'comment_filter':
                $this->load->model('ProductsModel');
                $product_id = $this->input->post('product_id');
                $this->data['comment_page_number'] = $this->input->post('pagenum');
                $this->data['comment_perpage'] = 5;
                $this->data['product_comments'] = $this->ProductsModel->getProductComments($product_id, $this->data['comment_page_number'], $this->data['comment_perpage']);

                $html = $this->load->view('product/comment-list.php', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'update_comment': {
                $id = $this->input->post('id', true);
                $text = $this->input->post('text', true);
                $table = $this->input->post('table_name', true);
                $data['comment'] = $text;
                $result = false;
                if($table == 'blognews'){
                    $this->load->model('BlogModel');
                    $result = $this->BlogModel->updateComments($id, $data);
                }elseif($table == 'products'){
                    $this->load->model('ProductsModel');
                    $result = $this->ProductsModel->updateComments($id, $data);
                }

                echo json_encode(array('success' => $result));
                exit;
                break;
            }
            case 'blognews_comment_filter':
                $this->load->model('BlogModel');
                $blognews_id = $this->input->post('blognews_id');
                $this->data['comment_page_number'] = $this->input->post('pagenum');
                $this->data['comment_perpage'] = 2;
                $this->data['blognews_comments'] = $this->BlogModel->getBlognewsComments($blognews_id, $this->data['comment_page_number'], $this->data['comment_perpage']);

                $html = $this->load->view('blog/comment-list.php', $this->data, true);
                echo  $html;
                exit;
                break;
            case 'orderhistory_filter':
                $this->load->model('OrderModel');
                $od_perpage = $this->input->post('od_perpage', true);
                $this->data['od_pagenum'] = $this->input->post('od_pagenum', true);
                $this->data['od_perpage'] = $od_perpage;
                $this->data['page_number'] = $this->data['od_pagenum'];
                $result =  $this->OrderModel->getUserOrders($this->data['od_pagenum'], $od_perpage);
                $this->data['orders'] = isset($result['orders']) ? $result['orders'] : array();
                $data_count = isset($result["total"]) ? $result["total"] : 1;
                $this->data['page_count'] = ceil($data_count / $this->data['od_perpage']);
                $html = $this->load->view('account/order-list.php', $this->data, true);
                echo  $html;
                exit;
                break;
            case 'all_comments_filter':
                $this->load->model('UserModel');
                $this->data['page_number'] = $this->input->post('blg_pagenum', true);
                $bn_perpage = $this->input->post('pr_perpage', true);
                $table = $this->input->post('table_name', true);
                $pr_string = $this->input->post('pr_string', true);
                $user_id = $this->session->userdata('user_id');
                $table_name = $table == 'blognews' ? 'blognews_comments' : ($table == 'products' ? 'product_comments' : false);
                $this->data['comment_perpage'] = $_COOKIE[$table_name.'_perpage'];
                if($table_name) {
                    $result = $this->UserModel->getUserComments($table_name, $user_id, $table);
                    $this->data['comments'] = $result['comments'];
                    $this->data['comment_type'] = $table;
                    $data_count = $result["total"];
                    $this->data['page_count'] = ceil($data_count / $bn_perpage);
                    $result = $this->UserModel->getUserComments($table_name, $user_id, $table, $pr_string, $this->data['page_number'], $bn_perpage);
                    $this->data['comments'] = isset($result['comments']) ? $result['comments'] : array();
                    $html = $this->load->view('account/comment-list.php', $this->data, true);
                }else{
                    $html = '';
                }

                echo  $html;
                exit;
                break;
            case 'found_product_filter':
                $this->load->model('ProductsModel');
                $keyword = $this->input->post('keyword');
                $cat_brand = intval($this->input->post('cat_brand'));
                $cat_perpage = $this->input->post('cat_perpage');
                $cat_pagenum = $this->input->post('cat_pagenum');


                $result = $this->ProductsModel->findProducts('DESC', $keyword, $cat_perpage, $cat_pagenum);
                $data_count = $result["total"];
                $page_count = ceil($data_count / $cat_perpage);
                $this->data['cat_display'] = $this->cat_display;
                $this->data['cat_brand'] = 0;
                $this->data['cat_perpage'] = $this->cat_perpage;
                $this->data['found_products'] = $result['products'];
                $this->data['page_count'] = $page_count;
                $this->data['page_number'] = $cat_pagenum;

                $html = $this->load->view('product/found-product-list.php', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'login':
                $this->load->model('UserModel');
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $user_data = $this->UserModel->authenticateLogin($email, $password);

                if ($user_data) {
                    $this->setLoginData($user_data);
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false));
                }

                exit;
                break;
            case 'add_to_cart':
                $this->load->model('ShoppingModel');
                $post = $this->input->post(NULL, true);
                if ($this->_is_logged_in()) {
                    $data['user_id'] = $this->session->userdata('user_id');
                    $data['temp_id'] = '';
                } else {
                    $data['user_id'] = '0';
                    $data['temp_id'] = $post['temp_id'];
                }
                $data['product_id'] = $post['prod_id'];
                $data['prod_qty'] = $post['prod_qty'];
                $this->ShoppingModel->addToCard($data);

                $shopping_cart = $this->ShoppingModel->getShoppingCart($data);




                echo json_encode(array('success' => true, 'products' => $shopping_cart));
                exit;
                break;
            case 'rate_product':
                $this->load->model('ProductsModel');
                $post = $this->input->post(NULL, true);
                if ($this->_is_logged_in()) {
                    $user_id = $this->session->userdata('user_id');
                } else {
                    echo json_encode(array('success' => false, 'message' => "You are not logged in."));
                }
                $product_id = $post['product_id'];
                $rate = intval($post['rate']) % 6;
                if($rate > 0) {
                    $this->ProductsModel->updateRating($user_id, $product_id, $rate);
                }
                $point_type = 'rate';
                $result = $this->ProductsModel->orderExist($user_id, $product_id, $point_type);
               // echo $point_type;exit;
                if(!empty($result) && isset($result[0])){
                    $order_id = 0;
                   $total_points =  $this->ProductsModel->insertUserPoints($user_id, $product_id, $order_id, $result[0]);
                   $this->session->set_userdata('total_points', $total_points);
                }

                $rate = $this->ProductsModel->getProductAvgRate($product_id);
                $avg_rate = round($rate['avg_rate'], 2);
                $count_rate = $rate['voters_count'];

                echo json_encode(array(
                                        'success' => true,
                                        'avg_rate' => $avg_rate,
                                        'voters_count' => $count_rate,
                                        'total_points' => isset($total_points) ? $total_points : 0
                ));
                exit;
                break;
            case 'order_call':
                $phone = $this->input->post('phone', true);
                $this->load->model('OrderModel');
                $result = $this->OrderModel->orderCall($phone);
                if($result) {
                    $from = "call@gnel.am";
                    $to = "babybuy_email@mail.ru";
                    $subject = "Call_" . $phone;
                    $message = "Call to: ".$phone;
                    $from_name = "Call_" . $phone;
                    $this->send_mail($from, $to, $subject, $message, $from_name); 
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false));
                }
                exit;
                break;

            case 'update_shopping_cart':
                $this->load->model('ShoppingModel');
                $post = $this->input->post(NULL, true);
                if ($this->_is_logged_in()) {
                    $data['user_id'] = $this->session->userdata('user_id');
                    $data['temp_id'] = '';
                } else {
                    $data['user_id'] = '0';
                    $data['temp_id'] = $post['temp_id'];
                }
                $data['product_id'] = $post['prod_id'];
                $this->ShoppingModel->updateShoppingCard($data, $post['prod_qty']);

                $shopping_cart = $this->ShoppingModel->getShoppingCart($data);




                echo json_encode(array('success' => true, 'products' => $shopping_cart));
                exit;
                break;
			case 'blognews_filter':
				$this->load->model('BlogModel');
				/*$blog_filter_data = $this->input->post('blog_filter_id', true);
				$blog_filter_name = $this->input->post('blog_filter_name', true);
				if($blog_filter_data != '' && $blog_filter_name != ''){
					if($blog_filter_name == 'category'){
						$where['blognews.blognews_category_id'] = $blog_filter_data;
					}else if($blog_filter_name == 'archive'){
						$month = date('m', strtotime($blog_filter_data));
						$where ="MONTH(blognews.date_created)='$month'";
					}
					
					$result = $this->BlogModel->getLastBlognews($where);
					echo json_encode(array('res' => $result));
				}
               */
                $where = array();
                $filter_name = $this->input->post('filter_name');
                $blg_pagenum = $this->input->post('blg_pagenum');
                $filter_id = $this->input->post('filter_id');
                $first_item_id = $this->input->post('first_item_id');
                if($filter_name == 'category'){
                    $where['blognews.blognews_category_id'] = $filter_id;
                   // $where = array('blognews.id !=' => $first_item_id, 'blognews.blognews_category_id' => $filter_id);
                }elseif($filter_name == 'archive'){
                    $month = date('m', strtotime($filter_id));
                    $where ="MONTH(blognews.date_created)='$month'";
                    //$where = array('blognews.id !=' => $first_item_id, 'MONTH(blognews.date_created)' => $month);
                }
                $special_news = $this->BlogModel->getSpecialBlognews();
                $this->data['special_news'] = !empty($special_news) && isset($special_news[0]) ? $special_news[0] : array();
                $this->data['first_item_id'] = $first_item_id;
                $this->data['blognews'] = $this->BlogModel->getLastBlognews($where, $blg_pagenum);

                $html = $this->load->view('blog/new-list.php', $this->data, true);
                echo $html;
                exit;
                break;	
            case 'remove_form_cart':
                $this->load->model('ShoppingModel');
                $post = $this->input->post(NULL, true);
                if ($this->_is_logged_in()) {
                    $data['user_id'] = $this->session->userdata('user_id');
                    $data['temp_id'] = '';
                } else {
                    $data['user_id'] = '0';
                    $data['temp_id'] = $post['temp_id'];
                }
                $data['product_id'] = $post['prod_id'];
                $this->ShoppingModel->removeFromCard($data);

                $shopping_cart = $this->ShoppingModel->getShoppingCart($data);




                echo json_encode(array('success' => true, 'products' => $shopping_cart));
                exit;
                break;
            default:
                echo "No such item";
                exit;
                break;
        }
    }

    public function checkoutValidateInfo(){

        $this->load->model('UserModel');
        $post = $this->input->post(NULL, true);

        $order_error = array();
        $order_error["email"][] = "";
        $order_error["password"][] = "";
        $order_error["reg_error"][] = "";
        $order_error["same_shipping"][] = "";
        $order_error["first_name"][] = "";
        $order_error["phone"][] = "";
        $order_error["ship_first_name"][] = "";
        $order_error["ship_phone"][] = "";
        $order_error["ship_address"][] = "";
        $order_error["success"] = 1;

        if ($post['first_name'] == "") {
            $order_error["success"] = 0;
            $order_error["first_name"][] = $this->lang->line("The field is required");
        }
        if ($post['phone'] == "") {
            $order_error["success"] = 0;
            $order_error["phone"][] = $this->lang->line("The field is required");
        }
        if ($post['ship_first_name'] == "") {
            $order_error["success"] = 0;
            $order_error["ship_first_name"][] = $this->lang->line("The field is required");
        }
        if ($post['ship_phone'] == "") {
            $order_error["success"] = 0;
            $order_error["ship_phone"][] = $this->lang->line("The field is required");
        }
        if ($post['ship_address'] == "") {
            $order_error["success"] = 0;
            $order_error["ship_address"][] = $this->lang->line("The field is required");
        }

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $order_error["success"] = 0;
            if($post['email'] == ""){
                $order_error["email"][] = $this->lang->line("The field is required");
            }else{
                $order_error["email"][] = $this->lang->line("You have submitted wrong email");
            }

        }

        if (isset($post['register-account'])) {
            if ($post['password'] != $post['repeat_password']) {
                $order_error["success"] = 0;
                $order_error["password"][] = $this->lang->line("Passwords are not match");
            }
            if (strlen($post['password']) < 6) {
                $order_error["success"] = 0;
                $order_error["password"][] = $this->lang->line('Password must contain at least 6 characters');
            }

            $user_email = array('email' => $post['email']);

            if ($this->UserModel->getUser($user_email)) {
                $order_error["success"] = 0;
                $order_error["email"][] = $this->lang->line("This email already exists");
            }

            $post['password'] = sha1($post['password']);
            if (($id = $this->UserModel->insert('users', $post)) != false) {
                $user_data = $this->UserModel->getUser($user_email);
                $this->setLoginData($user_data);
                $this->data['user_id'] = $this->session->userdata('user_id');
            } else {
                $order_error["success"] = 0;
                $order_error["reg_error"][]  = $this->lang->line('Unknown error during registration');
            }
        }

        if (!$this->_is_logged_in()) {
            $user_email = array('email' => $post['email']);
            if ($this->UserModel->getUser($user_email)) {
                $order_error["success"] = 0;
//                $order_error["email"][] = $this->lang->line("This email already exists");
                $order_error["email"][] = $this->lang->line("This email already registered, please login");
            }
        }

        if (isset($post['save_my_data'])) {
            $post['same_shipping'] = isset($post['same_shipping']) ? 1 : 0;
//            $new_data = array(
//                            'first_name' => $post['ship_first_name'],
//                            'last_name' => $post['ship_last_name'],
//                            'phone' => $post['ship_phone'],
//                            'email' => $post['email']
//            );
            if ($this->UserModel->update('users', $this->data['user_id'], $post)) {

            } else {
                $order_error["success"] = 0;
                $order_error["same_shipping"][]= $this->lang->line('Unknown error during data update');
            }
        }
        echo json_encode($order_error);
        exit;
    }

}

?>
