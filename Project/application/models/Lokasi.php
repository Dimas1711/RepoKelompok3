<?php 

    class Lokasi extends CI_Model{

            public function getprovinsi(){
                $this->load->database();
                $hasil=$this->db->query("SELECT * FROM provinsi");
                return $hasil;
            }

            public function getkabupaten($id){
                $hasil=$this->db->query("SELECT * FROM kabupaten WHERE id_provinsi='$id'");
                return $hasil->result();
            }

    }

?>