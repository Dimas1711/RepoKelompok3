<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Registrasi extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('api/User_Model' , 'UserModel');
    }
    public function index_post(){
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $role_id = $this->input->post('role_id');
        $nama = $this->input->post('nama');

        $cek = $this->db->get_where('registrasi', ['email' => $email])->row_array();
        $kode = $this->UserModel->buat_kode();
        if ($cek > 0) {
            $response = [
                'status' => false,
                'message' => 'Email Telah Digunakan',
            ];
        }else {
            $arr = [
                'id_registrasi' => $kode,
                'email' => $email,
                'password' => $password,
                'role_id' => $role_id,
                'is_actived' => 1,
                'nama' => $nama,
                'create_at' => time(),
                'status' => 1,
            ];
            $user = [
                'id_registrasi' => $kode,
                'nama_user' => $nama,
                'alamat' => '',
                'no_telp' => '',
                'email' => $email,
                'no_rekening' => '',
                'nama_rekening' => '',
                'nama_bank' => '',
                'tanggal_lahir' => '',
                'jenis_kelamin' => '',
                'tempat_lahir' => '',
                'nik' => '',
                'pekerjaan' => '',
                'finansial' => 0,
            ];
            $cek = $this->UserModel->insert('registrasi', $arr);
            $cek = $this->UserModel->insert('user', $user);

            $response = [
                'status' => true,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($response, 200);
    }


}