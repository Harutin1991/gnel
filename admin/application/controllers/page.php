<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property PageModel $PageModel
 * @property FaqModel $FaqModel
 * @property ContactModel $ContactModel
 * @property ContactTopicModel $ContactTopicModel
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
        $this->load->model('FaqModel');
        $this->load->model('ContactModel');
        $this->load->model('ContactTopicModel');
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
    
    public function add($parent_id = '') {
        if(!empty($parent_id)) {
            $this->data['parent_id'] = $parent_id;
        }
        if($this->input->post('Page')) {
            $this->form_validation->set_rules($this->PageModel->rules_add());
            if($this->form_validation->run()) {
                $data = $this->input->post('Page', true);
                $data['url'] = $data['title_' . $this->data['default_language']];

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
                if(!empty($parent_id)) {
                    redirect("page/edit/" . $this->data['parent_id'], 'refresh');

                } else {
                    redirect("page/index", 'refresh');

                }
            }
        }
        
		$this->load->view('page/add', $this->data);
	}
    
    public function edit($id = NULL) {
        if(!isset($id)) show_404();
        $this->data['page'] = $this->PageModel->get('pages', $id);
        if($this->data['page'] == false) show_404();
        $this->data['pages'] = $this->PageModel->getPageChildes('pages', $id);
        $parent_id = $this->data['page']['parent_id'];

        if($this->input->post('Page')) {
            $this->form_validation->set_rules($this->PageModel->rules_edit());
            
            if($this->form_validation->run()) {
                $data = $this->input->post('Page', true);
                $data['url'] = $data['title_' . $this->data['default_language']];
                
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
//                redirect(current_url(), 'refresh');
                if(!$this->data['pages']) {
                    redirect("page/edit/" . $parent_id, 'refresh');
                } else {
                    redirect("page/index", 'refresh');
                }

            }
        }
        
		$this->load->view('page/edit', $this->data);
	}

    public function contacts() {

        $this->data['contacts'] = $this->ContactModel->get('contact', '2');

        if($this->input->post('Contact')) {

            $data = $this->input->post('Contact', true);

            $old_image = $this->data['contacts']['image'];

            if(!empty($_FILES['image']['name']))
            {
                $image_data = $this->_do_upload('image', 'contact');

                if(isset($old_image))
                    $this->_delete_img($old_image, 'contact');

                if(isset($image_data['upload_data']))
                    $data['image'] = $image_data['upload_data']['file_name'];
            }

//                if(($id = $this->ContactModel->insert('contact', $data)) != false) {
//                    $this->addLog('Added page with id: ' . $id);
//                }

            if($this->ContactModel->update('contact', $id = 2, $data) != false) {
                $this->addLog('Edited page with id: ' . $id);
            }

            $this->session->set_flashdata('message', 'edit_success');

            redirect("page/contacts", 'refresh');


            }

        $this->load->view('page/contacts', $this->data);
    }

    public function faq() {
        $this->data['faqs'] = $this->FaqModel->getFaqOrder('faq');
        $this->load->view('page/faq', $this->data);
    }

    public function addfaq() {
        if($this->input->post('Faq')) {
            $this->form_validation->set_rules($this->FaqModel->rules_add());
            if($this->form_validation->run()) {
                $data = $this->input->post('Faq', true);
//                echo '<pre>'; print_r($data); die;

                if(($id = $this->FaqModel->insert('faq', $data)) != false) {
                    $this->addLog('Added page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'add_success');
                redirect("page/faq/", 'refresh');

            }
        }

        $this->load->view('page/addfaq');
    }

    public function editfaq($id = NULL) {
        if(!isset($id)) show_404();

        $this->data['faq'] = $this->FaqModel->get('faq', $id);
        if($this->data['faq'] == false) show_404();

        if($this->input->post('Faq')) {
            $this->form_validation->set_rules($this->FaqModel->rules_edit());

            if($this->form_validation->run()) {
                $data = $this->input->post('Faq', true);


                if($this->FaqModel->update('faq', $id, $data) != false) {
                    $this->addLog('Edited page with id: ' . $id);
                }

                $this->session->set_flashdata('message', 'edit_success');
                redirect("page/faq/", 'refresh');

            }
        }

        $this->load->view('page/editfaq', $this->data);
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