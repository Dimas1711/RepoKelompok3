<?php 

    class Model_kasus extends CI_Model{

        // public function index(){
        //     // return $this->db->get('kasus')->result_array();
        // }
        public function index($id = null){
            if ($id === null) {
                return $this->db->get_where('kasus' , ['status' => 1])->result_array();
            }else {
                return $this->db->get_where('kasus' , ['id_kasus' => $id , 'status' => 1])->result_array();
            }
        }
        public function top_up($id = null){
            if ($id === null) {
                return $this->db->get_where('user')->row_array();
            }else {
                return $this->db->get_where('user' , ['id_user' => $id])->row_array();
            }
        }
        public function cekdompet($id = null){
            if ($id === null) {
                return $this->db->get_where('dompet')->row_array();
            }else {
                return $this->db->get_where('dompet' , ['id_dompet' => $id])->row_array();
            }
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
        }
        public function buat_kode(){
            $this->db->select('RIGHT(dompet.id_dompet,3) as kode',FALSE);
            $this->db->order_by('id_dompet', 'DESC');
            $this->db->limit(1);
    
            $query=$this->db->get('dompet');
    
            if ($query->num_rows()<>0) {
                $data=$query->row();
                $kode=intval($data->kode)+1;
            }else{
                $kode=1;
            }
            $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
            $kode_jadi="DP00".$kode_max;
            return $kode_jadi;
        }
    }

?>