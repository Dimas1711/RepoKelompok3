<h1>Ubah Artikel</h1>
<form method="post">
<div>
    <label for="judul">Judul :</label><br>
    <input type="text" id="judul" value="<?php echo $berubah[0]->judul;?>" name="judul">
</div>
<div>
    <label for="penulis">Penulis :</label><br>
    <input type="text" id="penulis" value="<?php echo $berubah[0]->penulis;?>" name="penulis">
</div>
<div>
    <label for="isi">isi</label><br>
    <textarea name="isi" id="isi"value="<?php echo $berubah[0]->isi;?> cols="50" rows="8">
</textarea>
</div>
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>
<a href="../../">Kembali</a>