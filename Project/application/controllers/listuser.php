<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListUser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if(!$this->session->userdata('email'))
        {
            redirect("auth/login");
        }

        $this->load->model('Dede');
        // $this->load->model('Dede' , 'c');
        is_logged_in();
        // is_logged_in();
   //     if($cek == '2'){
            //redirect('auth/login');
        
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
    // public function delete($id_user)
    // {
    //     $data['registrasi'] = $this->db->get_where('registrasi',
    //     ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model("Dede");
    //     $delete = array('user' => $this->Dede->delete($id_user));
    //    $kembali = site_url("listuser");
    //    redirect($kembali);
    // }

    public function delete($id){
        $data = $this->Dede->delete($id);

        if ($data) {
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                    Data Berhasil Dihapus
            </div>');
            redirect('listuser');
        }else {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
                    Data Gagal Dihapus
            </div>');
            redirect('listuser');
        }
    }

    
   
}