<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property PageModel $PageModel
 *
 */

class Page extends Main_controller {
	
    public $layout = 'default';
    
    function __construct(){
		parent::__construct();
        
		if(!$this->_is_logged_in()){
            redirect(site_url('login'));
        }
        
        $this->load->model('PageModel');
        $this->load->model('LanguagesModel');
        $this->load->model('SettingsModel');
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        
        $this->data['languages'] = $this->LanguagesModel->getAllLanguages('languages', 'ASC');
        $this->data['default_language'] = $this->SettingsModel->get('default_language');
        
        $this->data['statuses'] = array(
            '1'=>$this->lang->line('Active'), 
            '0'=>$this->lang->line('Inactive'), 
        );
	}
	
    public function index() {
        $this->data['pages'] = $this->PageModel->getAll('pages');
		$this->load->view('page/index', $this->data);
	}
    
    public function add() {
        if($this->input->post('Page')) {
            $this->form_validation->set_rules($this->PageModel->rules_add());

            if($this->form_validation->run()) {
                $data = $this->input->post('Page', true);
                
                if(isset($data['status']))
                    $data['status'] = 1;
                else
                    $data['status'] = 0;
                
                $image_data = $this->_do_upload('image', 'pages');
//                var_dump($image_data);die;
                
                if(isset($image_data['upload_data']))
                    $data['image'] = $image_data['upload_data']['file_name'];
                
                if(($id = $this->PageModel->insert('pages', $data)) != false) {
                    $this->addLog('Added page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("page/edit/$id", 'refresh');
            }
        }
        
		$this->load->view('page/add', $this->data);
	}
    
    public function edit($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['page'] = $this->PageModel->get('pages', $id);
        if($this->data['page'] == false) show_404();

        if($this->input->post('Page')) {
            $this->form_validation->set_rules($this->PageModel->rules_edit());
            
            if($this->form_validation->run()) {
                $data = $this->input->post('Page', true);
                
                if(isset($data['status']))
                    $data['status'] = 1;
                else
                    $data['status'] = 0;
                
                $old_image = $this->data['page']['image'];

                if(!empty($_FILES['image']['name']))
                {
                    $image_data = $this->_do_upload('image', 'pages');

                    if(isset($old_image))
                        $this->_delete_img($old_image, 'pages');

                    if(isset($image_data['upload_data']))
                        $data['image'] = $image_data['upload_data']['file_name'];
                }
                
                if($this->PageModel->update('pages', $id, $data) != false) {
                    $this->addLog('Edited page with id: ' . $id);
                }
                
                $this->session->set_flashdata('message', 'edit_success');
                redirect(current_url(), 'refresh');
            }
        }
        
		$this->load->view('page/edit', $this->data);
	}

    public function subPages($id) {
        $this->data['pages'] = $this->PageModel->getPageChildes('pages', $id);
        $this->load->view('page/indexSubPage', $this->data);
    }

    public function addSubPage($id) {
        if(!isset($id)) show_404();

        $this->data['parent_id'] = $id;

        if($this->input->post('Page')) {
            $this->form_validation->set_rules($this->PageModel->rules_add());

            if($this->form_validation->run()) {
                $data = $this->input->post('Page', true);

                if(isset($data['status']))
                    $data['status'] = 1;
                else
                    $data['status'] = 0;

                $image_data = $this->_do_upload('image', 'pages');

                if(isset($image_data['upload_data']))
                    $data['image'] = $image_data['upload_data']['file_name'];

                if(($id = $this->PageModel->insert('pages', $data)) != false) {
                    $this->addLog('Added page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("page/edit/$id", 'refresh');
            }
        }

        $this->load->view('page/addsubpage', $this->data);
    }
    
    private function uploadImage($input_name, $path) {
        if(isset($_FILES[$input_name])) {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '100';
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
	
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if($row->$field != $this->data['page'][$field])
                    return false;
            }
        }
        
        return true;
    }

}