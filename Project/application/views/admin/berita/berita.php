<div class="well well-lg">
    <div class="container">
        <h2>Berita</h2>
        <span>Halaman yang berisi Berita Terkini </span>
    </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
        <div class="card-header py-3">
                <a href="<?= base_url('Berita/tambahberita') ?>"
                   class="btn btn-sm btn-info btn-icon-split shadow-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                  </span>
                  <span class="text">Tambah Berita</span>
                </a>

                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
              </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($berita as $b) {
                ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $b['judul'];?></td>
                        <td><?= $b['isi'];?></td>
                        <td><?= $b['tanggal_berita'];?></td>
                        <td><?= $b['gambar'];?></td>
                        <td>
                        <a href="<?php echo base_url("berita/detailberita/".$b['id_berita']);?>"
                             class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="<?php echo site_url("admin/komunitas/detail/");?>"
                             class="btn btn-sm btn-success btn-circle">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo site_url("admin/komunitas/detail/");?>"
                             class="btn btn-sm btn-danger btn-circle">
                            <i class="fas fa-trash"></i>
                        </a>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
