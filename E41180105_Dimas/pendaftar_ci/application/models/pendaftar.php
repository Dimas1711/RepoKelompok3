<?php
class Pendaftar extends CI_Model
{
    public function get()
    {
        $this->load->database();
        return $this->db->get("pendaftar")->result();
    }
    public function getRandom()
    {
        $this->load->database();
        $this->db->order_by("id", "RANDOM");
        $this->db->limit(4);
        return $this->db->get("pendaftar")->result();
    }
    public function detail($id)
    {
        $this->load->database();
        $this->db->where("id", $id);
        return $this->db->get("pendaftar")->result();
    }
    public function insert($data = array())
    {
        $this->load->database();
        return $this->db->insert("pendaftar", $data);
    }
}
?>