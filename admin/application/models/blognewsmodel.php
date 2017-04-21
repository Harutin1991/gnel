<?php 
class BlognewsModel extends MultilangModel {
    
    public function __construct() {
        parent::__construct();
		
		$this->setAttributesT('blognews_t', array('title', 'content', 'short_content', 'meta_keywords', 'meta_description'), 'lang_code', 'blognews_id');
    }
    
    public function rules() {
        $rules = array();
        
        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();
        
        foreach($languages as $language){
            $rules[] = array(
                'field'   => 'Blognews[meta_description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Meta description"), 
                'rules'   => 'max_length[255]', 
            );
            $rules[] = array(
                'field'   => 'Blognews[description_'.$language->code.']', 
                'label'   => $this->ci->lang->line("Description"), 
                'rules'   => '', 
            );
            $rules[] = array(
                'field'   => 'Blognews[ordering]',
                'label'   => $this->ci->lang->line("Ordering"),
                'rules'   => 'numeric',
            );
            
            if($language->code == $default_language) {
                $rules[] = array(
                    'field'   => 'Blognews[title_'.$language->code.']', 
                    'label'   => "lang:Name", 
                    'rules'   => 'required|max_length[255]', 
                );
			}
            else { 
                $rules[] = array(
                    'field'   => 'Blognews[name_'.$language->code.']', 
                    'label'   => $this->ci->lang->line("Name"), 
                    'rules'   => 'max_length[255]', 
                );
			}
        }
        
        return $rules;
    } 
	
	public function getBlogCategories(){
		$sql = 'SELECT blog_category_id, GROUP_CONCAT(CONCAT(lang_code, "_", title ) SEPARATOR ",") AS title FROM blognews_categories_t GROUP BY blog_category_id';
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	
	public function getAllBlognews($order_by = 'DESC', $pr_string = '', $pr_perpage = '', $page_num = '') {
		$table = 'blognews';
        $order_column = 'ordering';
        $pk = $this->getPkName($table);
		
		$str_select = $table . '.*';
		
		foreach ($this->attributes_t as $attr) {
            $str_select .= ', ';
            $str_select .= $this->table_t . '.' . $attr;
        }
		
		 $default_language = $this->getDefultLanguage();
        $this->db->select('SQL_CALC_FOUND_ROWS ' . $str_select, FALSE)
                ->from($table)
                ->join($this->table_t, $this->table_t . '.' . $this->foreign_key . '=' . $table . '.' . $pk, 'left')
                ->order_by($order_column, $order_by);

		if ($pr_string == '') {
            $this->db->where($this->table_t . '.' . $this->lang_key, $default_language);
        }
		$attributes = $this->getAttributes($table);
		
		if ($pr_string != '') {
            $this->db->where("(`blognews`.`title`  LIKE '%$pr_string%'
							OR	`blognews`.`content`  LIKE '%$pr_string%'
							OR	`blognews`.`short_content`  LIKE '%$pr_string%'
                            OR  `blognews_t`.`title`  LIKE '%$pr_string%'
                            OR  `blognews_t`.`content`  LIKE '%$pr_string%'
                            OR  `blognews_t`.`short_content`  LIKE '%$pr_string%'
							
							)");
        }
		
        $this->db->group_by("blognews.id");
        //$this->db->order_by("special", 'DESC');
        $this->db->order_by("id", $order_by);
		
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

    public function  updateSpecialBlognews($news_id, $special){
        $this->db->where('blognews.special', '1')
            ->update('blognews', array('special' => 0));
        if($special == '1') {
            $this->db->where('blognews.id', $news_id)
                ->update('blognews', array('special' => $special));
        }
        $is_updated = false;
        if ($this->db->affected_rows())
            $is_updated = true;

        return $is_updated;

    }

    public function getBlognewsDetails($id) {
        $query = $this->db
            ->select('blognews.* ')
            ->from('blognews')
            ->where('blognews.id', $id)
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
            $query = $this->db->where('blognews.id', $id)->get('blognews');
            if ($query->num_rows() > 0) {
                //redirect(site_url('product/addImages/' . $id));
            }
        }

        return array();
    }

    public function getBlognewsComments($blognews_id, $page_num = '', $perpage = '') {
        $table = 'blognews';
        $sql = "SELECT SQL_CALC_FOUND_ROWS blognews_comments.* , "
            . " users.image AS user_image, users.first_name AS first_name, users.last_name AS last_name "
            . " FROM blognews_comments "
            . " LEFT JOIN users ON users.id = blognews_comments.user_id"
            . " INNER JOIN blognews ON blognews.id = blognews_comments.blognews_id"
            . " WHERE blognews_comments.blognews_id = " . $blognews_id;
        $attributes = $this->getAttributes($table);
        $user = array("user_id" => $this->admin_id);
        $if_contains_user = array_intersect_key($user, $attributes);
        if ($this->admin_id != $this->config->item('super_global_admin_id') && !empty($if_contains_user)) {
            $this->db->where($table . '.user_id', $this->admin_id);
        }
        $sql .= " ORDER BY blognews_comments.comment_date DESC ";
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

    public function deleteBlogItem($table, $id) {
        $pk = $this->getPkName($table);
        $query = $this->db->where($pk, $id)
            ->delete($table);

        if ($this->db->affected_rows()) {
            $query = $this->db->where("id", $id);
            return true;
        }
        return false;
    }

    public function getWhere($table, $blognews_id, $order_by = 'ASC') {
        $query = $this->db->order_by('order', $order_by)
            ->where('blognews_id', $blognews_id)
            ->get($table);

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array();
    }

    function insertImages($data) {
        $attributes = $this->getAttributes('blognews_images');
        $attributes = array_intersect_key($data, $attributes);

        $this->db->insert_batch('blognews_images', $data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function SaveBlogCategories($data = array()) {
        $this->db->update_batch('blognews', $data, 'id');

    }

    public function SaveBlog($data = array()) {
        $this->db->update_batch('blognews', $data, 'id');

    }

}

?>