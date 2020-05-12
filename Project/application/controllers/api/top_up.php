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
        $this->load->model('api/Model_kasus' , 'topup');
    }

    public function index_post(){
        $token = base64_encode(random_bytes(32));
        // $id_dompet = $token;
        $id_user = $this->input->post('id_user');
        $jumlah = $this->input->post('jumlah_inginkan');
        $foto = $this->input->post('foto');
        
        $arr = [
            'id_dompet' => urlencode($token),
            'id_user' => $id_user,
            'jumlah_inginkan' => $jumlah,
            'foto' => '',
            'tanggal' => date("Y-m-d"),
            'status' => 0,
        ];
        $cek = $this->topup->insert('dompet', $arr);
   /// todo :: ini untuk ambil data dari user dompet yg sekarang
        $dompet = $this->topup->top_up($id_user);
        $www = $dompet['finansial'];

        /// ini untuk ambil saldo setelah di top up di tb dompet
        
        $cektopup = $this->topup->cekdompet(urlencode($token));
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