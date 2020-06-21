<?php 


    class Model_Berita extends CI_Model{
        
        public function getBerita($id = null){
            if ($id === null) {
                 return $this->db->get('berita')->result_array();
            }else {
                return $this->db->get_where('berita' , ['id_berita' => $id])->result_array();
            }
        }
        public function hapusberita($id){
            $this->db->delete('berita' , ['id_berita' => $id]);
            return $this->db->affected_rows();
        }
    }