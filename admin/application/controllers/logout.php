<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends Main_controller{
	public function __construct() 
	{   
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->session->unset_userdata('verify_code');
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_username');
		$this->session->unset_userdata('rol_id');
		redirect( site_url('login') );		
		
	}
	
}
