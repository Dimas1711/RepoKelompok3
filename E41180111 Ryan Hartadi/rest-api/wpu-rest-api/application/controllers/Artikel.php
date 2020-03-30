<?php

    require APPPATH . '/libraries/REST_Controller.php';
    use Restserver\Libraries\REST_Controller;
    
    class Artikel extends REST_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Artikel_model');
        }
        function index_get(){
            $id = $this->get('id');

            if ($id === null) {
                $artikel = $this->Artikel_model->getArtikel();
            }else {
                $artikel = $this->Artikel_model->getArtikel($id);
            }
            if ($artikel) {
                $this->response([
                    'status' => TRUE,
                    'data' => $artikel
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }
        }
        function index_delete(){
            $id = $this->delete('id');

            if ($id === null){ // jika id === null
                $this->response([
                    'status' => FALSE,
                    'message' => 'Silahkan masukkan id terlebih dahulu'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            } else{
                // lalu akan mengecek apa kah id ada atau tidak
                if ($this->Artikel_model->getDelete($id) > 0){
                    //ok
                        $this->response([
                            'status' => TRUE,
                            'id' => $id,
                            'message' => 'Id berhasil dihapus'
                        ], REST_Controller::HTTP_OK);
       
                }else {
                    //gaada
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Id tidak ditemukan'
                    ], REST_Controller::HTTP_BAD_REQUEST); 
                }
            }
        }

        public function index_post(){
            $data = [
                'penulis' => $this->post('penulis'),
                'judul' => $this->post('judul'),
                'isi' => $this->post('isi')
            ];

            if($this->Artikel_model->create($data) > 0){
                $this->response([
                    'status' => TRUE,
                    'message' => 'Artikel Berhasil Ditambahkan'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal menambahkan artikel baru'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        public function index_put(){
            $id = $this->put('id');
            $data = [
                'penulis' => $this->put('penulis'),
                'judul' => $this->put('judul'),
                'isi' => $this->put('isi')
            ];

            if($this->Artikel_model->update($data , $id) > 0){
                $this->response([
                    'status' => TRUE,
                    'message' => 'Artikel Berhasil Di Ubah'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal Ubah artikel '
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    

?>