<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;
class Riwayat extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_riwayat' , 'riwayat');
    }
    public function index_get(){
        $id = $this->get('id_user');

        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Id User Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->riwayat->index($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }

     
    }
}