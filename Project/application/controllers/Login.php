<?php

    class Login extends CI_Controller{
        public function index(){
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }
    }