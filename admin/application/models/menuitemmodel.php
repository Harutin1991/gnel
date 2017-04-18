<?php

class MenuItemModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('menu_items_t', array('name'), 'lang_code', 'item_id');
    }

    public function rules_add() {
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();

        $rules = array();

        foreach ($languages as $language) {
            if ($language->code == $default_language) {
                $rules[] = array(
                    'field' => 'MenuItem[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'required',
                );
            } else {
                $rules[] = array(
                    'field' => 'MenuItem[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => '',
                );
            }
        }

        return $rules;
    }

    public function rules_edit() {
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();

        $rules = array();

        foreach ($languages as $language) {
            if ($language->code == $default_language) {
                $rules[] = array(
                    'field' => 'MenuItem[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'required',
                );
            } else {
                $rules[] = array(
                    'field' => 'MenuItem[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => '',
                );
            }
        }

        return $rules;
    }

    public function deleteMenuItem($table, $id) {
        $pk = $this->getPkName($table);
        $query = $this->db->where($pk, $id)
                ->delete($table);

        if ($this->db->affected_rows()) {
            $query = $this->db->where("item_id", $id)
                    ->delete($table . '_t');
            return true;
        }
        return false;
    }

}

?>