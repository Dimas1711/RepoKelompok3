<?php 
 
class Topup_Model extends CI_Model
{
    public function tampil_verif_topup()
	{
		return $query = $this->db->query("SELECT id_dompet, nama_user, jumlah_inginkan, status, foto FROM dompet, user WHERE dompet.id_user = user.id_user")->result_array();
    }
}
?>