<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class update_email extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_user' , 'user');
    }

    public function index_put()
    {
        $id = $this->put('id_registrasi');
        $data = $this->put('email');
        if($this->user->updateEmail($data, $id) > 0)
        {
            $this->response([
                'status' => 'true',
                'message' => 'Email telah di update'
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => FALSE,
                'message' => 'Email gagal di update'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}