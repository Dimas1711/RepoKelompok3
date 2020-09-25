<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
    protected $user_table = 'registrasi';
    
    public function user_login($email, $password)
    {
      
        $this->db->where('email', $email);
        $q = $this->db->get($this->user_table);

        if( $q->num_rows() ) 
        {
            $user_pass = $q->row('password');
            if(md5($password) === $user_pass) {
                return $q->row();
            }
            return FALSE;
        }else{
            return FALSE;
        }
    }
    public function insert($tabel, $arr)
    {
        $cek = $this->db->insert($tabel, $arr);
        return $cek;
        
    }
    public function detail($id){
            return $this->db->get_where('registrasi' , ['id_registrasi' => $id])->row_array();
    }
    public function buat_kode(){
        $this->db->select('RIGHT(registrasi.id_registrasi,3) as kode',FALSE);
        $this->db->order_by('id_registrasi', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('registrasi');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
        $kode_jadi="R00".$kode_max;
        return $kode_jadi;
    }
  
    function randomkode($maxlength) {
        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $return_str = "";
        for ( $x=0; $x<$maxlength; $x++ ) {
            $return_str .= $chary[rand(0, count($chary)-1)];
        }
        return $return_str;
      }

}
