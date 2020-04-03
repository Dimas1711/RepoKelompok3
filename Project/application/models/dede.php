<?php
class Dede extends CI_Model 
{ 
    public function get() 
    {
        $this->load->database();
        return $this->db->get("user")->result();
    }

    public function detail ($id_user)
    {
        $this->load->database();
        $this->db->where("id_user", $id_user);
        return $this->db->get("user")->result();
    }

    public function delete ($id_user)
        {
            $this->load->database();
            $this->db->where("id_user", $id_user);
            return $this->db->delete("user");
        }
}