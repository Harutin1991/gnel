<?php

class PartnerModel extends MultilangModel {

    public function __construct() {
        parent::__construct();

        $this->setAttributesT('brands_t', array('name', 'meta_keywords', 'meta_description', 'description'), 'lang_code', 'brand_id');
    }


    public function getAllPartners() {
        $query = $this->db
                ->select('partners_t.partner_id AS id, partners_t.name AS name, '
                        . 'partners.image AS image, partners_t.description AS description, partners.link AS link')
                ->from('partners')
                ->join('partners_t', 'partners.id = partners_t.partner_id', 'inner')
                ->where('partners_t.lang_code', $this->config->item('language'))
                ->where('partners.status', '1')
                ->order_by('partners_t.name', 'ASC')
                ->distinct()
                ->get();
        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
    }

}

?>