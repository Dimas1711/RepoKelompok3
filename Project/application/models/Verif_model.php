<?php 
 
class Verif_Model extends CI_Model
{
	public function verif_data_panti()
	{
		return $query = $this->db->query("SELECT * FROM panti WHERE status = 0")->result_array();
	}
	
	public function verif_data_detail($id)
	{	
		$query = $this->db->query("SELECT * FROM panti, kabupaten, provinsi WHERE kabupaten.id_kabupaten = panti.id_kabupaten AND provinsi.id_provinsi = panti.id_provinsi AND kabupaten.id_provinsi = provinsi.id_provinsi AND panti.id_panti = $id")->result_array();
		return $query;
	}
	public function insertdata($data = array()){
		return $this->db->insert('akun_bank' , $data);
	}
	public function hapusdata($id){
		$this->db->where('id_akun' , $id);
		return $this->db->delete('akun_bank');
	}
	public function databank(){
		return $this->db->get('akun_bank')->result_array();
	}
	public function update_finansial($data= array(),$id){
		$this->load->database();
		return $this->db->update("akun_bank",$data , ["id_akun"=>$id]);
	 }
	public function detail_finansial($id){
		return $this->db->get_where("akun_bank" , [
			'id_akun' => $id
		])->result_array();
	}
	public function index_admin(){
		return $this->db->get('admin')->result_array();
	}
	public function detail_admin($id){
		return $this->db->get_where("admin" , [
			'id_admin' => $id
		])->result_array();
	}
	public function kategori()
    {
        return $query = $this->db->query("SELECT * FROM kategori")->result_array();
	}
	public function hapusdatapanti($id){
        // $this->db->where('id_registrasi' , $id);
		// return $this->db->delete('panti');
		$tables = array('panti', 'registrasi');
		$this->db->where('id_registrasi', $id);
		return $this->db->delete($tables);
    }
	public function buat_kode(){
        $this->db->select('RIGHT(registrasi.id_registrasi,3) as kode',FALSE);
        $this->db->order_by('id_registrasi', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('registrasi');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
        $kode_jadi="R00".$kode_max;
        return $kode_jadi;
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
	
	public function verif_kasus_detail($id)
	{
		return $query = $this->db->query("SELECT kasus.id_kasus, panti.nama_panti, kasus.judul, kategori.kategori, kasus.tujuan_dana, kasus.tanggal, kasus.tenggat_waktu, kasus.jumlah_pendonasi, kasus.jumlah_uang_terkumpul, kasus.deskripsi, kasus.gambar FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori AND kasus.id_kasus = $id")->result_array();
	}

	public function ubah_status_setuju_kasus($id)
	{
		$this->db->where('id_kasus', $this->input->post('id_kasus'));
		$this->db->update('kasus', ['status' => 1]);
		$this->db->update('kasus', ['is_active' => 1]);
	}

	public function ubah_status_tolak_kasus($id)
	{
		$this->db->where('id_kasus', $this->input->post('id_kasus'));
		$this->db->update('kasus', ['status' => 2]);
	}

	public function verif_topup_detail($id)
	{
		return $query = $this->db->query("SELECT * FROM dompet, user WHERE user.id_user = dompet.id_user AND dompet.id_dompet = '$id'")->result_array();
	}

	public function ubah_status_setuju_topup($id)
	{
		$this->db->where('id_dompet', $this->input->post('id_dompet'));
		$this->db->update('dompet', ['status' => 1]);
		$jumlah_inginkan = $this->input->post('jumlah_inginkan');
		$id_user = $this->input->post('id_user');
		$finansial = $this->input->post('finansial');
		$jumlah = $finansial + $jumlah_inginkan;
		$this->db->query("UPDATE user SET finansial = $jumlah WHERE id_user = $id_user");
	}

	public function ubah_status_tolak_topup($id)
	{
		$this->db->where('id_dompet', $this->input->post('id_dompet'));
		$this->db->update('dompet', ['status' => 2]);
	}
}
?>