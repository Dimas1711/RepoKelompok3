<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $artikel[0]->judul;?></h1>
    <h3>Tanggal : <?php echo $artikel[0]->artikel;?> | Penulis : 
    <?php echo $artikel[0]->penulis?></h3>
    <div>
        <?php echo $artikel[0]->isi;?>
    </div>
    <a href="../../../">Kembali</a>
</body>
</html>