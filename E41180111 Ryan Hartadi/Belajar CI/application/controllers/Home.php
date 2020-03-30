<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
 
    public function index(){
        
        // echo "Selamat Datang";
            // $this->load->model('DataModel');
            // $dataArr = $this->DataModel->getData();
                // untuk menampung getData()
            // echo "Nama :" .$dataArr["nama"]. '<br>';
            // echo "Status :" .$dataArr["status"]. '<br>';
            // echo "Website :" .$dataArr["website"]. '<br>';
            // $this->load->view('HomeView' , array("data" => $dataArr));

            // $this ->load->helper("html");
            // echo heading ('Selamat Datang!' , 1);
            // echo ul(array(
            //     'kesatu',
            //     'kedua',
            //     'ketiga'
            // ));

            // echo ol(array(
            //     'kesatu',
            //     'kedua',
            //     'ketiga'
            // ));
            // $this->load->helper("number");
            // echo 'Ukuran GB : ' . byte_format(4512244422). '<br>';
            // echo 'Ukuran MB : ' . byte_format(52245023). '<br>';
            // echo 'Ukuran kB : ' . byte_format(145023). '<br>';
            // $this->load->helper("url");
            // echo site_url() . '<br>'; // lokasi web
            // echo base_url() . '<br>'; // lokasi folder
            // echo current_url() . '<br>'; //url yg sedang dibuka

            // echo anchor ('http://google.com' , 'google.com') . '<br>';
            // //membuat URL
            // echo anchor ('http://polije.ac.id' , 'polije.ac.id') . '<br>';

            // $this->load->helper("form");
            // echo form_open ('/');
            // echo form_label ('Nama : ') .'<br>';
            // echo form_input ('nama') .'<br>';
            // echo form_label ('Alamat : ') .'<br>';
            // echo form_textarea ('alamat') .'<br>';
            // echo form_submit('submit' , 'Kirim Data');
            // echo form_close();

            // $this->load->helper("belajar_helper");
            // tampilkanTebal ("Polije SIP <br>"); 
            // tampilkanMiring ("Jurusan TIF <br>");
            // tampilkanBergaris ("2020 UWU <br>");
            
            // if ($this->input->method() == "post") {
            //    echo "nama : " . $this->input->post("nama"). '<br>';
            //    echo "email : " . $this->input->post("email"). '<br>';
               
            // }
            // $this->load->view("HomeView");

            // $error = "";
            // $data = "";

            // if ($this->input->method() == "post") {
            //     $config ['upload_path'] = "./gambar/";
            //     $config ['allowed_types'] = 'gif|jpg|png';
            //     $config ['max_size'] = 100;
            //     $config ['max_width'] = 1024;
            //     $config ['max_height'] = 768;

            //     $this->load->library('upload' , $config);

            //     if (!$this->upload->do_upload('gambar')) {
            //         $err = $this->upload->display_errors();
            //     } else {
            //         $data = $this->upload->data();
            //     }
            // }
            // $this->load->view("HomeView" , array(
            //     'error' => $error,
            //     'data' => $data
            // ));
                 //memanggil library session
        $this->load->library("session");
        //set session
        $this->session->set_userdata("nama","politeknik");
        //show session
        echo 'nama anda : ' .$this->session->userdata("nama");
        echo '<br>session di hapus</br>';
        //hapus session nama
        $this->session->unset_userdata("nama");
        echo 'nama anda : ' .$this->session->userdata("nama");
        
        }
}

?>