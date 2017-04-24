<?php 
class BaseModel extends CI_Model {
    
    protected $ci;
    protected $attributes_t = array();
    protected $lang_key = '';
    protected $foreign_key = '';
    protected $table_t = '';
    public $default_language;
    
    public function __construct() {
//        $this->output->enable_profiler(TRUE);
//        echo "<h7>You can disable this in basemodel construct</h7> - ";
        $this->ci =& get_instance();
        parent::__construct();
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
    }
  
    protected function getAttributes($table) {
        $fields = $this->db->list_fields($table);
        
        return array_fill_keys($fields, NULL);
    }
    
    protected function getPkName($table) {
        $query = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        $result = $this->db->query($query);
        
        if($result->num_rows() > 0)
            $res = $result->row_array();
            return $res['Column_name'];
    }
    
    public function insert($table, $data) {
        $attributes = $this->getAttributes($table);
		//add insert datetime
        $data["date_created"] = date("Y-m-d H:i:s", time());
        $data["date_modified"] = $data["date_created"];
        $attributes = array_intersect_key($data, $attributes);
        if($this->db->insert($table, $attributes)) {
            return $this->db->insert_id();
        }
        return false;
    }
    
    public function update($table, $id, $data) {
        $pk = $this->getPkName($table);
        $attributes = $this->getAttributes($table);
		
		//add update datetime
		$data['date_modified'] = date("Y-m-d H:i:s", time());
		
        $attributes = array_intersect_key($data, $attributes);
        $this->db->where($pk, $id)
                 ->update($table, $attributes);
        
        if($this->db->affected_rows())
            return true;

        return false;
    }
    
    public function get($table, $id) {
        $pk = $this->getPkName($table);
        $query = $this->db->get_where($table, array($pk => $id));
        
        if($query->num_rows() > 0)
            return $query->row_array();
        
        return NULL;
    }
    
//    public function getAll($table, $order_by='DESC') {
//        $pk = $this->getPkName($table);
//        $query = $this->db->order_by($pk, $order_by)
//                          ->get($table);
//
//        if($query->num_rows() > 0) {
//            return $query->result();
//        }
//
//        return array();
//    }

    protected function getDefultLanguage() {
        $this->ci->load->model('SettingsModel');
        return $this->ci->SettingsModel->get('default_language');
    }

    public function getAll($table, $order_by = 'ASC', $order_column = 'ordering') {
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
    
    public function getDeliveryPrices() {
        $query = $this->db
                ->select('cities_t.*,  cities.price')
                ->from('cities')
				->join('cities_t', "cities.id = cities_t.city_id", 'INNER')
				->where('cities_t.lang_code', $this->config->item('language'))
                ->order_by('cities_t.name', 'ASC')
                ->get();
		$result = array();
		if ($query->num_rows() > 0) {
            $result = $query->result();
		}
		
		return $result;
    }
    
}

?>