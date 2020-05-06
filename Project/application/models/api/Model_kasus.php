<?php 

    class Model_kasus extends CI_Model{

        // public function index(){
        //     // return $this->db->get('kasus')->result_array();
        // }
        public function index($id = null){
            if ($id === null) {
                 return $this->db->get('kasus')->result_array();
            }else {
                return $this->db->get_where('kasus' , ['id_kasus' => $id])->result_array();
            }
        }
        
    }

?>