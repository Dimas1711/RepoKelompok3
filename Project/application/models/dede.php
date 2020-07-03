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

        // public function hapusdata($id){
        //     $this->db->where('id_panti' , $id);
        //     return $this->db->delete('panti');
        // }

        function get_data_stok()
        {
            $query = $this->db->query("select count(is_active) from kasus WHERE is_active = 2 UNION ALL select count(is_active) from kasus WHERE is_active = 1 UNION ALL select count(is_active) from kasus WHERE is_active = 0
            ");
              
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data)
                {
                    $hasil[] = $data;
                }
                return $hasil;
            }
        }    
}