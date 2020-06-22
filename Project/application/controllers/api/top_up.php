<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;
class Top_Up extends REST_Controller{

    public function __construct(){
        parent ::__construct();
        $this->load->model('api/Model_Kasus' , 'topup');
    }

    public function index_post(){
        $id_user = $this->input->post('id_user');
        $jumlah = $this->input->post('jumlah_inginkan');
        $kode = $this->topup->buat_kode();

        $foto = $_FILES['foto']['name'];
     
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = '5000';
        $config['upload_path'] = '././uploads/topup';
        
        $this->load->library('upload' , $config);
        if ($this->upload->do_upload('foto')) {
        $arr = [
            'id_dompet' => $kode,
            'id_user' => $id_user,
            'jumlah_inginkan' => $jumlah,
            'foto' => $foto,
            'tanggal' => date("Y-m-d"),
            'status' => 0,
        ];
            if ($this->topup->insert('dompet', $arr)) {
                $response = [
                    'status' => true,
                    'pesan' => 'Top Up Berhasil , Tunggu Konfirmasi dari Admin',
                ];
                $this->response($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'pesan' => 'Top Up Gagal',
                ];
                $this->response($response, 200);
            }
      
            }
        
   /// todo :: ini untuk ambil data dari user dompet yg sekarang
        $dompet = $this->topup->top_up($id_user);
        $www = $dompet['finansial'];

        /// ini untuk ambil saldo setelah di top up di tb dompet
        
        $cektopup = $this->topup->cekdompet($kode);
        $qq = $cektopup['jumlah_inginkan'];

        $akhir = $www + $qq;
        // echo $akhir;
        if($cektopup['status'] == 1){
            $this->db->set('finansial' , $akhir);
            $this->db->where('id_user' , $id_user);
            $this->db->update('user');
        }else{
            $response = [
                'status' => true,
                'pesan' => 'Top Up Berhasil , Tunggu Konfirmasi dari Admin',
            ];
            $this->response($response, 200);
        }
        
       

       

     
        // $res = [
        //     'status' => true,
        //     'hasil' => $akhir
        // ];
        // $this->response($res, 200);


    }
    
}