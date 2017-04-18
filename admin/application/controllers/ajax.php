<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property BlognewsModel $BlognewsModel
 * @property MenuItemModel $MenuItemModel
 *
 */

class Ajax extends Main_controller {

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            echo "Error";
            exit;
        }

        $this->load->model('LanguagesModel');
        $this->load->model('MenuModel');
        $this->load->model('MenuItemModel');
        $this->load->model('PageModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductsModel');
        $this->load->model('OptionsModel');
        $this->load->model('BrandModel');
        $this->load->model('BlognewsModel');
    }

//  public $data = array();

    public function index() {
        $action = $this->input->post('action');
        ob_clean();
        switch ($action) {
            case 'product_filter':
                $this->load->model('ProductsModel');

                $this->data['pr_string'] = $this->input->post('pr_string');
                $this->data['pr_perpage'] = intval($this->input->post('pr_perpage'));
                $this->data['pr_pagenum'] = intval($this->input->post('pr_pagenum'));

                $result = $this->ProductsModel->getAllProducts('DESC', $this->data['pr_string'], $this->data['pr_perpage'], $this->data['pr_pagenum']);
                $this->data['products'] = $result['products'];
                $data_count = $result["total"];
                $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
                $this->data['page_number'] = $this->data['pr_pagenum'];
                $html = $this->load->view('product/datatable', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'comment_filter':
                $this->load->model('CommentsModel');

                $this->data['pr_string'] = $this->input->post('pr_string');
                $this->data['pr_perpage'] = intval($this->input->post('pr_perpage'));
                $this->data['pr_pagenum'] = intval($this->input->post('pr_pagenum'));
                $this->data['pr_pending'] = intval($this->input->post('pr_pending'));

                $result = $this->CommentsModel->getAllCommentedProducts('DESC', $this->data['pr_string'], $this->data['pr_perpage'], $this->data['pr_pagenum'], $this->data['pr_pending']);
                $this->data['products'] = $result['products'];
                $products_ids = getProductsArrayList($this->data['products']);
                $this->data['product_comments_counts'] = $this->CommentsModel->getProductsCommentsCount($products_ids);
                $data_count = $result["total"];
                $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
                $this->data['page_number'] = $this->data['pr_pagenum'];
                $html = $this->load->view('comment/product/datatable', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'blognews_comment_filter':
                $this->load->model('CommentsModel');

                $this->data['bg_string'] = $this->input->post('bg_string');
                $this->data['bg_perpage'] = intval($this->input->post('bg_perpage'));
                $this->data['bg_pagenum'] = intval($this->input->post('bg_pagenum'));
                $this->data['bg_pending'] = intval($this->input->post('bg_pending'));
                $result = $this->CommentsModel->getAllCommentedBlognews('DESC', $this->data['bg_string'], $this->data['bg_perpage'], $this->data['bg_pagenum'], $this->data['bg_pending']);
                $this->data['blognews'] = $result['blognews'];
                $blognews_ids = getProductsArrayList($this->data['blognews']);
                $this->data['blognews_comments_counts'] = $this->CommentsModel->getBlognewsCommentsCount($blognews_ids);
                $data_count = $result["total"];
                $this->data['page_count'] = ceil($data_count / $this->data['bg_perpage']);
                $this->data['page_number'] = $this->data['bg_pagenum'];
                $html = $this->load->view('comment/blognews/datatable', $this->data, true);
                echo $html;
                exit;
                break;
            case 'order_filter':
                $this->load->model('OrdersModel');

                $this->data['ord_perpage'] = intval($this->input->post('ord_perpage'));
                $this->data['ord_pagenum'] = intval($this->input->post('ord_pagenum'));
                $this->data['ord_status'] = $this->input->post('ord_status');

                //$result = $this->CommentsModel->getAllCommentedProducts('DESC', $this->data['ord_string'], $this->data['ord_perpage'], $this->data['ord_pagenum'], $this->data['ord_pending']);
                $result = $this->OrdersModel->getAllOrders($this->data['ord_perpage'], $this->data['ord_pagenum'], $this->data['ord_status']);
                $this->data['orders'] = $result['orders'];
                //$products_ids = getProductsArrayList($this->data['products']);
                //$this->data['product_comments_counts'] = $this->CommentsModel->getProductsCommentsCount($products_ids);
                $data_count = $result["total"];
                $this->data['page_count'] = ceil($data_count / $this->data['ord_perpage']);
                $this->data['page_number'] = $this->data['ord_pagenum'];
                $html = $this->load->view('order/datatable', $this->data, true);
                echo json_encode(array('html' => $html));
                exit;
                break;
            case 'update_comment': {
                    $id = $this->input->post('id', true);
                    $text = $this->input->post('text', true);
                    $table = $this->input->post('table_name', true);
                    $this->load->model('CommentsModel');
                    $data['comment'] = $text;
                    $result = $this->CommentsModel->update($table, $id, $data);

                    echo json_encode(array('success' => $result));
                    exit;
                    break;
                }
            case 'update_special_blognews': {
                $news_id = $this->input->post('news_id', true);
                $special = $this->input->post('special', true) == '1' ? 0 : 1;
                $this->load->model('BlognewsModel');
                $result = $this->BlognewsModel->updateSpecialBlognews($news_id, $special);
                echo json_encode(array('success' => $result));
                exit;
                break;
            }
            case 'get_sale_products': {
                $brand_id = $this->input->post('id', true);
                $result = $this->ProductsModel->getSaleProducts($brand_id);
                $this->data['products'] = $result['products'];
                $this->data['id'] = $brand_id;
                $data_count = $result["total"];
                $this->data['page_count'] = ceil($data_count / 15);
//                echo '<pre>'; print_r($this->data['products']);

                $html = $this->load->view('product/datatable', $this->data, true);

                echo json_encode(array('html' => $html));
                exit;
                break;
            }
            case 'delete_language': {
                    $id = $this->input->post('id');
                    if ($this->LanguagesModel->delete('languages', $id))
                        $this->addLog('Language with id: ' . $id . ' is deleted.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'disable_language': {
                    $id = $this->input->post('id');
                    if ($this->LanguagesModel->disable('languages', $id))
                        $this->addLog('Language with id: ' . $id . ' is disabled.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'enable_language': {
                    $id = $this->input->post('id');
                    if ($this->LanguagesModel->enable('languages', $id))
                        $this->addLog('Language with id: ' . $id . ' is enabled.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'make_special_product': {
                    $id = $this->input->post('id');
                    $table = $this->input->post('table');
                    if ($this->ProductsModel->makeSpecialProduct($table, $id)) {
                        $this->addLog("In $table row with id: $id is made_special.");
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }    
            case 'make_ordinary_product': {
                    $id = $this->input->post('id');
                    $table = $this->input->post('table');
                    if ($this->ProductsModel->makeOrdinaryProduct($table, $id)) {
                        $this->addLog("In $table row with id: $id is made_ordinary.");
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }    
            case 'enable': {
                    $id = $this->input->post('id');
                    $table = $this->input->post('table');
                    if ($this->LanguagesModel->enable($table, $id)) {
                        $this->addLog("In $table row with id: $id is enabled.");
                        if($this->input->post('user_points')) {
                            $user_id = $this->input->post('user_id');
                            $status = 1;
                            $this->ProductsModel->updateUserPoints($user_id, $id, $status);
                        }

                        if($this->input->post('comment_category') && $this->input->post('comment_category') == 'product'){
                            $user_id = $this->input->post('user_id', true);
                            $product_id = $this->input->post('product_id', true);
                            $points_type = 'comment';
                            $result = $this->ProductsModel->orderExist($user_id, $product_id, $points_type);
                            if(!empty($result)){
                                if(!empty($result) && isset($result[0])){
                                    $order_id = 0;
                                    $this->ProductsModel->insertUserPoints($user_id, $product_id, $order_id, $result[0]);
                                }
                            }

                        }
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'disable': {
                    $id = $this->input->post('id');
                    $table = $this->input->post('table');
                    if ($this->LanguagesModel->disable($table, $id)) {
                        $this->addLog("In $table row with id: $id is disabled.");
                        if($this->input->post('user_points')) {
                            $user_id = $this->input->post('user_id');
                            $status = 1;
                            $this->ProductsModel->updateUserPoints($user_id, $id, $status);
                        }
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'cancel': {
                    $id = $this->input->post('id');
                    $table = $this->input->post('table');
                    if ($this->LanguagesModel->cancel($table, $id)) {
                        $this->addLog("In $table row with id: $id is cancelled.");
                        if($this->input->post('user_points')) {
                            $user_id = $this->input->post('user_id');
                            $status = 0;
                            $this->ProductsModel->updateUserPoints($user_id, $id, $status);
                        }
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'delete_menu': {
                    $id = $this->input->post('id');
                    if ($this->MenuModel->delete('menus', $id))
                        $this->addLog('Menu with id: ' . $id . ' is deleted.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'get_menu_item': {
                    $id = $this->input->post('id');
                    $menu_item = $this->MenuItemModel->get('menu_items', $id);

                    echo json_encode(array('success' => true, 'menu_item' => $menu_item));
                    exit;
                    break;
                }
            case 'delete_menu_item': {
                    $id = $this->input->post('id');
                    if ($this->MenuItemModel->deleteMenuItem('menu_items', $id))
                        $this->addLog('Menu item with id: ' . $id . ' is deleted.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'save_menu_items': {
                    $menu_id = $this->input->post('menu_id');
                    $menu_items = json_decode($this->input->post('menu_items'));

                    foreach ($menu_items as $menu_item) {
                        if (isset($menu_item->parent_id)) {
                            $data = array('parent_id' => $menu_item->parent_id, 'order' => $menu_item->left);
                        } else {
                            $data = array('parent_id' => $menu_id, 'order' => $menu_item->left);
                        }

                        if ($this->MenuItemModel->update('menu_items', $menu_item->item_id, $data))
                            $this->addLog('Items of menu with id: ' . $menu_id . ' are updated.');
                    }
                    exit;
                    break;
                }
            case 'delete_blog': {
                $id = $this->input->post('id');
                if ($this->BlognewsModel->deleteBlogItem('blognews', $id))
                    $this->addLog('Blog News with id: ' . $id . ' is deleted.');

                echo json_encode(array('success' => true));
                exit;
                break;
            }
            case 'delete_page': {
                    $id = $this->input->post('id');
                    $this->data['page'] = $this->PageModel->get('pages', $id);
                    $old_image = $this->data['page']['image'];
                    if (isset($old_image))
                        $this->_delete_img($old_image, 'pages');

                    if ($this->PageModel->delete('pages', $id))
                        $this->addLog('Page with id: ' . $id . ' is deleted.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            /*
              case 'delete_brand': {
              $id = $this->input->post('id');
              $brand = $this->BrandModel->get('brands', $id);

              $old_image = $brand['image'];
              if (isset($old_image)) {
              $this->_delete_img($old_image, 'brand');
              }
              if ($this->BrandModel->delete('brands', $id)) {
              $this->addLog('Brand with id: ' . $id . ' is deleted.');
              }

              echo json_encode(array('success' => true));
              exit;
              break;
              }

              case 'delete_product': {
              $id = $this->input->post('id');
              $res = $this->ProductsModel->deleteProduct($id);
              if ($res) {
              $folder = 'product/' . $id;
              $this->_delete_folder($folder);
              $this->addLog('Product with id: ' . $id . ' is deleted.');
              }

              echo json_encode(array('success' => true));
              exit;
              break;
              }
              case 'delete_category': {
              $id = $this->input->post('id');

              if ($this->CategoryModel->hasProduct($id) || $this->CategoryModel->hasOption($id)) {
              echo json_encode(array('success' => false, 'message' => $this->lang->line('Category must not contain options or products.')));
              exit;
              } else {
              $this->data['category'] = $this->CategoryModel->get('categories', $id);
              $old_image = $this->data['category']['image'];
              if (isset($old_image))
              $this->_delete_img($old_image, 'category');

              if ($this->PageModel->delete('categories', $id))
              $this->addLog('Category with id: ' . $id . ' is deleted.');
              }

              echo json_encode(array('success' => true));
              exit;
              break;
              }
             */
            case 'save_categories': {
                    $items = json_decode($this->input->post('items'));
                    $childCategories = $this->input->post('childCategories');

                    foreach ($childCategories as $childCategoryId => $childCategory) {
                        if ($this->CategoryModel->hasProduct($childCategoryId) || $this->CategoryModel->hasOption($childCategoryId)) {
                            foreach ($items as $item) {
                                if (isset($item->parent_id)) {
                                    if ($item->parent_id == $childCategoryId) {

                                        echo json_encode(array('success' => false, 'message' => $this->lang->line('Child category must not contain options or products.')));
                                        exit;
                                    }
                                }
                            }
                        }
                    }

                    foreach ($items as $item) {
                        if (isset($item->parent_id)) {
                            $data = array('parent_id' => $item->parent_id, 'order' => $item->left);
                        } else {
                            $data = array('parent_id' => 0, 'order' => $item->left);
                        }

                        if ($this->CategoryModel->update('categories', $item->item_id, $data))
                            $this->addLog('Category list is updated.');
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'delete_category': {
                    $id = $this->input->post('id');
                    $this->data['category'] = $this->CategoryModel->get('categories', $id);
                    $old_image = $this->data['category']['image'];
                    if (isset($old_image))
                        $this->_delete_img($old_image, 'category');

                    if ($this->PageModel->delete('categories', $id))
                        $this->addLog('Category with id: ' . $id . ' is deleted.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'delete_option': {
                    $id = $this->input->post('id');

                    if ($this->OptionsModel->delete('options', $id)) {
                        $this->addLog('Option with id: ' . $id . ' is deleted.');


                        echo json_encode(array('success' => true));
                    }
                    exit;
                    break;
                }
            case 'order_product_images': {
                    $product_id = $this->input->post('product_id');
                    $images = $this->input->post('images');

                    if ($this->ProductsModel->orderImages('product_images', $images))
                        $this->addLog('Images of product with id: ' . $product_id . ' are ordered.');

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'delete_customposttype': {
                    $post_id = $this->input->post('post_id');
                    $foldername = ltrim($post_id, 'custom_');
                    $this->_delete_folder($foldername);
                    $this->load->model('CustomPostTypeModel');
                    $this->CustomPostTypeModel->deleteCustomPostType($post_id);
                    break;
                }
            case 'delete_post_type': {
                    $post_type = $this->input->post('post_type');
                    $post_id = $this->input->post('post_id');
                    $foldername = ltrim($post_type, 'custom_') . "/" . $post_id;
                    $this->_delete_folder($foldername);
                    $this->load->model('CustomPostTypeModel');
                    $this->CustomPostTypeModel->deletePost($post_type, $post_id);
                    break;
                }
            case 'delete_role': {
                    $post_id = $this->input->post('post_id');
                    $this->load->model('RolesModel');
                    $delete_role = $this->RolesModel->deleteRole($post_id);
                    echo $delete_role;
                    break;
                }
            case 'delete_user': {
                    $post_id = $this->input->post('post_id');
                    $this->load->model('UsersModel');
                    $this->UsersModel->deleteUser($post_id);
                    break;
                }
            case 'existTable': {
                    $table_name = $this->input->post('tabl_name');
                    $this->load->model('CustomPostTypeModel');
                    $rezult = $this->CustomPostTypeModel->existTable($table_name);
                    echo $rezult;
                    break;
                }
            case 'delete_img': {
                    $tab_name = $this->input->post('tab_name');
                    $field_name = $this->input->post('field_name');
                    $post_id = $this->input->post('post_id');
                    $lang_code = $this->input->post('lang_code');
                    $this->load->model('CustomPostTypeModel');
                    $rezult = $this->CustomPostTypeModel->editImg($tab_name, $field_name, $post_id, $lang_code);
                    $pos = strripos($rezult[$field_name], '/');
                    $folder_name = substr($rezult[$field_name], 0, $pos);
                    $file_name = substr($rezult[$field_name], $pos + 1);
                    $this->_delete_img($file_name, $folder_name);
                    break;
                }
            case 'delete_product_image': {
                    $id = $this->input->post('id');
                    $product_id = $this->input->post('product_id');

                    $product_image = $this->ProductsModel->get('product_images', $id);
                    $image_name = $product_image['image'];
                    if (isset($image_name))
                        $this->_delete_img($image_name, 'product/' . $product_id);

                    if ($this->ProductsModel->deleteImage($id, $product_id)) {
                        $this->addLog('Image of product with id: ' . $product_id . ' is deleted.');
                    }

                    echo json_encode(array('success' => true));
                    exit;
                    break;
                }
            case 'doMultiUpload': {
                    $id = $this->input->post('id');
                    $info = array();
                    if (!empty($_FILES['images']['name'][0])) {
                        $_FILES = reArrayFiles($_FILES['images']);

                        $path = $this->config->item('images_path');
                        $config['upload_path'] = $path . 'product/' . $id;

                        if (!is_dir($config['upload_path'])) {
                            @mkdir($config['upload_path'], 0755, true);
                            // add index.html file to new created folder
                            $dest = $config['upload_path']. "/index.html";
                            $source = FCPATH . "system/index.html";
                            if(is_file($source)) {
                                copy($source, $dest);
                            }
                        }

                        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // by extension, will check for whether it is an image
                        $config['encrypt_name'] = true;
                        $this->load->library('upload');
                        $this->upload->initialize($config);

                        $data = array();
                        foreach ($_FILES as $key => $image) {

                            $this->upload->do_upload($key);
                            $uploadData = $this->upload->data();
                            $data[] = array(
                                'product_id' => $id,
                                'image' => $uploadData['file_name'],
                            );
                            $img_src = $config['upload_path'] . '/' . $uploadData['file_name'];
                            convertImgToRectangle($img_src);
                        }

                        $last_id = $this->ProductsModel->insertImages($data);
                        foreach ($data as $key => $value) {
                            $data[$key]['id'] = $last_id;
                            $last_id++;
                        }

                        $info = $data;
                    }

                    echo json_encode($info);
                    exit;
                    break;
                }
			case 'blognews_filter':{
					$this->load->model('BlognewsModel');

					$this->data['pr_string'] = $this->input->post('pr_string');
					$this->data['pr_perpage'] = intval($this->input->post('pr_perpage'));
					$this->data['pr_pagenum'] = intval($this->input->post('pr_pagenum'));

					$result = $this->BlognewsModel->getAllBlognews('DESC', $this->data['pr_string'], $this->data['pr_perpage'], $this->data['pr_pagenum']);
					$this->data['blognews'] = $result['blognews'];
					$data_count = $result["total"];
					$this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
					$this->data['page_number'] = $this->data['pr_pagenum'];
					$html = $this->load->view('blognews/datatable', $this->data, true);
					echo json_encode(array('html' => $html));
					exit;
					break;	
				}
				case 'save_blog_categories':{
					$this->load->model('BlogcategoriesModel');
					$items = $this->input->post('items');
					$data = array();
					if(!empty($items)){
						foreach($items as $item){
							$data[] = array(
											'id' => $item['id'],
											'order' => $item['order']
											);						
						}
					}
					$this->BlogcategoriesModel->SaveBlogCategories($data);
					echo json_encode(array('html' => 'true'));
					
					
					exit;
					break;	
				}

				case 'save_blog':{
					$this->load->model('BlognewsModel');
					$items = $this->input->post('items');
					$data = array();
					if(!empty($items)){
						foreach($items as $item){
							$data[] = array(
											'id' => $item['id'],
											'ordering' => $item['order']
											);
						}
					}
					$this->BlognewsModel->SaveBlogCategories($data);
					echo json_encode(array('html' => 'true'));


					exit;
					break;
				}
        }
    }

    public function doMultiUpload($id) {
        $info = array();
        if (!empty($_FILES['images']['name'][0])) {
            $_FILES = reArrayFiles($_FILES['images']);

            $path = $this->config->item('images_path');
            $config['upload_path'] = $path . 'product/' . $id;

            if (!is_dir($config['upload_path'])) {
                @mkdir($config['upload_path'], 0755, true);
                // add index.html file to new created folder
                $dest = $config['upload_path']. "/index.html";
                $source = FCPATH . "system/index.html";
                if(is_file($source)) {
                    copy($source, $dest);
                }
            }

            $config['allowed_types'] = 'gif|jpg|png'; // by extension, will check for whether it is an image
            $config['encrypt_name'] = true;
            $this->load->library('upload');
            $this->upload->initialize($config);

            $data = array();
            foreach ($_FILES as $key => $image) {
                $this->upload->do_upload($key);
                $uploadData = $this->upload->data();
                $data[] = array(
                    'product_id' => $id,
                    'image' => $uploadData['file_name'],
                );
            }

            $last_id = $this->ProductsModel->insertImages($data);
            foreach ($data as $key => $value) {
                $data[$key]['id'] = $last_id;
                $last_id++;
            }

            $info = $data;
        }

        echo json_encode($info);
    }

}

?>
