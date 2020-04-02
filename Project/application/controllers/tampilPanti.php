<?php
class tampilPanti extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();	
        if(!$this->session->userdata('email'))
        {
            redirect("auth/login");
        }	
        $this->load->model('Panti_model');
	}
    function index()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $data_panti['panti'] = $this->Panti_model->tampil_data_panti();
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/panti", $data_panti);
        $this->load->view("template/footer");
    }
    
}

?>