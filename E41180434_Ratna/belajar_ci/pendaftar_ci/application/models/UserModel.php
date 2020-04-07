<?php
class UserModel extends CI_Model {//meextends Ci_Model
public function get () {
   
      //  public function ubah($data = array(), $id) {
        
        //select data
       // $this->db->select("*");
       //where bila id nya sesuai
    //    $this->db->where('id'. $id);
         //memberikan basis data yang diambil berasarkan where
        // $this->db->where("id",3);
         //memberikan basis data yang diambil berdasarkan group
        // $this->db->group_by("alamat");
        //memberikan basis data yang diambil
        //$this->db->limit(1,0);
        //diurutkan berdasarkan descending
    //$this->db->order_by("id","DESC");
    //ambil data tabel pegawai
  // $query = $this->db->get('pegawai');
   //return $query->result(); //untuk menampilkan hasil
   //return $this->db->update('pegawai', $data); //update data
}
//menambahkan data
//public function tambah ($data) {
  //      $this->load->database(); //memanggil database
    //    return $this->db->insert('pegawai',$data);
//mengubah data
/**public function ubah($data = array(), $id) {
  $this->load->database();
  $this->db->where('id', $id); //where bila id nya sesuai
  return $this->db->update('pegawai', $data); //update data
}*/

// menghapus data
public function hapus($id) {
  $this->load->database();
  $this->db->where('id', $id); //where bila id nya sesuai
  return $this->db->delete('pegawai'); //hapus data
}

  }

?>