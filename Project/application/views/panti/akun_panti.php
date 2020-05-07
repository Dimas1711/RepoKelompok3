<div class="well well-lg">
    <div class="container"> 
        <h2>Akun Panti</h2>
        <span>Halaman yang berisi informasi panti.</span>
    </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
         <?php foreach($akun as $a){?>
            <table >
                <tr>
                    <td rowspan="3"><img src="<?= base_url("uploads/panti/"). $a['foto']?>" alt="gambar"></td>
                    <td><h5><?= $a['nama_panti']?></h5></td>
                </tr>
                <tr>
                    <td ><h5><?= $a['email']?></h5></td>
                </tr>
                <tr>
                    <td><h5><?= $a['tanggal_berdiri']?></h5></td>
                </tr>
            </table>
         <?php }?>
        </div>
    </div>
</div>