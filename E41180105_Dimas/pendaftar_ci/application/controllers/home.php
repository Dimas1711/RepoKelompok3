<?php
class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model("pendaftar");
        $data = array(
            "pendaftar" => $this->pendaftar->get()
        );
        $this->load->view("template/header");
        $this->load->view("home", $data);
        $this->load->view("template/footer");
    }
    
}
?>