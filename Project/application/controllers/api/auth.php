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
            $output = $this->UserModel->user_login($this->input->post('email'),$this->input->post('password'));
            
            if (!empty($output) AND $output != FALSE) {
                $return_data = [
                    'id_registrasi' => $output->id_registrasi,
                    'email' => $output->email,
                    'role_id' => $output->role_id,
                    'is_actived' => $output->is_actived,
                    'nama' => $output->nama,
                    'create_at' => $output->create_at,
                    'status' => $output->status,
                ];

                $message = [
                    'status' => true,
                    'data' => $return_data,
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else {
                $message = [
                    'status' => false,
                    'message' => "Login Gagal"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
       
    }
    
    
}



?>