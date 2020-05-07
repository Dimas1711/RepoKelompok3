<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;
class Top_Up extends REST_Controller{

    public function Top_Up{
        $id = this->get('id_user');
        $query = this->db->query("SELECT finansial FROM user WHERE id_user = '$id'");
        console.log($query);
    }
}