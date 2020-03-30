<?php 

// $mahasiswa = [
//     [
//         "nama" => "Ryan Hartadi",
//         "umur" => 20,
//         "NIM" => "E41180111",
//         "Jurusan" => "Teknologi Informasi",
//         "hobby" => [
//             "coding",
//             "programming"
//         ],
     
//         "Doi" => "Agastya Amaranthine"
//     ],
//     [
//         "nama" => "Ryan Hartadi",
//         "umur" => 20,
//         "NIM" => "E41180111",
//         "Jurusan" => "Teknologi Informasi",
//         "hobby" => [
//             "coding",
//             "programming"
//         ],
     
//         "Doi" => "Agastya Amaranthine"
//         ]
// ];

$dbh = new PDO('mysql:host=localhost;dbname=belajar_ci' , 'root' , '');
$db = $dbh->prepare('SELECT * FROM pegawai');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;


?>