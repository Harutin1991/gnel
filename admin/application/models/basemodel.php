<?php 
class BaseModel extends CI_Model {
    
    protected $ci;
    
    public function __construct() {
//        $this->output->enable_profiler(TRUE);
//        echo "<h7>You can disable this in basemodel construct</h7> - ";
        $this->ci =& get_instance();
        parent::__construct();
    }
  
    protected function getAttributes($table) {
        $fields = $this->db->list_fields($table);
        
        return array_fill_keys($fields, NULL);
    }
    
    protected function getPkName($table) {
        $query = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        $result = $this->db->query($query);
        
        if($result->num_rows() > 0) {
            $res = $result->row_array();
            return $res['Column_name'];
        }
    }
    
    public function insert($table, $data) {
        $attributes = $this->getAttributes($table);
        $attributes = array_intersect_key($data, $attributes);
        if($this->db->insert($table, $attributes))
            return $this->db->insert_id();
        
        return false;
    }
    
    public function update($table, $id, $data) {
        $pk = $this->getPkName($table);
        $attributes = $this->getAttributes($table);
        $attributes = array_intersect_key($data, $attributes);
        $this->db->where($pk, $id)
                 ->update($table, $attributes);
        
        if($this->db->affected_rows())
            return true;

        return false;
    }
    
    public function get($table, $id, $admin_id = '') {
        $pk = $this->getPkName($table);
        $cond = array($pk => $id);
        
        //check if admin user have permitions
        $attributes = $this->getAttributes($table);
        $user  = array("user_id"=> $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table.'.user_id', $this->admin_id);
        }
        
        $query = $this->db->get_where($table, $cond);
        
        if($query->num_rows() > 0)
            return $query->row_array();
        
        return NULL;
    }
    
    public function getAll($table, $order_by='DESC') {
        $pk = $this->getPkName($table);
        $this->db->order_by($pk, $order_by);
        if($this->admin_id != $this->config->item('super_global_admin_id')) {
            $this->db->where('user_id', $this->admin_id);
        }
        $query = $this->db->get($table);
        
        if($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }
    
    public function delete($table, $id) {
        $pk = $this->getPkName($table);
        $this->db->where($pk, $id)
                 ->delete($table);
        
        if($this->db->affected_rows())
            return true;

        return false;
    }
    
    public function countAll($table) {
        return $this->db->count_all($table);
    }
    
    public function enable($table, $id) {
        $data = array("status" => "1");
        $result = $this->update($table, $id, $data);
        return $result;
    }
    public function disable($table, $id) {
        $data = array("status" => "0");
        $result = $this->update($table, $id, $data);
        return $result;
    }
    public function cancel($table, $id) {
        $data = array("status" => "-1");
        $result = $this->update($table, $id, $data);
        return $result;
    } 
    public function getCount($table) {
        $data['user_id'] = '';
        $attributes = $this->getAttributes($table);
        $attributes = array_intersect_key($data, $attributes);
        if ( $this->admin_id != $this->config->item('super_global_admin_id') && !empty($attributes)) {
            $this->db->where('user_id', $this->admin_id);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }
}

?>