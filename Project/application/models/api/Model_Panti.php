<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Panti extends CI_Model
{
        // public function index(){
        //     // return this->db->get('panti')->result();
        //     return $this->db->get('panti')->result_array();
        // }
        public function index($id = null){
            if($id === null)
            {
                return $this->db->get_where('panti', ['status' => 1])->result_array();
            }
            else
            {
                return $this->db->get_where('panti', ['id_panti' => $id, 'status' => 1])->result_array();
            }
            
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
            
        }
}