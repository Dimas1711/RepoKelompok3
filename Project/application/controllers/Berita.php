<?php 


class Berita extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('Berita_Model' , 'b');
            is_logged_in();
            if($cek == '2'){
                redirect('auth/login');
            }
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
        public function detailberita($id){
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $berita['berita'] = $this->b->detail($id);
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/berita/detail_berita" ,$berita);
            $this->load->view("template/footer");
        }

        public function editdata($id){
                      
            $this->form_validation->set_rules('judul','Judul','required');
            $this->form_validation->set_rules('isi','Isi','required');
          
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $berita['berita'] = $this->b->detail($id);
            if ($this->form_validation->run() == false) {
            
                $this->load->view("template/sidebar");
                $this->load->view("template/header",$data);
                $this->load->view("admin/berita/editberita" ,$berita);
                $this->load->view("template/footer");
            
            }else{
               $update = $this->b->update(array(
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'tanggal_berita' => $this->input->post('tgl')
               ),$id);

               if ($update) {
                   
                $ubahfoto = $_FILES['gambar']['name'];

                if ($ubahfoto) {
                    $config['allowed_types'] = 'jpg|png|gif|jpeg';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './uploads/berita/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('gambar')) {
                        $user = $this->db->get_where('berita', ['id_berita'=>$id])->row_array();
                        $fotolama = $user['gambar'];
                        if ($fotolama) {
                            unlink(FCPATH . '/uploads/berita/' . $fotolama);
                        }
                        $fotobaru = $this->upload->data('file_name');
                        $this->db->set('gambar', $fotobaru);
                        $this->db->where('id_berita', $id);
                        $this->db->update('berita');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                        redirect('berita');
                    }
			}
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			Berhasil Mengubah Data!
			</div>');
			redirect('berita');
            }else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Gagal Mengubah Data!
                    </div>');
                redirect('berita');
            }
        }
    }

        public function tambahberita(){
           
            
            $this->form_validation->set_rules('judul','Judul','required');
            $this->form_validation->set_rules('isi','Isi','required');
          
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
                    $foto_namaBaru = $this->upload->data('file_name');
                    $insert = array(
                        'judul' => $this->input->post('judul'),
                        'isi' => $this->input->post('isi'),
                        'tanggal_berita' => $this->input->post('tgl'),
                        'gambar' => $foto_namaBaru
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
        public function hapus($id){
            $data = $this->b->hapusdata($id);

            if ($data) {
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
						Data Berhasil Dihapus
                </div>');
                redirect('berita');
            }else {
                $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
						Data Gagal Dihapus
                </div>');
                redirect('berita');
            }
        }

}