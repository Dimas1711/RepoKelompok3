<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Account_Finansial extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_User' , 'user');
    }
    public function index_get()
    {
        $id = $this->get('id_akun');
        
        if ($id === null){
            $user = $this->user->getAcc();
        }else{
            $user = $this->user->getAcc($id);
        }
        
        if ($user) {
            $this->response([
                'status' => TRUE,
                'data' => $user,
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ada Akun'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
}