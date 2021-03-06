<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_User extends CI_Model
{
       
        public function index($id){
      
                return $this->db->get_where('user' , ['id_registrasi' => $id])->result_array();
            
        }
        public function data($id){
      
            return $this->db->get_where('registrasi' , ['id_registrasi' => $id])->result_array();
        
        }
        public function insert($tabel, $arr)
        {
            $cek = $this->db->insert($tabel, $arr);
            return $cek;
            
        }
        public function updateUser($data,$nama, $id)
        {
            $this->db->update('user', $data, ['id_registrasi' => $id]);
            $this->db->query("UPDATE registrasi SET nama = '$nama' WHERE id_registrasi = '$id'");
            return $this->db->affected_rows();
        }
        public function updateEmail($email, $id)
        {
            $this->db->query("UPDATE user SET email = '$email' WHERE id_registrasi = '$id'");
            $this->db->query("UPDATE registrasi SET email = '$email' WHERE id_registrasi = '$id'");
            return $this->db->affected_rows();
        }
        public function updatePass($password,$passwordbaru, $id)
        {
            $this->db->where('id_registrasi', $id);
        $q = $this->db->get("registrasi");

        if( $q->num_rows() ) 
        {
            $passlama = $q->row('password');
            if($password === $passlama)
            {
                $this->db->query("UPDATE registrasi SET password = '$passwordbaru' WHERE id_registrasi = '$id'");
                return $this->db->affected_rows();
            }
            return FALSE;
        }else{
            return FALSE;
        }
        }

        
        public function updateUserFoto($data, $id)
        {
            $this->db->update('registrasi', $data, ['id_registrasi' => $id]);
            return $this->db->affected_rows();
        }
        public function getAcc($id = null){
                if ($id === null) {
                     return $this->db->get('akun_bank')->result_array();
                }else {
                    return $this->db->get_where('akun_bank' , ['id_akun' => $id])->result_array();
                }
            }
}