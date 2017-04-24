<?php

class ContactTopicModel extends MultilangModel
{

    public function __construct()
    {
        parent::__construct();

        $this->setAttributesT('contact_topic_t', array('content','short_content'), 'lang_code', 'contact_topic_id');
    }


    public function rules()
    {
        $rules = array();

        $languages = $this->getLanguages();
        $default_language = $this->getDefultLanguage();

        foreach ($languages as $language) {

            if ($language->code == $default_language) {
                $rules[] = array(
                    'field' => 'Faq[question_' . $language->code . ']',
                    'label' => $this->ci->lang->line("question"),
                    'rules' => 'required|max_length[255]',
                );
            } else {
                $rules[] = array(
                    'field' => 'Faq[question_' . $language->code . ']',
                    'label' => $this->ci->lang->line("question"),
                    'rules' => 'max_length[255]',
                );
            }

            return $rules;
        }
    }

    public function rules_add()
    {
        $rules = $this->rules();

        return $rules;
    }

    public function rules_edit()
    {
        $rules = $this->rules();

        return $rules;
    }

    public function getFaqOrder($table)
    {

//        $query = $this->db->get_where($table)
//                           ->order_by('ordering', 'desc');

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


    public function deleteFaq($table, $id)
    {
        $pk = $this->getPkName($table);
        $this->db->where($pk, $id)
            ->delete($table);

        if ($this->db->affected_rows()) {
            $this->db->where("id", $id);
            return true;
        }
        return false;
    }


    public function SaveFaq($data = array())
    {
        $this->db->update_batch('faq', $data, 'id');
    }

}

?>