<?php

class CategoryModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('categories_t', array('name', 'description', 'meta_keywords', 'meta_description'), 'lang_code', 'category_id');
    }

    public function hasProduct($categoryId) {
        $query = $this->db->where('category_id', $categoryId)
                ->get('product_to_category');

        if ($query->num_rows() > 0)
            return true;

        return false;
    }

    public function hasOption($categoryId) {
        $query = $this->db->where('category_id', $categoryId)
                ->get('category_options');

        if ($query->num_rows() > 0)
            return true;

        return false;
    }

    public function getOptions($id) {
        $query = $this->db
                ->where('category_id', $id)
                ->get('category_options');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function getProductOptions($category_ids, $product_id) {
//        $query = $this->db
//                ->where_in('category_id', $category_ids)
//                -> left_join()
//                ->get('category_options');
        $query = $this->db
                ->select('cat_opt.*, cat_t.name AS cat_name, opt_t.name AS opt_name, prod_opt.value AS value')
                ->from('category_options AS cat_opt')
                ->join('product_to_category AS prod_t_co', 'prod_t_co.category_id = cat_opt.category_id AND prod_t_co.product_id = ' . $product_id, 'inner')
                ->join('categories_t AS cat_t', 'cat_opt.category_id = cat_t.category_id AND cat_opt.lang_code = cat_t.lang_code', 'left')
                ->join('options_t AS opt_t', 'cat_opt.option_id = opt_t.option_id AND cat_opt.lang_code = opt_t.lang_code', 'left')
                ->join('product_options AS prod_opt', 'cat_opt.option_id = prod_opt.option_id AND prod_opt.lang_code = opt_t.lang_code AND prod_opt.category_id = cat_t.category_id AND prod_opt.product_id = ' . $product_id, 'left')
                ->order_by('cat_t.category_id, opt_t.id', 'ASC')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function getCountOfOptions() {
        $query = $this->db->query("SELECT `category_id`, COUNT(DISTINCT `option_id`) as count FROM `category_options` WHERE 1 GROUP BY `category_id`");

        /*     $this->db->select('category_id, count(DISTINCT(option_id)) AS count')


          ->get('category_options');
         */
        $counts = array();

        if ($query->num_rows() > 0) {
            $option_counts = $query->result();

            foreach ($option_counts as $option_count) {
                $counts[$option_count->category_id] = $option_count->count;
            }
        }

        return $counts;
    }

    public function getCountOfProducts() {
		$query = $this->db->query("SELECT `category_id`, COUNT(DISTINCT `product_id`) as count "
                . "FROM `product_to_category` "
				. "LEFT JOIN `products` ON product_to_category.product_id = products.id "
				. "LEFT JOIN `brands` ON brands.id = products.brand_id "
                . "WHERE `category_id` <> 0 AND products.status = 1 "
				. "AND brands.status = 1 "
                . "GROUP BY `category_id`");

				
        $counts = array();

        if ($query->num_rows() > 0) {
            $product_counts = $query->result();

            foreach ($product_counts as $product_count) {
                $counts[$product_count->category_id] = $product_count->count;
            }
        }

        return $counts;
    }

    public function getCategoryProducts($category_id, $brand_id = 0, $limit = 15, $page = 1) {
        $offset = (intval($page) - 1) * intval($limit);
        $this->db
                ->select('SQL_CALC_FOUND_ROWS products_t.*, products.*, product_images.image AS image, brands_t.name AS brand_name', FALSE)
                ->from('product_to_category')
                ->join('products', "product_to_category.product_id = products.id", 'left')
                ->join('products_t', "products_t.product_id = products.id ", 'left')
                ->join('product_images', "product_images.product_id = products.id ", 'left')
                ->join('brands_t', "brands_t.brand_id = products.brand_id ", 'left')
                ->join('brands', "brands.id = products.brand_id ", 'left')
                ->where('product_to_category.category_id', $category_id)
                ->where('products_t.lang_code', $this->config->item('language'))
                ->where('brands_t.lang_code', $this->config->item('language'))
                ->where('products.status', '1')
				->where('brands.status', '1')
                ->where('product_images.order', '0');
        if ($brand_id != 0) {
            $this->db->where('products.brand_id', $brand_id);
        }
        $query = $this->db->order_by('products.price', 'ASC')
                ->limit($limit, $offset)
                ->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result['products'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
        }



        return $result;
    }

    public function getCategoryBrands($category_id) {
        $query = $this->db
                ->select('brands_t.brand_id AS id, brands_t.name AS name')
                ->from('categories')
                ->join('product_to_category', 'categories.id = product_to_category.category_id', 'left')
                ->join('products', "products.id = product_to_category.product_id", 'left')
                ->join('brands', "brands.id = products.brand_id", 'left')
                ->join('brands_t', "brands.id = brands_t.brand_id", 'left')
                ->where('categories.id', $category_id)
                ->where('brands_t.lang_code', $this->config->item('language'))
                ->where('brands.status', '1')
                ->where('products.status', '1')
                ->order_by('brands_t.name', 'ASC')
                ->distinct()
                ->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
    }


}

?>