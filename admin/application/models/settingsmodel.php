<?php

class SettingsModel extends BaseModel {
    
    private $table="settings";
    
    public function get($key) {
        $query = $this->db->get_where($this->table, array('key' => $key));
        
        if($query->num_rows() > 0) {
			$res = $query->row_array();
            return $res['value'];
		}
        
        return false;
    }
}

?>
