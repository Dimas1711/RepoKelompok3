<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Lokasi extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_Lokasi' , 'lokasi');
    }
    public function index_get(){
        $provinsi = $this->lokasi->provinsi();
        if ($provinsi) {
            $this->response([
                'status' => TRUE,
                'data' => $provinsi
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Provinsi Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    


}