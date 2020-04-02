<?php 
 
class Panti_model extends CI_Model{
	public function tampil_data_panti()
	{
		return $query = $this->db->query("SELECT * FROM panti WHERE status = 1")->result_array();
	}
}
?>