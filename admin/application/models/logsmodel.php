<?php

class LogsModel extends BaseModel {
    
    private $user_table = 'admin_users';
    private $pk_user = 'id';
    private $fk = 'user_id';
    private $user_name = 'username';
    
    public function getAll($table, $from=0, $per_page=50, $order_by='DESC') {
        $pk = $this->getPkName($table);
        $query = $this->db
                ->select($table.'.*'.', '.$this->user_table.'.'.$this->user_name)
                ->order_by($pk, $order_by)
                ->join($this->user_table, $this->user_table.'.'.$this->pk_user.' = '.$table.'.'.$this->fk, 'left')
                ->limit($per_page, $from)
                ->get($table);
        
        if($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }

}

?>