<?php

/**
 * @property ShoppingModel $ShoppingModel
 *
 */

class PageModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('pages_t', array('title', 'meta_description', 'short_description', 'text'), 'lang_code', 'page_id');
    }

    public function getPageData($id) {
		$query = $this->db
                ->select('pages_t.*,  pages.url AS url, pages.parent_id AS parent_id, pages.image AS image')
                ->from('pages')
				->join('pages_t', "pages.id = pages_t.page_id", 'left')
                ->where('pages.id', $id)
				->where('pages_t.lang_code', $this->config->item('language'))
                ->get();
		$result = array();
		if ($query->num_rows() > 0) {
            $result = $query->row();
		}
		
		return $result;
	}

	public function getPageChilds($parent_id) {
		$query = $this->db
                ->select('pages_t.*,  pages.url AS url, pages.parent_id AS parent_id, pages.image AS image')
                ->from('pages')
				->join('pages_t', "pages.id = pages_t.page_id", 'left')
                ->where('pages.parent_id', $parent_id)
				->where('pages_t.lang_code', $this->config->item('language'))
                ->get();
		$result = array();
		if ($query->num_rows() > 0) {
            $result = $query->result();

		}

		return $result;
	}

	public function getParrentPage($parent_id) {
		$query = $this->db
                ->select('pages_t.*,  pages.url AS url, pages.parent_id AS parent_id, pages.image AS image')
                ->from('pages')
				->join('pages_t', "pages.id = pages_t.page_id", 'left')
                ->where('pages.id', $parent_id)
				->where('pages_t.lang_code', $this->config->item('language'))
                ->get();
		$result = array();
		if ($query->num_rows() > 0) {
            $result = $query->result();

		}

		return $result;
	}

    public function getAllPages() {
        $query = $this->db->get('Pages');
        if ($query->num_rows() > 0) {
            $menus = array();
            foreach ($query->result() as $row) {
                $name = strtolower($row->name);
                $name = str_replace(' ', '_', $name);
                $menus[$row->name] = $this->getMenuPages($row->name);
            }
            return $menus;
        }
        return array();
    }

}

?>