<?php

class OrderModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function addOrderProduct($order_id, $shopping_cart) {
        $data = array();
        foreach ($shopping_cart AS $product) {
            $data[] = array(
                'order_id' => $order_id,
                'product_id' => $product->id,
                'product_qty' => $product->quantity,
                'product_price' => $product->total_amount/$product->quantity,
                'product_wholesale_price' => $product->wholesale_price
            );
        }
        $this->db->insert_batch('order_products', $data);
        return true;
    }

    public function getUserOrders($page = 1, $limit = 4) {
        $offset = (intval($page) - 1) * intval($limit);
        $this->db->select('SQL_CALC_FOUND_ROWS orders.id AS id, orders.date_created AS date_order, sum(product_qty * product_price) AS sum, orders.status', false);
        $this->db->from('orders');
        $this->db->join('order_products', 'orders.id = order_products.order_id', 'INNER');
        $this->db->where('orders.user_id', $this->data['user_id']);
        $this->db->group_by('orders.id');
        $this->db->order_by('orders.date_created', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            //return $query->result();
            $result['orders'] = $query->result();

            $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
            $result["total"] = $query->row()->Count;
            return $result;
        }

        return array();
    }

    public function getOrderDetails($order_id, $is_logged = true) {
        $this->db->select('*, cities_t.name AS city_name, countries_t.name AS country_name, '
                . 'cities.price AS delivery_price, products.id AS product_id, '
                . 'products_t.name AS product_name, products.price AS product_price,'
                . 'orders.date_created AS date_created');
        $this->db->from('orders');
        $this->db->join('order_products', 'orders.id = order_products.order_id', 'INNER');
        $this->db->join('products', 'products.id = order_products.product_id', 'INNER');
        $this->db->join('products_t', 'products_t.product_id = order_products.product_id AND products_t.lang_code = "' . $this->config->item('language') . '"', 'INNER');
        $this->db->join('product_images', 'product_images.product_id = order_products.product_id AND product_images.order = "0"', 'INNER');
        $this->db->join('cities', 'orders.ship_city_id = cities.id', 'INNER');
        $this->db->join('cities_t', 'orders.ship_city_id = cities_t.city_id AND cities_t.lang_code = "' . $this->config->item('language') . '"', 'INNER');
//        $this->db->join('countries', 'orders.ship_country_id = countries.id', 'INNER');
        $this->db->join('countries_t', 'orders.ship_country_id = countries_t.country_id AND countries_t.lang_code = "' . $this->config->item('language') . '"', 'INNER');
        $this->db->where('orders.id', $order_id);
        if($is_logged) {
            $this->db->where('orders.user_id', $this->data['user_id']);
        }
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
                          ->where(array(
                                        'user_points.user_id' => $user_id,
                                        'user_points.order_id' => $order_id,
                                        'user_points.points_type_id' => 3
                                ))
                          ->get()->row();
        return $query;
    }

    public function orderCall($phone) {
        $data['ip_address'] = get_client_ip();
        $data["date_order"] = date("Y-m-d H:i:s", time());
        $data["phone"] = $phone;


        $this->db->select('*');
        $this->db->from('phone_call');
        $this->db->where('phone', $phone);
        $this->db->order_by('date_order', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_order = $query->row();
            $subTime = strtotime($last_order->date_order) - strtotime($data["date_order"]);
            $min_interval = round(abs($subTime) / 60, 2) . " minute";

            if ($min_interval > 5) {
                $this->db->insert('phone_call', $data);
                return true;
            }

            return false;
        }
        $this->db->insert('phone_call', $data);
        return true;
    }

}

?>