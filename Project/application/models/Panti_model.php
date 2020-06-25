<?php 
 
class Panti_Model extends CI_Model
{
	public function index_get(){
        return $this->db->get_where('panti', [
            'status' => 1])->result_array();
    }
    public function insertdata($data = array()){
        return $this->db->insert('panti' , $data);
    }
    public function insertkasus($data = array()){
        return $this->db->insert('kasus' , $data);
    }
    public function detail($id){
        return $this->db->get_where('panti' , [
            'id_registrasi' => $id
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
    public function getDataPanti($id = null){
            return $this->db->get_where('panti' , ['id_registrasi' => $id])->result_array();
    }

    public function gantiDatapanti($data= array(),$id){
        $this->load->database();
        return $this->db->update("panti",$data , ["id_panti"=>$id]);
     }
}
?>