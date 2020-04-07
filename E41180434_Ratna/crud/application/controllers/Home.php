<?php
// class Home extends CI_Controller { //mengextend CI_Controller
//     public function index () {
//         $this->load->model("UserModel");
//         $hapus = $this->UserModel->hapus(3);
//         if($hapus) {
//             echo "Hapus data berhasil cuy";
//         }

//praktek 3
/**$this->load->model("UserModel");
$ubah = $this->UserModel->ubah(array(
    'nama' =>'Ratna',
'email' => 'ratnadwi@gmail.com',
'alamat' => 'Blitar'), 1); ///id yang dipilih
if($ubah) {
    echo "ubah data berhasil";
}*/
//praktek 2
//$this->load->model("UserModel"); //memanggil UserModel
//$tambah = $this->UserModel->tambah(array(
    //data yang akan ditambahkan
//'nama' =>'Ratna',
//'email' => 'ratnadwi@gmail.com',
//'alamat' => 'Blitar'));
//if ($tambah) {
  //  echo "Tambah data berhasil";}
//echo '<pre>';
//print_r($this->UserModel->get());
//echo '</pre>';

//Praktek 1
/**$this->load->library('table'); //memanggil library table
$template = array (
    "table_open"=>"<table border=1 cellpadding=3>"
);
//set table template
$this->table->set_template($template);
$this->table->set_caption
("<h1>Menampilkan Table dengan HTML Table Class </h1>"); //caption
$data = array ( //data yang akan dimasukkan ke table 
    array ('Nama', 'Email', 'Jenis Kelamin'),
    array ('Ratna', 'ratnadwikristinasari27@gmail.com', 'Perempuan'),
    array ('Nafis', 'lestamanta@gmail.com', 'Laki Laki'),
    array ('Maul', 'maulidya@gmail.com', 'Perempuan'));
    echo $this->table->generate($data); //tampilkan tabel */
//contoh 8
      //memanggil library session
        /**$this->load->library("session");
        //set session
        $this->session->set_userdata("nama" , "Politeknik");
        //show session
        echo 'Nama Anda : ' . $this->session->userdata("nama");
        echo '<br>Session di hapus<br>';
        //hapus session nama
        $this->session->unset_userdata("nama");
        echo 'Nama Anda : ' . $this->session->userdata("nama");*/
//Contoh 7
     /**$error = "";
        $data = "";

        if ($this->input->method() == "post") {
            //konfigurasi
        $config ['upload_path'] = './gambar';
        $config ['allowed_types'] = 'gif|jpg|png';
        $config ['max_size'] = 1024;
        $config ['max_width'] = 1024;
        $config ['max_height'] = 768;
        //panggil library
        $this->load->library('upload' , $config);

        //cek apakah gagal upload
        if (!$this->upload->do_upload('gambar')) {
            $error = $this->upload->display_errors();
        }
        else { //jika file berhasil diupload
            $data  = $this->upload->data();

        }
        }
        $this->load->view("HomeView", array ('error'=> $error, 'data'=>$data));*/
//contoh 6
        //cek apakah method = post
     /**if($this->input->method() == "post") {
            //tampilkan data
           // echo "nama : ". $this->input->post ("nama"). '<br>';
            //echo  "email : ". $this->input->post ("email") ;
        }
        $this->load->view("HomeView");*/

        /**$this->load->helper ("belajar") ;
        tampilkanTabel ("Politeknik Negeri Jember <br>");
        tampilkanMiring ("Jurusan Teknologi Informasi <br>");
        tampilkanBergaris ("2020 <br>");*/
//contoh 5
      /**$this->load->helper ("form");
        echo form_open ('/');
        echo form_label ('Nama : ') . '<br>'; //membuat label
        echo form_input ('nama : ') . '<br>';  //membuat textbox
        echo form_label ('Alamat : ') . '<br>';//membuat label
        echo form_textarea ('alamat') . '<br>'; //membuat textbox
        echo form_submit('submit' , 'Kirim Data'); //membuat tabel
        echo form_close (); //menutup form */
//contoh 4
      /**$this->load->helper ("url"); //memanggil helper url
        echo site_url () . '<br>'; //lokasi website
        echo base_url (). '<br>'; //folder lokasi website
        echo current_url () . '<br>'; //url yang sedang dibuka
        echo anchor ('http://google.com', 'google.com') . '<br>';
        //membuat url
        echo anchor ('http://polije.ac.id', 'polije.ac.id');*/
//contoh 3
       /**$this->load->helper ("number"); //memanggil helper number
        echo 'Ukuran GB : ' . byte_format (4512244422) . '<br>';
        echo 'Ukuran GB : ' . byte_format (52245023) . '<br>';
        echo 'Ukuran GB : ' . byte_format (145023);*/
//contoh 2
    /**$this->load->helper ("html"); //memanggil helper html
    echo heading ('Selamat Datang!', 1); //heading
    echo ul (array ( //ol
        'kesatu',
        'kedua',
        'ketiga'
    )); */
//contoh 1
    //$this->load->model ("DataModel"); //memanggil DataModel
    //$dataArr = $this->DataModel->getData();
    //menampung fungsi getData()
   /**echo "nama : " . $dataArr["nama"] . '<br>';
    echo "status : " . $dataArr["status"] . '<br>';
    echo "alamat : " . $dataArr["alamat"] . '<br>'; */

    //$this->load->view ("HomeView", array ("data" => $dataArr)); //memanggil Homeview
?>