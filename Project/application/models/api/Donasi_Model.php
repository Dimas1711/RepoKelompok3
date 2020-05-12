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
        public function panti($id = null){ // cek user finansial
            if ($id === null) {
                return $this->db->get_where('panti')->row_array();
            }else {
                return $this->db->get_where('panti' , ['id_panti' => $id])->row_array();
            }
        }
        public function cekdonasi($id = null){//cek hasil donasi
            if ($id === null) {
                return $this->db->get_where('donasi')->row_array();
            }else {
                return $this->db->get_where('donasi' , ['id_donasi' => $id])->row_array();
            }
        }
        public function buat_kode(){
            $this->db->select('RIGHT(donasi.id_donasi,3) as kode',FALSE);
            $this->db->order_by('id_donasi', 'DESC');
            $this->db->limit(1);
    
            $query=$this->db->get('donasi');
    
            if ($query->num_rows()<>0) {
                $data=$query->row();
                $kode=intval($data->kode)+1;
            }else{
                $kode=1;
            }
            $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
            $kode_jadi="GJ00".$kode_max;
            return $kode_jadi;
        }
    }