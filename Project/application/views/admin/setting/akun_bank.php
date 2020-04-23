<div class="well well-lg">
    <div class="container">
        <h2>Data Bank Admin</h2>
        <span>Halaman yang berisi Data Bank Admin</span>
      
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
                  <span class="text">Tambah Data Bank</span>
                </a>
                <div class="col mt-4">
                <?php echo $this->session->flashdata('pesan')?>
                </div>
              </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Rekening</th>
                        <th>Nomor Rekening</th>
                        <th>Nama Bank</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($admin as $b) {
                ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $b['nama_rekening'];?></td>
                        <td><?= $b['no_rekening'];?></td>
                        <td><?= $b['nama_bank'];?></td>
                        <td>
                        <a href="<?php echo base_url("admin/detail_setting/".$b['id_admin']);?>"
                             class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="<?php echo base_url("admin/edit_bank/".$b['id_akun']);?>"
                             class="btn btn-sm btn-success btn-circle">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="#"
                             onclick="confirm_modal('<?= 'berita/hapus/'.$b['id_admin'] ?>')"
                             class="btn btn-sm btn-danger btn-circle"
                             data-toggle="modal" data-target="#hapusModal">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?</h5>
                          <button class="close" type="button" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke Panel Admin.</div>
                        <div class="modal-footer">
                          <button class="btn btn-info" type="button" data-dismiss="modal">Batal</button>
                          <a id="delete_link" class="btn btn-danger" href="">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
                function confirm_modal(delete_url) {
                    $('#hapusModal').modal('show', {
                        backdrop: 'static'
                    });
                    document.getElementById('delete_link').setAttribute('href', delete_url);
                }
            </script>
    </div>
