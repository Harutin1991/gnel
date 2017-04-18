<?php

class BlogModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('blognews_t', array('title', 'meta_keywords', 'meta_description', 'content', 'short_content'), 'lang_code', 'blognews_id');
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

	public function getBlogNews($blognews_id){
		$query = array();
		$query = $this->db
			->select('blognews.id AS id, blognews.date_created, blognews.image, blognews.blognews_category_id AS catgory_id')
			->select(" (CASE WHEN blognews_t.title ='' THEN blognews.title else blognews_t.title end) as title  ")
			->select(" (CASE WHEN blognews_t.meta_description ='' THEN blognews.meta_description else blognews_t.meta_description end) as meta_description  ")
			->select(" (CASE WHEN blognews_t.meta_keywords ='' THEN blognews.meta_keywords else blognews_t.meta_keywords end) as meta_keywords  ")
			->select(" (CASE WHEN blognews_t.content ='' THEN blognews.content else blognews_t.content end) as content  ")
			->from('blognews')
			//->from('(SELECT date_created, COUNT(date_created) FROM blognews WHERE MONTH(date_created) < DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY MONTH(date_created)) AS ct')
			->join('blognews_t', "blognews.id = blognews_t.blognews_id", 'left')
			->where('blognews.id', $blognews_id)
			->where('blognews_t.lang_code', $this->config->item('language'))
			->where('blognews.status', '1')
			//->order_by('blognews_categories.order', 'ASC')
			->distinct()
			->get()->result();
		/*$sql = "SELECT * FROM blognews_t WHERE blognews_id='$blognews_id' AND lang_code='$lang_code'";
		$result = $this->db->query($sql)->result();*/
		return $query;
	}

	public function getSpecialBlognews(){
		$this->db->select('blognews_t.blognews_id AS id, blognews.image AS image, blognews_t.short_content AS short_content, blognews.date_created');
		$this->db->select(" (CASE WHEN blognews_t.title ='' THEN blognews.title else blognews_t.title end) as title  ");
		$this->db->select(" (CASE WHEN blognews_t.short_content ='' THEN blognews.short_content else blognews_t.short_content end) as short_content  ");
		$this->db->from('blognews');
		$this->db->join('blognews_t', "blognews.id = blognews_t.blognews_id", 'left');
		$this->db->where('(blognews.special = 1 OR blognews.date_created = (SELECT MAX(date_created) FROM blognews))');
		$this->db->where( array(
			'blognews_t.lang_code' => $this->config->item('language'),
			'blognews.status' => '1'
		));
		$this->db->order_by('blognews.special', 'DESC');
		$this->db->distinct();
		$query = $this->db->get()->result();
		return $query;
	}
    public function getLastBlognews($filter = null, $page = 1, $limit = 7) {
		$offset = (intval($page) - 1) * intval($limit);
        $where = array(
						'blognews_t.lang_code' => $this->config->item('language'),
						'blognews.status' => '1'
		);
		// return $filter;
		$this->db->select('blognews_t.blognews_id AS id, blognews.image AS image, blognews_t.short_content AS short_content, blognews.date_created, ct_news_comments.ct AS ct_comments, blognews.total_viewed');
		$this->db->select(" (CASE WHEN blognews_t.title ='' THEN blognews.title else blognews_t.title end) as title  ");
		$this->db->select(" (CASE WHEN blognews_t.short_content ='' THEN blognews.short_content else blognews_t.short_content end) as short_content  ");
		$this->db->from('blognews');
		$this->db->join('blognews_t', "blognews.id = blognews_t.blognews_id", 'left');
		$this->db->join('(SELECT blognews_comments.blognews_id AS id, COUNT(*) AS ct FROM blognews_comments WHERE blognews_comments.status = 1 GROUP BY blognews_comments.blognews_id) AS ct_news_comments', 'ct_news_comments.id = blognews.id', 'left');
		//->where('blognews_t.lang_code', $this->config->item('language'))
		//->where('blognews.status', '1')
		$this->db->where($where);
		if($filter){
			$this->db->where($filter);
		}
		$this->db->order_by('blognews.date_created', 'DESC');
		$this->db->distinct();
		$this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
                
    }
	public function getCountNews($filter = null){
		$this->db->select('id, COUNT(*) AS count_news');
		$this->db->from('blognews');
		$this->db->where('blognews.status', '1');
		if($filter){
			$this->db->where($filter);
		}
		$query = $this->db->get();
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
		}

		return $result;

	}

	public function addBlogewsWiewed($news_id){
		$sql = "UPDATE blognews
    			SET total_viewed = total_viewed + 1
    			WHERE id = '$news_id'";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getPopularNews($filter = null){
		$where = array(
			'blognews_t.lang_code' => $this->config->item('language'),
			'blognews.status' => '1'
		);
		// return $filter;
		$this->db->select('blognews_t.blognews_id AS id,blognews.total_viewed, blognews.image AS image, blognews_t.short_content AS short_content, blognews.date_created');
		$this->db->select(" (CASE WHEN blognews_t.title ='' THEN blognews.title else blognews_t.title end) as title  ");

		$this->db->from('blognews');
		$this->db->join('blognews_t', "blognews.id = blognews_t.blognews_id", 'left');
		//->where('blognews_t.lang_code', $this->config->item('language'))
		//->where('blognews.status', '1')
		$this->db->where($where);
		if($filter){
			$this->db->where($filter);
		}
		$this->db->order_by('total_viewed', 'DESC');
		$this->db->distinct();
		$this->db->limit(4);
		$query = $this->db->get();
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
	public function updateComments($id, $data){
		$pk = $this->getPkName('blognews_comments');
		$attributes = $this->getAttributes('blognews_comments');
		$attributes = array_intersect_key($data, $attributes);
		if(count($attributes) > 0)
			$this->db->where($pk, $id)
				->where('status', '0')
				->update('blognews_comments', $attributes);

		$is_updated = false;
		if($this->db->affected_rows())
			$is_updated = true;

		return $is_updated;
	}
	public function getBlognewsRepresantativeDetails($product_id) {
		$query = $this->db
			->select('admin_users.*')
			->from('products')
			->join('admin_users', "products.user_id = admin_users.id", 'INNER')
			->where('products.id', $product_id)
			->get();
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row();
		}
		return $result;
	}

	public function getBlognewsComments($blognews_id, $page_num = 1, $perpage = 5) {
		$sql = "SELECT SQL_CALC_FOUND_ROWS blognews_comments.* , "
			. " users.image AS user_image, users.first_name AS first_name, users.last_name AS last_name "
			. " FROM blognews_comments "
			//. " LEFT JOIN product_rates ON blognews_comments.blognews_id = product_rates.product_id AND blognews_comments.user_id = product_rates.user_id"
			. " LEFT JOIN users ON users.id = blognews_comments.user_id"
			. " WHERE blognews_comments.blognews_id = " . $blognews_id;

		if (isset($this->data['user_id'])) {
			$sql .= " AND (blognews_comments.status = 1 OR users.id=" . $this->data['user_id'] . " )";
		} else {
			$sql .= " AND (blognews_comments.status = 1 )";
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

    public function getBlogCategories(){
		 $query = $this->db
                ->select('blognews_categories.id AS id')
                ->select(" (CASE WHEN blognews_categories_t.title ='' THEN blognews_categories.title else blognews_categories_t.title end) as title  ")
				->select(" (CASE WHEN blognews_categories_t.meta_description ='' THEN blognews_categories.meta_description else blognews_categories_t.meta_description end) as meta_description  ")
				->select(" (CASE WHEN blognews_categories_t.meta_keywords ='' THEN blognews_categories.meta_keywords else blognews_categories_t.meta_keywords end) as meta_keywords  ")
				->select(" (CASE WHEN blognews_categories_t.content ='' THEN blognews_categories.content else blognews_categories_t.content end) as content  ")
				->from('blognews_categories')
				//->from('(SELECT date_created, COUNT(date_created) FROM blognews WHERE MONTH(date_created) < DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY MONTH(date_created)) AS ct')
                ->join('blognews_categories_t', "blognews_categories.id = blognews_categories_t.blog_category_id", 'left')
				->where('blognews_categories_t.lang_code', $this->config->item('language'))
                ->where('blognews_categories.status', '1')
                ->order_by('blognews_categories.order', 'ASC')
                ->distinct()
                ->get()->result();
		return $query;
	}
	public function getBlogArchive(){
		$sql = "SELECT date_created, COUNT(date_created) AS count_b FROM blognews WHERE MONTH(date_created) < DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND status = 1  GROUP BY MONTH(date_created) ORDER BY MONTH(date_created) DESC";
		$query = $this->db->query($sql)->result();
		
		return $query;
	}
}

?>