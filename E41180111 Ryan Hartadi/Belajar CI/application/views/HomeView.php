<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar CodeIgniter</title>
</head>
<body>
    <h1>Masukkan Data Diri Anda</h1>
    <!-- <p>
            Berikut ini adalah mahasiswa santuy:
    </p>
    Nama : <?php echo $data ["nama"];?> <br>
    Status : <?php echo $data ["status"];?><br>
    Website : <?php echo $data ["website"];?> --> 


    <h1>upload gambar</h1>
<?php
echo $error;
if($data)
{
    ?>
    <h3>Gambar Berhasil di upload</h3>
    <img src="./gambar/<?php echo $data ["file_name"];?>" width="200">
    <?php
}
?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="gambar" id="gambar"/>
<button type="submit">upload</button>
</body>
</html>