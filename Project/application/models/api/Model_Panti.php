<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Panti extends CI_Model
{
        public function index(){
            // return this->db->get('panti')->result();
            return $this->db->get('panti')->result_array();
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
            
        }
}