<?php 
class PageModel extends MultilangModel {
    
    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('pages_t', array('title', 'meta_description', 'short_description', 'text'), 'lang_code', 'page_id');
    }
    
    public function rules() {
        $rules = array();
        
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();
        
        foreach($languages as $language){

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
        
        return $rules;
    }
    
    public function rules_edit() {
        $rules = $this->rules();
        
        return $rules;
    }

    public function getPageChildes($table, $id) {

        $query = $this->db->get_where($table, array('parent_id' => $id));

        if ($query->num_rows() > 0) {
            $record = $query->result_array();
//            print_r($record); die;

            for ($i = 0; $i < count($record); $i++) {
                if (count($record) > 0) {
                    $languages = $this->getLanguages();

                    foreach ($languages as $language) {

                        $query = $this->db->get_where($this->table_t, array(
                                $this->foreign_key => $id,
                                $this->lang_key => $language->code
                            )
                        );

                        $record_t = $query->row_array();

                        if (count($record_t) > 0) {
                            foreach ($this->attributes_t as $attr) {
                                $record[$i][$attr . "_" . $language->code] = $record_t[$attr];
                            }
                        } else {
                            foreach ($this->attributes_t as $attr) {
                                //  $record[$attr."_".$language->code] = $record[$attr];
                                $record[$i][$attr . "_" . $language->code] = NULL;
                            }
                        }
                    }
                }
            }


            return $record;
        }

    }

}

?>