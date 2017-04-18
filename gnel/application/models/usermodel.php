<?php

class UserModel extends BaseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function authenticateLogin($email, $password) {
        if (!$email || !$password) {
            return false;
        }
        $this->db->select("users.*,user_points.sum_bonus AS total_points");
        $this->db->from('users');
        $this->db->join('user_points','user_points.user_id = users.id AND user_points.id = (SELECT max(user_points.id) FROM user_points WHERE user_points.status = 1) AND user_points.status = 1','left');
        $this->db->where(array('email' => trim($email), '`password`' => sha1($password), 'users.status' => '1'));
        $query = $this->db->get();
        $result = $query->row_array();
        $query->free_result();
        return $result;
    }

    function userLogin($email, $password) {
        //$fields = array('id', 'email', 'first_name', 'last_name','userrole');
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('users.email' => trim($email), 'users.`password`' => sha1($password)));
        $query = $this->db->get();
        $user = $query->first_row();
        $query->free_result();
        return $user;
    }

    public function getUser($user_data) {
        $query = $this->db->get_where('users', $user_data);

        if ($query->num_rows() > 0) {
            $record = $query->row_array();
            return $record;
        }
        return false;
    }
    
    public function getDeliveryPrice($user_id) {
        $sql = "SELECT cities.price AS delivery_price, cities.id AS city_id "
                . "FROM cities INNER JOIN users ON "
        //        . "(cities.id = users.city_id AND users.same_shipping=1) OR "
//                . "(cities.id = users.ship_city_id AND users.same_shipping=0)"
                . "(cities.id = users.ship_city_id)"
                . "WHERE users.id = '".$user_id."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return array('delivery_price' => $row->delivery_price, 'delivery_city_id' =>  $row->city_id);
        }

        return 0;
    }
    
    public function getCountries() {
        $data = array('lang_code' => $this->config->item('language'));
        $query = $this->db->order_by('name', 'ASC')->get_where('countries_t', $data);
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function getCities() {

        $this->db->select('cities_t.*, cities.price AS delivery_price');
        $this->db->from('cities');
        $this->db->join('cities_t', 'cities.id = cities_t.city_id');
        $this->db->where('lang_code', $this->config->item('language'));
        $this->db->order_by('cities_t.name', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function generateNewPassword($email) {
        $new_pass = generateRandomString(16);
        $data['date_modified'] = date("Y-m-d H:i:s", time());
        $data['password'] = sha1($new_pass);
        if ($this->db->where('email', $email)->update('users', $data)) {
            return $new_pass;
        }

        return false;
    }
    
    public function addValidationCodeToEmail($email) {
        $code = generateRandomString(32);
        $data['email'] = $email;
        $data['code']  = $code;
        if ($this->db->insert('email_validate', $data)) {
            return $code;
        }

        return false;
    }

    public function getUserComments($table, $user_id, $j_table, $filter_string = '', $page = 1, $limit = 4){
       //  $table = products_comments  OR blognews_comments;
       //  $j_table = products OR blognews;
        $offset = (intval($page) - 1) * intval($limit);
        if($filter_string != ''){
           $search = "(`blognews`.`title`  LIKE '%$filter_string%'
                            OR  `blognews_t`.`title`  LIKE '%$filter_string%'
                            OR  `blognews_comments`.`comment`  LIKE '%$filter_string%'
                      )";
        }

        $this->db->select('SQL_CALC_FOUND_ROWS  '.$table.'.*', false);
        if($j_table == 'products') {
            $this->db->select(" (CASE WHEN products_t.name ='' THEN products.latin_name else products_t.name end) as name, product_images.image, products.id AS item_id ");
            $this->db->from($table)
                ->join('products', "products.id = ".$table.".product_id", 'left')
                ->join('product_images','product_images.product_id ='.$table.".product_id", 'left')
                ->join('products_t', $table.".product_id = products_t.product_id", 'left')
                ->where($j_table.'_t.lang_code', $this->config->item('language'))
                ->where('product_images.order', '0')
                ->where($table.'.user_id',$user_id);
                if($filter_string != ''){
                    $this->db->where ("(`products`.`latin_name`  LIKE '%$filter_string%'
                                OR  `products_t`.`name`  LIKE '%$filter_string%'
                                OR  `product_comments`.`comment`  LIKE '%$filter_string%'
                          )");
                }
                //->distinct()
                $this->db->limit($limit, $offset);
        }elseif($j_table == 'blognews'){
            $this->db->select(" (CASE WHEN blognews_t.title ='' THEN blognews.title else blognews_t.title end) as name, blognews.image, blognews.id AS item_id  ");
            $this->db->from($j_table)
                ->join($table, $j_table.".id = ".$table.".".$j_table."_id", 'left')
                ->join($j_table.'_t', $table.'.'.$j_table."_id = ".$j_table."_t.".$j_table.'_id', 'left')
                ->where($j_table.'_t.lang_code', $this->config->item('language'))
                ->where($table.'.user_id',$user_id);
                if($filter_string != ''){
                    $this->db->where ("(`blognews`.`title`  LIKE '%$filter_string%'
                            OR  `blognews_t`.`title`  LIKE '%$filter_string%'
                            OR  `blognews_comments`.`comment`  LIKE '%$filter_string%'
                      )");
                }
                //->distinct()
            $this->db->limit($limit, $offset);
        }else{
            return array();
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result['comments'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }

        return $query;
    }
    public function ActivateUser($code) {
        $query = $this->db->get_where('email_validate', array('code' => $code));
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $email = $res->email;
            
            $this->db->where('email', $email);
            $this->db->update('users', array('status' => '1')); 
            return $email;
        }
        return false;
    }
    public function checkUserStatus($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->status;
        }
        return false;
    }
    public function getValidationCodeToEmail($email){
        $query = $this->db->get_where('email_validate', array('email' => $email));
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->code;
        }
        return false;
    }


}

?>