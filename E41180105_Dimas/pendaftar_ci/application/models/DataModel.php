<?php
class DataModel extends CI_Model
{
    public function getData()
    {
        $data = array(
            'nama' => 'Frengki',
            'status' => 'Mahasiswa',
            'website' => 'http://freng.ky'
        );
        return $data;
    }
}
?>