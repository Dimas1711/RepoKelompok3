<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model
{
       
        public function index($id){
      
                return $this->db->get_where('user' , ['id_registrasi' => $id])->result_array();
            
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
            
        }
        public function getAcc($id = null){
                if ($id === null) {
                     return $this->db->get('akun_bank')->result_array();
                }else {
                    return $this->db->get_where('akun_bank' , ['id_akun' => $id])->result_array();
                }
            }
}