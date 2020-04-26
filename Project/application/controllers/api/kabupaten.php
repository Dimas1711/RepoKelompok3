<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class kabupaten extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_Lokasi' , 'lokasi');
    }
    public function index_get(){
        $kabupaten = $this->lokasi->kabupaten();
        if ($kabupaten) {
            $this->response([
                'status' => TRUE,
                'data' => $kabupaten
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'kabupaten Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}