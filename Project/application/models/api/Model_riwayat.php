<?php 

    class Model_Riwayat extends CI_Model
    {
        public function index($id = null){
            $q = $this->db->query("SELECT * FROM donasi , kasus WHERE donasi.id_kasus = kasus.id_kasus AND id_user = '$id'")->result_array();
            return $q;
        }
    }