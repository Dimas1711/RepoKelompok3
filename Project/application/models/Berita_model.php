<?php 

    class Berita_model extends CI_Model{

        public function index_get(){
            return $this->db->get('berita')->result_array();
        }
        public function insertdata($data = array()){
            return $this->db->insert('berita' , $data);
        }
    }

?>