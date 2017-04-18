<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property AdminModel $AdminModel
 *
 */
class Login extends Main_controller{
	public function __construct() 
	{   
		parent::__construct();
		$this->load->library('encrypt');
	}
	public $layout = 'login';
	public $data_for_view = array();
	public function index()
	{
	    
		if(!$this->_is_logged_in()){
			$admin_username = $this->input->post('admin_username', true);
			$admin_password = $this->input->post('admin_password', true);
//			var_dump(sha1(123456)); die;
			$admin_data = $this->AdminModel->authenticate_login($admin_username, $admin_password);
			if($admin_data){
				$verify_code = $this->encrypt->encode($admin_username . $this->config->item('encryption_key'));
				$this->session->set_userdata('verify_code',    $verify_code);
				$this->session->set_userdata('admin_id',       $admin_data['id']);
				$this->session->set_userdata('admin_username', $admin_data['username']);
				$this->session->set_userdata('rol_id',         $admin_data['rol_id']);
                if($this->session->userdata('return_url')) {
                    redirect( $this->session->userdata('return_url') );
                }
				redirect( site_url('dashboard') );
			}else{
				if($admin_data !== false){
					$this->data_for_view['wrong_login'] = true;
				}
			}
			$this->load->view('pages/login', $this->data_for_view);
		}else{
			redirect( site_url('dashboard') );
		}
	}
	
}
