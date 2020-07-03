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
        $this->load->model('Verif_Model');
        $this->load->model('Panti_Model', 'b');
        $this->load->model('Lokasi');
        $this->load->model('Akun_Model', 'z');
        $email = $this->session->userdata('email');
        // is_logged_in();
        $cek = $this->session->userdata('role_id');
      
        if($cek == '1'){
            redirect('auth/login');
        }
     
    }



    public function gantistatus()
    {
        $tz_object = new DateTimeZone('Asia/Jakarta');
        $datetime = new DateTime(); 
        $datetime->setTimezone($tz_object);
        $gettgl = $datetime->format('Y-m-d');
        $query = $this->db->query("UPDATE kasus set is_active = 2 WHERE status = 1 and tenggat_waktu like '%$gettgl%'");
        echo $query;
    }

    public function index()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['cekst'] = $this->db->get_where('registrasi',['status' => $this->session->userdata('email')])->row_array();
        $id_registrasi = $this->session->userdata('id_registrasi');
        $data['totkasus'] = $this->db->query("SELECT COUNT(kasus.id_kasus) AS jmlkasus FROM kasus JOIN panti ON kasus.id_panti= panti.id_panti 
        join registrasi ON panti.id_registrasi= registrasi.id_registrasi WHERE panti.id_panti = kasus.id_panti 
        AND panti.id_registrasi = '$id_registrasi'")->result_array();
        $this->load->view("template/sidebar2",$data);
        $this->load->view("template/header",$data);
        $this->load->view("template/dashboard_panti", $data);
        $this->load->view("template/footer");
    }

    public function listKasusPanti()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $id_registrasi = $this->session->userdata('id_registrasi');

        $data['kasus'] = $this->db->query("SELECT kasus.id_kasus, nama_panti, judul, tujuan_dana, jumlah_uang_terkumpul, tenggat_waktu, kasus.status, kasus.is_active FROM panti, kasus WHERE panti.id_panti = kasus.id_panti AND panti.id_registrasi = '$id_registrasi'")->result_array();
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->load->view("template/sidebar2", $data);
        $this->load->view("template/header",$data);
        $this->load->view("panti/list_kasus",$data);
        $this->load->view("template/footer");
        
    }

    public function kasus_detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['donasi'] = $this->db->query("SELECT kasus.judul, kasus.tujuan_dana, kasus.jumlah_uang_terkumpul, kasus.tenggat_waktu, user.nama_user, donasi.jumlah_donasi, donasi.tanggal FROM kasus, user, donasi WHERE kasus.id_kasus = donasi.id_kasus AND user.id_user = donasi.id_user AND kasus.id_kasus = $id")->result_array();

        $data['kasus'] = $this->db->query("SELECT judul, tujuan_dana, jumlah_uang_terkumpul, tenggat_waktu FROM kasus WHERE id_kasus = $id")->result_array();
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->load->view("template/sidebar2" ,$data);
        $this->load->view("template/header",$data);
        $this->load->view("panti/list_kasus_detail",$data);
        $this->load->view("template/footer");
    }


    public function detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $id_registrasi = $this->session->userdata('id_registrasi');

        $data['akun'] = $this->db->query("SELECT * FROM panti WHERE id_panti = '$id'")->result_array();
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->load->view("template/sidebar2",$data);
        $this->load->view("template/header",$data);
        $this->load->view("panti/akun_panti_detail",$data);
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
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == false) 
        {
            $this->load->view("template/sidebar2" ,$data);
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
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
    
            $this->load->library('upload' , $config);
            if ($this->upload->do_upload('foto')) {
                $foto_namaBaru = $this->upload->data('file_name');
                $dataPost = array(
                    'id_panti' =>$this->input->post('id_panti'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'gambar' => $foto_namaBaru,
                    'judul'=> $this->input->post('judul'),
                    'tujuan_dana' => $this->input->post('tujuan_dana'),
                    'tenggat_waktu' => $this->input->post('tenggat_waktu'),
                    'tanggal' => $this->input->post('tanggal'),
                    'deskripsi' =>$this->input->post('deskripsi'),
                    'status' => 0,
                    'is_active' => 0
                    
                );
                if ($this->b->insertkasus($dataPost)) {
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

        public function tambahpanti(){
       
            $this->form_validation->set_rules('nama_panti','Nama Panti','required');
            $this->form_validation->set_rules('alamat_panti','Alamat Panti','required');
            $this->form_validation->set_rules('no_telp','No Telepon','required');
            $this->form_validation->set_rules('nama_yayasanInduk','Nama Yayasan Induk','required');
            $this->form_validation->set_rules('nama_rekening','Nama Rekening','required');
            $this->form_validation->set_rules('no_rekening','No Rekening','required');
            $this->form_validation->set_rules('nama_bank','Nama Bank','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('surat_pengesahan','Surat Pengesahan','trim');
            $this->form_validation->set_rules('foto','Foto','trim');
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

            if ($this->form_validation->run() == false) {
                $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
                $this->session->userdata('email')])->row_array();
                $this->load->view("template/sidebar2" ,$data);
                $this->load->view("template/header",$data);
                $this->load->view("panti/tambah_panti");
                $this->load->view("template/footer");
            }else {
                $foto = $_FILES['foto']['name'];
            
    
                $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/panti/';
                $pdf = $_FILES['surat_pengesahan']['name'];
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload' , $config);
               
    
                if ($this->upload->do_upload('foto') && $this->upload->do_upload('surat_pengesahan') ) {
                    $foto_namaBaru = $this->upload->data('file_name');
                    $insert = array(
                        'nama_panti' => $this->input->post('nama_panti'),
                        'alamat_panti' => $this->input->post('alamat_panti'),
                        'no_telp' => $this->input->post('no_telp'),
                        'nama_yayasanInduk' => $this->input->post('nama_yayasanInduk'),
                        'nama_rekening' => $this->input->post('nama_rekening'),
                        'no_rekening' => $this->input->post('no_rekening'),
                        'nama_bank' => $this->input->post('nama_bank'),
                        'email' => $this->input->post('email'),
                        'tanggal_berdiri' => $this->input->post('tanggal_berdiri'),
                        'foto' => $foto_namaBaru,
                        'surat_pengesahan' => trim($pdf)
                    );
                    if ($this->b->insertdata($insert)) {
                        $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                        Panti Berhasil Ditambahkan
                        </div>');
                        redirect('panti');
                    }else{
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                        redirect('panti');
                    }	
                } else {
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                    . $this->upload->display_errors() .
                    '</div>');
                    redirect('panti');
                }
            }
        }

        //panel panti
        public function permintaan_verifikasi()
        {
            $this->form_validation->set_rules('nama_panti','Nama Panti','required');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('no_telp','No Telp','required');
            $this->form_validation->set_rules('ketua_panti','Ketua Panitia','required');
            $this->form_validation->set_rules('nama_rekening','Nama Rekening','required');
            $this->form_validation->set_rules('nama_bank','Nama Bank','required');
            $this->form_validation->set_rules('nomor_rekening','No Rekening','required');
            $this->form_validation->set_rules('deskripsi_panti','Deskripsi','required');
            $this->form_validation->set_rules('no_ktp','No KTP','required');
            $data['cekst'] = $this->db->get_where('registrasi',['status' => $this->session->userdata('email')])->row_array();

            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $data['data']=$this->Lokasi->getprovinsi();

            if ($this->form_validation->run() == false) {
                $this->load->view("template/sidebar2" , $data);
                $this->load->view("template/header",$data);
                $this->load->view("panti/permintaan_verifikasi",$data);
                $this->load->view("template/footer");
            }
            else 
            {
                // $foto = $_FILES['foto']['name'];
                // //$foto_ktp = $_FILES['foto_ktp']['name'];
                // $pdf = $_FILES['surat_pengesahan']['name'];
                // $pdf2 = $_FILES['ktp_pemilik']['name'];

                $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf';
                $config['max_size'] = '3000';
                $config['upload_path'] = './uploads/panti/';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

        
                $this->load->library('upload' , $config);


                if($this->upload->do_upload('ktp_pemilik') && $this->upload->do_upload('surat_pengesahan') && $this->upload->do_upload('foto'))
                {
                        if(!empty($_FILES['foto']))
                        {
                            //$this->load->library('upload' , $config);
                            $this->upload->do_upload('foto');
                            $data1 = $this->upload->data();
                            $file1 = $data1['file_name'];
                        }

                        if(!empty($_FILES['surat_pengesahan']))
                        {
                            //$this->load->library('upload' , $config);
                            $this->upload->do_upload('surat_pengesahan');
                            $data2 = $this->upload->data();
                            $file2 = $data2['file_name'];
                        }

                        if(!empty($_FILES['ktp_pemilik']))
                        {
                            //$this->load->library('upload' , $config);
                            $this->upload->do_upload('ktp_pemilik');
                            $data3 = $this->upload->data();
                            $file3 = $data3['file_name'];
                        }


                    if ($this->form_validation->run()) {
                        $dataPost = array(
                            'id_registrasi' =>$this->input->post('id'),
                            'nama_panti' => $this->input->post('nama_panti'),
                            'alamat_panti' => $this->input->post('alamat'),
                            'id_kabupaten' => $this->input->post('kabupaten'),
                            'id_provinsi' => $this->input->post('provinsi'),
                            'no_telp' => $this->input->post('no_telp'),
                            'nama_yayasanInduk' => $this->input->post('ketua_panti'),
                            'tanggal_berdiri' => $this->input->post('tgl'),
                            'foto' => $file1,
                            'nama_rekening' => $this->input->post('nama_rekening'),
                            'nama_bank' => $this->input->post('nama_bank'),
                            'no_rekening' =>$this->input->post('nomor_rekening'),
                            'ktp_pemilik' => $file3,
                            'no_ktp' => $this->input->post('no_ktp'),
                            'surat_pengesahan' => $file2,
                            'email' => $this->input->post('email'),
                            'deskripsi' => $this->input->post('deskripsi_panti'),
                            'status' => 0
                            
                        );
                        if ($this->b->insertdata($dataPost)) {
                            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                            Data Berhasil Dikirim , Silahkan Tunggu Konfirmasi Dari Admin Melalui E-mail Anda Yang Terdaftar.
                            </div>');
                            redirect('panti');
                        }else{
                            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                            redirect('panti');
                        }					
                    }
                }
                else
                {
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                    . $this->upload->display_errors() .'</div>');
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

        //edit akun
        public function profilpanti()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();

     //  $id_registrasi = $this->session->userdata('id_registrasi');
          // $data['akun'] = $this->db->query("SELECT foto, no_ktp, ktp_pemilik FROM panti WHERE id_registrasi = '$id_registrasi'")->result_array();


         //$data['akun'] = $this->db->query("SELECT nama_panti, email, tanggal_berdiri, foto FROM panti WHERE id_registrasi = '$id_registrasi'")->result_array();
         $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
         $this->session->userdata('email')])->row_array();

            $this->load->view("template/sidebar2" , $data);
            $this->load->view("template/header",$data);
            $this->load->view("panti/profilpanti",$data);
            $this->load->view("template/footer");
        }
      
        public function editdataakun($id)
        {
                      
            $this->form_validation->set_rules('nama','Ketua Panti','required');
          
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => $this->session->userdata('email')])->row_array();
            $akun['akun'] = $this->z->detail($id);
            if ($this->form_validation->run() == false) {
            
              $this->load->view("template/sidebar2",$data);
              $this->load->view("template/header",$data);
              $this->load->view("panti/akun_panti",$akun);
              $this->load->view("template/footer");
            
            }else{
               $update = $this->z->update(array(
                'email' => $this->input->post('email'),
                          'password' => md5($this->input->post('password')),
                          'nama' => $this->input->post('nama')
               ),$id);

               if ($update) {
                   
                $ubahfoto = $_FILES['profil']['name'];

                if ($ubahfoto) {
                    $config['allowed_types'] = 'jpg|png|gif|jpeg';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './uploads/akun/';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('profil')) {
                        $user = $this->db->get_where('registrasi', ['id_registrasi'=>$id])->row_array();
                        $fotolama = $user['profil'];
                        if ($fotolama) {
                            unlink(FCPATH . '/uploads/akun/' . $fotolama);
                        }
                        $fotobaru = $this->upload->data('file_name');
                        $this->db->set('profil', $fotobaru);
                        $this->db->where('id_registrasi', $id);
                        $this->db->update('registrasi');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                        redirect('panti/profilpanti');
                    }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Berhasil Mengubah Data!
            </div>');
            redirect('panti/profilpanti');
            }else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Gagal Mengubah Data!
                    </div>');
                redirect('panti/profilpanti');
            }
        }
    }

   

    public function detaildata() {
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        //$id_registrasi = $this->session->userdata('id_registrasi');
        //$data2['datapanti'] = $this->db->query("SELECT panti.nama_panti, panti.alamat_panti, panti.no_telp, panti.nama_yayasanInduk, panti.nama_rekening, panti.no_rekening, panti.nama_bank, panti.email, panti.ktp_pemilik FROM panti WHERE panti.id_registrasi = '$id_registrasi'")->result_array();
        $id_registrasi = $this->session->userdata('id_registrasi');
        $data['datapanti'] = $this->b->getDataPanti($id_registrasi);
     //$data['akun'] = $this->db->query("SELECT nama_panti, email, tanggal_berdiri, foto FROM panti WHERE id_registrasi = '$id_registrasi'")->result_array();

        $this->load->view("template/sidebar2",$data);
        $this->load->view("template/header",$data);
        $this->load->view("panti/detail_panti",$data);
        $this->load->view("template/footer");
            
    }

    public function editdata($id) {
        
        $this->form_validation->set_rules('nama_panti','Nama Panti','required');
        $this->form_validation->set_rules('alamat_panti','Alamat Panti','required');
        $this->form_validation->set_rules('no_telp','No Telepon','required');
        $this->form_validation->set_rules('nama_yayasanInduk','Nama Ketua Panti','required');
        $this->form_validation->set_rules('nama_rekening','Nama Rekening','required');
        $this->form_validation->set_rules('no_rekening','Nomor Rekening','required');
        $this->form_validation->set_rules('nama_bank','Nama Bank','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('no_ktp','Nomor KTP','required');

          
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => $this->session->userdata('email')])->row_array();
            $edit['please'] = $this->b->getDataPanti($id);
            if ($this->form_validation->run() == false) {
            
              $this->load->view("template/sidebar2",$data);
              $this->load->view("template/header",$data);
              $this->load->view("panti/edit_data",$edit);
              $this->load->view("template/footer");
            
            }else{
               $update = $this->b->gantiDatapanti(array(
                'email' => $this->input->post('email'),
                          'nama_panti' => $this->input->post('nama_panti'),
                          'alamat_panti' => $this->input->post('alamat_panti'),
                          'no_telp' => $this->input->post('no_telp'),
                          'nama_yayasanInduk' => $this->input->post('nama_yayasanInduk'),
                          'nama_rekening' => $this->input->post('nama_rekening'),
                          'no_rekening' => $this->input->post('no_rekening'),
                          'nama_bank' => $this->input->post('nama_bank'),
                          'no_ktp' => $this->input->post('no_ktp')
                          ), $id);

               if ($update) {
                   
                $ubahfoto = $_FILES['ktp_pemilik']['name'];

                if ($ubahfoto) {
                    $config['allowed_types'] = 'jpg|png|gif|jpeg';
                    $config['max_size'] = '3000';
                    $config['upload_path'] = 'uploads/panti';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('ktp_pemilik')) {
                        $user = $this->db->get_where('registrasi', ['id_registrasi'=>$id])->row_array();
                        $fotolama = $user['ktp_pemilik'];
                        if ($fotolama) {
                            unlink(FCPATH . '/uploads/panti/' . $fotolama);
                        }
                        $fotobaru = $this->upload->data('file_name');
                        $this->db->set('ktp_pemilik', $fotobaru);
                        $this->db->where('id_registrasi', $id);
                        $this->db->update('panti');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                        redirect('panti/detaildata');
                    }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Berhasil Mengubah Data!
            </div>');
            redirect('panti/detaildata');
            }else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Gagal Mengubah Data!
                    </div>');
                redirect('panti/detaildata');
            }
        }
            
    }
} 

?>