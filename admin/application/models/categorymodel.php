<?php

class CategoryModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('categories_t', array('name', 'description', 'meta_keywords', 'meta_description'), 'lang_code', 'category_id');
    }

    public function rules() {
        $rules = array();

//        $rules[] = array(
//            'field' => 'Category[status]',
//            'label' => $this->ci->lang->line("Status"),
//            'rules' => 'required',
//        );

        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();

        foreach ($languages as $language) {
            $rules[] = array(
                'field' => 'Category[meta_keywords_' . $language->code . ']',
                'label' => $this->ci->lang->line("Meta keywords"),
                'rules' => 'max_length[255]',
            );
            $rules[] = array(
                'field' => 'Category[meta_description_' . $language->code . ']',
                'label' => $this->ci->lang->line("Meta description"),
                'rules' => 'max_length[255]',
            );
            $rules[] = array(
                'field' => 'Category[text_' . $language->code . ']',
                'label' => $this->ci->lang->line("Text"),
                'rules' => '',
            );

            if ($language->code == $default_language) {
                $rules[] = array(
                    'field' => 'Category[name_' . $language->code . ']',
                    'label' => $this->ci->lang->line("Name"),
                    'rules' => 'required|max_length[255]',
                );
            } else {
                $rules[] = array(
                    'field' => 'Category[name_' . $language->code . ']',
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

        if ($id != false) {
            $option_category = array();

            foreach ($data['option'] as $option_id => $option_value) {
                foreach ($option_value as $lang_code => $option_values_t) {
                    $option_category[] = array(
                        'option_id' => $option_id,
                        'category_id' => $id,
                        'lang_code' => $lang_code,
                        'option_value' => json_encode($option_values_t),
                    );
                }
            }
            if (!empty($option_category)) {
                $this->db->insert_batch('category_options', $option_category);
            }
        }

        return $id;
    }

    public function update($table, $id, $data) {
        $is_updated = parent::update($table, $id, $data);

        if (isset($data['current_options']) && !empty($data['current_options'])) {
            $current_option_ids = array();

            foreach ($data['current_options'] as $current_option_id => $current_option) {
                $current_option_ids[] = $current_option_id;
            }

            $this->db->where('category_id', $id)
                    ->where_in('option_id', $current_option_ids)
                    ->delete('category_options');
        }

        if (isset($data['option']) && !empty($data['option'])) {
            $option_category = array();

            foreach ($data['option'] as $option_id => $option_value) {
                foreach ($option_value as $lang_code => $option_values_t) {
                    $option_category[] = array(
                        'option_id' => $option_id,
                        'category_id' => $id,
                        'lang_code' => $lang_code,
                        'option_value' => json_encode($option_values_t),
                    );
                }
            }

            $this->db->insert_batch('category_options', $option_category);
        }

        return $is_updated;
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
                ->join('product_to_category AS prod_t_co', 'prod_t_co.category_id = cat_opt.category_id AND prod_t_co.product_id = '.$product_id, 'inner')
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
        $query = $this->db->query("SELECT `category_id`, COUNT(DISTINCT `product_id`) as count FROM `product_to_category` WHERE `category_id` <> 0 GROUP BY `category_id`");

        $counts = array();

        if ($query->num_rows() > 0) {
            $product_counts = $query->result();

            foreach ($product_counts as $product_count) {
                $counts[$product_count->category_id] = $product_count->count;
            }
        }

        return $counts;
    }

}

?>