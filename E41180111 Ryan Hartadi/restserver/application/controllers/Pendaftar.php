<?php 
    
    require APPPATH . '/libraries/REST_Controller.php';
    use restserver\Libraries\REST_Controller;

    class Pendaftar extends REST_Controller{
        function __construct($config = 'rest'){

            parent::__construct($config);
            $this->load->database();
        }

        //menampilkan data pendaftar

        function index_get() {
            $id = $this->get('id');
            if ($id == '') {
                $pendaftar = $this->db->get('pendaftar')->result();
            } else {
                $this->db->where('id', $id);
                $pendaftar = $this->db->get('pendaftar')->result();
            }
            $this->response($pendaftar, 200);
        }

        function index_post(){
            $data = array(
                'id' => $this->post('id'),
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'pekerjaan' => $this->post('pekerjaan')
            );
            $insert = $this->db->insert('pendaftar',$data);
            if($insert){
                $this->response($data ,  200);
            } else {
                $this->response(array('status' => 'fail' , 502));
            }
        }

        function index_put(){
            $id = $this->put('id');
            $data = array(
                'id' => $this->put('id'),
                'nama' => $this->put('nama'),
                'email' => $this->put('email'),
                'pekerjaan' => $this->put('pekerjaan')
            );
            $this->db->where('id',$id);
            $update = $this->db->update('pendaftar' , $data);

            if($update){
                $this->response($data, 200);
            }else {
                $this->response(array ('status' => 'fail' , 502));
            }
        }

        function index_delete(){
            $id = $this->delete('id');
            $this->db->where('id' , $id);
            $delete = $this->db->delete('pendaftar');

            if ($delete) {
                $this->response(array(
                    'status' => 'success' 
                ),201);
            } else {
                $this->response(array (
                    'status' => 'failed'
                ),502);
            }
        }
    }



?>