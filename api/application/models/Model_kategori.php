<?php 

    class Model_kategori extends CI_Model
    {
        public function index($id = null){
            if ($id === null){
                return $this->db->get('kategori')->result_array();
            }else {
                return $this->db->get_where('kategori' , ['id_kategori' => $id])->result_array();
            }
        }
        public function hapuskategori($id){
            $this->db->delete('kategori' , ['id_kategori' => $id]);
            return $this->db->affected_rows();
        }
        public function insert($data){
           $this->db->insert('kategori',$data);
           return $this->db->affected_rows();
        }
    }
    

?>