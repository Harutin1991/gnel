<?php 
class BlogcategoriesModel extends MultilangModel {
    
    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('blognews_categories_t', array('title', 'content', 'meta_keywords', 'meta_description'), 'lang_code', 'blog_category_id');
    }
    
    public function rules() {
        $rules = array();
        
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();
        
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Blogcategories[meta_keywords_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta keywords"), 
                'rules'   => 'max_length[255]', 
            ); 
            $rules[] = array(
                'field'   => 'Blogcategories[meta_description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta description"), 
                'rules'   => 'max_length[255]', 
            );
            $rules[] = array(
                'field'   => 'Blogcategories[description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Description"), 
                'rules'   => '', 
            );
            
            if($language->code == $default_language) {
                $rules[] = array(
                    'field'   => 'Blogcategories[title_'.$language->code.']', 
                    'label'   => "lang:Name", 
                    'rules'   => 'required|max_length[255]', 
                );
			}
            else { 
                $rules[] = array(
                    'field'   => 'Blogcategories[name_'.$language->code.']', 
                    'label'   => $this->ci->lang->line("Name"), 
                    'rules'   => 'max_length[255]', 
                );
			}
        }
        
        return $rules;
    } 
	
	public function SaveBlogCategories($data = array()) {
		$this->db->update_batch('blognews_categories', $data, 'id');
	
	}
    
}

?>