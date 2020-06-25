<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email'))
        {
            redirect("Auth/Login");
        }

        $this->load->model('Verif_Model');
        $this->load->model('Kasus_Model');
        $this->load->model('Topup_Model');
        $this->load->model('Dede');

    }

	public function index()
	{
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['hasil'] = $this->db->query("select sum(tbl.hasil)
        from(select count(status) as hasil from kasus WHERE status = 0 UNION ALL select count(status) as hasil from panti WHERE status = 0 UNION ALL select count(status) as hasil from dompet WHERE status = 0 ) tbl")->row_array();
        $data['task'] = $this->db->query("select sum(tbl.hasil)
        from(select count(status) as hasil from kasus WHERE status = 1 UNION ALL select count(status) as hasil from kasus WHERE status = 2 ) tbl")->row_array();
        $data['jumlah'] = $this->db->query("SELECT SUM(jumlah_donasi) FROM donasi")->row_array();
        $data['kasus'] = $this->db->query("select count(status) as hasil from kasus WHERE status = 0")->row_array();
        $data['panti'] = $this->db->query("select count(status) as hasil from panti WHERE status = 0")->row_array();
        $data['dompet'] = $this->db->query("select count(status) as hasil from dompet WHERE status = 0")->row_array();
        $data['activepanti'] = $this->db->query("select count(status) as hasil from panti WHERE status = 1")->row_array();
        $data['kasus1'] = $this->db->query("select count(is_active) as hasil from kasus WHERE is_active = 1")->row_array();
        $data['kasus2'] = $this->db->query("select count(is_active) as hasil from kasus WHERE is_active = 2")->row_array();
        $data['kasus3'] = $this->db->query("select count(is_active) as hasil from kasus WHERE is_active = 0")->row_array();
        $data['activeuser'] = $this->db->query("SELECT count(*) AS jumlah FROM user")->row_array();

        // $data['piechart']=$this->db->query("select count(is_active) from kasus WHERE is_active = 2 UNION ALL select count(is_active) from kasus WHERE is_active = 1 UNION ALL select count(is_active) from kasus WHERE is_active = 0")->row_array();
        

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("template/dashboard",$data);
        $this->load->view("template/footer");
    }

    public function settingakun(){

        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->Verif_Model->index_admin();
        
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/setting/setting" , $data);
        $this->load->view("template/footer");
    }

    public function profil(){

        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->Verif_Model->index_admin();
        
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/setting/profil" , $data);
        $this->load->view("template/footer");
    }

    public function data_bank(){

        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->Verif_Model->databank();
        
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/setting/akun_bank" , $data);
        $this->load->view("template/footer");
    }
    public function insertdata(){
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_rekening', 'Nama Rekening' , 'required');
        $this->form_validation->set_rules('no_rekening', 'Nomor Rekening' , 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank' , 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/setting/tambah_finansial" , $data);
            $this->load->view("template/footer");
        }else{

            $data = $this->Verif_Model->insertdata(array(
                'id_admin' => '5',
                'nama_rekening' => $this->input->post('nama_rekening'),
                'no_rekening' => $this->input->post('no_rekening'),
                'nama_bank' => $this->input->post('nama_bank')
            ));
            if ($data) {
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                Berita Berhasil Ditambahkan
                </div>');
                redirect('admin/data_bank');
            }else{
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                Berita Berhasil Ditambahkan
                </div>');
                redirect('admin/data_bank');
            }
        }
       
    }
    public function hapus($id){
        $data = $this->Verif_Model->hapusdata($id);

        if ($data) {
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                    Data Berhasil Dihapus
            </div>');
            redirect('admin/data_bank');
        }else {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
                    Data Gagal Dihapus
            </div>');
            redirect('admin/data_bank');
        }
    }
    public function edit_bank($id){
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_rekening', 'Nama Rekening' , 'required');
        $this->form_validation->set_rules('no_rekening', 'Nomor Rekening' , 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank' , 'required');

        if ($this->form_validation->run() == false) {
            $data['admin'] = $this->Verif_Model->detail_finansial($id);
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/setting/edit_finansial" , $data);
            $this->load->view("template/footer");
        }else {
            $update = $this->Verif_Model->update_finansial(array(
                'nama_rekening' => $this->input->post('nama_rekening'),
                'no_rekening' => $this->input->post('no_rekening'),
                'nama_bank' => $this->input->post('nama_bank')
            ),$id);
            if ($update) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			    Berhasil Mengubah Data!
			    </div>');
			    redirect('admin/data_bank');
            }else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			    Gagal Mengubah Data!
			    </div>');
			    redirect('admin/data_bank');
            }
        }
       
    }

    public function detail_setting($id){
        $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->Verif_Model->detail_admin($id);
        
        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/setting/detail_setting" , $data);
        $this->load->view("template/footer");
    }
    public function kasus()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['kasus'] = $this->Kasus_Model->tampil_kasus();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/kasus",$data);
        $this->load->view("template/footer");
    }

    public function verif_kasus()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['kasus'] = $this->Kasus_Model->tampil_verif_kasus();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/verif_kasus",$data);
        $this->load->view("template/footer");
    }

    public function verif_topup()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $dataa['dompet'] = $this->Topup_Model->tampil_verif_topup();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/veriftopup",$dataa);
        $this->load->view("template/footer");
    }

    public function verif_kasus_detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['kasus'] = $this->Verif_Model->verif_kasus_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_Model->ubah_status_setuju_kasus($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan kasus donasi diterima !
            </div>');
            redirect('admin/verif_kasus');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_Model->ubah_status_tolak_kasus($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                        Persetujuan kasus donasi ditolak !
                        </div>');
            redirect('admin/verif_kasus');
        }

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/kasus_detail",$data);
        $this->load->view("template/footer");
    }

    public function verif_topup_detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $dataa['dompet'] = $this->Verif_Model->verif_topup_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_Model->ubah_status_setuju_topup($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan top up donatur diterima !
            </div>');
            redirect('admin/verif_topup');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_Model->ubah_status_tolak_topup($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                        Persetujuan top up donatur ditolak !
                        </div>');
            redirect('admin/verif_topup');
        }

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/topup_detail",$dataa);
        $this->load->view("template/footer");
    }

    public function detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['panti'] = $this->Verif_Model->verif_data_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->send_mail_aktif();
            $this->Verif_Model->ubah_status_setuju($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan panti diterima !
            </div>');
            redirect('admin/verifikasi_panti');
        }
        else if(isset($_POST['tolak']))
        {
            $this->send_mail_failed();
            $this->Verif_Model->ubah_status_tolak($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                        Persetujuan panti ditolak !
                        </div>');
            redirect('admin/verifikasi_panti');
        }

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/detail_verifpanti",$data);
        $this->load->view("template/footer");
        
    }
    public function send_mail_aktif() { 

        $from_email = "donasiyatimk3@gmail.com"; 
        $to_email = $this->input->post('email'); 

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'donasiyatimk3@gmail.com',
            'smtp_pass' => 'IbanezRG1',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
    );
    $this->email->initialize($config);
    $this->email->from('donasiyatimk3@gmail.com','Donasi Panti');//pengirim
    $this->email->to($to_email);
    $this->email->subject('Activation Your Account From DonasiYatim');
    $this->email->message('Congrats Your Account Has been Active ,  Please Login :) ');

    if ($this->email->send()) {
        return true;
    }else {
        echo $this->email->print_debugger();
        die;
    }
    }
    public function send_mail_failed() { 

        $from_email = "donasiyatimk3@gmail.com"; 
        $to_email = $this->input->post('email'); 

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'donasiyatimk3@gmail.com',
            'smtp_pass' => 'IbanezRG1',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
    );
    $this->email->initialize($config);
    $this->email->from('donasiyatimk3@gmail.com','Donasi Panti');//pengirim
    $this->email->to($to_email);
    $this->email->subject('Activation Your Account From Donasi Yatim');
    $this->email->message('Sorry Your Account Hasbeen Disabled from Admin , Please Register');

    if ($this->email->send()) {
        return true;
    }else {
        echo $this->email->print_debugger();
        die;
    }
}


    public function verifikasi_panti()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            
            // $data['verif_acc'] = $this->Verif_model->verif_data_panti();

            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/verifpanti",$data);
            $this->load->view("template/footer");
        }

     public function hapus_panti($id)
    {
        $data = $this->Verif_Model->hapusdatapanti($id);
        if ($data) 
        {
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
                    Data Berhasil Dihapus
            </div>');
            redirect('admin/verifikasi_panti');
        }else {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
                    Data Gagal Dihapus
            </div>');
            redirect('admin/verifikasi_panti');
        }
    }   


    function get_status_verifpanti()
    {
        $status = $_GET['status'];
        if($status == 3)
        {
            $data = $this->db->query("SELECT * FROM panti")->result_array();
        }
        else
        {
            $data = $this->db->query("SELECT * FROM panti WHERE status = '$status' ")->result_array();
        }
        if(!empty($data))
        {
            $no = 1;
            foreach($data as $row){
            ?>
             <tr>
               <td><?= $no++?></td>
               <td><?= $row['nama_panti']?></td>
               <td><?= $row['no_telp']?></td>
               <td><?= $row['email']?></td>
               <td><?= $row['alamat_panti']?></td>
               <td><?php if ($row['status'] == 0) {
                 echo '<div class="badge badge-primary badge-pill">Pending</div>';
               } elseif ($row['status'] == 1) {
                 echo '<div class="badge badge-success badge-pill">Aktif</div>';
               }elseif ($row['status'] == 2) {
                 echo '<div class="badge badge-danger badge-pill">Cancel</div>';
               }
                ?></td>
               <td>
                 <a href="<?php echo base_url("admin/detail/" .$row['id_panti']);?>"
                    class="btn btn-sm btn-primary btn-circle">
                   <i class="fas fa-plus"></i>
                 </a>
                 <a href="#"
                    onclick="confirm_modal('<?= 'hapus_panti/'.$row['id_registrasi'] ?>')"
                    class="btn btn-sm btn-danger btn-circle"
                    data-toggle="modal" data-target="#hapusModal">
                   <i class="fa fa-trash"></i>
                 </a>
               </td>
             </tr>
             <?php }?> <?php
        }
        else
        {
            ?>
                <tr><td colspan="6" align="center">Tidak ada data</td></tr>
            <?php
        }               
    }


    function get_status_donasi()
    {
        $status = $_GET['status'];
        if($status == 3)
        {
            $data = $this->db->query("SELECT kasus.id_kasus, kasus.judul, kasus.gambar, panti.nama_panti, kategori.kategori, kasus.status FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori")->result_array();
        }
        else
        {
            $data = $this->db->query("SELECT kasus.id_kasus, kasus.judul, kasus.gambar, panti.nama_panti, kategori.kategori, kasus.status FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori AND kasus.status = '$status'")->result_array();
        }
        if(!empty($data))
        {
            $no = 1;
             foreach($data as $row){
             ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $row['nama_panti']?></td>
                <td><?= $row['judul']?></td>
                <td><?= $row['kategori']?></td>
                <td><?php if ($row['status'] == 0) {
                  echo '<div class="badge badge-primary badge-pill">Pending</div>';
                } elseif ($row['status'] == 1) {
                  echo '<div class="badge badge-success badge-pill">Aktif</div>';
                }elseif ($row['status'] == 2) {
                  echo '<div class="badge badge-danger badge-pill">Cancel</div>';
                }
                 ?></td>
                <td><img src="<?=base_url('uploads/panti/') . $row['gambar']?>" alt="gambar" width="100"></td>
                <td>
                <a href="<?php echo base_url("admin/verif_kasus_detail/" .$row['id_kasus']);?>"
                     class="btn btn-sm btn-primary btn-circle">
                    <i class="fas fa-plus"></i>
                  </a>
                </td>
            </tr>
             <?php }?> <?php  
        }
        else
        {
            ?>
                <tr><td colspan="6" align="center">Tidak ada data</td></tr>
            <?php
        }  
    }

    function get_status_topup()
    {
        $status = $_GET['status'];
        if($status == 3)
        {
            $data = $this->db->query("SELECT id_dompet, nama_user, jumlah_inginkan, status, foto FROM dompet, user WHERE dompet.id_user = user.id_user")->result_array();
        }
        else
        {
            $data = $this->db->query("SELECT id_dompet, nama_user, jumlah_inginkan, status, foto FROM dompet, user WHERE dompet.id_user = user.id_user AND dompet.status = '$status'")->result_array();
        }
        if(!empty($data))
        {
            $no = 1;
             foreach($data as $row){
             ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $row['nama_user']?></td>
                <td><?= $row['jumlah_inginkan']?></td>
                <td><?php if ($row['status'] == 0) {
                  echo '<div class="badge badge-primary badge-pill">Pending</div>';
                } elseif ($row['status'] == 1) {
                  echo '<div class="badge badge-success badge-pill">Aktif</div>';
                }elseif ($row['status'] == 2) {
                  echo '<div class="badge badge-danger badge-pill">Cancel</div>';
                }
                 ?></td>
                <td><img src="<?=base_url('uploads/topup/') . $row['foto']?>" alt="foto" width="100"></td>
                <td>
                <a href="<?php echo base_url("admin/verif_topup_detail/" .$row['id_dompet']);?>"
                     class="btn btn-sm btn-primary btn-circle">
                    <i class="fas fa-plus"></i>
                  </a>
                </td>
            </tr>
             <?php }?> <?php  
        }
        else
        {
            ?>
                <tr><td colspan="6" align="center">Tidak ada data</td></tr>
            <?php
        }  
    }
}