<div class="container-fluid">
<div class="well well-lg">
    <div class="container">
        <h2>List Kasus Donasi</h2>
        <span>Halaman yang berisi list kasus donasi</span>
    </div>
</div>
<div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panti</th>
                        <th>Judul</th>
                        <th>Target Dana</th>
                        <th>Jumlah Uang Terkumpul</th>
                        <th>Tenggat Waktu</th>
                        <th>Status Donasi</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                    $no = 1;
                    foreach ($kasus as $row){  
                    ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $row['nama_panti']?></td>
                            <td><?= $row['judul']?></td>
                            <td><?= $row['tujuan_dana']?></td>
                            <td><?= $row['jumlah_uang_terkumpul']?></td>
                            <td><?= $row['tenggat_waktu']?></td>
                            <td><?php if ($row['is_active'] == 0) {
                            echo '<div class="badge badge-primary badge-pill">Belum Berlangsung</div>';
                            } elseif ($row['is_active'] == 1) {
                            echo '<div class="badge badge-success badge-pill">Berlangsung</div>';
                            }
                            elseif ($row['is_active'] == 2) {
                                echo '<div class="badge badge-danger badge-pill">Batas Waktu Habis</div>';
                            }
                            ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url("panti/kasus_detail/" .$row['id_kasus']);?>"
                                class="btn btn-sm btn-primary btn-circle">
                                <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>




