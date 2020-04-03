<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email'))
        {
            redirect("auth/login");
        }

        $this->load->model('Verif_model');
    }

	public function index()
	{
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("template/dashboard");
        $this->load->view("template/footer");
    }

    public function kasus()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/kasus");
        $this->load->view("template/footer");
    }

    public function detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['panti'] = $this->Verif_model->verif_data_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_model->ubah_status_setuju($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan panti diterima !
            </div>');
            redirect('panti/verifikasi');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_model->ubah_status_tolak($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                        Persetujuan panti ditolak !
                        </div>');
            redirect('panti/verifikasi');
        }

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/detail_verifpanti",$data);
        $this->load->view("template/footer");
        
    }
}