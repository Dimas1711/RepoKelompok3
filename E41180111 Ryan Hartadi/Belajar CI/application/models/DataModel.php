<?php 

class DataModel extends CI_Model{
    public function getData(){
        $data = array (
            'nama' => 'Ryan',
            'status' => 'Mahasiswa',
            'website' => 'https://optima.evoindo.com'
        );
        return $data;
    }
}

?>