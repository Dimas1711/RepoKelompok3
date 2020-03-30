<?php
class UserModel extends CI_Model
{
    public function get()
    {
        // $this->load->database();//memanggil database
        // //select data, apabila semua data tulis *
        // $this->db->select("*");
        // //ambil data table pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result(); //untuk menampilkan hasil

        // $this->load->database();//memanggil database
        // $query = $this->db->query("SELECT * FROM pegawai");
        // return $query->result();

        // $this->load->database();//memanggil database
        // //select data
        // $this->db->select("*");
        // //diurutkan berdasarkan descending
        // $this->db->order_by("id","DESC");
        // //ambil data table pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result();


        // $this->load->database();//memanggil database
        // //select data
        // $this->db->select("*");
        // //diurutkan berdasarkan descending
        // $this->db->limit(1,0);
        // //ambil data table pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result();

        // $this->load->database();//memanggil database
        // //select data
        // $this->db->select("*");
        // //diurutkan berdasarkan descending
        // $this->db->group_by("alamat");
        // //ambil data table pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result();


        $this->load->database();//memanggil database
        //select data
        $this->db->select("*");
        //diurutkan berdasarkan descending
        $this->db->where("id",1);
        //ambil data table pegawai
        $query = $this->db->get('pegawai');
        return $query->result();

    }
    public function tambah($data)
    {
        $this->load->database();
        return $this->db->insert('pegawai',$data);
    }
    public function ubah($data = array(),$id)
    {
        $this->load->database();
        $this->db->where('id',$id);
        return $this->db->update('pegawai',$data);
    }
    public function hapus($id)
    {
        $this->load->database();
        $this->db->where('id',$id);
        return $this->db->delete('pegawai');
    }
}
?>