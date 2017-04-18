<?php

class RolesModel extends baseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
    }

    function addRole($role_name, $role_permission) {
        $data = array(
            'rol_name' => $role_name
        );
        $this->db->insert('admin_roles', $data);

        $this->db->order_by('rol_id', 'desc');
        $query = $this->db->get('admin_roles');
        $row = $query->row_array();
        //echo $row['rol_id'];
        $data2 = array(
            'rol_id' => $row['rol_id'],
            'url' => serialize($role_permission)
        );
        $this->db->insert('rol_permission', $data2);
    }

    function getRoles() {
        $this->db->order_by('rol_id', 'desc');
        $this->db->where_not_in('rol_id', 1);
        $query = $this->db->get('admin_roles');
        $row = $query->result_array();
        return $row;
    }

    function deleteRole($post_id) {
        $query = $this->db->get_where('admin_users', array('rol_id' => $post_id));
        if ($query->num_rows() > 0) {
            return true;
        }        
        $this->db->delete('admin_roles', array('rol_id' => $post_id));
        $this->db->delete('rol_permission', array('rol_id' => $post_id));
    }

    function getEditRole($post_id) {
        $this->db->select('*');
        $this->db->from('admin_roles');
        $this->db->join('rol_permission', 'admin_roles.rol_id = rol_permission.rol_id','INNER');
        $this->db->where('admin_roles.rol_id', $post_id); 
        $query = $this->db->get();        
        $row = $query->row_array();        
        return $row;
    }

    function editRole($post_id, $role_name, $role_permission) {
        $data = array(
            'rol_name' => $role_name
        );
        $data2 = array(
            'rol_id' => $post_id
        );
        $data3 = array(
            'url' => serialize($role_permission)
        );
        $this->db->where($data2);
        $this->db->update('admin_roles', $data);
        $this->db->where($data2);
        $this->db->update('rol_permission', $data3);
    }

    function existPostId($post_id) {
        $query = $this->db->get_where('admin_roles', array('rol_id' => $post_id));
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

}

?>