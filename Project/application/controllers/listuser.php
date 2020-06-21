<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class listuser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email'))
        {
            redirect("auth/login");
        }

        $this->load->model('Dede');
    }
    
    public function index()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $data_user['user'] = $this->Dede->get();
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("ListUser/listuser",$data_user);
        $this->load->view("template/footer");

        
    }

    public function detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();
        $data_userr['user'] = $this->Dede->detail($id);
        if (count($data_userr["user"])<1)
            {
                redirect("listuser");
            }
        $data_userr["user"] = $data_userr["user"][0];

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("ListUser/detail",$data_userr);
        $this->load->view("template/footer");
        
    }
    public function delete($id_user)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model("Dede");
        $delete = array('user' => $this->Dede->delete($id_user));
       $kembali = site_url("listuser");
       redirect($kembali);
    }

    
   
}