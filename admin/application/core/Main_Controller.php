<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CustomPostTypeModel $CustomPostTypeModel
 * @property UsersModel $UsersModel
 * @property LanguagesModel $LanguagesModel
 * @property SettingsModel $SettingsModel
 *
 */

class Main_controller extends CI_Controller {

    public $post_type;
    public $admin_id;
    public $permission = array();

    public function __construct() {
        parent::__construct();
        header("Content-type: text/html; charset=utf-8");
        $this->lang->load('custom', $this->config->item('language'));
        $this->load->model('CustomPostTypeModel');
        $this->post_type = $this->CustomPostTypeModel->customStartingWithChoiceOfTables();
        $this->load->model('UsersModel');
        $user_id = $this->session->userdata('admin_id');
        $this->admin_id = $this->session->userdata('admin_id'); 
        if ($user_id == true && !($user_id == $this->config->item('super_global_admin_id'))) {
            $this->permission = $this->UsersModel->getUserPermission($user_id);
            $this->permission = unserialize($this->permission['url']);
            $current_url = $this->uri->slash_segment(1) . $this->uri->segment(2);
            //var_dump($current_url);exit;
            if (!in_array($current_url, $this->permission) && !($current_url == 'ajax/' ) && !($current_url == 'dashboard/' ) && !($current_url == 'login/' ) && !($current_url == 'logout/' ) && !($current_url == '/' )) {
                show_404();
            }
        }

        $data = array();
        $this->data['languages'] = $data['languages'] = $this->LanguagesModel->getAllLanguages('languages', 'ASC');
        $this->data['default_language'] = $data['default_language'] = $this->SettingsModel->get('default_language');
        $this->load->vars($data);

        //var_dump($current_url);        
    }

    protected function _is_logged_in() {
        $this->load->library('encrypt');
        $config_verify_code = $this->config->item('encryption_key');
        $admin_username = $this->session->userdata('admin_username');
        $verify_code_ = $admin_username . $config_verify_code;
        $verify_code = $this->session->userdata('verify_code');
        $verify_code = $this->encrypt->decode($verify_code);
        $logged = strcmp($verify_code, $verify_code_) === 0;
        if ($logged) {
            $this->session->set_userdata('return_url', uri_string());
        }
        return $logged;
    }

    protected function _do_upload($userfile, $folder) {
        $path = $this->config->item('images_path');
        $config['upload_path'] = $path . "{$folder}";
        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0755, true);
            // add index.html file to new created folder
            $dest = $config['upload_path']. "/index.html";
            $source = FCPATH . "system/index.html";
            if(is_file($source)) {
                copy($source, $dest);
            }
        }
        $config['upload_path'] = $path . "{$folder}";
        $config['allowed_types'] = 'gif|jpg|png'; // by extension, will check for whether it is an image
        $config['encrypt_name'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $files = $this->upload->do_upload($userfile);

        if ($files === false) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());

            return $data;
        }
    }

    protected function _delete_img($filename, $folder) {
        $path = $this->config->item('images_path');
        $file_path = $path . "{$folder}/{$filename}";
        if (is_file($file_path)) {
            unlink($file_path);
        }
    }

    protected function _delete_folder($foldername, $edit = true) {
        $path = $this->config->item('images_path');
        $folder = $path . "{$foldername}";
        
		if (file_exists($folder)) {
			$files = scandir($folder);
			foreach ($files as $file) {
				if ($file == '.' || $file == '..') {
					continue;
				}
				if (is_dir($folder . '/' . $file)) {
					$this->_delete_folder($foldername . '/' . $file);
				} else {
					@unlink($folder . "/" . $file);
				}
			}
			if ($edit) {
				rmdir($folder);
			}
		}
    }

    public function addLog($action = NULL) {
        $log_data['user_id'] = $this->session->userdata('admin_id');
        $log_data['url'] = $_SERVER['REQUEST_URI'];

        if ($action == NULL) {
            $current_controller = $this->router->fetch_class();
            $current_method = $this->router->fetch_method();
            $action = $current_method . " " . $current_controller;
        }

        $log_data['action'] = $action;
        $log_data['time'] = date('Y-m-d H:i:s', time());

        if ($this->LogsModel->insert('logs', $log_data))
            return true;

        return false;
    }

}
