<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller{

    public function __construct() {
        parent::__construct();
        // Load User Model
        $this->load->model('api/User_model', 'UserModel');
    }

    // public function index_post(){
    //     $email = $this->input->post('email', true);
    //     $password = md5($this->input->post('password', true));

    //     $login = $this->db->get_where('registrasi', ['email' => $email , 'password' => $password])->row_array();
    //     if ($login) {
    //         $res = [
    //             'status' => true,
    //             'pesan' => 'Login Berhasil',
    //             'data' => $login
    //         ];
    //     } else {
    //         $res = [
    //             'status' => false,
    //             'pesan' => 'Login Gagal , Email / Password Anda Salah',
    //         ];
    //     }
    //     $this->response($res, 200);

    // }

    // 1. perbandingan function atasss ,kalo atas gabisa make md5 
    // 2. nama function gak bisa diubah
    // 3. jwt token

    public function index_post(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]');

        if ($this->form_validation->run() == false) {
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );

            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }else {
            $email = $this->input->post('Email');
            $password = md5($this->input->post('Password'));
            // Load Login Function
            $output = $this->UserModel->user_login($email,$password);
            if (!empty($output) AND $output != FALSE)
            {
                // Load Authorization Token Library
                $this->load->library('Authorization_Token');

                // Generate Token
                $token_data['id_registrasi'] = $output->id_registrasi;
                $token_data['email'] = $output->email;
                $token_data['password'] = $output->password;
                $token_data['role_id'] = $output->role_id;
                $token_data['is_actived'] = $output->is_actived;
                $token_data['nama'] = $output->nama;
                $token_data['create_at'] = $output->create_at;

                $user_token = $this->authorization_token->generateToken($token_data);

                $data = [
                    'id_registrasi' => $output->id_registrasi,
                    'email' => $output->email,
                    'role_id' => $output->role_id,
                    'is_actived' => $output->is_actived,
                    'nama' => $output->nama,
                    'created_at' => $output->created_at,
                    'token' => $user_token,
                ];

                // Login Success
                $message = [
                    'status' => true,
                    'data' => $data,
                    'message' => "User login successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else
            {
                // Login Error
                $message = [
                    'status' => FALSE,
                    'message' => "Invalid Username or Password"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    
    
}



?>