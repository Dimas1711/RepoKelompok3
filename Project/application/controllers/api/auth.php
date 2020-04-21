<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller{

    public function index_post(){
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));

        $cek = $this->db->get_where('registrasi', ['email' => $email, 'password' => $password])->row_array();
        if ($cek > 0) {
            $res = [
                'status' => true,
                'pesan' => 'Login Berhasil',
                'data' => $cek
            ];
        } else {
            $res = [
                'status' => false,
                'pesan' => 'Login Gagal, Email / Password Salah',
                'data' => null
            ];
        }
        $this->response($res, 200);

    }
    
    
}



?>