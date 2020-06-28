<div class="container-fluid">
<div class="well well-lg">
    <div class="container">
        <h2>List Verifikasi Top up para Donatur</h2>
        <span>Halaman yang berisi list verifikasi top up dompet untuk para Donatur</span>
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
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>foto</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($dompet as $row) {
                ?>
                  <tr>
                      <td><?= $no++?></td>
                      <td><?= $row['nama_user']?></td>
                      <td><?= $row['jumlah_inginkan']?></td>
                      <td>
                      <?php if ($row['status'] == 0) {
                        echo '<div class="badge badge-primary badge-pill">Pending</div>';
                      }
                      ?>
                      </td>
                      <td><img src="<?=base_url('uploads/topup/') . $row['foto']?>" alt="foto" width="100"></td>
                      <td>
                      <a href="<?php echo base_url("admin/verif_topup_detail/" .$row['id_dompet']);?>"
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