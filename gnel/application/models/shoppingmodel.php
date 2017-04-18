<?php

class ShoppingModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function addToCard($data) {
        $data['selected_time'] = date('Y-m-d H:i:s', time());

        $this->db->query("INSERT INTO shopping_cart "
                . "(user_id, temp_id , selected_time, product_id, prod_qty) VALUES "
                . "('" . $data['user_id'] . "', '" . $data['temp_id'] . "', '" . $data['selected_time'] . "', '" . $data['product_id'] . "', '" . $data['prod_qty'] . "') "
                . "ON DUPLICATE KEY UPDATE prod_qty = prod_qty + " . $data['prod_qty']);

        return true;
    }

    public function updateShoppingCard($data, $prod_qty) {
//        $this->db->where($data);
//        $this->db->update('shopping_cart', array('prod_qty' => $prod_qty)); 
        $this->db->update('shopping_cart', array('prod_qty' => $prod_qty), $data);
        return true;
    }

    public function removeFromCard($data) {
        $this->db->delete('shopping_cart', $data);
        return true;
    }

    public function updateShoppingCartDuringLogin($user_id, $temp_id) {

        $sql = "UPDATE IGNORE shopping_cart "
                . "SET user_id = " . $user_id . ", temp_id = ''"
                . "WHERE temp_id = '" . $temp_id . "'";
        $this->db->query($sql);
        $this->db->delete('shopping_cart', array('temp_id' => $temp_id));
        return true;
    }

    public function getShoppingCart($data) {

        $query = $this->db
                ->select('products.id AS id, 
                    products.code AS code, 
                    shopping_cart.prod_qty AS quantity, 
                    products_t.name AS name, 
                    product_images.image AS image,
                    products.price AS price, 
                    brands_t.name AS brand_name,
                    products.wholesale_price AS wholesale_price,   
                    products.percent_off as percent_off, 
                    products.amount_off as amount_off,
                    (CASE 
                        WHEN products.percent_off != 0 THEN (shopping_cart.prod_qty * (products.price - (products.price * products.percent_off/100 )))
                        WHEN products.amount_off != 0 THEN (shopping_cart.prod_qty * (products.price - products.amount_off))
                    ELSE shopping_cart.prod_qty * price
                    END) as total_amount
                    ')
                ->from('shopping_cart')
                ->join('products', 'shopping_cart.product_id = products.id', 'left')
                ->join('products_t', 'products_t.product_id = products.id', 'left')
                ->join('product_images', 'product_images.product_id = products.id', 'left')
                ->join('brands_t', 'brands_t.brand_id = products.brand_id', 'left')
                ->where('products_t.lang_code', $this->config->item('language'))
                ->where('brands_t.lang_code', $this->config->item('language'))
                ->where('products.status', '1')
                ->where('product_images.order', '0')
                ->where('shopping_cart.user_id', $data['user_id'])
                ->where('shopping_cart.temp_id', $data['temp_id'])
                ->order_by('products.brand_id', 'ASC')
                ->get();

        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    public function clearShoppingCart($user_id, $temp_id) {
        $this->db->delete('shopping_cart', array('temp_id' => $temp_id, 'user_id' => $user_id));
        return true;
    }

    public function cityDeliveryPrice() {
        $this->db->select('cities.id AS id, cities.price AS price, cities_t.name AS name')
                ->from('cities')
                ->join('cities_t', 'cities.id = cities_t.city_id', 'INNER')
                ->where('cities_t.lang_code', $this->config->item('language'));
        $query = $this->db->get();
        $result = array();
//        if ($query->num_rows() > 0) {
//            $result = $query->result();
//        }
//        return $result;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $result[$row->id] = array('name' => $row->name, 'price' => $row->price);
            }
        }
        $query->free_result();
        return $result;
    }

}

?>