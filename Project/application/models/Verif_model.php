<?php 
 
class Verif_model extends CI_Model
{
	public function verif_data_panti()
	{
		return $query = $this->db->get('panti')->result_array();
	}
	
	public function verif_data_detail($id)
	{	
		return $this->db->get_where('panti', ['id_panti' => $id])->result_array();
	}
	
	public function ubah_status_setuju($id)
	{
		$this->db->where('id_panti', $this->input->post('id_panti'));
		$this->db->update('panti', ['status' => 1]);
	}
	
	public function ubah_status_tolak($id)
	{
		$this->db->where('id_panti', $this->input->post('id_panti'));
		$this->db->update('panti', ['status' => 2]);
    }
}
?>