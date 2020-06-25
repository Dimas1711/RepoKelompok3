<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Update_Password extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_User' , 'user');
    }

    public function index_get()
    {

    }


    public function index_put()
    {
        $id = $this->put('id_registrasi');
        $password = $this->put('password');
        $passkonf = $this->put('passkonf');
        $passwordbaru = $this->put('passwordbaru');
        
        // if(md5($password) == $passlama)
        // {
            if(md5($passwordbaru) != md5($password))
            {
                if(md5($passwordbaru) == md5($passkonf))
                {
                    if($this->user->updatePass(md5($password),md5($passwordbaru), $id) > 0)
                    {
                        $this->response([
                            'status' => 'true',
                            'message' => 'password berhasil di ubah'
                        ], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        $this->response([
                            'status' => 'false',
                            'message' => 'password gagal di ubah'
                        ], REST_Controller::HTTP_OK);
                    }
                }
                else
                {
                    $this->response([
                        'status' => 'false',
                        'message' => 'password konfirmasi salah'
                    ], REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response([
                    'status' => 'false',
                    'message' => 'password telah digunakan'
                ], REST_Controller::HTTP_OK);
            }
        // }
        // else
        // {
        //     $this->response([
        //         'status' => 'false',
        //         'message' => 'password salah'
        //     ], REST_Controller::HTTP_OK);
        // }
    }
}