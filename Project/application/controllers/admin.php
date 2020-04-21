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
        $this->load->model('Kasus_model');
        $this->load->model('topup_model');
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

        $data['kasus'] = $this->Kasus_model->tampil_kasus();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/kasus",$data);
        $this->load->view("template/footer");
    }

    public function verif_kasus()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['kasus'] = $this->Kasus_model->tampil_verif_kasus();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/verif_kasus",$data);
        $this->load->view("template/footer");
    }

    public function verif_topup()
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $dataa['dompet'] = $this->topup_model->tampil_verif_topup();

        $this->load->view("template/sidebar");
        $this->load->view("template/header",$data);
        $this->load->view("admin/veriftopup",$dataa);
        $this->load->view("template/footer");
    }

    public function verif_kasus_detail($id)
    {
        $data['registrasi'] = $this->db->get_where('registrasi',
        ['email' => $this->session->userdata('email')])->row_array();

        $data['kasus'] = $this->Verif_model->verif_kasus_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_model->ubah_status_setuju_kasus($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan kasus donasi diterima !
            </div>');
            redirect('admin/verif_kasus');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_model->ubah_status_tolak_kasus($id);
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

        $dataa['dompet'] = $this->Verif_model->verif_topup_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_model->ubah_status_setuju_topup($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan top up donatur diterima !
            </div>');
            redirect('admin/verif_topup');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_model->ubah_status_tolak_topup($id);
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

        $data['panti'] = $this->Verif_model->verif_data_detail($id);

        if(isset($_POST['setuju']))
        {
            $this->Verif_model->ubah_status_setuju($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Persetujuan panti diterima !
            </div>');
            redirect('admin/verifikasi_panti');
        }
        else if(isset($_POST['tolak']))
        {
            $this->Verif_model->ubah_status_tolak($id);
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

    public function verifikasi_panti()
        {
            $data['registrasi'] = $this->db->get_where('registrasi',['email' => 
            $this->session->userdata('email')])->row_array();
            
            $verif_panti_acc['verif_acc'] = $this->Verif_model->verif_data_panti();
            $this->load->view("template/sidebar");
            $this->load->view("template/header",$data);
            $this->load->view("admin/verifpanti",$verif_panti_acc);
            $this->load->view("template/footer");
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
                 echo '<div class="badge badge-warning badge-pill">Aktif</div>';
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
                    onclick="confirm_modal('<?php echo 'komunitas/hapus/' ?>')"
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
            $data = $this->db->query("SELECT kasus.id_kasus, kasus.gambar, panti.nama_panti, kategori.kategori, kasus.status FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori")->result_array();
        }
        else
        {
            $data = $this->db->query("SELECT kasus.id_kasus, kasus.gambar, panti.nama_panti, kategori.kategori, kasus.status FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori AND kasus.status = '$status'")->result_array();
        }
        if(!empty($data))
        {
            $no = 1;
             foreach($data as $row){
             ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $row['nama_panti']?></td>
                <td><?= $row['kategori']?></td>
                <td><?php if ($row['status'] == 0) {
                  echo '<div class="badge badge-primary badge-pill">Pending</div>';
                } elseif ($row['status'] == 1) {
                  echo '<div class="badge badge-warning badge-pill">Aktif</div>';
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
                  echo '<div class="badge badge-warning badge-pill">Aktif</div>';
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