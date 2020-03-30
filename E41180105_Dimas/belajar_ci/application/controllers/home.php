<?php
class Home extends CI_Controller
{
    public function index()
    {   
        $this->load->model("UserModel"); 
        $hapus = $this->UserModel->hapus(4);
        if ($hapus)
        {
            echo "hapus data berhasil";
        }



        // $this->load->model("UserModel"); 
        // $ubah = $this->UserModel->ubah(array(
        //     //data yang akan ditambahkan
        //     'nama' => 'agus', //data yang diubah
        //     'email' => 'agus@gmail.com',
        //     'alamat' => 'jember'),1); //id yang dipilih
        // if ($ubah)
        // {
        //     echo "ubah data berhasil";
        // }




        // $this->load->model("UserModel"); 
        // $tambah = $this->UserModel->tambah(array(
        //     //data yang akan ditambahkan
        //     'nama' => 'Andri',
        //     'email' => 'Andri@gmail.com',
        //     'alamat' => 'Ponorogo'
        // ));
        // if ($tambah)
        // {
        //     echo "tambah data berhasil";
        // }


        // $this->load->model("UserModel"); //memanggil UserModel
        // echo '<pre>';
        // print_r($this->UserModel->get());
        // echo '</pre>';

        // $this->load->library("table");
        // $template = array(
        //     "table_open"=>"<table border=1 cellpaddin=3>"
        // );

        // //set table template
        // $this->table->set_template($template);
        // $this->table->set_caption
        // ("<h1>Menampilkan table dengan HTML table class</h1>"); //caption
        // $data = array(
        //     array('nama','email','jenis kelamin'),
        //     array('Frengki','frengki@gmail.com','laki - laki'),
        //     array('lutfi','lutfi@gmail.com','laki - laki'),
        //     array('kholik','kholik@gmail.com','perempuan')
        // );
        // echo $this->table->generate($data);





        // //memanggil library session
        // $this->load->library("session");
        // //set session
        // $this->session->set_userdata("nama","politeknik");
        // //show session
        // echo 'nama anda : ' .$this->session->userdata("nama");
        // echo '<br>session di hapus</br>';
        // //hapus session nama
        // $this->session->unset_userdata("nama");
        // echo 'nama anda : ' .$this->session->userdata("nama");
        
        
        
        
    
        
            
            // $error = "";
            // $data = "";

            // if($this->input->method() == "post")
            // {
            //     //konfigurasi
            //     $config ['upload_path'] = './gambar/';
            //     $config ['allowed_types'] = 'gif|jpg|png';
            //     $config ['max_size'] = 100;
            //     $config ['max_width'] = 1024;
            //     $config ['max_height'] = 768;

            //     //panggil library
            //     $this->load->library('upload', $config);

            //     //cek apakah gagal upload
            //     if (!$this->upload->do_upload('gambar'))
            //     {
            //         $error = $this->upload->display_errors();
            //     }
            //     else
            //     {
            //         $data = $this->upload->data();
            //     }
            // }
            // $this->load->view("HomeView", array(
            //     'error' => $error,
            //     'data' => $data
            // ));




        // if($this->input->method() == "post")
        // {
        //     echo "nama : " . $this->input->post("nama") . '<br>';
        //     echo "email : " . $this->input->post("email") . '<br>';
        // }
        // $this->load->view("HomeView");




        // $this->load->helper("belajar");
        // tampilKanTebal("Politeknik Negeri Jember <br>");
        // tampilKanMiring("Jurusan Teknologi Informasi <br>");
        // tampilkanBergaris("2020");


        // $this->load->helper("form"); //memanggil helper form
        // echo form_open('/'); //membuka form
        // echo form_label('Nama : ') . '<br>'; //membuat label
        // echo form_input('nama') . '<br>'; //membuat textbox
        // echo form_label('Alamat') . '<br>'; //membuat label
        // echo form_textarea('alamat') . '<br>'; //membuat textarea
        // echo form_submit('submit', "Kirim Data"); //membuat tombol
        // echo form_close(); //menutup form



        // $this->load->helper("url"); //memanggil helper url
        // echo site_url() . '<br>'; //lokasi website
        // echo base_url() . '<br>'; //folder lokasi website
        // echo current_url() . '<br>'; //url yang sedang dibuka
        // echo anchor ('http://google.com', 'google.com') . '<br>';
        // //membuat url 
        // echo anchor ('http://polije.ac.id', 'polije.ac.id');




        // $this->load->helper("number");
        // echo "ukuran GB : " . byte_format(4512244422) . '<br>';
        // echo "ukuran MB : " . byte_format(52245023) . '<br>';
        // echo "ukuran KB : " . byte_format(145023);



        // $this->load->helper("html");
        // echo heading ("selamat datang", 1);
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



        // $this->load->model("DataModel");

        // $dataArr = $this->DataModel->getData();

        // // echo "nama  :" .$dataArr['nama']. "</br>"; 
        // // echo "status  :" .$dataArr['status']. "</br>";
        // // echo "website  :" .$dataArr['website']. "</br>";

        // $this->load->view("HomeView",array("data" => $dataArr));
    }
    
}
?>