<?php 

    class Model_Riwayat extends CI_Model
    {
        public function index($id = null){
            $q = $this->db->query("SELECT * FROM donasi, kasus WHERE kasus.id_kasus = donasi.id_kasus AND id_user = (SELECT user.id_user FROM user WHERE user.id_registrasi = '$id')")->result_array();
            //$q = $this->db->query("SELECT * FROM donasi , kasus WHERE donasi.id_kasus = kasus.id_kasus AND id_user = '$id'")->result_array();
            return $q;
        }
    }