<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function tampil()
	{
        $this->load->view("template/sidebar");
        $this->load->view("template/header");
        $this->load->view("template/dashboard");
        $this->load->view("template/footer");
    }
}