<?php

class BlogModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('blognews_t', array('title', 'meta_description', 'content', 'short_content'), 'lang_code', 'blognews_id');
    }


//    public function getAllBlognews() {
//        $query = $this->db
//                ->select('blognews_t.blognews_id AS id, blognews_t.name AS name, blognews.image AS image, blognews_t.short_content AS short_content')
//                ->from('categories')
//                ->join('product_to_category', 'categories.id = product_to_category.category_id', 'left')
//                ->join('products', "products.id = product_to_category.product_id", 'left')
//                ->join('brands', "brands.id = products.brand_id", 'left')
//                ->join('brands_t', "brands.id = brands_t.brand_id", 'left')
//                ->where('brands_t.lang_code', $this->config->item('language'))
//                ->where('brands.status', '1')
//                ->where('products.status', '1')
//                ->order_by('brands_t.name', 'ASC')
//                ->distinct()
//                ->get();
//        $result = array();
//        if ($query->num_rows() > 0) {
//            $result = $query->result();
//        }
//
//        return $result;
//    }






}

?>