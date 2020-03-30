<?php
class UserModel extends CI_Model {
    public function get () {
    

// $this->load->database(); //memanggil database
// //select data
// $this->db->where("id",1);
// //ambil data tabel pegawai
// $query = $this->db->get('pegawai');
// return $query->result(); //untuk menampilkan hasil



// $this->load->database(); //memanggil database
// //select data
// $this->db->select("*");
// //memeberikan basis data yang diambil berdasarkan group
// $this->db->group_by("alamat");
// //ambil data tabel pegawai
// $query = $this->db->get('pegawai');
// return $query->result(); //untuk menampilkan hasil



// $this->load->database(); //memanggil database
// //select data
// $this->db->select("*");
// //memberikan basis data yang diambil
// $this->db->limit(1,0);
// //ambil data tabel pegawai
// $query = $this->db->get('pegawai');
// return $query->result(); // untuk menampilkan hasil



// $this->load->database(); //memanggil database
// //select data
// $this->db->select("*");
// //diurutkan berdasarkan descending
// $this->db->order_by("id", "DESC");
// //ambil data tabel pegawai

// $query = $this->db->get('pegawai');
// return $query->result(); // untuk menampilka hasl



        // $this->load->database(); //memanggil database
        // //select data, menggunakan query
        // $query = $this->db->query("select*from pegawai");
        // return $query->result(); //untuk menampilkan hasil
        



//         $this->load->database(); //memanggil database
// //select data, apabila semua data tulis *
// $this->db->select("*");
// //ambil data tabel pegawai
// $query = $this->db->get('pegawai');
// return $query->result(); //untuk menampilkan hasil

}
public function ubah ($data = array(), $id) {
    $this->load->database();
    $this->db->where('id', $id); //where bila id nya sesuai
    return $this->db->update('pegawai', $data); //update data
}
public function tambah ($data)
{
    $this->load->database(); //memanggil database
    return $this->db->insert('pegawai', $data);
}
public function hapus ($id) {
    $this->load->database();
    $this->db->where('id', $id); //where bila id nya sesuai
    return $this->db->delete('pegawai'); //hapus data
}
}
?>