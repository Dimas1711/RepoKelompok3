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
    public function index_get(){
        // $id_user = $this->input->post('Id_User');
        // $judul = $this->input->post('Judul');
        // $body = $this->input->post('Body');
        // $arr = [
        //     'Id_User' => $id_user,
        //     'Judul' => $judul,
        //     'Body' => $body,
        //     'CreatedDate' => date('Y-m-d H:i:s'),
        // ]; 
        // $cek = $this->User_Model->insert('notification', $arr);
        // if($cek > 0 ){
        //     $to = $id_user;
        //     $data = array(
        //         'Id_User' => $id_user,
        //         'Judul' => $judul,
        //         'Body' => $body,
        //         'CreatedDate' => date('Y-m-d H:i:s'),
        //     );
            // $this->pushNotif();
        //     $response = [
        //         'status' => true,
        //         'pesan' => 'Notifikasi Berhasil',
        //     ];
        //     $this->response($response, 200);
        // }else {
        //     $response = [
        //         'status' => false,
        //         'pesan' => 'Kirim Notif Gagal',
        //     ];
        //     $this->response($response, 404);
        // }
        define( 'API_ACCESS_KEY', 'YOUR-API-ACCESS-KEY-GOES-HERE' );
        $registrationIds = array('dzwgYN7b5Wo:APA91bHsGddf0WeF_vB330_QIXT6UWp7TSTM_hm9IbS8JRlS6mrvvcTSqClQAEq3dZH61_YuDt4lffHIiR5Lb-hOQqMDaaCM2xid_sxFnE0NWrKAHuDKzTYqSH0k493UCYJU60YvIopU');
        $msg = array
        (
            'message'   => 'here is a message. message',
            'title'     => 'Verifikasi Anda Telah Disetujui',
            'subtitle'  => 'This is a subtitle. subtitle',
            'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds, //dari last token yg diambil dari firebase instance get token (android)
            'data'          => $msg
        );
          
        $headers = array
        (
            //authorization ini dari firebase
            'Authorization: key= AAAA4t4vK14:APA91bFEftRAURBsiCFryQYsslg_vI4xH_IV1OS67_jgIX4mT0UKWDt6ZDjysMyIdDy22aIYZpgOnU07YJiBDkaupjO6bsb9FhJZk8pUUjsQZ6EF459M4lLqkXkDBi8I_y-S7GCVPc9y',
            'Content-Type: application/json'
        );
          
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;
    }
}