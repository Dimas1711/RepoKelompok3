
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ubah Artikel</h1>
    <form action="" method="post">
    <?php foreach($artikel as $a){?>
    
        <div>
            <label for="judul">Judul :</label><br>
            <input type="text" id="judul" name="judul" value="<?php echo $a->judul;?>">
        </div>
        <div>
            <label for="penulis">penulis :</label><br>
            <input type="text" id="penulis" name="penulis" value="<?php echo $a->penulis;?>">
        </div>
        <div>
            <label for="isi">isi :</label><br>
            <textarea type="text" id="isi" cols="50" rows="8" name="isi"value=""><?php echo $a->isi;?></textarea>
        </div>
        <?php } ?>
        <button type="submit">Ubah Data</button>
        <button type="reset">Reset</button>
    </form>
    <a href="<?php echo base_url();?>">Kembali</a>
</body>
</html>