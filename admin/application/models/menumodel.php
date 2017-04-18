<?php

class MenuModel extends BaseModel {

    public function rules_add() {
        return array(
            array(
                'field' => 'Menu[name]',
                'label' => $this->ci->lang->line("Name"),
                'rules' => 'required|is_unique[menus.name]',
            ),
        );
    }

    public function rules_edit() {
        return array(
            array(
                'field' => 'Menu[name]',
                'label' => $this->ci->lang->line("Name"),
                'rules' => 'required|callback_is_unique[menus.name]',
            ),
        );
    }

}

?>