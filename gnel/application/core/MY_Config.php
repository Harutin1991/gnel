<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Config extends CI_Config {

	function site_url($uri = '') {
		if (is_array($uri)) {
			$uri = implode('/', $uri);
		}
		
		if (class_exists('CI_Controller')) {
			$uri = addCurrentLang($uri);
		}

		return $this->config_site_url($uri);
	}
	function config_site_url($uri = '') {
		if ($uri == '') {
			return $this->slash_item('base_url').$this->item('index_page');
		}

		if ($this->item('enable_query_strings') == FALSE) {
			$suffix = ($this->item('url_suffix') == FALSE) ? '/' : $this->item('url_suffix');
			return $this->slash_item('base_url').$this->slash_item('index_page').$this->_uri_string($uri).$suffix;
		} else {
			return $this->slash_item('base_url').$this->item('index_page').'?'.$this->_uri_string($uri);
		}
	}
		
}

/* End of file */
