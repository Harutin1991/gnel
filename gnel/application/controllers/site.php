<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends MY_Controller {

//    protected $tamplate = 'babybuy/product';

    public function index() {
        $this->load->view('site/index');
    }

    public function about() {
        $this->load->view('site/about');
    }

    public function contacts() {
        $this->load->view('site/contacts');
    }

    public function country() {
        //$this->output->enable_profiler(TRUE);
//        echo "<h7>You can disable this in basemodel construct</h7> - ";
        echo "country<br/>";

        $query = $this->db->select('*')->from('countries')->order_by('id', 'ASC')->get();
        $i = 0;
        $lang = array('am', 'ru', 'en');
        //$row = $query->result_array();
        //var_dump($row);exit;
        foreach ($query->result_array() as $row) {
            //  echo $i . " - " . $row['name'] . "<br/>";

            $comp = '_eng_long_country="' . $row['name'] . '" OR short_country="' . $row['name'] . '"';
            $query2 = $this->db->query("SELECT * FROM allcountry WHERE " . $comp);
            $ret = $query2->row();
            if (empty($ret)) {
                echo $row["name"] . "<br/>";
            } else {

//                    echo $i++ . " - " ;
//                    var_dump($ret);
//                    echo "<br/>";
                $data_am = array(
                    'country_id' => $row['id'],
                    'lang_code' => 'am',
                    'name' => $ret->_arm_long_country
                );
                $data_ru = array(
                    'country_id' => $row['id'],
                    'lang_code' => 'ru',
                    'name' => $ret->_rus_long_country
                );
                $data_en = array(
                    'country_id' => $row['id'],
                    'lang_code' => 'en',
                    'name' => $ret->_eng_long_country
                );
//echo "<pre>";
//                var_dump($data_am, $data_ru, $data_en);
//                exit;
                $this->db->insert('countries_t', $data_am);
                $this->db->insert('countries_t', $data_ru);
                $this->db->insert('countries_t', $data_en);
            }
        }
    }

}
