<?php

class OrdersModel extends MultilangModel {

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

    public function getAllOrders($ord_perpage = 15, $page_number = 1, $ord_status = '') {

        $this->db->select('SQL_CALC_FOUND_ROWS  orders.id AS id, orders.date_created AS date_order, '
                . 'sum(product_qty * product_price) AS order_sum, orders.status, '
                . 'orders.ship_address AS address', FALSE);
        $this->db->from('orders');
        $this->db->join('order_products', 'orders.id = order_products.order_id', 'INNER');
        
        if ($ord_status !== '') {
            $this->db->where('orders.status', $ord_status);
        }
        
        
        $this->db->group_by('orders.id');
        $this->db->order_by('orders.date_created', 'DESC');
        
        if ($ord_perpage != '' && $page_number != '') {
            $offset = ($page_number - 1) * $ord_perpage;
            $this->db->limit($ord_perpage, $offset);
        }
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result['orders'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }
        $result['orders'] = array();
        $result['products'] = array();
        $result['total'] = 0;
        return $result;
    }
    
    public function getOrderDetails($order_id) {
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $this->db->select('*, cities_t.name AS city_name, countries_t.name AS country_name, '
                . 'cities.price AS delivery_price, products.id AS product_id, '
                . 'products_t.name AS product_name, order_products.product_price AS product_price, '
                . 'orders.status AS order_status, orders.date_created AS date_created, brands_t.name AS brand_name, orders.user_id');
        $this->db->from('orders');
        $this->db->join('order_products', 'orders.id = order_products.order_id', 'INNER');
        $this->db->join('products', 'products.id = order_products.product_id', 'INNER');
        $this->db->join('products_t', 'products_t.product_id = order_products.product_id AND products_t.lang_code = "'.$this->default_language.'"', 'INNER');
        $this->db->join('brands_t', 'products.brand_id = brands_t.brand_id AND brands_t.lang_code = "'.$this->default_language.'"', 'INNER');
        $this->db->join('product_images', 'product_images.product_id = order_products.product_id AND product_images.order = "0"', 'INNER');
        $this->db->join('cities', 'orders.ship_city_id = cities.id', 'INNER');
        $this->db->join('cities_t', 'orders.ship_city_id = cities_t.city_id AND cities_t.lang_code = "'.$this->default_language.'"', 'INNER');
        $this->db->join('countries_t', 'orders.ship_country_id = countries_t.country_id AND countries_t.lang_code = "'.$this->default_language.'"', 'INNER');
        $this->db->where('orders.id', $order_id);
        $this->db->order_by('products.brand_id', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    public function getUserOrderPoints($user_id, $order_id){
        $query = $this->db->select('user_points.bonus AS points')
            ->from('user_points')
            ->where('user_points.user_id', $user_id)
            ->where('user_points.order_id', $order_id)
            ->where('user_points.points_type_id', 3)
            ->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return array();
    }
      
}

?>