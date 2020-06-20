<?php 
 
class Kasus_Model extends CI_Model
{
    public function tampil_kasus()
    {
        return $query = $this->db->query("SELECT kasus.id_kasus, kasus.judul, panti.nama_panti, kategori.kategori, kasus.tujuan_dana, kasus.tenggat_waktu, kasus.tanggal, kasus.jumlah_pendonasi, kasus.jumlah_uang_terkumpul FROM kasus, panti, kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori AND kasus.status = 1")->result_array();
    }
    public function tampil_verif_kasus()
	{
		return $query = $this->db->query("SELECT kasus.id_kasus, kasus.judul, kasus.gambar, panti.nama_panti, kategori.kategori, kasus.status FROM kasus,panti,kategori WHERE kasus.id_panti = panti.id_panti AND kasus.id_kategori = kategori.id_kategori")->result_array();
    }
    public function total_kasus() 
    {
        return $query = $this->db->query("SELECT * FROM kasus WHERE status = '1'")->result_array();
    }
}
?>