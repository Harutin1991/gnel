<?php 
class PartnerModel extends MultilangModel {
    
    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('partners_t', array('name', 'meta_keywords', 'meta_description', 'description'), 'lang_code', 'partner_id');
    }
    
    public function rules() {
        $rules = array();
        
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();
        $rules[] = array(
                'field'   => 'Partner[link]', 
                'label'   => $this->ci->lang->line("Link"), 
                'rules'   => '', 
            );
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Partner[meta_keywords_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta keywords"), 
                'rules'   => 'max_length[255]', 
            ); 
            $rules[] = array(
                'field'   => 'Partner[meta_description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta description"), 
                'rules'   => 'max_length[255]', 
            );
            $rules[] = array(
                'field'   => 'Partner[description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Description"), 
                'rules'   => '', 
            );
            
            if($language->code == $default_language) {
                $rules[] = array(
                    'field'   => 'Partner[name_'.$language->code.']', 
                    'label'   => "lang:Name", 
                    'rules'   => 'required|max_length[255]', 
                );
			}
            else { 
                $rules[] = array(
                    'field'   => 'Partner[name_'.$language->code.']', 
                    'label'   => $this->ci->lang->line("Name"), 
                    'rules'   => 'max_length[255]', 
                );
			}
        }
        
        return $rules;
    } 
	
	
    
}

?>