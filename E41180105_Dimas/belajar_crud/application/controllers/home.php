<?php
class Home extends CI_Controller
{
    public function index()
    {   
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->get()
        );
        $this->load->view("HomeView", $data);
    }

    public function detail($id)
    {
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->detail($id)
        );
        $this->load->view("DetailView", $data);
    }
    public function tambah()
    {
        $this->load->model("ArtikelModel");
        if($this->input->method() == "post")
        {
            $insert = $this->ArtikelModel->tambah(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'tanggal' => date ("Y-m-d H:i:s")
            ));
            if($insert)
            {
                echo "Sukses tambah artikel";
            }
            else
            {
                echo "Gagal tambah artikel";
            }
        }
        $this->load->view("FormView");
    }
    public function ubah($id)
    {
        $this->load->model("ArtikelModel");
        $data ["artikel"] = $this->ArtikelModel->detail($id);
        if($this->input->method() == "post")
        {
            $update = $this->ArtikelModel->ubah(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'tanggal' => date ("Y-m-s H:i:s")
            ), $id);
            if($update)
            {
                $data ["artikel"] = $this->ArtikelModel->detail($id);
                echo "Sukses Update Artikel";
            }
            else
            {
                echo "Gagal Update Artikel";
            }
        }
        $this->load->view("FormUpdateView", $data);
    }
    public function hapus($id)
    {
        $kembali = base_url();
        $this->load->model("ArtikelModel");
        $hapus = $this->ArtikelModel->hapus($id);
        redirect($kembali);
    }
    
}
?>