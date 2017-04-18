<?php

class BrandModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('brands_t', array('name', 'meta_keywords', 'meta_description', 'description'), 'lang_code', 'brand_id');
    }


    public function getAllBrands() {
        $query = $this->db
                ->select('brands_t.brand_id AS id, brands_t.name AS name, brands.image AS image, brands_t.description AS description')
                ->from('categories')
                ->join('product_to_category', 'categories.id = product_to_category.category_id', 'left')
                ->join('products', "products.id = product_to_category.product_id", 'left')
                ->join('brands', "brands.id = products.brand_id", 'left')
                ->join('brands_t', "brands.id = brands_t.brand_id", 'left')
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
    
    public function getBrandProducts($brand_id, $category_id = 0, $limit = 15, $page = 1) {
        $offset = (intval($page) - 1) * intval($limit);
        $this->db
                ->select('SQL_CALC_FOUND_ROWS products_t.*, products.*, product_images.image AS image', FALSE)
                ->from('products')
                ->join('products_t', "products_t.product_id = products.id ", 'LEFT')
                ->join('product_images', "product_images.product_id = products.id ", 'LEFT')
                ->join('product_to_category', "product_to_category.product_id = products.id ", 'INNER');
        if(isset($category_id) && $category_id != 0){
            $this->db->where('product_to_category.category_id', $category_id);
        }
        $this->db
                ->where('products_t.lang_code', $this->config->item('language'))
                ->where('products.status', '1')
                ->where('products.brand_id', $brand_id)
                ->where('product_images.order', '0')
                ->order_by('product_to_category.category_id', 'ASC');

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
    
    public function getBrandCategories($brand_id) {
        $this->db
                ->select('categories_t.*, categories.id AS id')
                ->from('categories')
                ->join('categories_t', "categories.id = categories_t.category_id ", 'INNER')
                ->join('product_to_category', "product_to_category.category_id = categories.id ", 'INNER')
                ->join('products', "products.id = product_to_category.product_id ", 'INNER')
                ->join('brands', "brands.id = products.brand_id ", 'INNER')
                ->where('categories_t.lang_code', $this->config->item('language'))
                ->where('products.status', '1')
                ->where('products.brand_id', $brand_id)
                ->order_by('product_to_category.category_id', 'ASC')
                ->distinct();
        
        $query = $this->db->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        
        return $result;
    }

}

?>