<?php

class UsersModel extends baseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
    }
    function addUser($login, $email, $password,$role_id) {
        $password = sha1($password);
        $data = array(
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'rol_id' => $role_id
        );
        $this->db->insert('admin_users', $data);        
    }
    function getUsers() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('admin_users');
        $row = $query->result_array();
        return $row;
    }
    function deleteUser($post_id) {
        $this->db->delete('admin_users', array('id' => $post_id));        
    }
    function getEditUser($post_id) {        
        $query = $this->db->get_where('admin_users', array('id' => $post_id));        
        $row = $query->row_array();        
        return $row;
    }
    function editUser($login, $email, $password, $role_id,$post_id) {
        $data = array(
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'rol_id' => $role_id,
        );
        $data2 = array(
            'id' => $post_id
        );        
        $this->db->where($data2);
        $this->db->update('admin_users', $data);
        
    }
     function existPostId($post_id) {
        $query = $this->db->get_where('admin_users', array('id' => $post_id));
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
    function getUserPermission($user_id) {
        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->join('rol_permission', 'admin_users.rol_id = rol_permission.rol_id','INNER');
        $this->db->where('admin_users.id', $user_id); 
        $query = $this->db->get();        
        $row = $query->row_array();        
        return $row;
    }   

    
    
}

?>