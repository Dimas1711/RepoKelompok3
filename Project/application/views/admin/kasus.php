<div class="well well-lg">
    <div class="container">
        <h2>List Donasi</h2>
        <span>Halaman yang berisi list hasil donasi </span>
    </div>
</div>
<div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panti</th>
                        <th>Kategori</th>
                        <th>Tanggal Permohonan</th>
                        <th>Tenggat Waktu</th>
                        <th>Target Dana</th>
                        <th>Jumlah Pendonasi</th>
                        <th>Jumlah Uang Terkumpul</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                     foreach($kasus as $row){
                     ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $row['nama_panti']?></td>
                        <td><?= $row['kategori']?></td>
                        <td><?= $row['tanggal']?></td>
                        <td><?= $row['tenggat_waktu']?></td>
                        <td><?= $row['tujuan_dana']?></td>
                        <td><?= $row['jumlah_pendonasi']?></td>
                        <td><?= $row['jumlah_uang_terkumpul']?></td>
                        <td><?php if ($row['is_active'] == 0) {
                            echo '<div class="badge badge-primary badge-pill">Pending</div>';
                            } elseif ($row['is_active'] == 1) {
                            echo '<div class="badge badge-success badge-pill">Berlangsung</div>';
                            }
                            elseif ($row['is_active'] == 2) {
                                echo '<div class="badge badge-danger badge-pill">Batas Waktu Habis</div>';
                            }
                            ?></td>
                    </tr>
                     <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

