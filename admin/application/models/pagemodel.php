<?php 
class PageModel extends MultilangModel {
    
    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('pages_t', array('title', 'meta_keywords', 'meta_description', 'short_description', 'text'), 'lang_code', 'page_id');
    }
    
    public function rules() {
        $rules = array();
        
        $rules[] = array(
            'field'   => 'Page[status]', 
            'label'   => $this->ci->lang->line("Status"),
            'rules'   => 'required', 
        );
        
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();
        
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Page[meta_keywords_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta keywords"), 
                'rules'   => 'max_length[255]', 
            ); 
            $rules[] = array(
                'field'   => 'Page[meta_description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta description"), 
                'rules'   => 'max_length[255]', 
            );
            $rules[] = array(
                'field'   => 'Page[short_description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Short description"), 
                'rules'   => '', 
            );
            $rules[] = array(
                'field'   => 'Page[text_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Text"), 
                'rules'   => '', 
            );
            
            if($language->code == $default_language) {
                $rules[] = array(
                    'field'   => 'Page[title_'.$language->code.']', 
                    'label'   => $this->ci->lang->line("Title"), 
                    'rules'   => 'required|max_length[255]', 
                );
			}
            else { 
                $rules[] = array(
                    'field'   => 'Page[title_'.$language->code.']', 
                    'label'   => $this->ci->lang->line("Title"), 
                    'rules'   => 'max_length[255]', 
                );
			}
        }
        
        return $rules;
    } 
    
    public function rules_add() {
        $rules = $this->rules();
        
        $rules[] = array(
            'field'   => 'Page[url]', 
            'label'   => 'URL', 
            'rules'   => 'required|max_length[255]|is_unique[pages.url]', 
        );
        
        return $rules;
    }
    
    public function rules_edit() {
        $rules = $this->rules();
        
        $rules[] = array(
            'field'   => 'Page[url]', 
            'label'   => 'URL', 
            'rules'   => 'required|max_length[255]|callback_is_unique[pages.url]', 
        );
        
        return $rules;
    }
}

?>