<?php 
    class Panti extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email'))
        {
            redirect("auth/login");
        }
        $this->load->model('Verif_model');
        $this->load->model('Panti_model');
    }

        public function index()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $this->load->view("template/sidebar2");
            $this->load->view("template/header",$data);
            $this->load->view("template/dashboard");
            $this->load->view("template/footer");
        }
        //buat panel admin
        public function verifikasi()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            
            $verif_panti['verif'] = $this->Verif_model->verif_data_panti();
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/verifpanti",$verif_panti);
            $this->load->view("template/footer");
        }

        public function addKasus()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

            $data_panti['data'] = $this->Panti_model->data_panti();
            $this->load->view("template/sidebar2");
            $this->load->view("template/header",$data);
            $this->load->view("panti/tambah_kasus",$data_panti);
            $this->load->view("template/footer");
        }
}
?>