<?php 


    class Model_Lokasi extends CI_Model{

        public function provinsi(){
            return $this->db->get('provinsi')->result_array();
        }
        public function kabupaten(){
            return $this->db->get('kabupaten')->result_array();
        }
    }
        