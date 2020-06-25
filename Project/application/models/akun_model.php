<?php 

    class Akun_Model extends CI_Model{

        public function detail($id){
            return $this->db->get_where("registrasi" , [
                'id_registrasi' => $id
            ])->result_array();
        }

        public function update($data= array(),$id){
            $this->load->database();
            return $this->db->update("registrasi",$data , ["id_registrasi"=>$id]);
         }

    }

?>