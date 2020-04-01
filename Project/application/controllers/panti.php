<?php 


    class Panti extends CI_Controller {

        public function index(){
            $this->load->view("template/sidebar2");
            $this->load->view("template/header");
            $this->load->view("template/dashboard");
            $this->load->view("template/footer");
        }
        //buat panel admin
        public function verifikasi(){
            $this->load->view("template/sidebar");
            $this->load->view("template/header");
            $this->load->view("admin/verifpanti");
            $this->load->view("template/footer");
        }
    }
?>