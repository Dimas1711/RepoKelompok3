<?php 

class Home extends CI_Controller{
    public function index(){
        $this->load->model("UserModel");
        // $tambah = $this->UserModel->tambah(array(
        //     "nama" => "Yo",
        //     "email" => "Yo@gmail.com",
        //     "alamat" => "Jember"
        // ));
        // if($tambah){
        //     echo "Tambah Data Berhasil";
        // }
        // $ubah = $this->UserModel->ubah(array(
        //     "nama" => "Yo123",
        //     "email" => "Yo123123@gmail.com",
        //     "alamat" => "Jember"
        // ),2);
        // if($ubah){
        //     echo "Ubah Data Berhasil";
        // }
     $hapus = $this->UserModel->hapus(5);
     if($hapus){
         echo "Hapus data berhasil";
     }
    }
}

?>