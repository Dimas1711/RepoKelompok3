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
        $this->load->model('api/User_Model', 'UserModel');
    }

    public function index_post(){
        $this->form_validation->set_rules('token', 'Token', 'required');
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
                
                //load token
                $this->load->library('Authorization_Token');
                //generate
                $token_data['id_registrasi'] = $output->id_registrasi;
                $token_data['email'] = $output->email;
                $token_data['role_id'] = $output->role_id;
                $token_data['is_actived'] = $output->is_actived;
                $token_data['nama'] = $output->nama;
                $token_data['create_at'] = $output->create_at;
                $token_data['status'] = $output->status;
                $token_data['last_token'] = $output->last_token;    
                $tokenku = $this->authorization_token->generateToken($token_data);

                $id_user =  $output->id_registrasi;
                $getDetail = $this->UserModel->detail($id_user);
                $www = $getDetail['last_token'];

                $last_tokennya = $this->input->post('token');

                $this->db->set('last_token' , $last_tokennya);
                $this->db->where('id_registrasi' , $id_user);
                $this->db->update('registrasi');

                $return_data = [
                    'id_registrasi' => $output->id_registrasi,
                    'email' => $output->email,
                    'role_id' => $output->role_id,
                    'is_actived' => $output->is_actived,
                    'nama' => $output->nama,
                    'create_at' => $output->create_at,
                    'status' => $output->status,
                    'token' => $tokenku,
                    'last_token' =>$last_tokennya,
                    'pesan' => 'Selamat Datang di Aplikasi Donasi',
                   
                ];

                $message = [
                    'status' => true,
                    'data' => $return_data,
                  
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else {
                $message = [
                    'status' => false,
                    'pesan' => "Invalid Username / Password"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
       
    }
    
    
}



?>