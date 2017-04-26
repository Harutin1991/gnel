<?php

class ContactModel extends MultilangModel
{

    public function __construct()
    {
        parent::__construct();

        $this->setAttributesT('contact_t', array('content'), 'lang_code', 'contact_id');
    }




    public function getContactTopic($table)
    {

        $query = $this->db->select("*")
            ->from($table)
            ->order_by('ordering', 'asc')
            ->get();


        if ($query->num_rows() > 0) {
            $record = $query->result_array();

            for ($i = 0; $i < count($record); $i++) {
                if (count($record) > 0) {
                    $languages = $this->getLanguages();

                    foreach ($languages as $language) {

                        $query = $this->db->get_where($this->table_t, array(
                                $this->lang_key => $language->code
                            )
                        );

                        $record_t = $query->row_array();

                        if (count($record_t) > 0) {
                            foreach ($this->attributes_t as $attr) {
                                $record[$i][$attr . "_" . $language->code] = $record_t[$attr];
                            }
                        } else {
                            foreach ($this->attributes_t as $attr) {
                                //  $record[$attr."_".$language->code] = $record[$attr];
                                $record[$i][$attr . "_" . $language->code] = NULL;
                            }
                        }
                    }
                }
            }


            return $record;
        }
    }

}

?>