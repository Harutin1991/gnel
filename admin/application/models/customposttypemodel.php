<?php

class CustomPostTypeModel extends baseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
    }

    function existTable($table_name) {
        if ($this->db->table_exists('custom_' . $table_name)) {
            return false;
        }
        return true;
    }

    function createTable($table_name, $field_param) {
        if ($this->db->table_exists('custom_' . $table_name)) {
            return false;
        }
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'status' => array(
                'type' => 'TINYINT'
            )
        );
        $fields2 = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            $table_name . '_id' => array(
                'type' => 'INT'
            ),
            'lang_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '4'
            )
        );
        foreach ($field_param as $element) {
            if ($element['add_translation'] == 0) {
                if ($element['field_type'] == 'text') {
                    $fields[$element['name'] . '_' . $element['element_type']] = array(
                        'type' => $element['field_type']
                    );
                } else {
                    $fields[$element['name'] . '_' . $element['element_type']] = array(
                        'type' => $element['field_type'],
                        'constraint' => $element['field_size']
                    );
                }
            } else {
                if ($element['field_type'] == 'text') {
                    $fields2[$element['name'] . '_' . $element['element_type']] = array(
                        'type' => $element['field_type']
                    );
                } else {
                    $fields2[$element['name'] . '_' . $element['element_type']] = array(
                        'type' => $element['field_type'],
                        'constraint' => $element['field_size']
                    );
                }
            }
        }

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('custom_' . $table_name, TRUE);


        $this->dbforge->add_field($fields2);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('custom_' . $table_name . '_t', TRUE);
        return true;
    }

    function editTable($old_table_name, $new_table_name, $field_param) {
        //var_dump($old_table_name);var_dump($new_table_name);exit;
        if (!($old_table_name == $new_table_name)) {
            $fields = array(
                $old_table_name.'_id' => array(
                    'name' => $new_table_name.'_id',
                    'type' => 'int'
                )
            );
            $this->dbforge->modify_column('custom_' . $old_table_name . '_t', $fields);
            $this->dbforge->rename_table('custom_' . $old_table_name, 'custom_' . $new_table_name);
            $this->dbforge->rename_table('custom_' . $old_table_name . '_t', 'custom_' . $new_table_name . '_t');
        }
    }

    function deleteCustomPostType($table_name) {
        $this->dbforge->drop_table($table_name);
        $this->dbforge->drop_table($table_name . "_t");
    }

    function customStartingWithChoiceOfTables() {
        $tab = array();
        $tabls = $this->db->list_tables();
        foreach ($tabls as $tabl) {
            if ((!(stripos($tabl, 'custom') === false)) && (stripos($tabl, '_t') === false)) {
                $tab[] = $tabl;
            }
        }
        //print_r($tab);
        return $tab;
    }

    function customField($table_name) {
        return $this->db->list_fields($table_name);
    }

    function customFieldTranslation($table_name) {
        return $this->db->list_fields($table_name . '_t');
    }

    function last_id($table_name) {
        $query = $this->db->query("SHOW TABLE STATUS LIKE '$table_name' ");
        $rezult = $query->row_array();
        $last_id = $rezult['Auto_increment'];
        //var_dump($rezult);
        return $last_id;
    }

    function insertPostType($table_name, $default_id, $array_custom, $array_languages) {
        $this->db->insert($table_name, $array_custom);
        foreach ($array_languages as $index => $element) {
            $element[ltrim($table_name, 'custom_') . '_id'] = $default_id;
            $element['lang_code'] = $index;
            $this->db->insert($table_name . '_t', $element);
        }
    }

    function getAllPostType($table_name) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table_name);
        $row = $query->result_array();
        return $row;
    }

    function getAllPostTypeDefaultLeng($table_name, $default_lang) {
        $this->db->order_by('id', 'desc');
        $this->db->where('lang_code', $default_lang);
        $query = $this->db->get($table_name . '_t');
        $row = $query->result_array();
        return $row;
    }

    function getPostTypeFieldData($table_name) {
        $fields = $this->db->field_data($table_name);
        $fields2 = $this->db->field_data($table_name . '_t');
        return $fields + $fields2;
    }

    function getEditPostType($table_name, $post_id) {
        $query = $this->db->get_where($table_name, array('id' => $post_id));
        $row = $query->row_array();
        return $row;
    }

    function getEditTranslationPostType($table_name, $post_id) {
        $query = $this->db->get_where($table_name . '_t', array(ltrim($table_name, 'custom_') . '_id' => $post_id));
        $row = $query->result_array();
        return $row;
    }

    function deletePost($table_name, $post_id) {
        $this->db->delete($table_name, array('id' => $post_id));
        $this->db->delete($table_name . '_t', array(ltrim($table_name, 'custom_') . '_id' => $post_id));
    }

    function editPostType($table_name, $post_id, $array_custom, $array_languages) {
        $data = array(
            'id' => $post_id
        );
        $this->db->where($data);
        $this->db->update($table_name, $array_custom);

        foreach ($array_languages as $index => $element) {
            $data = array(
                ltrim($table_name, 'custom_') . '_id' => $post_id,
                'lang_code' => $index
            );
            $this->db->where($data);
            $this->db->update($table_name . '_t', $element);
        }
    }

    function editImg($tab_name, $field_name, $post_id, $lang_code) {
        if ($lang_code == '') {
            $this->db->select($field_name);
            $this->db->where('id', $post_id);
            $query = $this->db->get($tab_name);
            $row = $query->row_array();
            $data = array(
                'id' => $post_id
            );
            $this->db->where($data);
            $this->db->update($tab_name, array($field_name => 'no-img.jpg'));
            return $row;
        } else {
            $this->db->select($field_name);
            $this->db->where(ltrim($tab_name, 'custom_') . '_id', $post_id);
            $this->db->where('lang_code', $lang_code);
            $query = $this->db->get($tab_name . '_t');
            $row = $query->row_array();
            $data = array(
                ltrim($tab_name, 'custom_') . '_id' => $post_id,
                'lang_code' => $lang_code
            );
            $this->db->where($data);
            $this->db->update($tab_name . '_t', array($field_name => 'no-img.jpg'));
            return $row;
        }
    }

    function existPostType($post_type) {
        return $this->db->table_exists($post_type);
    }

    function existPostId($post_type, $post_id) {
        $query = $this->db->get_where($post_type, array('id' => $post_id));
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function getDefaultLanguage() {
        $query = $this->db->get_where('settings', array('key' => 'default_language'));
        $row = $query->row_array();
        if ($query->num_rows() > 0) {
            return $row;
        }
        return false;
    }

}

?>