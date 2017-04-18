<?php

class MultilangModel extends BaseModel {

    protected $attributes_t = array();
    protected $lang_key = '';
    protected $foreign_key = '';
    protected $table_t = '';
    public $default_language;

    public function __construct() {
        parent::__construct();
        $this->default_language = $this->getDefultLanguage();
    }

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
        return $this->getAllActive('languages', 'ASC');
    }

    protected function getDefultLanguage() {
        $this->ci->load->model('SettingsModel');
        return $this->ci->SettingsModel->get('default_language');
    }

    public function insert($table, $data) {
        $pk = $this->getPkName($table);
        $attributes = $this->getAttributes($table);
        $maxorder = 1;
        $maxorder = $this->getMaxOrdering($table);
        $maxorder = intval($maxorder) + 1;
//        var_dump($maxorder); die;

        //insert default values in main table
        $default_language = $this->getDefultLanguage();
        $data_def = array();
        foreach ($data AS $key => $val) {
            $tr_key = rtrim($key, "_" . $default_language);
            $data_def[$tr_key] = $val;
        }
        //add insert datetime
        $data_def["date_created"] = date("Y-m-d H:i:s", time());
        $data_def["date_modified"] = $data_def["date_created"];
        $data_def["ordering"] = $maxorder;

        $attributes = array_intersect_key($data_def, $attributes);
        if (count($attributes) == 0)
            $attributes = array($pk => NULL);

        if ($this->db->insert($table, $attributes)) {

            $insert_id = $this->db->insert_id();
            if (isset($insert_id)) {
                $attributes = $this->getAttributes($this->table_t);
                $data[$this->foreign_key] = $insert_id;
                $languages = $this->getLanguages();

                foreach ($languages as $language) {

                    foreach ($this->attributes_t as $attr) {
                        if (isset($data[$attr . "_" . $language->code]))
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

        //insert default values in main table
        $default_language = $this->getDefultLanguage();
        $data_def = array();
        foreach ($data AS $key => $val) {
            $tr_key = rtrim($key, "_" . $default_language);
            $data_def[$tr_key] = $val;
        }
        //add update datetime
        $data_def["date_modified"] = date("Y-m-d H:i:s", time());

        $attributes = array_intersect_key($data_def, $attributes);

        if (count($attributes) > 0)
            $this->db->where($pk, $id)
                    ->update($table, $attributes);

        $is_updated = false;
        if ($this->db->affected_rows())
            $is_updated = true;

        $attributes = $this->getAttributes($this->table_t);
        $data[$this->foreign_key] = $id;
        $languages = $this->getLanguages();

        foreach ($languages as $language) {
            foreach ($this->attributes_t as $attr) {
                if (isset($data[$attr . "_" . $language->code]))
                    $data[$attr] = $data[$attr . "_" . $language->code];
            }

            $data[$this->lang_key] = $language->code;
            $attributes = array_intersect_key($data, $attributes);

            if (count($attributes) > 0) {
                $query = $this->db->get_where($this->table_t, array(
                    $this->foreign_key => $id,
                    $this->lang_key => $language->code
                        )
                );

                if ($query->num_rows() > 0)
                    $this->db->where($this->foreign_key, $id)
                            ->where($this->lang_key, $language->code)
                            ->update($this->table_t, $attributes);
                else
                    $this->db->insert($this->table_t, $attributes);

                if ($this->db->affected_rows())
                    $is_updated = true || $is_updated;
            }
        }

        return $is_updated;
    }

    public function get($table, $id) {
        $pk = $this->getPkName($table);
        $query = $this->db->get_where($table, array($pk => $id));

        if ($query->num_rows() > 0) {
            $record = $query->row_array();

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
                            $record[$attr . "_" . $language->code] = $record_t[$attr];
                        }
                    } else {
                        foreach ($this->attributes_t as $attr) {
                            //  $record[$attr."_".$language->code] = $record[$attr];
                            $record[$attr . "_" . $language->code] = NULL;
                        }
                    }
                }
            }

            return $record;
        }

        return false;
    }

    public function getAll($table, $order_by = 'DESC', $order_column = 'id') {
        $pk = $this->getPkName($table);
        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }
        $default_language = $this->getDefultLanguage();
        $this->db->select($str_select)
                ->from($table)
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk . ' AND ' . $this->table_t . '.' . $this->lang_key . ' = ' . '"' . $default_language . '"', 'left')
                ->order_by($order_column, $order_by);
        //check if admin user have permitions
        $attributes = $this->getAttributes($table);
        $user  = array("user_id"=> $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') 
                && !empty($if_contains_user)
                && $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            $this->db->where($table.'.user_id', $this->admin_id);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getAllActive($table, $order_by = 'DESC') {
        $pk = $this->getPkName($table);

        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

        $default_language = $this->getDefultLanguage();
        $query = $this->db->select($str_select)
                ->from($table)
                ->where("status", "1")
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk . ' AND ' . $this->table_t . '.' . $this->lang_key . ' = ' . '"' . $default_language . '"', 'left')
                ->order_by("id", $order_by)
                ->get();

        if ($query->num_rows() > 0)
            return $query->result();;

        return false;
    }

    public function delete($table, $id) {
        if (parent::delete($table, $id)) {
            $query = $this->db->where($this->foreign_key, $id)
                    ->delete($this->table_t);

            return true;
        }

        return false;
    }

}

?>