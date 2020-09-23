<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Notifikasi extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/User_Model');
    }
    //buat notifikasi kalo:
        //1 . Ada Kasus Baru
        //2 . Pembayaran di terima / ditolak
    public function index_post(){
        $id_user = $this->input->post('Id_User');
        $judul = $this->input->post('Judul');
        $body = $this->input->post('Body');
        $arr = [
            'Id_User' => $id_user,
            'Judul' => $judul,
            'Body' => $body,
            'CreatedDate' => date('Y-m-d H:i:s'),
        ]; 
        $cek = $this->User_Model->insert('notification', $arr);
        if($cek > 0 ){
            $to = $id_user;
            $data = array(
                'Id_User' => $id_user,
                'Judul' => $judul,
                'Body' => $body,
                'CreatedDate' => date('Y-m-d H:i:s'),
            );
            $this->sendPushNotification($to , $data);
            $response = [
                'status' => true,
                'pesan' => 'Notifikasi Berhasil',
            ];
            $this->response($response, 200);
        }else {
            $response = [
                'status' => false,
                'pesan' => 'Kirim Notif Gagal',
            ];
            $this->response($response, 404);
        }
    }
    public function sendPushNotification ($to= "" , $data=array()){
        $apiKey = 'AAAAO3q3hYM:APA91bEHyXSAtBcK1IGDWlHI02GBOUKxzggQr-3vhKwxMF8wB1uGYbfTmSlhVdGT1fgbQ-llelKMd8DBseaCelqj3ngZqu4ZrZY18_o3zbgnfdKLSJUTQpma5EQKLdXB6xqD-iO85wKt';
        $fields = array('to' => $to , 'notification' => $data);
        $headers = array ('Authorization: key='.$apiKey,'Content-Type:application/json');

        $url = 'https://android.googleapis.com/fcm/send';
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_POST, true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result , true);
    }


}