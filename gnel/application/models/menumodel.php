<?php

class MenuModel extends BaseModel {

    public function getAllMenus() {
        $query = $this->db->get('menus');

        if ($query->num_rows() > 0) {
            $menus = array();
            foreach ($query->result() as $row) {
                $name = strtolower($row->name);
                $name = str_replace(' ', '_', $name);
                $menus[$row->name] = $this->getMenuPages($row->name);
            }
            return $menus;
        }
        return array();
    }

    public function getMenuPages($menu_name) {
        $row = $this->getMenuIdByName($menu_name);
        $menu_id = $row->id;
        $parent_id = $row->parent_id;
        $menu_items = $this->getMenuItems('menu_items', $menu_id);

        $Arr = array();
        foreach ($menu_items as $menuItem) {
            array_push($Arr, (array) $menuItem);
        }

        $result = treealize($Arr, 'id', 'parent_id', $parent_id);
        Sort_Multidimension_Array($result);

        return $result;
    }

    public function getMenuIdByName($menu_name) {
        $query = $this->db->get_where('menus', array('name' => $menu_name));

        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }

        return NULL;
    }

    public function getMenuItems($table, $menu_id, $order_by = 'DESC') {
        $table_t = $table . '_t';

        $query = $this->db->select("$table.*, $table_t.lang_code AS lang_code, $table_t.name AS name")
                ->from($table)
                ->join($table_t, "$table.id = $table_t.item_id", 'left')
                ->where($table_t . ".lang_code", $this->config->item('language'))
                ->get();


        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

}

?>