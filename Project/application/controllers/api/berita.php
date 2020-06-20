<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

    class Berita extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('api/Model_Berita' , 'berita');
        }

        public function index_get(){

            $id = $this->get('id_berita');
            // $output = $this->berita->getBerita();
            if ($id === null){
                $berita = $this->berita->getBerita();
            }else{
                $berita = $this->berita->getBerita($id);
            }
            if ($berita) {
                $this->response([
                    'status' => TRUE,
                    'data' => $berita,
                ], REST_Controller::HTTP_OK);
            }else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak Ada Berita'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        public function index_delete(){
            $id = $this->delete('id_berita');
           
            if ($id === null) {

                $this->response([
                    'status' => FALSE,
                    'message' => 'Silahkan masukkan id terlebih dahulu'
                ], REST_Controller::HTTP_BAD_REQUEST); 

            }else {

               if ($this->berita->hapusberita($id) > 0) {
                 $this->response([
                    'status' => TRUE,
                    'id_berita' => $id,
                    'message' => 'berhasil dihapus'
                ], REST_Controller::HTTP_OK);

               } else {

                $this->response([
                    'status' => false,
                    'message' => 'Id tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);

               }
            }
        }

        public function index_post(){
            
        }


    }