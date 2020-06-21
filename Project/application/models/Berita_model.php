<?php 

    class Berita_Model extends CI_Model{

        public function index_get(){
            return $this->db->get('berita')->result_array();
        }
        public function insertdata($data = array()){
            return $this->db->insert('berita' , $data);
        }
        public function detail($id){
            return $this->db->get_where("berita" , [
                'id_berita' => $id
            ])->result_array();
        }
        public function hapusdata($id){
            $this->db->where('id_berita' , $id);
            return $this->db->delete('berita');
        }
        public function update($data= array(),$id){
            $this->load->database();
            return $this->db->update("berita",$data , ["id_berita"=>$id]);
         }
    }

?>