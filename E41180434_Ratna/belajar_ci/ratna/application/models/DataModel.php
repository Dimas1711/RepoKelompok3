<?php
class DataModel extends CI_Model { //meextend CI_Model
    public function getData () {
        $Data = array (
            'nama' => 'Ratna',
            'status' => 'Mahasiswa',
            'alamat' => 'Blitar'
        );
        return $Data;
    }
}
?>