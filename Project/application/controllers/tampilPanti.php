<?php
class tampilPanti extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Panti_model' , 'b');
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
                  
        $this->form_validation->set_rules('nama_panti','nama_panti','required');
        $this->form_validation->set_rules('alamat_panti','alamat_panti','required');
        $this->form_validation->set_rules('no_telp','no_telp','required');
        $this->form_validation->set_rules('nama_yayasanInduk','nama_yayasanInduk','required');
        $this->form_validation->set_rules('nama_rekening','nama_rekening','required');
        $this->form_validation->set_rules('no_rekening','no_rekening','required');
        $this->form_validation->set_rules('nama_bank','nama_bank','required');
        $this->form_validation->set_rules('email','email','required');
      
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
               
            $ubahfoto = $_FILES['gambar']['name'];

            if ($ubahfoto) {
                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/listpanti/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $user = $this->db->get_where('listpanti', ['id_panti'=>$id])->row_array();
                    $fotolama = $user['gambar'];
                    if ($fotolama) {
                        unlink(FCPATH . '/uploads/listpanti/' . $fotolama);
                    }
                    $fotobaru = $this->upload->data('file_name');
                    $this->db->set('gambar', $fotobaru);
                    $this->db->where('id_panti', $id);
                    $this->db->update('listpanti');
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
       
        $this->form_validation->set_rules('nama_panti','nama_panti','required');
        $this->form_validation->set_rules('alamat_panti','alamat_panti','required');
        $this->form_validation->set_rules('no_telp','no_telp','required');
        $this->form_validation->set_rules('nama_yayasanInduk','nama_yayasanInduk','required');
        $this->form_validation->set_rules('nama_rekening','nama_rekening','required');
        $this->form_validation->set_rules('no_rekening','no_rekening','required');
        $this->form_validation->set_rules('nama_bank','nama_bank','required');
        $this->form_validation->set_rules('email','email','required');
      
        if ($this->form_validation->run() == false) {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("ListPanti/tambah_panti");
            $this->load->view("template/footer");
        }else {
            $gambar = $_FILES['gambar']['name'];

            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './uploads/listpanti';

            
            $this->load->library('upload' , $config);

            if ($this->upload->do_upload('gambar')) {
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
                    'gambar' => $gambar
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