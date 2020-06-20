<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Data_User extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('api/Model_User' , 'user');
    }
    public function index_get()
    {
        $id = $this->get('id_registrasi');
        
     
        $user = $this->user->index($id);
 
        if ($user) {
            $this->response([
                'status' => TRUE,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        $id = $this->put('id_registrasi');
        $data = [
            'nama_user' => $this->put('nama_user'),
            'alamat' => $this->put('alamat'),
            'no_telp' => $this->put('no_telp'),
            'email' => $this->put('email'),
            'no_rekening' => $this->put('no_rekening'),
            'nama_rekening' => $this->put('nama_rekening'),
            'nama_bank' => $this->put('nama_bank'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'tempat_lahir' => $this->put('tempat_lahir'),
            'nik' => $this->put('nik'),
            'pekerjaan' => $this->put('pekerjaan'),
            'finansial' => $this->put('finansial')
        ];
        if($this->user->updateUser($data, $id) > 0)
        {
            $this->response([
                'status' => 'true',
                'message' => 'User telah di update'
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => FALSE,
                'message' => 'User gagal di update'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function put_email()
    {
        $id = $this->put('id_registrasi');
        $data = [
            'email' => $this->put('email')
        ];
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

    public function index_post()
    {
        $id = $this->input->post('id_registrasi');
        $profil = $_FILES['profil']['name'];
     
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = '5000';
        $config['upload_path'] = '././uploads/akun';
        
        $this->load->library('upload' , $config);
        if ($this->upload->do_upload('profil')) {
            $data = [
                'profil' => $profil
            ];
        if($this->user->updateUserFoto($data, $id) > 0)
        {
            $this->response([
                'status' => 'true',
                'message' => 'Foto User telah di update'
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => FALSE,
                'message' => 'Foto User gagal di update'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        }
    }
    


}