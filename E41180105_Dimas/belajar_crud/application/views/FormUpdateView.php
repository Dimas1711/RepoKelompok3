<h1>Ubah Artikel : </h1>
    <form action="" method="post">
    <div>
        <label for="judul">Judul :</label><br>
        <input type="text" name="judul" id="judul" value="<?= $artikel[0]->judul?>" >
       
    </div>
    <div>
        <label for="penulis">Penulis :</label><br>
        <input type="text" name="penulis" id="penulis" value="<?= $artikel[0]->penulis?>">
    </div>
    <div>
        <label for="isi">Isi :</label>
        <textarea name="isi" id="isi" cols="50" rows="8"><?= $artikel[0]->isi?></textarea>
    </div>
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
    </form>
    <a href="../../../">Kembali</a>

    
    
