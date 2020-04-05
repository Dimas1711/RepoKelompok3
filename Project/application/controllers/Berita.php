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
           
            
            $this->form_validation->set_rules('judul','Judul','required');
            $this->form_validation->set_rules('isi','Isi','required');
            $this->form_validation->set_rules('tgl','Tanggal','required');
          
            if ($this->form_validation->run() == false) {
                $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
                $this->session->userdata('email')])->row_array();
                $this->load->view("template/sidebar");
                $this->load->view("template/header",$data);
                $this->load->view("admin/berita/tambahberita");
                $this->load->view("template/footer");
            }else {
                $gambar = $_FILES['gambar']['name'];

                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/berita';

                
                $this->load->library('upload' , $config);

                if ($this->upload->do_upload('gambar')) {
                    $insert = array(
                        'judul' => $this->input->post('judul'),
                        'isi' => $this->input->post('isi'),
                        'tanggal_berita' => $this->input->post('tgl'),
                        'gambar' => $gambar
                    );
                    if ($this->b->insertdata($insert)) {
                        $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                        Berita Berhasil Ditambahkan
                        </div>');
                        redirect('berita');
                    }else{
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                        redirect('berita');
                    }	
                } else {
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                    . $this->upload->display_errors() .
                    '</div>');
                    redirect('berita');
                }
            }
           
        }

}