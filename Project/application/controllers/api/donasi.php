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

        $arr = [
            'id_donasi' => urlencode($token),
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

        if ($www < $jumlah_donasi) {
            $response = [
                'status' => false,
                'pesan' => 'Donasi Gagal , Silahkan Top Up Terlebih Dahuu',
            ];
        }else{
            $cek = $this->donasi->insert('donasi', $arr);
            $updatejumlahsaldo = $www - $jumlah_donasi;
            $updateuangterkumpul = $zzz + $jumlah_donasi;

            //update saldo user

            $this->db->set('finansial' , $updatejumlahsaldo);
            $this->db->where('id_user' , $id_user);
            $this->db->update('user');

            //tambah ke kasus finansial nya

            $this->db->set('jumlah_uang_terkumpul',$updateuangterkumpul);
            $this->db->where('id_kasus' , $id_kasus);
            $this->db->update('kasus');

            $response = [
                'status' => true,
                'pesan' => 'Donasi Berhasil',
            ];
           
        }
        $this->response($response, 200);
    }


}