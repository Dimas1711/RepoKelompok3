<?php 
 
class Verif_model extends CI_Model
{
	public function verif_data_panti_acc()
	{
		return $query = $this->db->query("SELECT * FROM panti WHERE status = 1")->result_array();
	}
	public function verif_data_panti_pending()
	{
		return $query = $this->db->query("SELECT * FROM panti WHERE status = 0")->result_array();
	}
	public function verif_data_panti_cancel()
	{
		return $query = $this->db->query("SELECT * FROM panti WHERE status = 2")->result_array();
	}
	
	public function verif_data_detail($id)
	{	
		// return $this->db->get_where('panti', ['id_panti' => $id])->result_array();
		$query = $this->db->query("SELECT * FROM panti, kabupaten, provinsi WHERE kabupaten.id_kabupaten = panti.id_kabupaten AND provinsi.id_provinsi = panti.id_provinsi AND kabupaten.id_provinsi = provinsi.id_provinsi AND panti.id_panti = $id")->result_array();
		return $query;
	}
	
	public function ubah_status_setuju($id)
	{
		$this->db->where('id_panti', $this->input->post('id_panti'));
		$this->db->update('panti', ['status' => 1]);
		$this->db->where('id_registrasi', $this->input->post('id_regis'));
		$this->db->update('registrasi', ['status' => 1]);
	}
	
	public function ubah_status_tolak($id)
	{
		$this->db->where('id_panti', $this->input->post('id_panti'));
		$this->db->update('panti', ['status' => 2]);
		$this->db->where('id_registrasi', $this->input->post('id_regis'));
		$this->db->update('registrasi', ['status' => 0]);
    }
}
?>