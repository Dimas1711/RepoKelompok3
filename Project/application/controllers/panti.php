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
        $this->load->model('Lokasi');
    }

        public function index()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $this->load->view("template/sidebar2");
            $this->load->view("template/header",$data);
            $this->load->view("template/dashboard_panti");
            $this->load->view("template/footer");
        }

        public function listKasusPanti()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

            $id_registrasi = $this->session->userdata('id_registrasi');

            $data['kasus'] = $this->db->query("SELECT kasus.id_kasus, nama_panti, judul, tujuan_dana, jumlah_uang_terkumpul, tenggat_waktu, kasus.status FROM panti, kasus WHERE panti.id_panti = kasus.id_panti AND panti.id_registrasi = $id_registrasi AND kasus.status = 1")->result_array();

            $this->load->view("template/sidebar2");
            $this->load->view("template/header",$data);
            $this->load->view("panti/list_kasus",$data);
            $this->load->view("template/footer");
            
        }

        public function kasus_detail($id)
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

            $data['kasus'] = $this->db->query("SELECT kasus.judul, kasus.tujuan_dana, kasus.jumlah_uang_terkumpul, kasus.tenggat_waktu, user.nama_user, donasi.jumlah_donasi, donasi.tanggal FROM kasus, user, donasi WHERE kasus.id_kasus = donasi.id_kasus AND user.id_user = donasi.id_user AND kasus.id_kasus = $id")->result_array();

            $this->load->view("template/sidebar2");
            $this->load->view("template/header",$data);
            $this->load->view("panti/list_kasus_detail",$data);
            $this->load->view("template/footer");
        }

        public function addKasus()
        {
            
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

            $data['panti'] = $this->db->get_where('panti',['id_registrasi' => 
            $this->session->userdata('id_registrasi')])->row_array();

            $data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

            $this->form_validation->set_rules('judul','Judul','required|trim');
            $this->form_validation->set_rules('tujuan_dana','Tujuan dana','required|trim');
            $this->form_validation->set_rules('tanggal','Tanggal','required|trim');
            $this->form_validation->set_rules('tenggat_waktu','Tenggat waktu','required|trim');
            $this->form_validation->set_rules('deskripsi','Deskripsi','required|trim');

            if ($this->form_validation->run() == false) 
            {
                $this->load->view("template/sidebar2");
                $this->load->view("template/header",$data);
                $this->load->view("panti/tambah_kasus",$data);
                $this->load->view("template/footer");
            }
            else
            {
                $foto = $_FILES['foto']['name'];

                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/panti';
        
                $this->load->library('upload' , $config);
                if ($this->upload->do_upload('foto')) {
                    $dataPost = array(
                        'id_panti' =>$this->input->post('id_panti'),
                        'id_kategori' => $this->input->post('id_kategori'),
                        'gambar' => $foto,
                        'judul'=> $this->input->post('judul'),
                        'tujuan_dana' => $this->input->post('tujuan_dana'),
                        'tenggat_waktu' => $this->input->post('tenggat_waktu'),
                        'tanggal' => $this->input->post('tanggal'),
                        'status' => 0
                        
                    );
                    if ($this->Panti_model->insertkasus($dataPost)) {
                        $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                        Data Kasus Berhasil Dikirim , Silahkan Tunggu Konfirmasi Dari Admin
                        </div>');
                        redirect('panti');
                    }else{
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                        redirect('panti');
                    }					
                }
                else{
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                        redirect('panti');
                }

            }

        }

        //panel panti
        public function permintaan_verifikasi(){
            $this->form_validation->set_rules('nama_panti','Nama Panti','required');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('no_telp','No Telp','required');
            $this->form_validation->set_rules('ketua_panti','Ketua Panitia','required');
            $this->form_validation->set_rules('nama_rekening','Nama Rekening','required');
            $this->form_validation->set_rules('nama_bank','Nama Bank','required');
            $this->form_validation->set_rules('nomor_rekening','No Rekening','required');
            $this->form_validation->set_rules('deskripsi_panti','Deskripsi','required');
		
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $data['data']=$this->Lokasi->getprovinsi();

            if ($this->form_validation->run() == false) {
                $this->load->view("template/sidebar2");
                $this->load->view("template/header",$data);
                $this->load->view("panti/permintaan_verifikasi",$data);
                $this->load->view("template/footer");
            }else {
                $foto = $_FILES['foto']['name'];

                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/panti';
        
                $this->load->library('upload' , $config);
                if ($this->upload->do_upload('foto')) {
                    $dataPost = array(
                        'id_registrasi' =>$this->input->post('id'),
                        'nama_panti' => $this->input->post('nama_panti'),
                        'alamat_panti' => $this->input->post('alamat'),
                        'id_kabupaten' => $this->input->post('kabupaten'),
                        'id_provinsi' => $this->input->post('provinsi'),
                        'no_telp' => $this->input->post('no_telp'),
                        'nama_yayasanInduk' => $this->input->post('ketua_panti'),
                        'tanggal_berdiri' => $this->input->post('tgl'),
                        'foto' => $foto,
                        'nama_rekening' => $this->input->post('nama_rekening'),
                        'nama_bank' => $this->input->post('nama_bank'),
                        'no_rekening' =>$this->input->post('nomor_rekening'),
                        'email' => $this->input->post('email'),
                        'deskripsi' => $this->input->post('deskripsi_panti'),
                        'status' => 0
                        
                    );
                    if ($this->Panti_model->insertdata($dataPost)) {
                        $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                        Data Berhasil Dikirim , Silahkan Tunggu Konfirmasi Dari Admin
                        </div>');
                        redirect('panti');
                    }else{
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                        redirect('panti');
                    }					
                }
                else{
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                        redirect('panti');
                }
    
            }
        }
    
           //panel panti
        function get_subkategori(){
            $id=$this->input->post('id_provinsi');
            $data=$this->Lokasi->getkabupaten($id);
            echo json_encode($data);
        }

        //add data
      
        
}
?>