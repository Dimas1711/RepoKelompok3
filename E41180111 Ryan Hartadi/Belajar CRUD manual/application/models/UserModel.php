<?php

class UserModel extends CI_Model {
    public function get(){
        $this->load->database();
        //select data , apabila ditulis *
        $this->db->select("*");
        //mengurutkan
        // $this->db->order_by("id" , "DESC");
        
        //menggunakan limit 
        // $this->db->limit(1,0);

        //grup by
        // $this->db->group_by("alamat");
        //ambil data pegawai
        
        //where
        $this->db->where("id",1);

        $query = $this->db->get('pegawai');
        return $query->result();
    }
    public function tambah($data){
        $this->load->database();
       return $this->db->insert('pegawai' , $data);
       
    }
    public function ubah($data = array() , $id){
        $this->load->database();
        $this->db->where('id' , $id);
        return $this->db->update('pegawai', $data);
    }
    public function hapus($id){
        $this->load->database();
        $this->db->where('id' , $id);
       return $this->db->delete('pegawai');
       
    }
}

?>