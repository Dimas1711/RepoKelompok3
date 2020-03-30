<?php 

class Artikel_model extends CI_Model{
    public function getArtikel($id = null){
        if ($id === null) {
            return $this->db->get('artikel')->result_array();
        } else {
            return $this->db->get_where('artikel',['id' => $id])->result_array();
        }
    }
    public function getDelete($id){
        $this->db->delete('artikel' , ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function create($data){
        $this->db->insert('artikel',$data);
        return $this->db->affected_rows();
    }
    public function update($data ,$id){
        $this->db->update('artikel' , $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}