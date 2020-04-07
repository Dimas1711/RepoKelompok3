<?php
class Home2 extends CI_Controller {
    public function index() {
        $this->load->model("ArtikelModel");
        $data = array (
            "artikel" => $this->ArtikelModel->get());
            $this->load->view("HomeView", $data);
    }
public function detail($id) {
    $this->load->model("ArtikelModel");
    $data = array (
        "artikel" => $this->ArtikelModel->detail($id)
    );
    $this->load->view("DetailView", $data);   
}
public function tambah() {
    $this->load->model("ArtikelModel");
    if($this->input->method() == "post") {
        $insert = $this->ArtikelModel->tambah(array(
            'judul' => $this->input->post("judul"),
            'penulis' => $this->input->post("penulis"),
            'isi' => $this->input->post("isi")
        ));
    if ($insert) {
        echo "Sukses tambah artikel.";
    } else {
        echo "Gagal tambah artikel.";
    }
    }
    $this->load->view("FormView");
    }
public function hapus($id) {
    $aksi = ['2'];
    $this->load->model("ArtikelModel");
    $autoReload = base_url();
    $hapus = $this->ArtikelModel->hapus($id); 
    if($hapus){
        echo "Hapus data berhasil";
        redirect($autoReload);
    }
    }
public function ubah($id) {
    $this->load->model("ArtikelModel");
    if($this->input->method() == "post") {
        $ubah = $this->ArtikelModel->ubah(array(
            'judul' => $this->input->post("judul"),
            'penulis' => $this->input->post("penulis"),
            'isi' => $this->input->post("isi"),
        ),$id);
        if ($ubah) {
            echo "Sukses ubah artikel.";
        } else {
            echo "Gagal ubah artikel.";
        }
}
$data = array(
    "berubah"=>$this->ArtikelModel->detail($id));
$this->load->view("UbahView", $data);
} 
} 
?>