<?php 

    class Model_kasus extends CI_Model{

        public function index(){
            return $this->db->get('kasus')->result_array();
        }
    }

?>