<?php 

    class Model_Riwayat extends CI_Model
    {
        public function index($id = null){
            // if ($id === null){
            //     return $this->db->get('donasi')->result_array();
            // }else {
            //     return $this->db->get_where('donasi' , ['id_user' => $id])->result_array();
            // }
            return $this->db->get_where('donasi' , ['id_user' => $id])->result_array();

        }
    }