<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CRUD dengan CodeIgniter</h1>
    <h3><a href="index.php/home/tambah">+ Tambah Data</a></h3>

    <table border="1" cellpadding="5">
        <tr>
             <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Isi</th>
            <th>DateTime</th>
            <th>Aksi</th>
        </tr>
        <?php 
        foreach($artikel as $a){
        ?>
        <tr>
        <td><?php echo $a->id;?></td>
            <td><?php echo $a->judul;?></td>
            <td><?php echo $a->penulis;?></td> 
            <td><?php echo substr($a->isi ,0 , 70);?> ... </td>
            <td><?php echo $a->artikel;?></td>
            <td>
                <a href="<?php echo "index.php/home/detail/".$a->id;?>">Detail</a>
                <a href="<?php echo "index.php/home/ubah/".$a->id;?>">Ubah</a>
                <a href="<?php echo "index.php/home/hapus/".$a->id;?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>