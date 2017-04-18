<?php

class CommentsModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('products_t', array('name', 'description', 'meta_keywords', 'meta_description'), 'lang_code', 'product_id');
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

    public function getAllCommentedProducts($order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '', $pending = 1) {
        $table = 'products';
        $pk = $this->getPkName($table);
//        $str_select  = '';
        $str_select = $table . '.*';

        foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }

//        $str_select = ' products.id, products_t.name AS product_name, products.code';
        $str_select .= ', pr_img.image AS image, brands_t.name AS brand_name, GROUP_CONCAT( product_comments.status) AS product_comment_statuses, COUNT(*) AS comment_count';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
                ->from('product_comments')
                ->join($table, 'products.id = product_comments.product_id', 'left')
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
                ->join('(SELECT * FROM product_images WHERE product_images.order="0") AS pr_img', $table . '.id = pr_img.product_id', 'left')
                ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left');
        if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }

        if ($pending == 1) {
            $this->db->where('product_comments.status', '0');
        }

        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
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
        $this->db->group_by("products.id");
        $this->db->order_by("product_comments.comment_date", $order_by);

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

    public function getAllCommentedBlognews($order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '', $pending = 1) {
        $table = 'blognews';
        $pk = $this->getPkName($table);
//        $str_select  = '';
        $str_select = $table . '.*';

        /*foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }*/

//        $str_select = ' products.id, products_t.name AS product_name, products.code';
        $str_select .= ',  GROUP_CONCAT( blognews_comments.status) AS blognews_comment_statuses, COUNT(*) AS comment_count';

        $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
            ->from('blognews_comments')
            ->join($table, 'blognews.id = blognews_comments.blognews_id', 'left')
            ->join('blognews_t',  'blognews_t.blognews_id ='. $table . '.' . $pk, 'left');
           // ->join('(SELECT * FROM product_images WHERE product_images.order="0") AS pr_img', $table . '.id = pr_img.product_id', 'left')
           // ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left');
        if ($pr_string == '') {
            $this->db->where('blognews_t.lang_code ', $default_language);
        }

        if ($pending == 1) {
            $this->db->where('blognews_comments.status', '0');
        }

        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }

        if ($pr_string != '') {
            $this->db->where("(`blognews_t`.`title`  LIKE '%$pr_string%'
                            OR  `blognews`.`title`  LIKE '%$pr_string%'
                            OR  `blognews`.`meta_description`  LIKE '%$pr_string%'

							)");
        }
        //             OR  `products_t`.`description`  LIKE '%$pr_string%'
        $this->db->group_by("blognews.id");
        $this->db->order_by("blognews_comments.comment_date", $order_by);

        if ($pr_perpage != '' && $page_num != '') {
            $offset = ($page_num - 1) * $pr_perpage;
            $this->db->limit($pr_perpage, $offset);
        }


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result['blognews'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }
        $result['blognews'] = array();
        $result['total'] = 0;
        return $result;
    }
    public function getProductsCommentsCount($prod_ids = array()) {
        $this->db->select('product_id, GROUP_CONCAT( product_comments.status) AS product_comment_statuses')
                ->group_by('product_id');
        if (!empty($prod_ids)) {
            $this->db->where_in('product_id', $prod_ids);
        }
        $query = $this->db->get('product_comments');
        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $all_status = explode(',', $row->product_comment_statuses);
                $all_comments = count($all_status);
                $counts = array_count_values($all_status);
                $pending_comments = isset($counts[0]) ? $counts[0] : 0;
                $result[$row->product_id] = array(
                    'pending_comments' => $pending_comments,
                    'all_comments' => $all_comments
                );
            }
        }
        return $result;
    }

    public function getBlognewsCommentsCount($news_ids = array()) {
        $this->db->select('blognews_id, GROUP_CONCAT( blognews_comments.status) AS blognews_comment_statuses')
            ->group_by('blognews_id');
        if (!empty($news_ids)) {
            $this->db->where_in('blognews_id', $news_ids);
        }
        $query = $this->db->get('blognews_comments');
        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $all_status = explode(',', $row->blognews_comment_statuses);
                $all_comments = count($all_status);
                $counts = array_count_values($all_status);
                $pending_comments = isset($counts[0]) ? $counts[0] : 0;
                $result[$row->blognews_id] = array(
                    'pending_comments' => $pending_comments,
                    'all_comments' => $all_comments
                );
            }
        }
        return $result;
    }

    public function getUserProductsCommentsCount() {
        $table = "products";
        $this->db->select("count(*) AS count ")
                ->from('product_comments')
                ->join('products', 'product_comments.product_id = products.id', 'INNER');


        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->count;
        }

        return 0;
    }
    public function getUserBlognewsCommentsCount() {
        $table = "blognews";
        $this->db->select("count(*) AS count ")
            ->from('blognews_comments')
            ->join('blognews', 'blognews_comments.blognews_id = blognews.id', 'INNER');

        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->count;
        }

        return 0;
    }


}

?>