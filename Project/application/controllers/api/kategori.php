<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;
class Kategori extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/model_kategori' , 'kat');
    }
    public function index_get(){
        $id = $this->get('id_kategori');

        if ($id === null){
            $kategori = $this->kat->index();
        }else{
            $kategori = $this->kat->index($id);
        }

        if ($kategori) {
            $this->response([
                'status' => TRUE,
                'data' => $kategori
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Kategori Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){
        $id = $this->delete('id_kategori');

        if ($id === null) {

                $this->response([
                    'status' => FALSE,
                    'message' => 'Silahkan masukkan id terlebih dahulu'
                ], REST_Controller::HTTP_BAD_REQUEST); 

            }else {
            
            if ($this->kat->hapuskategori($id) > 0) {
                $this->response([
                   'status' => TRUE,
                   'id_kategori' => $id,
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
        $data = [
            'kategori' => $this->post('kategori')
        ];

        if ($this->kat->insert($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Kategori Berhasil Ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal menambahkan Kategori baru'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
?>