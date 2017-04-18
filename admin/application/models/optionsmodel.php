<?php

class OptionsModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('options_t', array('name'), 'lang_code', 'option_id');
    }

    public function rules() {
        $rules = array();

        $languages = $this->getLanguages();

        foreach ($languages as $language) {
            if ($language->code == $this->default_language) {
                $rules[] = array(
                    'field' => 'Option[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'required|max_length[255]',
                );
            } else {
                $rules[] = array(
                    'field' => 'Option[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'max_length[255]',
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

    public function insert($table, $data) {

        $data['name'] = $data["name_" . $this->default_language];
        $id = parent::insert($table, $data);

        return $id;
    }
    public function update($table, $id, $data) {
        $data['name'] = $data["name_" . $this->default_language];
        $is_updated = parent::update($table, $id, $data);

        return $is_updated;
    }    
    
    public function getAllWhere($table, $option_ids = array(), $order_by = 'DESC') {
      if(count($option_ids) >0) {
      $pk = $this->getPkName($table);

      $str_select = $table . '.*, '. $table . '.name AS default_name';
      foreach ($this->attributes_t as $attr) {
      $str_select .= ', ';
      $str_select .= $this->table_t . '.' . $attr;
      }

      $default_language = $this->getDefultLanguage();
      $query = $this->db->select($str_select)
      ->from($table)
      ->where_in($table.'.'.$pk, $option_ids)
      ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk . ' AND ' . $this->table_t . '.' . $this->lang_key . ' = ' . '"' . $default_language . '"', 'left')
      ->order_by("id", $order_by)
      ->get();

      if ($query->num_rows() > 0)
      return $query->result();
      }

      return array();
      }

    /*

      public function update($table, $id, $data) {
      $is_updated = parent::update($table, $id, $data);

      if($is_updated != false) {
      if(!array_key_exists('category', $data))
      $data['category'] = array();

      $categories_to_add = array_diff($data['category'], $data['current_category']);
      $categories_to_delete = array_diff($data['current_category'], $data['category']);

      if(count($categories_to_delete) > 0) {
      $query = $this->db->where('option_id', $id)
      ->where_in('category_id', $categories_to_delete)
      ->delete('category_options');
      }

      if(count($categories_to_add) > 0) {
      $option_category = array();

      foreach ($categories_to_add as $category) {
      $option_category[] = array(
      'option_id' => $id,
      'category_id' => $category,
      );
      }

      $this->db->insert_batch('category_options', $option_category);
      }
      }

      return $is_updated;
      }

      public function getCategoryIds($id) {
      $query = $this->db->select('category_id')
      ->where('option_id', $id)
      ->get('category_options');

      $category_ids = array();

      if($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
      $category_ids[] = $row->category_id;
      }
      }

      return $category_ids;
      }

      

      public function delete($table, $id) {
      if(parent::delete($table, $id)) {
      $query = $this->db->where('option_id', $id)
      ->delete('category_options');

      return true;
      }

      return false;
      }
     */
    /*
      public function getOptions($table='options') {
      $options = array();

      foreach ($this->getAll('options') as $option) {
      $options[$option->id] = $option->name;
      }

      return $options;
      }
     * 
     */
}

?>