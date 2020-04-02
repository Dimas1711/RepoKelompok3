<?php 
 
class Verif_model extends CI_Model
{
	public function verif_data_panti()
	{
		return $query = $this->db->get('panti')->result_array();
    }
}
?>