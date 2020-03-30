<?php

    class Auth extends CI_Controller{
        public function login(){
            $data['title'] = "Login";
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }
        public function registration(){
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
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
    }