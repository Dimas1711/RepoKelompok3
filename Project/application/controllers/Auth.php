<?php
defined('BASEPATH') or exit('No direct script access allowed');
    class Auth extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Verif_Model' , 'v');
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
            $password = md5($this->input->post('password'));
    
            //lakukan pengecekan apakah email dari user ada
            $user = $this->db->get_where('registrasi', ['email' => $email])->row_array();
           
            if ($user) { //jika user active
                if ($user['is_actived'] == 1) {
                    if ($password === $user['password']) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                            'id_registrasi' => $user['id_registrasi'],
                        ];
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 1) {
                            redirect('admin');
                        }
                        else if($user['role_id'] == 3)
                        {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Please Login as User From Android !
                        </div>');
                        redirect('auth/login');
                        } 
                        else {
                            if ($user['status'] == 1) {
                                redirect('panti');
                            }else {
                                redirect('panti/dashboard_panti');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Wrong password !
                        </div>');
                        redirect('auth/login');
                    }
                }   else if ($user['is_actived'] == 0) {
                    // if (password_verify($password, $user['password'])) {
                    //     $data = [
                    //         'email' => $user['email'],
                    //         'role_id' => $user['role_id'],
                    //     ];
                    //     $this->session->set_userdata($data);
                    //     if ($user['role_id'] == 2) {
                    //         redirect('panti');
                    //         // echo "panti";
                    //     } 
                    // } else {
                    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    //     Wrong password !
                    //     </div>');
                    //     redirect('auth/login');
                    // }
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    This email has not been activated!
                    </div>');
                    redirect('auth/login');
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
            $kode = $this->v->buat_kode();
            if ($this->form_validation->run() == false) {
                    $data['title'] = "Registration";
                    $this->load->view('templates/auth_header',$data);
                    $this->load->view('auth/register');
                    $this->load->view('templates/auth_footer');
            }else {
                $email = $this->input->post('email');
                $data = [
                    'id_registrasi' => $kode,
                    'email' => $email,
                    'password' => md5($this->input->post('pass1')),
                    'role_id' => 2,
                    'is_actived' => 0,
                    'nama' => $this->input->post('name'),
                    'create_at' => time()
                ];

                //siapkan token dulu 
                $token = base64_encode(random_bytes(32));

                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('registrasi', $data);
                $this->db->insert('token', $user_token);

                $this->_sendEmail($token , 'verify');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your Account has been success created . Please Active Your Account!
            </div>');
                redirect('auth/login');
            }
        }
        public function _sendEmail($token , $type){
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'donasiyatimk3@gmail.com',
                'smtp_pass' => 'IbanezRG1',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
            ];
            // $this->load->library('email' , $config);
            $this->email->initialize($config);
            $this->email->from('donasiyatimk3@gmail.com','Donasi Panti');//pengirim
            $this->email->to($this->input->post('email'));//ditujukann
            if ($type == 'verify') {

                $this->email->subject('Account Verification');
                $this->email->message('Click this link to verify your account : <a href="'.base_url() . 'auth/verify?email=' .$this->input->post('email').'&token=' .urlencode($token).'">Active</a>');
            }else if ($type == 'forgot') {
                $this->email->subject('Forgot Password');
                $this->email->message('Click this link to reset your password : <a href="'.base_url() . 'auth/resetPassword?email=' .$this->input->post('email').'&token=' .urlencode($token).'">Reset Password</a>');
        
            }

            if ($this->email->send()) {
                return true;
            }else {
                echo $this->email->print_debugger();
                die;
            }
        }

        public function verify(){

            $email = $this->input->get('email');
            $token = $this->input->get('token');
            
            $user = $this->db->get_where('registrasi' , ['email' => $email])->row_array();

            if ($user) {
                $user_token = $this->db->get_where('token' , ['token' => $token])->row_array();

                if ($user_token) {
                   if (time() - $user_token['date_created'] < (60*60*24)) {
                       
                        $this->db->set('is_actived' , 1);
                        $this->db->where('email' ,$email);   
                        $this->db->update('registrasi');

                        $this->db->delete('token', ['email' => $email]);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        '. $email .'Has Been Activated Please Login !.
                        </div>');
                        redirect('auth/login');

                   }else{
                       
                       $this->db->delete('registrasi', ['email' => $email]);
                       $this->db->delete('token', ['email' => $email]);


                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Account Activation failed! Wrong Token
                        </div>');
                        redirect('auth/login');
                   }
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Account Activation failed! Wrong Token
                    </div>');
                    redirect('auth/login');
                }
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account Activation failed! Wrong Email
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
        public function forgot_password(){

            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            if ($this->form_validation->run() === false) {
                $data['title'] = "Forgot Password";
                $this->load->view('templates/auth_header',$data);
                $this->load->view('auth/forgot_password');
                $this->load->view('templates/auth_footer');
            }else {

                $email = $this->input->post('email');
                $user = $this->db->get_where('registrasi' , ['email' => $email , '  is_actived' => 1])->row_array();

                if ($user) {
                    $token = base64_encode(random_bytes(32));

                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];
    
                    $this->db->insert('token', $user_token);
                    $this->_sendEmail($token , 'forgot');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Please check your email to reset your password!
                    </div>');
                    redirect('auth/forgot_password');
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Your Account not Registered or Your Account not Activated
                    </div>');
                    redirect('auth/login');
                }
            }
          
        }

        public function resetPassword(){

            $email = $this->input->get('email');
            $token = $this->input->get('token');

            $user = $this->db->get_where('registrasi' , ['email' => $email])->row_array();

            if ($user) {
                $user_token = $this->db->get_where('token' , ['token' => $token])->row_array();

                if ($user_token) {
                    
                    $this->session->set_userdata('reset_email' , $email);
                    $this->changePassword();
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset Password Failed ! Wrong Token
                    </div>');
                    redirect('auth/login');
                }
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset Password Failed ! Wrong Email
                </div>');
                redirect('auth/login');
            }
        }
        public function changePassword(){

            if (!$this->session->userdata('reset_email')) {
                redirect('auth/login');
            }
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password Dont Match!',
                'min_length' => 'Password too short'
            ]);
            $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
            if ($this->form_validation->run() == false) {
                $data['title'] = "Change Password";
                $this->load->view('templates/auth_header',$data);
                $this->load->view('auth/reset_password');
                $this->load->view('templates/auth_footer');
            }else {
                $password = md5($this->input->post('password1'));
                $email = $this->session->userdata('reset_email');

                $this->db->set('password' , $password);
                $this->db->where('email' , $email);
                $this->db->update('registrasi');

                $this->session->unset_userdata('reset_email');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password Has Been change , Please Login!
                </div>');
                redirect('auth/login');
            }
           
        }
        
    }
    ?>