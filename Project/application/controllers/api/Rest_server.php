<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_Server extends CI_Controller {

    public function index()
    {

        $this->load->view('rest_server');
    }
}
