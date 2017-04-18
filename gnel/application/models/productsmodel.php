<?php

class ProductsModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('products_t', array('name', 'description', 'meta_keywords', 'meta_description'), 'lang_code', 'product_id');
    }

    public function getProductDetails($id) {
        $query = $this->db
                ->select('products.*, product_images.image AS image, product_to_category.category_id AS category_id, brands_t.name AS brand_name, brands.status AS brand_status')
                ->select(" (CASE WHEN products_t.name ='' THEN products.latin_name else products_t.name end) as name  ")
               // ->select(" (CASE WHEN products_t.description ='' THEN products.latin_description else products_t.description end) as p_description  ")
                ->from('products')
                ->join('product_images', 'product_images.product_id = products.id', 'left')
                ->join('products_t', "products_t.product_id = products.id AND products_t.lang_code ='" . $this->config->item('language') . "'", 'left')
                ->join('product_to_category', 'product_to_category.product_id = products.id', 'left')
                ->join('brands', 'brands.id = products.brand_id', 'left')
                ->join('brands_t', "brands_t.brand_id = products.brand_id AND brands_t.lang_code = '" . $this->config->item('language') . "'", 'left')
                ->where('product_images.order', 0)
                ->where('products.status', '1')
                ->where('products.id', $id)
                ->get();
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
                        foreach ($this->attributes_t as $attr)
                            $record[$attr . "_" . $language->code] = $record_t[$attr];
                    } else {
                        foreach ($this->attributes_t as $attr)
                            $record[$attr . "_" . $language->code] = $record[$attr];
                    }
                }
            }

            return $record;
        } else {
            $query = $this->db->where('products.id', $id)->get('products');
            if ($query->num_rows() > 0) {
                redirect(site_url('product/addImages/' . $id));
            }
        }

        return array();
    }

    public function getProductCategories($product_id) {
        $query = $this->db
                ->select('product_to_category.category_id AS category')
                ->from('product_to_category')
                ->where('product_to_category.product_id', $product_id)
                ->get();

        $arr = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();

            foreach ($result AS $row) {
                $arr[] = $row->category;
            }
        }

        return $arr;
    }

    public function updateComments($id, $data){
        $pk = $this->getPkName('product_comments');
        $attributes = $this->getAttributes('product_comments');
        $attributes = array_intersect_key($data, $attributes);
        if(count($attributes) > 0)
            $this->db->where($pk, $id)
                ->where('status', '0')
                ->update('product_comments', $attributes);

        $is_updated = false;
        if($this->db->affected_rows())
            $is_updated = true;

        return $is_updated;
    }

    public function getProductImages($product_id) {
        $query = $this->db
                ->select('product_images.image AS image')
                ->from('product_images')
                ->where('product_images.product_id', $product_id)
                ->order_by('order', 'ASC')
                ->get();
        $result = FALSE;
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
    }

    public function getProductOptions($product_id) {
        $query = $this->db
                ->select('options_t.*,  product_options.value AS val')
                ->from('product_options')
                ->join('options_t', "product_options.option_id = options_t.option_id", 'left')
                ->where('product_options.product_id', $product_id)
                ->where('product_options.lang_code', $this->config->item('language'))
                ->where('options_t.lang_code', $this->config->item('language'))
                ->order_by('options_t.option_id', 'ASC')
                ->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    public function getProductData($product_id) {
        $query = $this->db
                ->select('options_t.*,  product_options.value AS val, product_images.image AS image, 
                    COUNT(product_rates.rate) AS vouters_count, AVG(product_rates.rate) AS avg_rate')
                ->from('product_options')
                ->join('options_t', "product_options.option_id = options_t.option_id", 'left')
                ->join('product_images', "product_options.product_id = product_images.product_id", 'left')
                ->join('product_rates', "product_rates.product_id = product_images.product_id", 'left')
                ->join('product_comments', "product_comments.product_id = product_images.product_id", 'left')
                ->where('product_options.product_id', $product_id)
                ->where('product_images.product_id', $product_id)
                ->where('product_rates.product_id', $product_id)
                ->where('product_comments.product_id', $product_id)
                ->where('product_options.lang_code', $this->config->item('language'))
                ->where('options_t.lang_code', $this->config->item('language'))
                ->order_by('product_images.order', 'ASC')
                ->order_by('options_t.option_id', 'ASC')
                ->get();

        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    public function getProductRates($product_id) {
        
    }

    public function findProducts($order_by = 'DESC', $pr_string = '', $pr_perpage = 15, $page_num = '') {
        $table = 'products';
        $pk = $this->getPkName($table);
//        $str_select  = '';
        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

        $str_select .= ', pr_img.image AS image, brands_t.name AS brand_name';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
                ->from($table)
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
                ->join('(SELECT * FROM product_images WHERE product_images.order="0") AS pr_img', $table . '.id = pr_img.product_id', 'left')
                ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left')
                ->join('brands', 'products.brand_id = brands.id', 'left');
        if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }


        $attributes = $this->getAttributes($table);


        if ($pr_string != '') {
            $this->db->where("(`products_t`.`name`  LIKE '%$pr_string%'
                            OR  `products_t`.`description`  LIKE '%$pr_string%'
                            OR  `products`.`code`  LIKE '%$pr_string%'
                            OR  `products`.`latin_name`  LIKE '%$pr_string%'
                            OR  `products`.`latin_description`  LIKE '%$pr_string%'
							OR  `brands_t`.`name`  LIKE '%$pr_string%'
							)");
        }
        //             OR  `products_t`.`description`  LIKE '%$pr_string%'
        $this->db->where('products.status', '1');
        $this->db->where('brands.status', '1');
        $this->db->group_by("products.id");
        $this->db->order_by("id", $order_by);

        if ($pr_perpage != '' && $page_num != '') {
            $offset = ($page_num - 1) * $pr_perpage;
            $this->db->limit($pr_perpage, $offset);
        }


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result['products'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }
        $result['products'] = array();
        $result['total'] = 0;
        return $result;
    }

    public function updateRating($user_id, $product_id, $rate) {
        $rate_date = date('Y-m-d H:i:s', time());
        $ip = get_client_ip();
        $this->db->query("INSERT INTO product_rates "
                . "(user_id, product_id , rate, ip, rate_date) VALUES "
                . "('" . $user_id . "', '" . $product_id . "', '" . $rate . "', '" . $ip . "', '" . $rate_date . "') "
                . "ON DUPLICATE KEY UPDATE rate = " . $rate);

        return true;
    }

    public function getUserRates($user_id, $product_id) {
        $query = $this->db
                ->select('*')
                ->from('product_rates')
                ->where('product_id', $product_id)
                ->where('user_id', $user_id)
                ->get();
        $result = FALSE;
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->rate;
        }

        return $result;
    }

    public function getProductAvgRate($product_id) {
        $query = $this->db->query("SELECT product_id,  AVG(rate) AS avg_rate, COUNT(*) AS voters_count "
                . "FROM product_rates "
                . "WHERE product_id = " . $product_id);
        $result = array();
        if ($query->num_rows() > 0) {

            $result = $query->row();
            $ret['avg_rate'] = $result->avg_rate;
            $ret['voters_count'] = $result->voters_count;
            return $ret;
        }
        return false;
    }

    public function getProductComments($product_id, $page_num = 1, $perpage = 5) {
        $sql = "SELECT SQL_CALC_FOUND_ROWS product_comments.* , product_rates.rate AS user_rate , "
                . " users.image AS user_image, users.first_name AS first_name, users.last_name AS last_name "
                . " FROM product_comments "
                . " LEFT JOIN product_rates ON product_comments.product_id = product_rates.product_id AND product_comments.user_id = product_rates.user_id"
                . " LEFT JOIN users ON users.id = product_comments.user_id"
                . " WHERE product_comments.product_id = " . $product_id;

        if (isset($this->data['user_id'])) {
            $sql .= " AND (product_comments.status = 1 OR users.id=" . $this->data['user_id'] . " )";
        } else {
            $sql .= " AND (product_comments.status = 1 )";
        }
        $sql .= " ORDER BY product_comments.comment_date DESC ";
        if ($perpage != '' && $page_num != '') {
            $offset = ($page_num - 1) * $perpage;
            $sql .= "LIMIT " . $offset . ", " . $perpage;
        }

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result['comments'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }
        $result['comments'] = array();
        $result['total'] = 0;
        return $result;
    }

    public function updateSearchWordTable($keyword) {
        $data = array();
        $data['keyword'] = $keyword;
        $data['modified_time'] = date('Y-m-d H:i:s', time());

        $this->db->query("INSERT INTO search_words "
                . "(keyword , search_count, modified_time) VALUES "
                . "('" . $data['keyword'] . "', '1', '" . $data['modified_time'] . "') "
                . "ON DUPLICATE KEY UPDATE search_count = search_count + 1");

        return true;
    }

    public function getProductRepresantativeDetails($product_id) {
        $query = $this->db
                ->select('admin_users.*')
                ->from('products')
                ->join('admin_users', "products.user_id = admin_users.id", 'INNER')
                ->where('products.id', $product_id)
                ->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->row();
        }
        return $result;
    }

    /*public function getTotalUserPoints($user_id){
        $query = $this->db->select('SUM(user_points.bonus) AS total_points')
                ->where('user_id', $user_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return array();
        }
    }*/
    public function getUserPoints($user_id){
        $query = $this->db->select('user_points.*,points_type.name, SUM(user_points.bonus) AS points')
                          ->from('user_points')
                          ->join('points_type','points_type.id = user_points.points_type_id', 'left')
                          ->where(array('user_points.user_id' => $user_id, 'user_points.status' => '1'))
                          ->group_by("points_type.name")
                        ->get()->result();
        return $query;
    }
    public function orderExist($user_id, $product_id, $point_type){
        $point_amount = array();
        $query = $this->db->select('orders.*')
            ->from('orders')
            ->join('order_products', 'orders.id = order_products.order_id','left')
            //->join('user_points', 'user_points.user_id = orders.user_id')
            ->where('orders.user_id', $user_id)
            ->where('order_products.product_id', $product_id)
            ->where('orders.status ', '1')
            ->get();
        if ($query->num_rows() > 0) {
            $sql = $this->db->select('user_points.*')
                ->from('user_points')
                ->where('user_points.user_id', $user_id)
                ->where('user_points.product_id', $product_id)
                ->where('user_points.points_type_id','2')
               ->get();
           if($sql->num_rows() == 0) {
               $point_amount = $this->db->select('points_type.*')
                   ->from('points_type')
                   ->where('points_type.name', $point_type)
                   ->get()->result();
           }
        }
        return $point_amount;
    }

    public function insertUserPoints($user_id, $product_id, $order_id = 0, $point){

        $bonus_query = $this->db->select('user_points.sum_bonus AS bonus')
                                ->from('user_points')
                                ->where('user_points.user_id', $user_id)
                                ->where('user_points.id = (SELECT max(user_points.id) FROM user_points WHERE user_points.status = 1)')
                                ->where('user_points.status', 1)
                                ->get();

        $sum_bonus = $bonus_query->num_rows() > 0 ? ($bonus_query->row()->bonus + $point->amount) : $point->amount;

        $data = array(
            'user_id' => $user_id,
            'bonus' => $point->amount,
            'product_id' => $product_id,
            'order_id' => $order_id,
            'sum_bonus' => $sum_bonus,
            'points_type_id' => $point->id
        );
        $this->db->insert('user_points', $data);
        return $sum_bonus;
        /*$query = $this->db->select('user_points.sum_bonus AS total_points')
                            ->from('user_points')
                            ->where(array('user_points.user_id' => $user_id, 'user_points.status' => '1'))
                            ->get();
        //$insert_id = $this->db->insert_id();
        return $query->row();*/
    }

}

?>