<?php

/**
 * @property SettingsModel $SettingsModel
 *
 */
class MultilangModel extends BaseModel {
    
    protected $attributes_t = array();
    protected $lang_key = '';
    protected $foreign_key = '';
    protected $table_t = '';

    
    protected function setAttributesT($table_t, $data, $lang_key, $foreign_key) {
        $this->table_t = $table_t;
		$this->attributes_t = $data;
		$this->lang_key = $lang_key;
        $this->foreign_key = $foreign_key;
        
   }
    
    protected function getAttributesT() {
        return $this->$attributes_t;
    }
    
    protected function getLanguages() {
        return $this->getAll('languages');
    }
    
    protected function getDefultLanguage() {
        $this->ci->load->model('SettingsModel');
        return $this->ci->SettingsModel->get('default_language');
        
    }

    public function insert($table, $data) {
        $pk = $this->getPkName($table);
        $attributes = $this->getAttributes($table);
        $attributes = array_intersect_key($data, $attributes);

        if(count($attributes) == 0)
            $attributes = array($pk=>NULL);
        
        if($this->db->insert($table, $attributes)) {
            $insert_id = $this->db->insert_id();
        
            if(isset($insert_id)) {
                $attributes = $this->getAttributes($this->table_t);
                $data[$this->foreign_key] = $insert_id;
                $languages = $this->getLanguages();

                foreach ($languages as $language) {
                        foreach($this->attributes_t as $attr) {
                            if(isset($data[$attr . "_" . $language->code]))
                        $data[$attr] = $data[$attr . "_" . $language->code];
                        }

                    $data[$this->lang_key] = $language->code;
                    $attributes = array_intersect_key($data, $attributes);

                    $this->db->insert($this->table_t, $attributes);
                }
            }
            
            return $insert_id;
        }
        
        return false;
    }
    
    public function update($table, $id, $data) {
        $pk = $this->getPkName($table);
        $attributes = $this->getAttributes($table);
        $attributes = array_intersect_key($data, $attributes);
        if(count($attributes) > 0)
            $this->db->where($pk, $id)
                     ->update($table, $attributes);
        
        $is_updated = false;
        if($this->db->affected_rows())
            $is_updated = true;
        
        $attributes = $this->getAttributes($this->table_t);
        $data[$this->foreign_key] = $id;
        $languages = $this->getLanguages();
        
        foreach ($languages as $language) {
            foreach($this->attributes_t as $attr) {
                if(isset($data[$attr . "_" . $language->code]))
				$data[$attr] = $data[$attr . "_" . $language->code];
            }
            
            $data[$this->lang_key] = $language->code;
            $attributes = array_intersect_key($data, $attributes);
            
            if(count($attributes)>0) {
                $query = $this->db->get_where($this->table_t,  array(
                        $this->foreign_key=>$id, 
                        $this->lang_key=>$language->code
                    )
                );
                
                if($query->num_rows() > 0)
                    $this->db->where($this->foreign_key, $id)
                             ->where($this->lang_key, $language->code)
                             ->update($this->table_t, $attributes);
                else 
                    $this->db->insert($this->table_t, $attributes);
                
                if($this->db->affected_rows())
                    $is_updated = true || $is_updated;
            }
        }
        
        return $is_updated;
    }
    
    public function get($table, $id) {
        $pk = $this->getPkName($table);
        $query = $this->db->get_where($table, array($pk => $id));
        
        if($query->num_rows() > 0){
            $record = $query->row_array();
            
            if(count($record) > 0) {
                $languages = $this->getLanguages();
                
                foreach ($languages as $language) {
                    
                    $query = $this->db->get_where($this->table_t, 
                        array(
                            $this->foreign_key=>$id, 
                            $this->lang_key=>$language->code
                        )
                    );
                    
                    $record_t = $query->row_array();
                    
                    if(count($record_t) > 0) {
                        foreach($this->attributes_t as $attr)
                            $record[$attr."_".$language->code] = $record_t[$attr];
                    }
                    else {
                        foreach($this->attributes_t as $attr)
                            $record[$attr."_".$language->code] = $record[$attr];
                    }
                }
            }
            
            return $record;
        }
        
        return false;
    }
    
    public function getAll($table, $order_by='DESC') {
        $pk = $this->getPkName($table);
        
        $str_select = $table.'.*';
        
        foreach($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t.'.'.$attr;
        }
        
        $default_language = $this->getDefultLanguage();
		$current_language = $this->config->item('language');
        $this->db->select($str_select)
                ->from($table)
                ->join($this->table_t, $this->table_t.'.'.$this->foreign_key.'='.$table.'.'.$pk.' AND '.$this->table_t.'.'.$this->lang_key.' = '.'"'.$current_language.'"', 'left')
                ->order_by("id", $order_by);
                
        $attributes = $this->getAttributes($table);

        $status  = array("status"=> "1");
        $if_contains_status = array_intersect_key($status, $attributes);
        if (!empty($if_contains_status)) {
            $this->db->where($table.'.status', '1');
        }        
                
        $query = $this->db->get();
       
        if($query->num_rows() > 0) 
            return $query->result();
        
        return false;
    }
    
    public function delete($table, $id) {
        if(parent::delete($table, $id)) {
            $query = $this->db->where($this->foreign_key, $id)
                              ->delete($this->table_t);
            
            return true;
        }
        
        return false;
    }

    public function getProducts($limit = 4, $offset = 0, $order_by_col = 'id', $order_by = 'DESC', $category = '' ) {
        $current_lang = $this->config->item('language');
        $sql = "SELECT products.*, products_t.*,   product_images.*, products.id AS prod_id "
                . "FROM products "
                . "LEFT JOIN products_t "
                . "ON products.id = products_t.product_id AND products_t.lang_code = '$current_lang' "
                . "INNER JOIN product_images "
                . "ON products.id = product_images.product_id AND product_images.order = '0' "
				. "LEFT JOIN brands "
                . "ON products.brand_id = brands.id "
                . "WHERE products.status = '1' "
				. "AND brands.status = '1' "
                . "ORDER BY products.$order_by_col $order_by "
                . "LIMIT $offset, $limit";
        
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }
    public function getSpecialProducts($limit = 4, $offset = 0, $order_by_col = 'id', $order_by = 'DESC', $category = '' ) {
        $current_lang = $this->config->item('language');
        $sql = "SELECT products.*, products_t.*,   product_images.*, products.id AS prod_id "
                . "FROM products "
                . "LEFT JOIN products_t "
                . "ON products.id = products_t.product_id AND products_t.lang_code = '$current_lang' "
                . "INNER JOIN product_images "
                . "ON products.id = product_images.product_id AND product_images.order = '0' "
				. "LEFT JOIN brands "
                . "ON products.brand_id = brands.id "
                . "WHERE products.status = '1' "
				. "AND brands.status = '1' "
				. "AND products.special = '1' "
                . "ORDER BY products.$order_by_col $order_by "
                . "LIMIT $offset, $limit";
        
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }
}

?>