<?php 
 
class Panti_model extends CI_Model
{
	public function index_get(){
        return $this->db->get('panti')->result_array();
    }
    public function insertdata($data = array()){
        return $this->db->insert('panti' , $data);
    }
    public function detail($id){
        return $this->db->get_where("panti" , [
            'id_panti' => $id
        ])->result_array();
    }
    public function hapusdata($id){
        $this->db->where('id_panti' , $id);
        return $this->db->delete('panti');
    }
    public function update($data= array(),$id){
        $this->load->database();
        return $this->db->update("panti",$data , ["id_panti"=>$id]);
     }
}
?>