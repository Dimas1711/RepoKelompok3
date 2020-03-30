<?php 

class Home extends CI_Controller{
    public function index(){
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" =>$this->ArtikelModel->get()
        );
        $this->load->view("HomeView" , $data);
    }   
    public function detail($id){
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->detail($id)
        );
        $this->load->view("DetailView",$data);
    }
    
    public function tambah(){ 
        $this->load->model("ArtikelModel");
        if($this->input->method() == "post"){
            $insert = $this->ArtikelModel->tambah(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'artikel' => date("Y-m-d H:i:s")
            ));
            if ($insert) {
                echo "Berhasil Tambah Data";
            }else {
                echo "Gagal Input Data";
            }
        }
        $this->load->view("FormView");
     
    }
    public function update($id)
    {
        $this->load->model("ArtikelModel");
        $data ["artikel"] = $this->ArtikelModel->detail($id);
        if($this->input->method() == "post")
        {
            $update = $this->ArtikelModel->update(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'artikel' => date ("Y-m-s H:i:s")
            ),$id);
            if($update)
            {
                echo "Sukses Update Artikel";
            }
            else
            {
                echo "Gagal Update Artikel";
            }
        }
        $this->load->view("EditView", $data);
    }

    public function ubah($id){ 
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->ubah($id)
        );
        $this->load->view("EditView",$data);
    }
    public function hapus($id){
        
        $this->load->model("ArtikelModel");
        $hapus = $this->ArtikelModel->hapus($id);
        if($hapus){
            echo "Berhasil Hapus";
            redirect('');
        }

       
    }
}

?>