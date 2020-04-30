<div class="container-fluid">
<div class="well well-lg">
    <div class="container">
        <h2>List Kasus Detail</h2>
        <span>Halaman yang berisi list pendonasi </span>
    </div>
</div>
<div class="card-body">
<a href="<?php echo base_url('panti/listKasusPanti') ?>" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-reply"></i>
                </span>
                <span class="text">Kembali</span>
              </a>
              <div class="table-responsive">
            <table class="table table-bordered mt-3" id="tabel_verif">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tujuan Dana</th>
                        <th>Jumlah Uang Terkumpul</th>
                        <th>Tenggat Waktu</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                    foreach ($kasus as $row){  
                    ?>
                        <tr>
                            <td><?= $row['judul']?></td>
                            <td><?= $row['tujuan_dana']?></td>
                            <td><?= $row['jumlah_uang_terkumpul']?></td>
                            <td><?= $row['tenggat_waktu']?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <h3>List Pendonasi</h3>
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="tabel_verif">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendonasi</th>
                        <th>Jumlah Donasi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                    $no = 1;
                    foreach ($donasi as $row){  
                    ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $row['nama_user']?></td>
                            <td><?= $row['jumlah_donasi']?></td>
                            <td><?= $row['tanggal']?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>
    
</div>




