<?php 
 
class Panti_model extends CI_Model
{
	public function insertdata($data = array()){
        $this->load->database();
        return $this->db->insert("panti" , $data);
    }
    public function data_panti(){
        
    }
}
?>