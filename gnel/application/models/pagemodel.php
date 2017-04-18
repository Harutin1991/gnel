<?php

class PageModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('pages_t', array('title', 'meta_keywords', 'meta_description', 'short_description', 'text'), 'lang_code', 'page_id');
    }

    public function getPageData($url) {
		$query = $this->db
                ->select('pages_t.*,  pages.url AS url, pages.image AS image')
                ->from('pages')
				->join('pages_t', "pages.id = pages_t.page_id", 'left')
                ->where('pages.url', $url)
				->where('pages_t.lang_code', $this->config->item('language'))
                ->get();
		$result = array();
		if ($query->num_rows() > 0) {
            $result = $query->row();
		}
		
		return $result;
	}

}

?>