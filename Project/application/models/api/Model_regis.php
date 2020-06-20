<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Regis extends CI_Model
{
       
        public function index($id){
      
            return $this->db->get_where('registrasi' , ['id_registrasi' => $id])->result_array();
            
        }
}