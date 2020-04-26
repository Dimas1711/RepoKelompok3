<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model
{
        public function index(){
            // return this->db->get('panti')->result();
            return $this->db->get('user')->result_array();
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
            
        }
}