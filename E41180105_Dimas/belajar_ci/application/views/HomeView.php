<!-- <h1>Selamat datang di website jurusan teknologi informasi</h1>
<p>
    Berikut ini mahasiswa bermasalah :
</p> -->

<!-- Nama : <?php echo $data["nama"];?><br>
Status : <?php echo $data["status"];?><br>
Website : <?php echo $data["website"];?><br> -->

<!-- <form action="post">
    <label for="nama">Nama</label><br>
    <input type="text" name="nama" id="nama"><br>
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email"><br>
    <button type="submit">Kirim</button>
</form> -->


<h1>upload gambar</h1>
<?php
echo $error;
if($data)
{
    ?>
    <h3>Gambar Berhasil di upload</h3>
    <img src="../gambar/<?php echo $data ["file_name"];?>" width="200">
    <?php
}
?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="gambar" id="gambar"/>
<button type="submit">upload</button>
</form>