<div class="well well-lg">
    <div class="container">
        <h2>List Verifikasi Donasi</h2>
        <span>Halaman yang berisi list verifikasi donasi panti yang butuh donasi</span>
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
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td><?php if ($row['status'] == 0) {
                          echo '<div class="badge badge-primary badge-pill">Pending</div>';
                        } elseif ($row['status'] == 1) {
                          echo '<div class="badge badge-warning badge-pill">Aktif</div>';
                        }elseif ($row['status'] == 2) {
                          echo '<div class="badge badge-danger badge-pill">Cancel</div>';
                        }
                         ?></td>
                        <td>
                        <a href="<?php echo base_url("admin/verif_kasus_detail/" .$row['id_kasus']);?>"
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

