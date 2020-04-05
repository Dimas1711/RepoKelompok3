<?php 


class Berita extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('Berita_model' , 'b');
        }

        public function index(){
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $data['berita'] = $this->b->index_get();
            
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/berita/berita" ,$data);
            $this->load->view("template/footer");
        }
        public function tambahberita(){
           
            
            $this->form_validation->set_rules('judul','judul','required');
          
            if ($this->form_validation->run() == false) {
                $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
                $this->session->userdata('email')])->row_array();
                $this->load->view("template/sidebar");
                $this->load->view("template/header",$data);
                $this->load->view("admin/berita/tambahberita");
                $this->load->view("template/footer");
            }else {
                echo "sukses";
            }
           
        }

}