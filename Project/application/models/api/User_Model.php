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
        $kode_jadi="A00".$kode_max;
        return $kode_jadi;
    }

}
