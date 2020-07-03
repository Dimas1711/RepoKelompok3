<?php
class TampilPanti extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Panti_Model' , 'b');
        is_logged_in();
 //       if($cek == '2'){
          //  redirect('auth/login');
        }
    

    public function index(){
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => $this->session->userdata('email')])->row_array();
            $data['listpanti'] = $this->b->index_get();
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("ListPanti/listpanti",$data);
            $this->load->view("template/footer");
    }

    public function detailpanti($id){
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $listpanti['listpanti'] = $this->b->detail($id);
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("ListPanti/detail_panti" ,$listpanti);
        $this->load->view("template/footer");
    }

    public function editdata($id){
                  
        $this->form_validation->set_rules('nama_panti','Nama Panti','required');
        $this->form_validation->set_rules('alamat_panti','Alamat Panti','required');
        $this->form_validation->set_rules('no_telp','No Telepon','required');
        $this->form_validation->set_rules('nama_yayasanInduk','Nama Yayasan Induk','required');
        $this->form_validation->set_rules('nama_rekening','Nama Rekening','required');
        $this->form_validation->set_rules('no_rekening','No Rekening','required');
        $this->form_validation->set_rules('nama_bank','Nama Bank','required');
        $this->form_validation->set_rules('email','Email','required');
      
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $listpanti['listpanti'] = $this->b->detail($id);
        if ($this->form_validation->run() == false) {
        
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("ListPanti/edit_panti" ,$listpanti);
            $this->load->view("template/footer");
        
        }else{
           $update = $this->b->update(array(
            'nama_panti' => $this->input->post('nama_panti'),
            'alamat_panti' => $this->input->post('alamat_panti'),
            'no_telp' => $this->input->post('no_telp'),
            'nama_yayasanInduk' => $this->input->post('nama_yayasanInduk'),
            'nama_rekening' => $this->input->post('nama_rekening'),
            'no_rekening' => $this->input->post('no_rekening'),
            'nama_bank' => $this->input->post('nama_bank'),
            'email' => $this->input->post('email'),
            'tanggal_berdiri' => $this->input->post('tanggal_berdiri')
           ),$id);

           if ($update) {
               
            $ubahfoto = $_FILES['foto']['name'];
            $ubahpdf = $_FILES['surat_pengesahan']['name'];

            if ($ubahfoto) {
                $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/listpanti/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $user = $this->db->get_where('panti', ['id_panti'=>$id])->row_array();
                    $fotolama = $user['foto'];
                    if ($fotolama) {
                        unlink(FCPATH . '/uploads/listpanti/' . $fotolama);
                    }
                    $fotobaru = $this->upload->data('file_name');
                    $this->db->set('foto', $fotobaru);
                    $this->db->where('id_panti', $id);
                    $this->db->update('panti');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
                    . $this->upload->display_errors() .
                    '</div>');
                    redirect('tampilPanti');
                }
        }elseif ($ubahpdf) {
            $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf';
            $config['max_size'] = '2048';
            $config['upload_path'] = './uploads/listpanti/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('surat_pengesahan')) {
                $user = $this->db->get_where('panti', ['id_panti'=>$id])->row_array();
                $fotolama = $user['surat_pengesahan'];
                if ($fotolama) {
                    unlink(FCPATH . '/uploads/listpanti/' . $fotolama);
                }
                $fotobaru = $this->upload->data('file_name');
                $this->db->set('surat_pengesahan', $fotobaru);
                $this->db->where('id_panti', $id);
                $this->db->update('panti');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
                . $this->upload->display_errors() .
                '</div>');
                redirect('tampilPanti');
            }
            }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Berhasil Mengubah Data!
        </div>');
        redirect('tampilPanti');
        }else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gagal Mengubah Data!
                </div>');
            redirect('tampilPanti');
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
      
        if ($this->form_validation->run() == false) {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("ListPanti/tambah_panti");
            $this->load->view("template/footer");
        }else {
            $foto = $_FILES['foto']['name'];
        

            $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf';
            $config['max_size'] = '2048';
            $config['upload_path'] = './uploads/listpanti/';
            $pdf = $FILES['surat_pengesahan']['name'];
            
            $this->load->library('upload' , $config);
           

            if ($this->upload->do_upload('foto') && $this->upload->do_upload('surat_pengesahan') ) {
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
                    'foto' => $foto,
                    'surat_pengesahan' => trim($pdf)
                );
                if ($this->b->insertdata($insert)) {
                    $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                    Panti Berhasil Ditambahkan
                    </div>');
                    redirect('tampilPanti');
                }else{
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
                    redirect('tampilPanti');
                }	
            } else {
                $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
                . $this->upload->display_errors() .
                '</div>');
                redirect('tampilPanti');
            }
        }
       
    }
    public function hapus($id){
        $data = $this->b->hapusdata($id);

        if ($data) {
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                    Data Berhasil Dihapus
            </div>');
            redirect('tampilPanti');
        }else {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
                    Data Gagal Dihapus
            </div>');
            redirect('tampilPanti');
        }
    }
}

?>