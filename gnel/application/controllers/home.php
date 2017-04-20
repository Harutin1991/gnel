<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property LanguagesModel $LanguagesModel
 * @property SettingsModel $SettingsModel
 *
 */

class Home extends MY_Controller {

    protected $tamplate = 'gnel/main';
    function __construct() {
        parent::__construct();

//        if (!$this->_is_logged_in()) {
//            redirect(site_url('login'));
//        }

        $this->load->model('MultilangModel');
        $this->load->model('BrandModel');
		$this->load->model('UserModel');


//        $this->data['languages'] = $this->LanguagesModel->getAllLanguages('languages');
//        $this->data['default_language'] = $this->SettingsModel->get('default_language');


    }
	public function index() {



//if(isset($_GET['html'])) {
//    addHTMLFileToAllFolders();
//}



        $lang = $this->config->item('language');
        $limit = 4;
        $order_by = 'id';
        
        if ($this->input->post('login')) {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $user_data = $this->UserModel->authenticateLogin($email, $password);

            if ($user_data) {
                $this->setLoginData($user_data);
                redirect(site_url(''));
            } else {
                $this->data['wrong_login'] = true;
            }
        }

        $this->data['last_products'] = $this->MultilangModel->getProducts();
        $this->data['special_products'] = $this->MultilangModel->getSpecialProducts();
        
        $this->data['brands'] = $this->BrandModel->getAllBrands();
        if ($this->_is_logged_in()) {
			$this->data['user'] = $this->UserModel->get('users', $this->data['user_id']);
		}

        $this->data['home_page'] = 1;

        $this->load->view('home/index', $this->data);
	}

	public function about() {
		$this->load->view('site/about');
	}

	public function contacts() {
		$this->load->view('site/contacts');
	}
}
