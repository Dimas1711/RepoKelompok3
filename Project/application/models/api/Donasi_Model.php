<?php 


    class Donasi_Model extends CI_Model{
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
        }
        public function saldosekarang($id = null){ // cek user finansial
            if ($id === null) {
                return $this->db->get_where('user')->row_array();
            }else {
                return $this->db->get_where('user' , ['id_user' => $id])->row_array();
            }
        }
        public function kasus($id = null){ // cek user finansial
            if ($id === null) {
                return $this->db->get_where('kasus')->row_array();
            }else {
                return $this->db->get_where('kasus' , ['id_kasus' => $id])->row_array();
            }
        }
        public function cekdonasi($id = null){//cek hasil donasi
            if ($id === null) {
                return $this->db->get_where('donasi')->row_array();
            }else {
                return $this->db->get_where('donasi' , ['id_donasi' => $id])->row_array();
            }
        }
        // public function kasus($id){//cek kasus
        //     if ($id === null) {
        //         return $this->db->get_where('donasi')->row_array();
        //     }else {
        //         return $this->db->get_where('donasi' , ['id_donasi' => $id])->row_array();
        //     }
        // }
    }