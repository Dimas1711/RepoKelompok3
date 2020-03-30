<?php
defined('BASEPATH') or exit('No direct script access allowed');
    class Auth extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
        }
        public function login(){
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['title'] = "Login";
                $this->load->view('templates/auth_header',$data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            }else {
                $this->_login();
            }
        }

        private function _login()
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            //lakukan pengecekan apakah email dari user ada
            $user = $this->db->get_where('registrasi', ['email' => $email])->row_array();
           
            if ($user) { //jika user active
                if ($user['is_actived'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                        ];
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 1) {
                            redirect('admin');
                        } else {
                            redirect('panti');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Wrong password !
                        </div>');
                        redirect('auth/login');
                    }
                }   else if ($user['is_actived'] == 0) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                        ];
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 2) {
                            // redirect('admin');
                            echo "panti";
                        } 
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Wrong password !
                        </div>');
                        redirect('auth/login');
                    }
                }
                else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    This email has not been activated!
                    </div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email Not Register
                </div>');
                redirect('auth/login');
            }
        }
        public function registration(){
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[registrasi.email]', [
                'is_unique' => 'Email Already Registered!'
            ]);
            $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[3]|matches[pass2]', [
                'matches' => 'Password Dont Match!',
                'min_length' => 'Password too short'
            ]);
            $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');
            if ($this->form_validation->run() == false) {
                    $data['title'] = "Registration";
                    $this->load->view('templates/auth_header',$data);
                    $this->load->view('auth/register');
                    $this->load->view('templates/auth_footer');
            }else {
                $data = [
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_actived' => 0,
                    'nama' => $this->input->post('name'),
                    'create_at' => time()
                ];
                $this->db->insert('registrasi', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your Account has been success created!
            </div>');
                redirect('auth/login');
            }
        }
        public function logout()
        {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your account has been logged out!
            </div>');
            redirect('auth/login');
        }
    }
    ?>