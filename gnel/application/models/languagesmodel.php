<?php 
class LanguagesModel extends MultilangModel {

    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('languages_t', array('name'), 'lang_code', 'lang_id');
    }
    
    public function rules_add() {
        $languages = $this->getLanguages();
        $rules = array();
        
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Languages[code]', 
                'label'   => $this->ci->lang->line("Code"), 
                'rules'   => 'required|alpha|exact_length[2]|is_unique[languages.code]', 
            ); 

            $rules[] = array(
                'field'   => 'Languages[name_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Name"), 
                'rules'   => 'required|max_length[32]', 
            );
        }
        
        return $rules;
    }
    
    public function rules_edit() {
        $languages = $this->getLanguages();
        $rules = array();
        
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Languages[code]', 
                'label'   => $this->ci->lang->line("Code"), 
                'rules'   => 'required|alpha|exact_length[2]|callback_is_unique[languages.code]', 
            ); 

            $rules[] = array(
                'field'   => 'Languages[name_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Name"), 
                'rules'   => 'required|max_length[32]', 
            );
        }
        
        return $rules;
    }
    
    public function getLanguages($table) {
        $pk = $this->getPkName($table);
        $query = $this->db->select('code, name')
                          ->get($table);
        
        if($query->num_rows() > 0) {
            $codes = array();
            foreach ($query->result() as $row)
                $codes[$row->code] = $row->name;
            
            return $codes;
        }
        
        return array();
    }

    public function getAllLanguages($table, $order_by='ASC') {
        $pk = $this->getPkName($table);
        $str_select = $table.'.*';

        foreach($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t.'.'.$attr;
        }

        $default_language = $this->getDefultLanguage();
        $query = $this->db->select($str_select)
            ->from($table)
            ->where("status", "1")
            ->join($this->table_t, $this->table_t.'.'.$this->foreign_key.'='.$table.'.'.$pk.' AND '.$this->table_t.'.'.$this->lang_key.' = '.'"'.$default_language.'"', 'left')
            ->order_by("id", $order_by)
            ->get();

        if($query->num_rows() > 0)
            return $query->result();;

        return false;
    }
    
}

?>