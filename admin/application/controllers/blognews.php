<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property BlognewsModel $BlognewsModel
 * @property form_validation $form_validation
 *
 */

class Blognews extends Main_controller {

    public $layout = 'default';
	public $bn_string = '';
    public $bn_perpage = 15;
	
    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }

        $this->load->model('BlognewsModel');
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        $this->load->library('form_validation');

        $this->data['languages'] = $this->LanguagesModel->getAllLanguages('languages');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');

        $this->data['statuses'] = array(
            '1' => $this->lang->line('Active'),
            '0' => $this->lang->line('Inactive'),
        );
    }

    public function index() {
		if (!isset($_COOKIE['bn_string'])) {
            setcookie('bn_string', $this->bn_string, time() + (86400 * 30 * 7), "/");
        } else {
            $_COOKIE['bn_string'] = '';
            $this->bn_string = $_COOKIE['bn_string'];
        }

        if (!isset($_COOKIE['bn_perpage'])) {
            setcookie('bn_perpage', $this->bn_perpage, time() + (86400 * 30 * 1), "/");
        } else {
            $this->bn_perpage = $_COOKIE['bn_perpage'];
        }
        $this->data['pr_string'] = $this->bn_string;
        $this->data['pr_perpage'] = $this->bn_perpage;
        $this->data['page_number'] = 1;
        $result = $this->BlognewsModel->getAllBlognews('DESC', $this->bn_string, $this->bn_perpage, $this->data['page_number']);

        $this->data['blognews'] = $result['blognews'];
        $data_count = $result["total"];
        $this->data['page_count'] = ceil($data_count / $this->data['pr_perpage']);
        $this->load->view('blognews/index', $this->data);
    }

    public function add() {
        if ($this->input->post('Blognews')) {
            $this->form_validation->set_rules($this->BlognewsModel->rules());

            if ($this->form_validation->run()) {
                $data = $this->input->post('Blognews', true);
                $data["user_id"] = $this->admin_id;

                $image_data = $this->_do_upload('image', 'blognews');

                if (isset($image_data['upload_data']))
                    $data['image'] = $image_data['upload_data']['file_name'];
                $data = trim_array($data);
                $data['blognews_category_id'] = $this->input->post('blognews_category');
                if (($id = $this->BlognewsModel->insert('blognews', $data)) != false) {
                    $this->addLog('Added blognews with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("blognews/edit/$id", 'refresh');
            }
        }
        $blogcategories = $this->BlognewsModel->getBlogCategories();
        $newblog_categories = array();
        if(!empty($blogcategories)) {
            foreach($blogcategories as $category) {
                $title = explode(',', $category['title']);
                foreach($title as $title_v){
                    list($key, $val) = explode('_', $title_v);
                    $newblog_categories[$category['blog_category_id']][$key] = $val;
                }
            }
        }
        $this->data['blogcategories'] = $newblog_categories;
        $this->load->view('blognews/add', $this->data);
    }

    public function edit($id = NULL) {
        if (!isset($id))
            show_404();
        
		$this->data['blognews'] = $this->BlognewsModel->get('blognews', $id, $this->session->userdata('admin_id'));
		$blogcategories = $this->BlognewsModel->getBlogCategories();
		$newblog_categories = array();
		if(!empty($blogcategories)) {
			foreach($blogcategories as $category) {
				$title = explode(',', $category['title']);
				foreach($title as $title_v){
					list($key, $val) = explode('_', $title_v); 
					$newblog_categories[$category['blog_category_id']][$key] = $val;
				}
			}											
		}
		$this->data['blogcategories'] = $newblog_categories;
		if ($this->data['blognews'] == false)
            show_404();
			
        if ($this->admin_id != $this->data['blognews']['user_id'] &&
                $this->admin_id != $this->config->item('super_global_admin_id') &&
                $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            redirect(site_url('brand'));
        }

        if ($this->input->post('Blognews')) {
            $this->form_validation->set_rules($this->BlognewsModel->rules());
            if ($this->form_validation->run()) {
                $data = $this->input->post('Blognews', true);
				
                $old_image = $this->data['blognews']['image'];
				$data['blognews_category_id'] = $this->input->post('blognews_category');
                if (!empty($_FILES['image']['name'])) {
                    $image_data = $this->_do_upload('image', 'blognews');

                    if (isset($old_image))
                        $this->_delete_img($old_image, 'blognews');

                    if (isset($image_data['upload_data']))
                        $data['image'] = $image_data['upload_data']['file_name'];
                }
                $data = trim_array($data);
                if ($this->BlognewsModel->update('blognews', $id, $data) != false) {
                    $this->addLog('Edited blognews with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }

        $this->load->view('blognews/edit', $this->data);
    }

    public function addImages($id = NULL) {
        if (!isset($id)) {
            show_404();
            redirect(site_url('product'));
        }
        $this->data['blognews'] = $this->BlognewsModel->get('blognews', $id);
        if ($this->data['blognews'] == false) {
            show_404();
            redirect(site_url('blognews'));
        }

//echo '<pre>'; print_r($this->data); die;
        if ($this->admin_id != $this->data['blognews']['user_id'] &&
            $this->admin_id != $this->config->item('super_global_admin_id') &&
            $this->session->userdata('rol_id') !== '3' // if operator
        ) {
            redirect(site_url('blognews'));
        }
        $this->data['blognews']['images'] = $this->BlognewsModel->getWhere('blognews_images', $id);

        if ($this->input->post() != false) {

            if (!empty($_FILES['images']['name'][0])) {
                $_FILES = reArrayFiles($_FILES['images']);

                $path = $this->config->item('images_path');
                $config['upload_path'] = $path . 'blognews/';

                if (!is_dir($config['upload_path'])) {
                    @mkdir($config['upload_path'], 0755, true);
                    // add index.html file to new created folder
                    $dest = $config['upload_path']. "/index.html";
                    $source = FCPATH . "system/index.html";
                    if(is_file($source)) {
                        copy($source, $dest);
                    }
                }

                $config['allowed_types'] = 'gif|jpg|png|jpeg'; // by extension, will check for whether it is an image
                $config['encrypt_name'] = true;
                $this->load->library('upload');
                $this->upload->initialize($config);

                $data = array();
                foreach ($_FILES as $key => $image) {
                    $this->upload->do_upload($key);
                    $uploadData = $this->upload->data();
                    $data[] = array(
                        'blognews_id' => $id,
                        'image' => $uploadData['file_name']
                    );
                }

                $this->BlognewsModel->insertImages($data);
            }

            $this->session->set_flashdata('message', 'add_success');
        }

        $this->load->view('blognews/addimages', $this->data);
    }

    private function uploadImage($input_name, $path) {
        if (isset($_FILES[$input_name])) {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $fileext = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
            $config['file_name'] = uniqid() . '.' . strtolower($fileext);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($input_name)) {
                $upload_data = $this->upload->data();
                return $config['upload_path'] . $upload_data['file_name'];
            }
        }

        return false;
    }

    public function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);

        $query = $this->db->get_where($table, array($field => $str));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->$field != $this->data['page'][$field])
                    return false;
            }
        }

        return true;
    }

    public function getBlognewsCount() {
        if ( $this->admin_id != $this->config->item('super_global_admin_id')) {
            $this->db->where('user_id', $this->admin_id);
        }
        $this->db->from('blognews');
        return $this->db->count_all_results();
    }

    public function comments($blognews_id) {
        if (preg_match('/^[0-9]*$/', $blognews_id)){
            $this->data['blognews_comments'] = array(1 => 'test');
            $this->data['blognews'] = $this->BlognewsModel->getBlognewsDetails($blognews_id);
            if (!empty($this->data['blognews'])) {
                $this->data['blognews_comments'] = $this->BlognewsModel->getBlognewsComments($blognews_id);
                $this->load->view('blognews/comments', $this->data);
            } else {

                redirect('blognews_comments');
            }
        }else{
            redirect('blognews_comments');
        }
    }


}
