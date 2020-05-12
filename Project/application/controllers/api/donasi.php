<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;
class Donasi extends REST_Controller{

    public function __construct(){
        parent ::__construct();
        $this->load->model('api/Donasi_Model' , 'donasi');
    }
    public function index_post(){
        $token = base64_encode(random_bytes(32));
        
        $id_user = $this->input->post('id_user');
        $id_kasus = $this->input->post('id_kasus');
        $jumlah_donasi = $this->input->post('jumlah_donasi');
        $kode = $this->donasi->buat_kode();
        $arr = [
            'id_donasi' => $kode,
            'id_user' =>  $id_user,
            'id_kasus' => $id_kasus,
            'jumlah_donasi' => $jumlah_donasi,
            'tanggal' => date("Y-m-d"),
            'status' => 1,
        ];
        $dompet = $this->donasi->saldosekarang($id_user);
        $www = $dompet['finansial'];

        $kasus = $this->donasi->kasus($id_kasus);
       
        $zzz = $kasus['jumlah_uang_terkumpul'];

        $id_panti = $kasus['id_panti'];
        $panti = $this->donasi->panti($id_panti);
        $finansial = $panti['finansial'];
       

        $jumlah_orang = $kasus['jumlah_pendonasi'];
        if ($www < $jumlah_donasi) {
            $response = [
                'status' => false,
                'pesan' => 'Donasi Gagal , Silahkan Top Up Terlebih Dahuu',
            ];
        }else{
            $cek = $this->donasi->insert('donasi', $arr);
            // echo $finansial;
            $updatejumlahsaldo = $www - $jumlah_donasi;
            $updatefinansial = $jumlah_donasi + $finansial;
            $updateuangterkumpul = $zzz + $jumlah_donasi;
            $updateorang = $jumlah_orang + 1;

            //update saldo user

            $this->db->set('finansial' , $updatejumlahsaldo);
            $this->db->where('id_user' , $id_user);
            $this->db->update('user');

            //tambah ke kasus finansial nya

            $this->db->set('jumlah_uang_terkumpul',$updateuangterkumpul);
            $this->db->where('id_kasus' , $id_kasus);
            $this->db->update('kasus');
            //jumlah donasi orangnya
            $this->db->set('jumlah_pendonasi',$updateorang);
            $this->db->where('id_kasus' , $id_kasus);
            $this->db->update('kasus');

            //update ke tb panti finansialnya
            $this->db->set('finansial',$updatefinansial);
            $this->db->where('id_panti' , $id_panti);
            $this->db->update('panti');

            $response = [
                'status' => true,
                'pesan' => 'Donasi Berhasil',
            ];
           
        }
        $this->response($response, 200);
    }


}