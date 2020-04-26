<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Panti extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_Panti' , 'panti');
    }
    public function index_get(){
        $panti = $this->panti->index();
        if ($panti) {
            $this->response([
                'status' => TRUE,
                'data' => $panti
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Panti Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post(){}


}