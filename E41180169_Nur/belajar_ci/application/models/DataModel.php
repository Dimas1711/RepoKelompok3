<?php
class DataModel extends CI_Model {// mengextends CI_Model
public function getData () {
    $Data = array (
        'nama' => 'Frengki',
        'status' => 'Mahasiswa',
        'website' => 'http://frengk.ky'
    );
    return $Data;
}
}
?>