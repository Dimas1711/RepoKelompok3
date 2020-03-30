<?php
class Home extends CI_Controller
{
    public function index()
    {   
        // $this->load->view("template/header");
        $this->load->view("template/tes");
        $this->load->view("home");
        $this->load->view("template/footer");
    }
}
?>