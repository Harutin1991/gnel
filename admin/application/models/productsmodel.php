<?php

class ProductsModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('products_t', array('name', 'description', 'meta_keywords', 'meta_description'), 'lang_code', 'product_id');
    }

    public function rules() {
        $rules = array();

        $rules[] = array(
            'field' => 'Product[brand_id]',
            'label' => $this->ci->lang->line("Brand"),
            'rules' => 'required',
        );

        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();

        foreach ($languages as $language) {
            $rules[] = array(
                'field' => 'Product[meta_keywords_' . $language->code . ']',
                'label' => $this->ci->lang->line("Meta keywords"),
                'rules' => 'max_length[255]',
            );
            $rules[] = array(
                'field' => 'Product[meta_description_' . $language->code . ']',
                'label' => $this->ci->lang->line("Meta description"),
                'rules' => 'max_length[255]',
            );
            $rules[] = array(
                'field' => 'Product[text_' . $language->code . ']',
                'label' => $this->ci->lang->line("Text"),
                'rules' => '',
            );

            if ($language->code == $default_language) {
                $rules[] = array(
                    'field' => 'Product[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'required|max_length[255]',
                );
            } else {
                $rules[] = array(
                    'field' => 'Product[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'max_length[255]',
                );
            }
        }

        return $rules;
    }

    public function rules_add() {
        $rules = $this->rules();

        return $rules;
    }

    public function rules_edit() {
        $rules = $this->rules();

        return $rules;
    }

    public function insert($table, $data) {
        $id = parent::insert($table, $data);

        if ($id != false && isset($data['category'])) {
            $attributes = $this->getAttributes('product_to_category');
            $product_category = array();

            foreach ($data['category'] as $category) {
                $product_category[] = array(
                    'product_id' => $id,
                    'category_id' => $category,
                );
            }

            $this->db->insert_batch('product_to_category', $product_category);
        }

        return $id;
    }

    function insertImages($data) {
        $attributes = $this->getAttributes('product_images');
        $attributes = array_intersect_key($data, $attributes);

        $this->db->insert_batch('product_images', $data);

        $id = $this->db->insert_id();
        return $id;
    }

    function deleteImage($id) {
        $query = $this->db->where('id', $id)
                ->delete('product_images');

        if ($this->db->affected_rows())
            return true;

        return false;
    }

    public function update($table, $id, $data) {
        $is_updated = parent::update($table, $id, $data);

        return $is_updated;
    }

    public function getWhere($table, $product_id, $order_by = 'ASC') {
        $query = $this->db->order_by('order', $order_by)
                ->where('product_id', $product_id)
                ->get($table);

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function orderImages($table, $data) {
        $this->db->update_batch($table, $data, 'id');

        if ($this->db->affected_rows())
            return true;

        return false;
    }

    public function getCategoryIds($id) {
        $query = $this->db->select('category_id')
                ->where('product_id', $id)
                ->get('product_to_category');

        $category_ids = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $category_ids[] = $row->category_id;
            }
        }

        return $category_ids;
    }

    public function getOptionIds($category_ids) {
        $option_ids = array();
        if (!empty($category_ids)) {
            $query = $this->db->select('option_id')
                    ->where_in('category_id', $category_ids)
                    ->distinct()
                    ->get('category_options');


            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $option_ids[] = $row->option_id;
                }
            }
        }

        return $option_ids;
    }

    public function updatePrductOtions($options) {
        $sql = "INSERT INTO product_options (product_id, category_id, option_id, lang_code, value) VALUES ";

        foreach ($options AS $option) {
            $sql .= "('" . $option['product_id'] . "', '" .
                    $option['category_id'] . "', '" .
                    $option['option_id'] . "', '" .
                    $option['lang_code'] . "', '" .
                    $option['value'] . "'),";
        }
        $sql = rtrim($sql, ",");

        $query = $this->db->query($sql);

        return $query;
    }

    public function removeOptionOldValues($product_id) {
        $remove_result = $this->db
                ->where_in('product_id', $product_id)
                ->delete('product_options');
        return $remove_result;
    }

    public function getProductDetails($id) {
        $query = $this->db
                ->select('products.*, product_images.image AS image')
                ->from('products')
                ->join('product_images', 'product_images.product_id = products.id', 'left')
                ->where('product_images.order', 0)
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

    public function getAdminBrands() {
        $data = $this->BrandModel->getAll("brands");
        $brands = array();
        foreach ($data AS $br) {
            if ($br->status == "1") {
                $brands[$br->id] = $br->name;
            }
        }

        return $brands;
    }

    public function insertProductCategory($product_id, $categories) {
        $product_category = array();
        foreach ($categories as $category) {
            $product_category[] = array(
                'product_id' => $product_id,
                'category_id' => $category,
            );
        }

        $this->db->insert_batch('product_to_category', $product_category);
    }

    public function updateProductCategory($product_id, $categories) {
        $remove_result = $this->db
                ->where('product_id', $product_id)
                ->delete('product_to_category');
        $this->insertProductCategory($product_id, $categories);
    }

    public function getAllProducts($order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '') {
        
//        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $table = 'products';
        $pk = $this->getPkName($table);

//        $str_select  = '';
        $str_select = $table . '.*';


        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

        $str_select .= ', product_images.image AS image, brands_t.name AS brand_name';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
                ->from($table)
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
                ->join('product_images', $table . '.id = product_images.product_id', 'left')
                ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left');
        if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }

        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && 
                    !empty($if_contains_user) &&
                    $this->session->userdata('rol_id') !== '3' // if operator
                ) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }

        if ($pr_string != '') {
            $this->db->where("(`products_t`.`name`  LIKE '%$pr_string%'
                            OR  `products`.`code`  LIKE '%$pr_string%'
                            OR  `products`.`latin_name`  LIKE '%$pr_string%'
                            OR  `products`.`latin_description`  LIKE '%$pr_string%'
							OR  `brands_t`.`name`  LIKE '%$pr_string%'
							)");
        }
        //             OR  `products_t`.`description`  LIKE '%$pr_string%'
        $this->db->where('product_images.order', '0');
        $this->db->group_by("products.id");
        $this->db->order_by("special", 'DESC');
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

    public function updateSaleProduct($id, $data) {
        $this->db->where('brand_id', $id);
        $this->db->update('products', $data);
    }

    public function getBrandProducts($id, $order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '') {

//        $this->db->query('SET SQL_BIG_SELECTS=1');
        $table = 'products';
        $pk = $this->getPkName($table);
//        $str_select  = '';
        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

        $str_select .= ', product_images.image AS image, brands_t.name AS brand_name';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
            ->from($table)
            ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
            ->join('product_images', $table . '.id = product_images.product_id', 'left')
            ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left')
            ->where($table. '.brand_id', $id);
        if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }


        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') &&
            !empty($if_contains_user) &&
            $this->session->userdata('rol_id') !== '3' // if operator
        ) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }

        if ($pr_string != '') {
            $this->db->where("(`products_t`.`name`  LIKE '%$pr_string%'
                            OR  `products`.`code`  LIKE '%$pr_string%'
                            OR  `products`.`latin_name`  LIKE '%$pr_string%'
                            OR  `products`.`latin_description`  LIKE '%$pr_string%'
							OR  `brands_t`.`name`  LIKE '%$pr_string%'
							)");
        }
        //             OR  `products_t`.`description`  LIKE '%$pr_string%'
        $this->db->where('product_images.order', '0');
        $this->db->group_by("products.id");
        $this->db->order_by("special", 'DESC');
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

    public function getSaleProducts($id, $order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '') {

//        $this->db->query('SET SQL_BIG_SELECTS=1');
        $table = 'products';
        $pk = $this->getPkName($table);
//        $str_select  = '';
        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

        $str_select .= ', product_images.image AS image, brands_t.name AS brand_name';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
            ->from($table)
            ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
            ->join('product_images', $table . '.id = product_images.product_id', 'left')
            ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left')
            ->where($table. '.brand_id', $id)
            ->where($table. '.percent_off !=', '0')
            ->or_where($table. '.amount_off !=', '0');
        if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }


        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') &&
            !empty($if_contains_user) &&
            $this->session->userdata('rol_id') !== '3' // if operator
        ) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }

        if ($pr_string != '') {
            $this->db->where("(`products_t`.`name`  LIKE '%$pr_string%'
                            OR  `products`.`code`  LIKE '%$pr_string%'
                            OR  `products`.`latin_name`  LIKE '%$pr_string%'
                            OR  `products`.`latin_description`  LIKE '%$pr_string%'
							OR  `brands_t`.`name`  LIKE '%$pr_string%'
							)");
        }
        //             OR  `products_t`.`description`  LIKE '%$pr_string%'
        $this->db->where('product_images.order', '0');
        $this->db->group_by("products.id");
        $this->db->order_by("special", 'DESC');
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

    public function deleteProduct($id) {

        //$product = $this->ProductsModel->get('brands', $id);
        $del_prod = $this->db->where("id", $id)->delete("products");
        $del_prod_t = $this->db->where("product_id", $id)->delete("products_t");
        $del_prod_img = $this->db->where("product_id", $id)->delete("product_images");
        $del_prod_opt_val = $this->db->where("product_id", $id)->delete("product_option_values");
        $del_prod_opt = $this->db->where("product_id", $id)->delete("product_options");
        $del_prod_cat = $this->db->where("product_id", $id)->delete("product_to_category");
        //echo json_encode(array($del_prod.$del_prod_t.$del_prod_img.$del_prod_opt_val.$del_prod_opt.$del_prod_cat)); exit;


        return true;
    }

    public function getProductComments($product_id, $page_num = '', $perpage = '') {
        $table = 'products';
        $sql = "SELECT SQL_CALC_FOUND_ROWS product_comments.* , "
                . " users.image AS user_image, users.first_name AS first_name, users.last_name AS last_name "
                . " FROM product_comments "
                . " LEFT JOIN users ON users.id = product_comments.user_id"
                . " INNER JOIN products ON products.id = product_comments.product_id"
                . " WHERE product_comments.product_id = " . $product_id;
        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table . '.user_id', $this->admin_id);
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
    
    public function makeSpecialProduct($table, $id) {
        $data = array("special" => "1");
        $result = $this->update($table, $id, $data);
        return $result;
    }
    
    public function makeOrdinaryProduct($table, $id) {
        $data = array("special" => "0");
        $result = $this->update($table, $id, $data);
        return $result;
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
                ->where('user_points.points_type_id','1')
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

        $sum_bonus = $bonus_query->num_rows() > 0 ? ((int)$bonus_query->row()->bonus + (int)$point->amount) : $point->amount;

        $data = array(
                            'user_id' => $user_id,
                            'bonus' => $point->amount,
                            'product_id' => $product_id,
                            'order_id' => $order_id,
                            'sum_bonus' => $sum_bonus,
                            'points_type_id' => $point->id
        );
        $this->db->insert('user_points', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function updateUserPoints($user_id, $order_id, $status){
        $this->db->where(array('user_id' => $user_id, 'order_id' => $order_id))
                 ->update('user_points', array('status' => $status));

    }

}

?>